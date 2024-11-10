import prismadb from "@/lib/prismadb";
import { Chat } from "@prisma/client";


export type ChatsResponse = {
    success: boolean;
    data?: Chat[];
    error?: string;
  };
  

export async function getAllChatsByCustomerId(customerId: string): Promise<ChatsResponse> {
    try {
      const chats = await prismadb.chat.findMany({
        where: { customerId },
        include: { messages: true },
      });
      return { success: true, data: chats };
    } catch (error) {
      console.error("Error fetching chats for Customer:", error);
      return { success: false, error: "Failed to fetch chats for Customer" };
    }
  }
  