"use client";
import React, { useState, useEffect } from 'react';
import  Container  from '@/components/ui/container';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Utensils, Clock, DollarSign, ShoppingBag } from 'lucide-react';

interface Customer {
  id: string;
  name: string;
  email: string;
  vendors: string[];
}

interface Vendor {
  id: string;
  name: string;
  orders: string[];
}

interface Order {
  id: string;
  vendorId: string;
  customerId: string;
  items: { name: string; quantity: number; price: number }[];
  total: number;
  date: string;
}

const CustomerDashboard = () => {
  const [customer, setCustomer] = useState<Customer | null>(null);
  const [vendors, setVendors] = useState<Vendor[]>([]);
  const [orders, setOrders] = useState<Order[]>([]);
  const [selectedVendorId, setSelectedVendorId] = useState<string | null>(null);

  useEffect(() => {
    const fetchData = async () => {
      const customerData = await fetch('/data/customers.json').then(res => res.json());
      setCustomer(customerData[0]);

      const vendorData = await fetch('/data/vendors.json').then(res => res.json());
      setVendors(vendorData);

      const orderData = await fetch('/data/orders.json').then(res => res.json());
      setOrders(orderData);
    };
    fetchData();
  }, []);

  const handleVendorClick = (vendorId: string) => {
    setSelectedVendorId(vendorId);
  };

  const filteredOrders = orders.filter(order => order.vendorId === selectedVendorId);

  return (
    <div className="min-h-screen bg-gray-50 ">
      <Container>
        <div className="py-8 flex flex-col ml-8">
          <h1 className="text-4xl font-bold mb-2">Hey {customer?.name}! 👋</h1>
          <p className="text-gray-600 mb-8">Ready to explore your favorite restaurants?</p>

          {customer && (
            <>
              <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                {vendors
                  .filter(vendor => customer.vendors.includes(vendor.id))
                  .map(vendor => (
                    <Card 
                      key={vendor.id}
                      className={`cursor-pointer transition-all hover:shadow-lg ${
                        selectedVendorId === vendor.id ? 'ring-2 ring-primary' : ''
                      }`}
                      onClick={() => handleVendorClick(vendor.id)}
                    >
                      <CardContent className="p-6">
                        <div className="flex items-center space-x-4">
                          <div className="h-12 w-12 rounded-full bg-primary/10 flex items-center justify-center">
                            <Utensils className="h-6 w-6 text-primary" />
                          </div>
                          <div>
                            <h3 className="text-lg font-semibold">{vendor.name}</h3>
                            <p className="text-sm text-gray-500">
                              {orders.filter(o => o.vendorId === vendor.id).length} ordeclearrs
                            </p>
                          </div>
                        </div>
                      </CardContent>
                    </Card>
                  ))}
              </div>

              {selectedVendorId && (
                <div className="space-y-6">
                  <h2 className="text-2xl font-semibold flex items-center gap-2">
                    <ShoppingBag className="h-6 w-6" />
                    Order History
                  </h2>
                  
                  {filteredOrders.length > 0 ? (
                    <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">
                      {filteredOrders.map(order => (
                        <Card key={order.id} className="overflow-hidden">
                          <CardHeader className="bg-primary/5">
                            <CardTitle className="text-lg flex justify-between items-center">
                              <span className="flex items-center gap-2">
                                <Clock className="h-4 w-4" />
                                {new Date(order.date).toLocaleDateString()}
                              </span>
                              <span className="flex items-center gap-1 text-primary">
                                <DollarSign className="h-4 w-4" />
                                {order.total.toFixed(2)}
                              </span>
                            </CardTitle>
                          </CardHeader>
                          <CardContent className="p-6">
                            <div className="space-y-4">
                              {order.items.map((item, index) => (
                                <div 
                                  key={index}
                                  className="flex justify-between items-center border-b last:border-0 pb-2 last:pb-0"
                                >
                                  <div>
                                    <p className="font-medium">{item.name}</p>
                                    <p className="text-sm text-gray-500">Qty: {item.quantity}</p>
                                  </div>
                                  <p className="font-semibold">
                                    ${(item.quantity * item.price).toFixed(2)}
                                  </p>
                                </div>
                              ))}
                            </div>
                          </CardContent>
                        </Card>
                      ))}
                    </div>
                  ) : (
                    <Card className="p-12">
                      <div className="text-center text-gray-500">
                        <ShoppingBag className="h-12 w-12 mx-auto mb-4 opacity-50" />
                        <p className="text-lg">No orders found for this vendor</p>
                        <p className="text-sm">Time to place your first order!</p>
                      </div>
                    </Card>
                  )}
                </div>
              )}
            </>
          )}
        </div>
      </Container>
    </div>
  );
};

export default CustomerDashboard;
