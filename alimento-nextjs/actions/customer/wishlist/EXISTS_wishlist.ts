'use server';

import prismadb from '@/lib/prismadb';

export async function checkWishlistExists({
  customerId,
  dishId,
}: {
  customerId: string;
  dishId: string;
}): Promise<{ success: boolean; error?: string; exists: boolean }> {
  try {
    const existingwishlist = await prismadb.wishlist.findUnique({
      where: { customerId_dishId: { customerId, dishId } },
    });

    return { success: true, exists: !!existingwishlist };
  } catch (error) {
    console.error('[CHECK_wishlist_EXISTS_ERROR]', error);
    return { success: false, error: 'Error checking wishlist existence', exists: false };
  }
}
