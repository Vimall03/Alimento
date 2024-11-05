'use server';

import prismadb from '@/lib/prismadb';
import { Prisma, Vendor } from '@prisma/client';

export async function editVendor({
  id,
  name,
  email,
}: {
  id: string;
  name?: string;
  email?: string;
}): Promise<{ success: boolean; error?: string; data?: Vendor }> {
  // Check if all required fields are provided
  if (!id || !name || !email) {
    return {
      success: false,
      error: 'All fields (id, name, email, ) are required.',
    };
  }

  try {
    const updatedVendor = await prismadb.vendor.update({
      where: { id },
      data: {
        name,
        email,
      },
    });

    return { success: true, data: updatedVendor };
  } catch (error) {
    console.error('[EDIT_VENDOR_ERROR]', error);
    return { success: false, error: 'Error updating vendor details' };
  }
}
