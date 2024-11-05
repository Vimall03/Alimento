"use client"
import React, { useEffect, useState } from 'react';
import { usePathname } from 'next/navigation';
import Link from 'next/link';
import { Card, CardHeader, CardTitle, CardContent } from '@/components/ui/card';
import { Star, MapPin, ChevronRight } from 'lucide-react';

const Restaurants = () => {
  const pathname = usePathname();
  const [restaurants, setRestaurants] = useState([]);
  const [isLoggedIn, setIsLoggedIn] = useState(false);

  // Sample restaurant data
  const restaurantData = [
    {
      restaurant_id: "R001",
      restaurant_name: "Punjab Grill",
      rating: 4.5,
      cuisine: "North Indian, Mughlai",
      address: "123 Park Street",
      average_cost: 1200,
      image: "https://via.placeholder.com/150"
    },
    {
        restaurant_id: "R001",
        restaurant_name: "Punjab Grill",
        rating: 4.5,
        cuisine: "North Indian, Mughlai",
        address: "123 Park Street",
        average_cost: 1200,
        image: "https://via.placeholder.com/150"
      },
    {
      restaurant_id: "R002",
      restaurant_name: "Pizza Express",
      rating: 4.2,
      cuisine: "Italian, Pizza",
      address: "456 Lake Road",
      average_cost: 800,
      image: "https://via.placeholder.com/150"
    },
    {
      restaurant_id: "R003",
      restaurant_name: "Sushi World",
      rating: 4.8,
      cuisine: "Japanese, Sushi",
      address: "789 River Avenue",
      average_cost: 1500,
      image: "https://via.placeholder.com/150"
    },
    {
      restaurant_id: "R004",
      restaurant_name: "Masala Wok",
      rating: 4.3,
      cuisine: "Indian, Chinese",
      address: "321 Main Street",
      average_cost: 950,
      image: "https://via.placeholder.com/150"
    },
    {
      restaurant_id: "R005",
      restaurant_name: "Burger Shack",
      rating: 4.1,
      cuisine: "American, Burgers",
      address: "654 Oak Avenue",
      average_cost: 700,
      image: "https://via.placeholder.com/150"
    }
  ];

  useEffect(() => {
    const checkLogin = async () => {
      const res = true;
      if (res) {
        setIsLoggedIn(true);
        setRestaurants(restaurantData);
      } else if (pathname !== '/user_login') {
        window.location.href = '/user_login';
      }
    };
    checkLogin();
  }, [pathname]);

  return (
    <div className="min-h-screen bg-gray-50 py-8">
      <div className="container mx-auto px-4">
        <h2 className="text-2xl font-bold text-gray-800 mb-6">Restaurants Near You</h2>

        <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
          {restaurants.map((restaurant, index) => (
            <Card key={index} className="hover:shadow-md transition-shadow duration-200">
              <div className="p-4">
                <div className="flex items-center justify-between mb-4">
                  <div className="flex items-center space-x-3">
                    <img src={restaurant.image} alt={restaurant.restaurant_name} className="w-12 h-12 rounded-full" />
                    <span className="font-medium text-gray-900 text-lg">{restaurant.restaurant_name}</span>
                  </div>
                  <div className="flex items-center text-yellow-500 space-x-1">
                    <Star size={20} />
                    <span className="font-medium">{restaurant.rating}</span>
                  </div>
                </div>

                <div className="mb-4">
                  <p className="text-gray-600 mb-2">{restaurant.cuisine}</p>
                  <div className="flex items-center text-sm text-gray-500">
                    <MapPin size={16} className="mr-1" />
                    <span>{restaurant.address}</span>
                  </div>
                </div>

                <div className="flex items-center justify-between pt-4 border-t border-gray-100">
                  <div className="text-sm">
                    <span className="text-gray-500">Average Cost: </span>
                    <span className="font-medium">₹{restaurant.average_cost} for two</span>
                  </div>
                  <div className="flex items-center space-x-2">
                    <Link href={`/restaurant/${restaurant.restaurant_id}`} legacyBehavior>
                      <a className="text-orange-500 font-medium hover:underline">View Details</a>
                    </Link>
                    <ChevronRight size={20} className="text-gray-400" />
                  </div>
                </div>
              </div>
            </Card>
          ))}
        </div>

        {restaurants.length === 0 && (
          <div className="text-center py-12">
            <MapPin size={48} className="mx-auto text-gray-400 mb-4" />
            <h3 className="text-lg font-medium text-gray-900 mb-2">No restaurants found</h3>
            <p className="text-gray-500">Try searching for something else.</p>
          </div>
        )}
      </div>
    </div>
  );
};

export default Restaurants;