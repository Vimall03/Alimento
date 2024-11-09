'use server';

import { DishWithImages } from '@/app/vendor/[vendorId]/page';
import prismadb from '@/lib/prismadb';
import { Dish, Category, Tag } from '@prisma/client';

export async function getAllDishes({
  tags,
  categories,
  sort, // Accept the sort parameter (which can be "", "asc", or "desc")
  query, // New parameter to handle search query
}: {
  tags?: Tag[];
  categories?: Category[];
  sort?: "" | "asc" | "desc"; // Updated to include empty string ("")
  query?: string; // Added query parameter
}): Promise<{ success: boolean; error?: string; data?: DishWithImages[] }> {
  try {
    // Build the `where` clause conditionally based on the presence of tags and categories
    const whereConditions: any = {
      AND: [
        // Only include the tags filter if the tags array is non-empty
        ...(tags && tags.length > 0 ? [{ tags: { hasSome: tags } }] : []),
        
        // Only include the categories filter if the categories array is non-empty
        ...(categories && categories.length > 0 ? [{ category: { in: categories } }] : []),
        
        // Apply the query filter if it's provided
        ...(query ? [{ OR: [
            { name: { contains: query, mode: 'insensitive' } },
            { description: { contains: query, mode: 'insensitive' } }
          ] }] : []),
      ],
    };

    const dishes = await prismadb.dish.findMany({
      where: whereConditions,
      include: {
        images: true, // Including images for the dishes
      },
      orderBy: sort === "" ? undefined : { price: sort }, // If sort is "", don't apply sorting
    });

    return { success: true, data: dishes };
  } catch (error) {
    console.error('[GET_ALL_DISHES_ERROR]', error);
    return { success: false, error: 'Error retrieving dishes' };
  }
}
