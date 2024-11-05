import { deleteCustomer } from "@/actions/customer/customerDELETE";
import { editCustomer } from "@/actions/customer/customerEDIT";
import { getCustomerById } from "@/actions/customer/customerGET";
import { NextResponse } from "next/server";

export async function PATCH(
  req: Request,
  { params }: { params: { customerId: string } }
) {
  try {
    const body = await req.json();
    const { customerId } = await params;
    const { name, email } = body;

    if (!name || !email) {
      return new NextResponse("All fields are required!", { status: 400 });
    }

    const resp = await editCustomer({ id: customerId, name, email });

    if (resp.error) {
      return new NextResponse(resp.error, { status: 500 });
    }

    return NextResponse.json(resp.data);
  } catch (err) {
    console.log('[CUSTOMER_PATCH]', err);
    return new NextResponse('Internal Server Error', { status: 500 });
  }
}

export async function DELETE(
  req: Request,
  { params }: { params: { customerId: string } }
) {
  try {
    const { customerId } = await params;

    if (!customerId) {
      return new NextResponse("Customer ID is required", { status: 400 });
    }

    const resp = await deleteCustomer({ id: customerId });

    if (resp.error) {
      return new NextResponse(resp.error, { status: 500 });
    }

    return new NextResponse("Customer successfully deleted", { status: 200 });
  } catch (err) {
    console.log('[CUSTOMER_DELETE]', err);
    return new NextResponse("Internal Server Error", { status: 500 });
  }
}

export async function GET(
  req: Request,
  { params }: { params: { customerId: string } }
) {
  try {
    const { customerId } = await params;

    if (!customerId) {
      return new NextResponse("Customer ID is required", { status: 400 });
    }

    const resp = await getCustomerById({ id: customerId });

    if (resp.error) {
      return new NextResponse(resp.error, { status: 500 });
    }

    return NextResponse.json(resp.data);
  } catch (err) {
    console.log('[CUSTOMER_GET]', err);
    return new NextResponse("Internal Server Error", { status: 500 });
  }
}
