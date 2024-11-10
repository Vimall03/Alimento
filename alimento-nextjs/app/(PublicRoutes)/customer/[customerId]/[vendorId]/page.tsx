'use client';
import React, { useState, useEffect } from 'react';
import { Card, CardContent } from '@/components/ui/card';
import { Utensils } from 'lucide-react';
import { Dish, Vendor } from '@prisma/client';
import { Spinner } from '@/components/ui/spinner';
import { useParams } from 'next/navigation';
import Link from 'next/link';
import Container from '@/components/ui/container';

interface Customer {
  id: string;
  name: string;
  email: string;
  vendorIds: string[];
}

interface VendorWithDish extends Vendor {
  dishes: Dish[];
}

const DishesByVendor = () => {
  const [customer, setCustomer] = useState<Customer | null>(null);
  const [vendor, setVendor] = useState<VendorWithDish | null>(null);
  const [searchQuery, setSearchQuery] = useState<string>('');
  const [isMounted, setIsMounted] = useState(false);

  const params = useParams<{ customerId: string; vendorId: string }>();
  const { customerId, vendorId } = params;

  useEffect(() => {
    const fetchData = async () => {
      if (!vendorId) return;

      try {
        const customerData = await fetch('/data/customers.json').then(res => res.json());
        setCustomer(customerData[0]);

        const response = await fetch('/data/vendors.json');
        const vendorData: VendorWithDish[] = await response.json();

        const filteredVendor = vendorData.find(v => v.id === vendorId);
        setVendor(filteredVendor || null);
      } catch (error) {
        console.error('Error fetching vendor data:', error);
      } finally {
        setIsMounted(true);
      }
    };

    fetchData();
  }, [vendorId]);

  if (!vendor || !isMounted) {
    return <Spinner />;
  }

  const filteredDishes = vendor.dishes.filter(dish =>
    dish.name.toLowerCase().includes(searchQuery.toLowerCase())
  );

  return (
    <div className="min-h-screen bg-[url('/customerdashboard.jpg')]">
      <Container>
        <div className="p-8 h-screen bg-black bg-opacity-50 flex flex-col">
          <div className="bg-black text-gray-200 w-fit my-4 bg-opacity-80 rounded-xl p-5">
            <h1 className="text-6xl font-bold mb-2">Alimento Chat</h1>
            <p className="text-pink-500">Discuss your queries directly with the owners!</p>
          </div>
          <div className="bg-gray-200 h-full p-5 rounded-lg">
            {customer && (
              <>
                <div className="w-full flex items-center justify-center">
                  <div className="text-3xl font-bold py-2">
                    Select a dish by <span className="text-pink-500">{vendor.name}</span> to chat about
                  </div>
                </div>
                {/* Search Bar */}
                <div className="mb-6">
                  <input
                    type="text"
                    className="w-full p-3 border border-gray-300 rounded-lg"
                    placeholder="Search dish by name"
                    value={searchQuery}
                    onChange={e => setSearchQuery(e.target.value)}
                  />
                </div>

                <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                  {filteredDishes.length ? (
                    filteredDishes.map(dish => (
                      <Link key={dish.id} href={`/customer/${customerId}/${vendorId}/${dish.id}`}>
                        <Card>
                          <CardContent className="p-6">
                            <div className="flex items-center space-x-4">
                              <div className="h-12 w-12 rounded-full bg-primary/10 flex items-center justify-center">
                                <Utensils className="h-6 w-6 text-primary" />
                              </div>
                              <div>
                                <div className="text-lg font-semibold">{dish.name}</div>
                              </div>
                            </div>
                          </CardContent>
                        </Card>
                      </Link>
                    ))
                  ) : (
                    <p className="col-span-full text-center text-gray-500">No dishes found</p>
                  )}
                </div>
              </>
            )}
          </div>
        </div>
      </Container>
    </div>
  );
};

export default DishesByVendor;
