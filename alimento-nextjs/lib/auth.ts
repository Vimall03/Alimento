import CredentialsProvider from 'next-auth/providers/credentials';
import { NextAuthOptions } from 'next-auth';
import prismadb from './prismadb';
import sendEmail from './sendEmail';

// const prisma = new PrismaClient();

export const NEXT_AUTH_CONFIG: NextAuthOptions = {
  providers: [
    CredentialsProvider({
      name: 'Credentials',
      credentials: {
        email: { label: 'Email', type: 'text' },
        otp: { label: 'OTP', type: 'text' },
        role: { label: 'Role', type: 'text' },
      },
      async authorize(credentials) {
        if (!credentials?.email || !credentials?.otp || !credentials?.role) {
          throw new Error('Invalid credentials');
        }

        let account;
        if (credentials.role === 'customer') {
          account = await prismadb.customer.findUnique({
            where: { email: credentials.email },
          });
        } else {
          account = await prismadb.vendor.findUnique({
            where: { email: credentials.email },
          });
        }

        if (!account) {
          return null;
        }

        // Verify OTP
        if (credentials.otp !== account.otp) {
          // Assuming 'otp' field exists in your customer/vendor model
          return null;
        }

        const updateData = { otp: null };
        // Clear OTP after successful login
        if (credentials.role === 'customer') {
          await prismadb.customer.update({
            where: { email: credentials.email },
            data: updateData, // Reset OTP or delete it after use
          });
        } else {
          await prismadb.vendor.update({
            where: { email: credentials.email },
            data: updateData, // Reset OTP or delete it after use
          });
        }

        return {
          id: account.id,
          name: account.name,
          email: account.email,
          role: account.role == 'customer' ? 'customer' : 'vendor',
        };
      },
    }),
  ],
  secret: process.env.NEXTAUTH_SECRET,
  callbacks: {
    jwt: async ({ token, user }) => {
      if (user) {
        token.uid = user.id;
        token.role = user.role; // Store role in JWT token
      }
      return token;
    },
    session: async ({ session, token }) => {
      if (session.user) {
        session.user.id = token.uid;
        session.user.role = token.role; // Pass role to session
      }
      return session;
    },
  },
};


export const generateAndSendOTP = async (
  email: string,
  role: 'vendor' | 'customer'
) => {
  const otp = Math.floor(100000 + Math.random() * 900000).toString(); // Generate 6-digit OTP

  // Store OTP in the customer or vendor record

  if (role === 'customer') {
    try {
      await prismadb.customer.update({
        where: { email },
        data: { otp }, // Ensure 'otp' field exists in your customer model
      });
    } catch (err) {
      console.error(
        'DB Error sending OTP for customer:',
        err instanceof Error ? err.message : err
      );
      return false;
    }
  } else if (role === 'vendor') {
    try {
      await prismadb.vendor.update({
        where: { email },
        data: { otp },
      });
    } catch (err) {
      console.error(
        'DB Error sending OTP for vendor:',
        err instanceof Error ? err.message : err
      );
      return false;
    }
  }

  try {
    const response = await sendEmail({
      to: email,
      subject: 'Your OTP Code',
      text: `Your OTP code is ${otp}`,
      html: `<strong>Your OTP code is ${otp}</strong>`,
    });

    console.log('OTP email sent successfully:', response);
    return true;
  } catch (err) {
    console.error(
      'Error sending OTP:',
      err instanceof Error ? err.message : err
    );
    return false;
  }
};