'use server';

import prismadb from '@/lib/prismadb';

export async function getOrderHistory({
  customerId,
  vendorId,
}: {
  customerId?: string;
  vendorId?: string;
}) {
  try {
    const orders = await prismadb.order.findMany({
      where: {
        ...(customerId ? { customerId } : {}),
        ...(vendorId ? { vendorId } : {}),
      },
      include: {
        customer: true,
        vendor: true,
      },
    });

    return {
      success: true,
      data: orders,
    };
  } catch (error) {
    console.error('[GET_ORDER_HISTORY_ERROR]', error);
    return { success: false, error: 'Error fetching order history' };
  }
}
