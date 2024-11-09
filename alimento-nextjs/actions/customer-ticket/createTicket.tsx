'use server';

import prismadb from '@/lib/prismadb';

export async function createTicket({
  customerId,
  title,
  description,
}: {
  customerId: string;
  title: string;
  description: string;
}): Promise<{ success: boolean; error?: string }> {
  try {
    // Create a new ticket for the customer
    await prismadb.ticket.create({
      data: {
        customerId,
        title,
        description,
      },
    });

    return { success: true };
  } catch (error) {
    console.error('[CREATE_TICKET_ERROR]', error);
    return { success: false, error: 'Error creating ticket' };
  }
}
