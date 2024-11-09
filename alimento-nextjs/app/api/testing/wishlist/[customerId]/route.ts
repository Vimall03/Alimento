
import { getWishlistsBycustomer } from '@/actions/customer/wishlist/GETBYCUSTOMER_wishlist';
import { NextRequest, NextResponse } from 'next/server';

export type Params = Promise<{ 
  customerId: string;
}>;

export async function GET(
  request: NextRequest,
  { params }: { params: Params }
) {
  const { customerId } = await params;

  if (!customerId) {
    return new NextResponse('customer ID is required', { status: 400 });
  }

  try {
    const resp = await getWishlistsBycustomer({ customerId });

    if (resp.success) {
      return NextResponse.json(resp.data);
    } else {
      return NextResponse.json({ err: resp.error }, { status: 400 });
    }
  } catch (err) {
    console.log('[BOOKMARKS_GET_BY_customer]', err);
    return new NextResponse('Internal Server Error', { status: 500 });
  }
}
