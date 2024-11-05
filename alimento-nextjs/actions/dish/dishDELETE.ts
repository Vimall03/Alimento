'use server';

import prismadb from '@/lib/prismadb';

export async function deleteDish({
  id,
  vendorId,
}: {
  id: string;
  vendorId: string;
}): Promise<{ success: boolean; error?: string }> {
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

    await prismadb.dish.delete({
      where: { id },
    });

    return { success: true };
  } catch (error) {
    console.error('[DELETE_DISH_ERROR]', error);
    return { success: false, error: 'Error deleting dish' };
  }
}
