import { VendorCreate } from "@/actions/vendor/signup-action";
import { NextResponse } from "next/server";

export async function POST(req: Request) {
  try {
    const body = await req.json();
    // console.log('Request Body:', body);

    const { name, email } = body;

    if (!name || !email) {
      return new NextResponse("All fields are required!", { status: 400 });
    }

    const resp = await VendorCreate({ name, email });
    // console.log('VendorCreate Response:', resp);

    if (resp.error) {
      return new NextResponse(resp.error, { status: 500 });
    }

    return NextResponse.json(resp.data);
  } catch (err) {
    console.log('[LISTING_POST]', err);
    return new NextResponse('Internal Server Error', { status: 500 });
  }
}
