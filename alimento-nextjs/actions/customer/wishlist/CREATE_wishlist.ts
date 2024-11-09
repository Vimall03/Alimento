'use server';

import prismadb from '@/lib/prismadb';
import { Wishlist } from '@prisma/client';

export async function createWishlist({
  customerId,
  dishId,
}: {
  customerId: string;
  dishId: string;
}): Promise<{ success: boolean; error?: string; data?: Wishlist }> {
  try {
    const existingWishlist = await prismadb.wishlist.findUnique({
      where: { customerId_dishId: { customerId, dishId } },
    });

    if (existingWishlist) {
      return { success: false, error: 'Wishlist already exists' };
    }

    const Wishlist = await prismadb.wishlist.create({
      data: {
        customerId,
        dishId,
      },
    });

    return { success: true, data: Wishlist };
  } catch (error) {
    console.error('[CREATE_Wishlist_ERROR]', error);
    return { success: false, error: 'Error creating Wishlist' };
  }
}
    