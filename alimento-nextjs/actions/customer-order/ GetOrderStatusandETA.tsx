'use server';

import prismadb from '@/lib/prismadb';

export async function getOrderStatusAndETA({
  orderId,
}: {
  orderId: string;
}): Promise<{ success: boolean; data?: any; error?: string }> {
  try {
    const order = await prismadb.order.findUnique({
      where: { id: orderId },
      include: {
        dish: true,  // Include dish details
      },
    });

    if (!order) {
      return { success: false, error: 'Order not found' };
    }

    return { success: true, data: { status: order.status, eta: order.estimatedTimeOfArrival } };
  } catch (error) {
    console.error('[GET_ORDER_STATUS_ETA_ERROR]', error);
    return { success: false, error: 'Error fetching order status and ETA' };
  }
}
