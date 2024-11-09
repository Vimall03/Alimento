'use server';

import prismadb from '@/lib/prismadb';

export async function updateOrderStatus({
  orderId,
  status,
}: {
  orderId: string;
  status: 'PENDING' | 'IN_PROGRESS' | 'COMPLETED' | 'CANCELLED';
}): Promise<{ success: boolean; error?: string }> {
  try {
    await prismadb.order.update({
      where: { id: orderId },
      data: { status },
    });

    return { success: true };
  } catch (error) {
    console.error('[UPDATE_ORDER_STATUS_ERROR]', error);
    return { success: false, error: 'Error updating order status' };
  }
}
