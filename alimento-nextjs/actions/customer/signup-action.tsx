'use server';
import { generateAndSendOTP } from '@/lib/auth';
import prismadb from '@/lib/prismadb';
import { Prisma, Customer } from '@prisma/client';

export async function CustomerCreate({
  name,
  email,
}: {
  name: string;
  email: string;
}): Promise<{ success: boolean; error?: string; data?: Customer }> {
  
  const exitingCustomer = await prismadb.customer.findUnique({
    where: {
      email: email,
    },
  });

  if (exitingCustomer) {
    return {
      success: false,
      error: 'Customer already exists',
    };
  }

  try {
    const res = await prismadb.customer.create({
      data: {
        name: name,
        email: email,
      },
    });

    if (!res) {
      return { success: false, error: 'Error occured in Customer creation' };
    }

    const resp = await generateAndSendOTP(res.email, 'customer');

    if (!resp) {
      return { success: false, error: 'Error occured in sending otp' };
    }

    return { success: true, data: res };
  } catch (err) {
    if (err instanceof Prisma.PrismaClientKnownRequestError) {
      console.log(err.message);
    }
    return { success: false, error: 'An unexpected error occurred.' };
  }
}
