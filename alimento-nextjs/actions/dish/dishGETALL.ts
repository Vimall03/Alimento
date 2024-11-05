'use server';

import prismadb from '@/lib/prismadb';
import { Dish, Category, Tag } from '@prisma/client';

export async function getAllDishes({
  tags,
  categories,
}: {
  tags?: Tag[];
  categories?: Category[];
}): Promise<{ success: boolean; error?: string; data?: Dish[] }> {
  try {
    const dishes = await prismadb.dish.findMany({
      where: {
        AND: [
          tags ? { tags: { hasSome: tags } } : {},
          categories ? { category: { in: categories } } : {},
        ],
      },
    });

    return { success: true, data: dishes };
  } catch (error) {
    console.error('[GET_ALL_DISHES_ERROR]', error);
    return { success: false, error: 'Error retrieving dishes' };
  }
}
