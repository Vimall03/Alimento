'use server';
import { generateAndSendOTP } from '@/lib/auth';
import prismadb from '@/lib/prismadb';
import { Prisma, Vendor } from '@prisma/client';

export async function VendorVerify({
  email,
}: {
  email: string;
}): Promise<{ success: boolean; error?: string; data?: Vendor }> {
  const exitingVendor = await prismadb.vendor.findUnique({
    where: {
      email: email,
    },
  });

  if (!exitingVendor) {
    return {
      success: false,
      error: 'Vendor does not exists',
    };
  }
  const resp = await generateAndSendOTP(email, 'vendor');

  if (!resp) {
    return { success: false, error: 'Error occured in sending otp' };
  }

  return { success: true };
}
