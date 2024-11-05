'use server';

import prismadb from '@/lib/prismadb';

export async function deleteVendor({
  id,
}: {
  id: string;
}): Promise<{ success: boolean; error?: string }> {
  try {
    await prismadb.vendor.delete({
      where: { id },
    });

    return { success: true };
  } catch (error) {
    console.error('[DELETE_VENDOR_ERROR]', error);
    return { success: false, error: 'Error deleting vendor' };
  }
}
