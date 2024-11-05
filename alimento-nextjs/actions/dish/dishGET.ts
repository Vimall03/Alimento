'use server';

import prismadb from '@/lib/prismadb';
import { Dish } from '@prisma/client';

export async function getDishById({
  id,
}: {
  id: string;
}): Promise<{ success: boolean; error?: string; data?: Dish }> {
  try {
    const dish = await prismadb.dish.findUnique({
      where: { id },
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
