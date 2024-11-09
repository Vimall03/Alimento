'use server';

import prismadb from '@/lib/prismadb';

export async function getCustomerCurrentOrder({
  customerId,
}: {
  customerId: string;
}): Promise<{ success: boolean; data?: any; error?: string }> {
  try {
    const order = await prismadb.order.findFirst({
      where: {
        customerId,
        status: {
          in: ['PENDING', 'IN_PROGRESS'], // Fetch only active orders (pending or in progress)
        },
      },
      include: {
        dish: true,  // Include details of the ordered dish
        customer: true,  // Include customer details
      },
    });

    return { success: true, data: order };
  } catch (error) {
    console.error('[GET_CUSTOMER_CURRENT_ORDER_ERROR]', error);
    return { success: false, error: 'Error fetching current order' };
  }
}
