
import { createWishlist } from '@/actions/customer/wishlist/CREATE_wishlist';
import { deleteWishlist } from '@/actions/customer/wishlist/DELETE_wishlist';
import { checkWishlistExists } from '@/actions/customer/wishlist/EXISTS_wishlist';
import { NextRequest, NextResponse } from 'next/server';

export type Params = Promise<{
  customerId: string;
  dishId: string;
}>;

export async function POST(
  request: NextRequest,
  { params }: { params: Params }
) {
  const { customerId, dishId } = await params;

  if (!customerId || !dishId) {
    return new NextResponse('Necessary params are required', { status: 400 });
  }

  try {
    const resp = await createWishlist({ customerId, dishId });

    if (resp.success) {
      return NextResponse.json(resp.data);
    } else {
      return NextResponse.json({ err: resp.error }, { status: 400 });
    }
  } catch (err) {
    console.log('[Wishlist_CREATE]', err);
    return new NextResponse('Internal Server Error', { status: 500 });
  }
}

export async function DELETE(
  request: NextRequest,
  { params }: { params: Params }
) {
  const { customerId, dishId } = await params;

  if (!customerId || !dishId) {
    return new NextResponse('Necessary params are required', { status: 400 });
  }

  try {
    const resp = await deleteWishlist({ customerId, dishId });

    if (resp.success) {
      return NextResponse.json(resp.data);
    } else {
      return NextResponse.json({ err: resp.error }, { status: 400 });
    }
  } catch (err) {
    console.log('[Wishlist_DELETE]', err);
    return new NextResponse('Internal Server Error', { status: 500 });
  }
}

export async function GET(
  request: NextRequest,
  { params }: { params: Params }
) {
  const { customerId, dishId } = await params;

  if (!customerId || !dishId) {
    return new NextResponse('Necessary params are required', { status: 400 });
  }

  try {
    const resp = await checkWishlistExists({ customerId, dishId });

    if (resp.success) {
      return NextResponse.json({ exists: resp.exists });
    } else {
      return NextResponse.json({ err: resp.error }, { status: 400 });
    }
  } catch (err) {
    console.log('[Wishlist_CHECK_EXISTS]', err);
    return new NextResponse('Internal Server Error', { status: 500 });
  }
}
