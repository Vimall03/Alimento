import prismadb from "@/lib/prismadb";
import { ChatsResponse } from "./getAllChatByUserId";

export async function getAllChatsByVendorId(vendorId: string): Promise<ChatsResponse> {
    try {
      const chats = await prismadb.chat.findMany({
        where: { vendorId },
        include: { messages: true },
      });
      return { success: true, data: chats };
    } catch (error) {
      console.error("Error fetching chats for Vendor:", error);
      return { success: false, error: "Failed to fetch chats for Vendor" };
    }
  }