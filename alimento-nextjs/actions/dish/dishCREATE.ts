'use server';

import prismadb from '@/lib/prismadb';
import { Dish, Category, Tag } from '@prisma/client';

export async function createDish({
  name,
  description,
  price,
  category,
  tags,
  vendorId,
  images,
}: {
  name: string;
  description?: string;
  price: number;
  category: Category;
  tags: Tag[];
  vendorId: string;
  images: string[]
}): Promise<{ success: boolean; error?: string; data?: Dish }> {
  try {
    const newDish = await prismadb.dish.create({
      data: {
        name,
        description,
        price,
        category,
        tags,
        vendorId,
        images: {
          create: images.map(url => ({ url })), // Assuming you're passing URLs
        },
      },
    });
    return { success: true, data: newDish };
  } catch (error) {
    console.error('[CREATE_DISH_ERROR]', error);
    return { success: false, error: 'Error creating dish' };
  }
}
