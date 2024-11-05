
import { createDish } from "@/actions/dish/dishCREATE";
import { getAllDishes } from "@/actions/dish/dishGETALL";
import { Category, Tag } from "@prisma/client";
import { NextResponse } from "next/server";

// POST route: Creates a new dish
export async function POST(req: Request) {
  try {
    const body = await req.json();
    const { name, description, price, category, tags, vendorId } = body;

    if (!name || !price || !category || !vendorId) {
      return new NextResponse("Name, price, category, and vendor ID are required!", { status: 400 });
    }

    const resp = await createDish({ name, description, price, category, tags, vendorId });

    if (!resp.success) {
      return new NextResponse(resp.error || "Failed to create dish", { status: 500 });
    }

    return NextResponse.json(resp.data);
  } catch (err) {
    console.log('[DISH_POST]', err);
    return new NextResponse("Internal Server Error", { status: 500 });
  }
}

// GET route: Retrieves all dishes with optional filtering
export async function GET(req: Request) {
  try {
    const url = new URL(req.url);

    const resp = await getAllDishes({});

    if (!resp.success) {
      return new NextResponse(resp.error || "Failed to retrieve dishes", { status: 500 });
    }

    return NextResponse.json(resp.data);
  } catch (err) {
    console.log('[DISH_GET_ALL]', err);
    return new NextResponse("Internal Server Error", { status: 500 });
  }
}
