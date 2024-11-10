
import CredentialsProvider from "next-auth/providers/credentials";
import { NextAuthOptions } from "next-auth";
import sendEmail from "@/lib/sendEmail"; // Ensure this points to your sendEmail function
import prismadb from "./prismadb";

// const prisma = new PrismaClient();

export const NEXT_AUTH_CONFIG: NextAuthOptions = {
  providers: [
    CredentialsProvider({
      name: "Credentials",
      credentials: {
        email: { label: "Email", type: "text" },
        otp: { label: "OTP", type: "text" },
        role: { label: "Role", type: "text" },
      },
      async authorize(credentials) {

        console.log(credentials+"controlp0")

        if (!credentials?.email || !credentials?.otp || !credentials?.role) {
          throw new Error("Invalid credentials");
        }

        console.log(credentials)

        console.log(credentials+"control1")
        let account;
        if (credentials.role === "customer") {
          account = await prismadb.customer.findUnique({
            where: { email: credentials.email },
          });
        } else if (credentials.role === "vendor"){
          account = await prismadb.vendor.findUnique({
            where: { email: credentials.email },
          });
        }else if (credentials.role === "admin"){
          account = await prismadb.admin.findUnique({
            where: { email: credentials.email },
          });
        }
        else{
          return null
        }

        console.log(account+"control2")

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
        if (credentials.role === "customer") {
          await prismadb.customer.update({
            where: { email: credentials.email },
            data: updateData, // Reset OTP or delete it after use
          });
        } else if(credentials.role === "vendor"){
          await prismadb.vendor.update({
            where: { email: credentials.email },
            data: updateData, // Reset OTP or delete it after use
          });
        }else if (credentials.role === "admin"){
          await prismadb.admin.update({
            where: { email: credentials.email },
            data: updateData, // Reset OTP or delete it after use
          });
        }
        else{
          return null
        }

        const role =  account.role == "customer" ? "customer" : account.role == "vendor"? "vendor" : "admin"

        return {
          id: account.id,
          name: account.name,
          email: account.email,
          role: role
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

// Function to generate and send OTP
export const generateAndSendOTP = async (
  email: string,
  role: string
) => {
  const otp = Math.floor(100000 + Math.random() * 900000).toString(); // Generate 6-digit OTP

  // Store OTP in the user or vendor record

  if (role === "user") {
    try {
      await prismadb.customer.update({
        where: { email },
        data: { otp }, // Ensure 'otp' field exists in your User model
      });
    } catch (err) {
      console.error(
        "DB Error sending OTP for user:",
        err instanceof Error ? err.message : err
      );
      return false;
    }
  } else if (role === "vendor") {
    try {
      await prismadb.vendor.update({
        where: { email },
        data: { otp }, // Ensure 'otp' field exists in your User model
      });
    } catch (err) {
      console.error(
        "DB Error sending OTP for vendor:",
        err instanceof Error ? err.message : err
      );
      return false;
    }
  }

  else if (role === "admin") {
    try {
      await prismadb.admin.update({
        where: { email },
        data: { otp }, // Ensure 'otp' field exists in your User model
      });
    } catch (err) {
      console.error(
        "DB Error sending OTP for admin:",
        err instanceof Error ? err.message : err
      );
      return false;
    }
  }

  try {
    const response = await sendEmail({
      to: email,
      subject: "Your OTP Code",
      text: `Your OTP code is ${otp}`,
      html: `<strong>Your OTP code is ${otp}</strong>`,
    });

    console.log("OTP email sent successfully:", response);
    return true;
    // Handle success response if needed (e.g., logging messageId)
  } catch (err) {
    console.error(
      "Error sending OTP:",
      err instanceof Error ? err.message : err
    );
    return false;
  }
};

// Call generateAndSendOTP(email) before redirecting to the login page to send OTP to the user
