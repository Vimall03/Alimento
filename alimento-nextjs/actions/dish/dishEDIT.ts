'use server';

import prismadb from '@/lib/prismadb';
import { Dish, Category, Tag } from '@prisma/client';

export async function UpdateDish({
  name,
  description,
  price,
  category,
  tags,
  vendorId,
  images,
  dishId
}: {
  vendorId: string;
  dishId: string;
  name: string;
  description: string;
  price: number;
  category: Category;
  tags: Tag[];
  images: string[]
}): Promise<{ success: boolean; error?: string; data?: Dish }> {
  // Validate input data
  if (
    !vendorId ||
    !dishId ||
    !name ||
    !category ||
    !description ||
    !price ||
    !images ||
    images.length === 0
  ) {
    return { success: false, error: 'All entries are required!' };
  }

  try {
    // Check if Dish belongs to vendor to prevent unauthorized updates
    const existingDish = await prismadb.dish.findUnique({
      where: { id: dishId },
      select: { vendorId: true },
    });

    if (!existingDish) {
      return { success: false, error: 'Dish not found' };
    }

    if (existingDish.vendorId !== vendorId) {
      return { success: false, error: 'Unauthorized: You do not own this Dish' };
    }

    // Delete existing images and then add new images to the Dish
    await prismadb.image.deleteMany({
      where: { dishId },
    });

    const updatedDish = await prismadb.dish.update({
      where: { id: dishId },
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

    return { success: true, data: updatedDish };
  } catch (err) {
    console.error('[UPDATE_Dish_ERROR]', err);
    if (err instanceof Error) {
      return { success: false, error: err.message };
    }
    return { success: false, error: 'An unknown error occurred during Dish update' };
  }
}
