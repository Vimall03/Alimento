'use server';

import prismadb from '@/lib/prismadb';
import { Vendor } from '@prisma/client';

export async function getVendorById({
  id,
}: {
  id: string;
}): Promise<{ success: boolean; error?: string; data?: Vendor }> {
  try {
    const vendor = await prismadb.vendor.findUnique({
      where: { id },
    });

    if (!vendor) {
      return { success: false, error: 'Vendor not found' };
    }

    return { success: true, data: vendor };
  } catch (error) {
    console.error('[GET_VENDOR_ERROR]', error);
    return { success: false, error: 'Error retrieving vendor' };
  }
}
