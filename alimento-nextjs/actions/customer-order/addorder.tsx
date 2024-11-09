'use server';

import prismadb from '@/lib/prismadb';

export async function createOrder({
  customerId,
  dishId,
  estimatedTimeOfArrival,
}: {
  customerId: string;
  dishId: string;
  estimatedTimeOfArrival: Date;
}): Promise<{ success: boolean; error?: string }> {
  try {
    await prismadb.order.create({
      data: {
        customerId,
        dishId,
        estimatedTimeOfArrival,
      },
    });

    return { success: true };
  } catch (error) {
    console.error('[CREATE_ORDER_ERROR]', error);
    return { success: false, error: 'Error creating order' };
  }
}
