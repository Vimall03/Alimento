'use server';
import { generateAndSendOTP } from '@/lib/auth';
import prismadb from '@/lib/prismadb';
import { Prisma, Customer } from '@prisma/client';

export async function CustomerVerify({
  email,
}: {
  email: string;
}): Promise<{ success: boolean; error?: string; data?: Customer }> {
  const exitingCustomer = await prismadb.customer.findUnique({
    where: {
      email: email,
    },
  });

  if (!exitingCustomer) {
    return {
      success: false,
      error: 'Customer does not exists',
    };
  }
  const resp = await generateAndSendOTP(email, 'customer');

  if (!resp) {
    return { success: false, error: 'Error occured in sending otp' };
  }

  return { success: true };
}
