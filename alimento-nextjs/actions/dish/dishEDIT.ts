'use server';

import prismadb from '@/lib/prismadb';
import { Dish, Category, Tag } from '@prisma/client';

export async function editDish({
  id,
  name,
  description,
  price,
  category,
  tags,
  vendorId,
}: {
  id: string;
  name?: string;
  description?: string;
  price?: number;
  category?: Category;
  tags?: Tag[];
  vendorId: string;
}): Promise<{ success: boolean; error?: string; data?: Dish }> {
  try {
    const existingDish = await prismadb.dish.findUnique({
      where: { id },
    });

    if (!existingDish) {
      return { success: false, error: 'Dish not found' };
    }

    if (existingDish.vendorId !== vendorId) {
      return { success: false, error: 'Unauthorized: You do not own this dish' };
    }

    const updatedDish = await prismadb.dish.update({
      where: { id },
      data: {
        name,
        description,
        price,
        category,
        tags,
      },
    });

    return { success: true, data: updatedDish };
  } catch (error) {
    console.error('[EDIT_DISH_ERROR]', error);
    return { success: false, error: 'Error updating dish' };
  }
}
