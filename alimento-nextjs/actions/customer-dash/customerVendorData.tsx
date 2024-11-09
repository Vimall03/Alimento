'use server';

import prismadb from '@/lib/prismadb';

export async function getCustomerVendorData() {
  try {
    const customers = await prismadb.customer.findMany();
    const vendors = await prismadb.vendor.findMany();

    return {
      success: true,
      data: {
        customers,
        vendors,
      },
    };
  } catch (error) {
    console.error('[GET_CUSTOMER_VENDOR_ERROR]', error);
    return { success: false, error: 'Error fetching data' };
  }
}
