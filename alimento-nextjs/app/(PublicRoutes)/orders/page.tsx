"use client"
import { useEffect, useState } from 'react';
import { usePathname } from 'next/navigation';
import Link from 'next/link';
import { Card } from '@/components/ui/card';
import { ChevronRight, Clock, Package, MapPin, Menu, X } from 'lucide-react';

export default function Orders() {
  const pathname = usePathname();
  const [orders, setOrders] = useState([]);
  const [isLoggedIn, setIsLoggedIn] = useState(false);
  const [menuOpen, setMenuOpen] = useState(false);

  // Sample order data
  const orderData = [
    {
      order_id: "OD123456789",
      order_name: "Butter Chicken, Naan, Dal Makhani",
      vendor: "Punjab Grill",
      dt: "2024-03-15 19:30",
      order_status: "Delivered",
      amount: 850,
      items: 3,
      address: "123 Park Street"
    },
    {
      order_id: "OD123456788",
      order_name: "Margherita Pizza, Garlic Bread",
      vendor: "Pizza Express",
      dt: "2024-03-14 20:15",
      order_status: "Processing",
      amount: 650,
      items: 2,
      address: "456 Lake Road"
    }
  ];

  useEffect(() => {
    const checkLogin = async () => {
      const res = true;
      if (res) {
        setIsLoggedIn(true);
        setOrders(orderData);
      } else if (pathname !== '/user_login') {
        window.location.href = '/user_login';
      }
    };
    checkLogin();
  }, [pathname]);

  const getStatusColor = (status) => {
    switch (status.toLowerCase()) {
      case 'delivered':
        return 'text-green-600 bg-green-50';
      case 'processing':
        return 'text-orange-600 bg-orange-50';
      case 'cancelled':
        return 'text-red-600 bg-red-50';
      default:
        return 'text-gray-600 bg-gray-50';
    }
  };

  const formatDate = (dateStr) => {
    const date = new Date(dateStr);
    return date.toLocaleDateString('en-US', { 
      day: 'numeric',
      month: 'short',
      year: 'numeric'
    });
  };

  const formatTime = (dateStr) => {
    const date = new Date(dateStr);
    return date.toLocaleTimeString('en-US', { 
      hour: '2-digit',
      minute: '2-digit',
      hour12: true
    });
  };

  return (
    <div className="min-h-screen bg-gray-50">
``      {/* Main Content */}
      <div className="container mx-auto px-4 py-8">
        <h2 className="text-2xl font-bold text-gray-800 mb-6">Past Orders</h2>
        
        <div className="space-y-4">
          {orders.length > 0 ? (
            orders.map((order, index) => (
              <Card key={index} className="hover:shadow-md transition-shadow duration-200">
                <div className="p-6">
                  <div className="flex items-center justify-between mb-4">
                    <div className="flex items-center space-x-3">
                      <Package className="text-gray-400" size={20} />
                      <span className="font-medium text-gray-900">{order.vendor}</span>
                    </div>
                    <span className={`px-3 py-1 rounded-full text-sm font-medium ${getStatusColor(order.order_status)}`}>
                      {order.order_status}
                    </span>
                  </div>
                  
                  <div className="mb-4">
                    <p className="text-gray-600 mb-2">{order.order_name}</p>
                    <div className="flex items-center text-sm text-gray-500">
                      <Clock size={16} className="mr-1" />
                      <span>{formatDate(order.dt)} at {formatTime(order.dt)}</span>
                    </div>
                  </div>
                  
                  <div className="flex items-center justify-between pt-4 border-t border-gray-100">
                    <div className="flex items-center space-x-4">
                      <div className="text-sm">
                        <span className="text-gray-500">Order ID: </span>
                        <span className="font-medium">{order.order_id}</span>
                      </div>
                      <div className="text-sm">
                        <span className="text-gray-500">Items: </span>
                        <span className="font-medium">{order.items}</span>
                      </div>
                    </div>
                    <div className="flex items-center space-x-2">
                      <span className="font-bold text-lg">₹{order.amount}</span>
                      <ChevronRight size={20} className="text-gray-400" />
                    </div>
                  </div>
                </div>
              </Card>
            ))
          ) : (
            <div className="text-center py-12">
              <Package size={48} className="mx-auto text-gray-400 mb-4" />
              <h3 className="text-lg font-medium text-gray-900 mb-2">No orders yet</h3>
              <p className="text-gray-500">Looks like you haven't placed any orders yet.</p>
            </div>
          )}
        </div>
      </div>
    </div>
  );
}