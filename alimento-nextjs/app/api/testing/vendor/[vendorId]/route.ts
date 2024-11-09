import { deleteVendor } from "@/actions/vendor/vendorDELETE";
import { editVendor } from "@/actions/vendor/vendorEDIT";
import { getVendorById } from "@/actions/vendor/vendorGET";
import { NextResponse } from "next/server";

export async function PATCH(req: Request,
    { params }: { params: { vendorId: string } }
) {
  try {
    const body = await req.json();

    const { vendorId } = await params;

    const { name, email } = body;

    if (!name || !email) {
      return new NextResponse("All fields are required!", { status: 400 });
    }

    const resp = await editVendor({ id:vendorId, name, email });

    if (resp.error) {
      return new NextResponse(resp.error, { status: 500 });
    }

    return NextResponse.json(resp.data);
  } catch (err) {
    console.log('[LISTING_PATCH]', err);
    return new NextResponse('Internal Server Error', { status: 500 });
  }
}



// DELETE route: Deletes a vendor record by vendorId
export async function DELETE(
  req: Request,
  { params }: { params: { vendorId: string } }
) {
  try {
    const { vendorId } = await params;

    if (!vendorId) {
      return new NextResponse("Vendor ID is required", { status: 400 });
    }

    const resp = await deleteVendor({ id: vendorId });

    if (resp.error) {
      return new NextResponse(resp.error, { status: 500 });
    }

    return new NextResponse("Vendor successfully deleted", { status: 200 });
  } catch (err) {
    console.log('[VENDOR_DELETE]', err);
    return new NextResponse("Internal Server Error", { status: 500 });
  }
}

// GET route: Retrieves a vendor record by vendorId
export async function GET(
  req: Request,
  { params }: { params: { vendorId: string } }
) {
  try {
    const { vendorId } = await params;

    if (!vendorId) {
      return new NextResponse("Vendor ID is required", { status: 400 });
    }

    const resp = await getVendorById({ id: vendorId });

    if (resp.error) {
      return new NextResponse(resp.error, { status: 500 });
    }

    return NextResponse.json(resp.data);
  } catch (err) {
    console.log('[VENDOR_GET]', err);
    return new NextResponse("Internal Server Error", { status: 500 });
  }
}
