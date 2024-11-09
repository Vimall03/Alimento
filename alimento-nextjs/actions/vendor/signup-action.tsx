'use server';
import { generateAndSendOTP } from '@/lib/auth';
import prismadb from '@/lib/prismadb';
import { Prisma, Vendor } from '@prisma/client';

export async function VendorCreate({
  name,
  email,
}: {
  name: string;
  email: string;
}): Promise<{ success: boolean; error?: string; data?: Vendor }> {
  
  const exitingVendor = await prismadb.vendor.findUnique({
    where: {
      email: email,
    },
  });

  if (exitingVendor) {
    return {
      success: false,
      error: 'Vendor already exists',
    };
  }

  try {
    const res = await prismadb.vendor.create({
      data: {
        name: name,
        email: email,
      },
    });

    if (!res) {
      return { success: false, error: 'Error occured in Vendor creation' };
    }

    const resp = await generateAndSendOTP(res.email, 'vendor');

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
