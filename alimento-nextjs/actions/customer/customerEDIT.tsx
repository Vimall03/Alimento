'use server';

import prismadb from '@/lib/prismadb';
import { Prisma, Customer } from '@prisma/client';

export async function editCustomer({
  id,
  name,
  email,
}: {
  id: string;
  name?: string;
  email?: string;
}): Promise<{ success: boolean; error?: string; data?: Customer }> {
  // Check if all required fields are provided
  if (!id || !name || !email) {
    return {
      success: false,
      error: 'All fields (id, name, email, ) are required.',
    };
  }

  try {
    const updatedCustomer = await prismadb.customer.update({
      where: { id },
      data: {
        name,
        email,
      },
    });

    return { success: true, data: updatedCustomer };
  } catch (error) {
    console.error('[EDIT_Customer_ERROR]', error);
    return { success: false, error: 'Error updating Customer details' };
  }
}
