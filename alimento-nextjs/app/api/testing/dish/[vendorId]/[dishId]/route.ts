import { getDishById } from "@/actions/dish/dishGET";
import { editDish } from "@/actions/dish/dishEDIT";
import { deleteDish } from "@/actions/dish/dishDELETE";
import { NextResponse } from "next/server";

// GET route: Retrieves a specific dish by its ID
export async function GET(req: Request, { params }: { params: { dishId: string } }) {
  try {
    const { dishId } = await params;

    const resp = await getDishById({ id: dishId });

    if (!resp.success) {
      return new NextResponse(resp.error || "Failed to retrieve dish", { status: 500 });
    }

    return NextResponse.json(resp.data);
  } catch (err) {
    console.log('[DISH_GET]', err);
    return new NextResponse("Internal Server Error", { status: 500 });
  }
}

// PATCH route: Edits a specific dish by its ID
export async function PATCH(req: Request, { params }: { params: { dishId: string, vendorId: string } }) {
  try {
    const body = await req.json();
    const { name, description, price, category, tags } = body;

    const { dishId, vendorId } = await params;

    if (!name || !price || !category) {
      return new NextResponse("Name, price, and category are required!", { status: 400 });
    }

    const resp = await editDish({ id: dishId, vendorId, name, description, price, category, tags });

    if (!resp.success) {
      return new NextResponse(resp.error || "Failed to edit dish", { status: 500 });
    }

    return NextResponse.json(resp.data);
  } catch (err) {
    console.log('[DISH_PATCH]', err);
    return new NextResponse("Internal Server Error", { status: 500 });
  }
}

// DELETE route: Deletes a specific dish by its ID
export async function DELETE(req: Request, { params }: { params: { dishId: string, vendorId: string } }) {
  try {
    const { dishId, vendorId } = await params;

    const resp = await deleteDish({ id: dishId, vendorId });

    if (!resp.success) {
      return new NextResponse(resp.error || "Failed to delete dish", { status: 500 });
    }

    return new NextResponse("Dish successfully deleted", { status: 200 });
  } catch (err) {
    console.log('[DISH_DELETE]', err);
    return new NextResponse("Internal Server Error", { status: 500 });
  }
}
