'use server';

import prismadb from '@/lib/prismadb';

export async function deleteCustomer({
  id,
}: {
  id: string;
}): Promise<{ success: boolean; error?: string }> {
  try {
    await prismadb.customer.delete({
      where: { id },
    });

    return { success: true };
  } catch (error) {
    console.error('[DELETE_Customer_ERROR]', error);
    return { success: false, error: 'Error deleting Customer' };
  }
}
