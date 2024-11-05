
import { CustomerCreate } from "@/actions/customer/signup-action";
import { NextResponse } from "next/server";

export async function POST(req: Request) {
  try {
    const body = await req.json();
    const { name, email } = body;

    if (!name || !email) {
      return new NextResponse("Name and email are required!", { status: 400 });
    }

    const resp = await CustomerCreate({ name, email });

    if (!resp.success) {
      return new NextResponse(resp.error || "Failed to create customer", { status: 500 });
    }

    return NextResponse.json(resp.data);
  } catch (err) {
    console.log('[CUSTOMER_POST]', err);
    return new NextResponse("Internal Server Error", { status: 500 });
  }
}
