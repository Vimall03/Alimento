'use server';

import prismadb from '@/lib/prismadb';
import { Wishlist } from '@prisma/client';

export async function deleteWishlist({
  customerId,
  dishId,
}: {
  customerId: string;
  dishId: string;
}): Promise<{ success: boolean; error?: string; data?: Wishlist }> {
  try {
    if (!customerId || !dishId) {
      // console.log(customerId,dishId)
      return { success: false, error: 'Customer ID or Dish ID is missing.' };
    }
    const Wishlist = await prismadb.wishlist.delete({
      where: { customerId_dishId: { customerId, dishId } },
    });

    return { success: true, data: Wishlist };
  } catch (error) {
    console.error('[DELETE_Wishlist_ERROR]', error);
    return { success: false, error: 'Error deleting Wishlist' };
  }
}
