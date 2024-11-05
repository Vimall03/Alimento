'use server';

import prismadb from '@/lib/prismadb';
import { Customer } from '@prisma/client';

export async function getCustomerById({
  id,
}: {
  id: string;
}): Promise<{ success: boolean; error?: string; data?: Customer }> {
  try {
    const Customer = await prismadb.customer.findUnique({
      where: { id },
    });

    if (!Customer) {
      return { success: false, error: 'Customer not found' };
    }

    return { success: true, data: Customer };
  } catch (error) {
    console.error('[GET_Customer_ERROR]', error);
    return { success: false, error: 'Error retrieving Customer' };
  }
}
