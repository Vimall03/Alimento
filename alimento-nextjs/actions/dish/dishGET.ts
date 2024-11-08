'use server';

import prismadb from '@/lib/prismadb';
import { Dish, Image } from '@prisma/client';

interface DishWithImage extends Dish{
  images:Image[]
}

export async function getDishById({
  id,
}: {
  id: string;
}): Promise<{ success: boolean; error?: string; data?: DishWithImage }> {
  try {
    const dish = await prismadb.dish.findUnique({
      where: { id },
      include:{
        images:true
      }
    });

    if (!dish) {
      return { success: false, error: 'Dish not found' };
    }

    return { success: true, data: dish };
  } catch (error) {
    console.error('[GET_DISH_ERROR]', error);
    return { success: false, error: 'Error retrieving dish' };
  }
}
