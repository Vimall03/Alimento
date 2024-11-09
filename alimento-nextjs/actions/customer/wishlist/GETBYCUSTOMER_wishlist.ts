'use server';

import prismadb from '@/lib/prismadb';
import { Wishlist, Image, Dish } from '@prisma/client';

// Interface for the Wishlist with Dish and Images
export interface WishlistWithDish extends Wishlist {
  dish: Dish & {
    images: Image[]; // Assuming images is an array of strings (URLs)
  };
}

export async function getWishlistsBycustomer({
  customerId,
}: {
  customerId: string;
}): Promise<{ success: boolean; error?: string; data?: WishlistWithDish[] }> {
  try {
    // Fetch Wishlists including related Dish data and images
    const Wishlists = await prismadb.wishlist.findMany({
      where: { customerId },
      include: {
        dish: {
          include: {
            images: true, // Include the images field from the Dish
          },
        },
      },
    });
    // console.log(Wishlists)
    return { success: true, data: Wishlists as WishlistWithDish[] };
  } catch (error) {
    console.error('[GET_WishlistS_BY_customer_ERROR]', error);
    return { success: false, error: 'Error fetching Wishlists' };
  }
}
