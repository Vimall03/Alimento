"use client"
import React from 'react';
import { useParams } from 'next/navigation';
import { Card, CardHeader, CardTitle, CardContent } from '@/components/ui/card';
import { Star, MapPin, Clock, CurrencyRupee } from 'lucide-react';

const RestaurantItem = () => {
  const { restaurantId } = useParams();

  // Sample restaurant data
  const restaurantData = [
    {
      restaurant_id: "R001",
      restaurant_name: "Punjab Grill",
      rating: 4.5,
      cuisine: "North Indian, Mughlai",
      address: "123 Park Street",
      average_cost: 1200,
      image: "https://via.placeholder.com/300x200",
      hours: {
        monday: "11:00 AM - 10:00 PM",
        tuesday: "11:00 AM - 10:00 PM",
        wednesday: "11:00 AM - 10:00 PM",
        thursday: "11:00 AM - 10:00 PM",
        friday: "11:00 AM - 11:00 PM",
        saturday: "11:00 AM - 11:00 PM",
        sunday: "11:00 AM - 10:00 PM"
      },
      menu: [
        {
          item_id: "M001",
          item_name: "Butter Chicken",
          price: 450
        },
        {
          item_id: "M002",
          item_name: "Naan",
          price: 50
        },
        {
          item_id: "M003",
          item_name: "Palak Paneer",
          price: 350
        },
        {
          item_id: "M004",
          item_name: "Biryani",
          price: 400
        }
      ]
    }
  ];

  const restaurant = restaurantData.find((r) => r.restaurant_id === restaurantId);

  if (!restaurant) {
    return (
      <div className="min-h-screen bg-gray-50 py-8">
        <div className="container mx-auto px-4 text-center">
          <h2 className="text-2xl font-bold text-gray-800 mb-2">Restaurant Not Found</h2>
          <p className="text-gray-500">The requested restaurant could not be found.</p>
        </div>
      </div>
    );
  }

  return (
    <div className="min-h-screen bg-gray-50 py-8">
      <div className="container mx-auto px-4">
        <Card className="mb-6">
          <div className="flex items-center justify-between">
            <div className="flex items-center space-x-4">
              <img src={restaurant.image} alt={restaurant.restaurant_name} className="w-24 h-24 rounded-full" />
              <div>
                <h2 className="text-2xl font-bold text-gray-800 mb-2">{restaurant.restaurant_name}</h2>
                <div className="flex items-center text-yellow-500 space-x-1 mb-2">
                  <Star size={20} />
                  <span className="font-medium">{restaurant.rating}</span>
                </div>
                <p className="text-gray-600">{restaurant.cuisine}</p>
              </div>
            </div>
            <div className="text-right">
              <p className="text-gray-500 mb-2">Average Cost: <span className="font-medium">₹{restaurant.average_cost} for two</span></p>
              <p className="text-gray-500">
                <MapPin size={16} className="inline-block mr-1" />
                {restaurant.address}
              </p>
            </div>
          </div>
        </Card>

        <Card>
          <CardHeader>
            <CardTitle>Opening Hours</CardTitle>
          </CardHeader>
          <CardContent>
            <div className="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
              {Object.entries(restaurant.hours).map(([day, time]) => (
                <div key={day} className="flex items-center space-x-2 text-gray-500">
                  <Clock size={16} />
                  <div>
                    <p className="font-medium">{day}</p>
                    <p>{time}</p>
                  </div>
                </div>
              ))}
            </div>
          </CardContent>
        </Card>

        <Card className="mt-6">
          <CardHeader>
            <CardTitle>Menu</CardTitle>
          </CardHeader>
          <CardContent>
            <div className="space-y-4">
              {restaurant.menu.map((item) => (
                <div key={item.item_id} className="flex items-center justify-between">
                  <div>
                    <h3 className="font-medium text-gray-800">{item.item_name}</h3>
                    <p className="text-gray-500">₹{item.price}</p>
                  </div>
                  <button className="bg-orange-500 hover:bg-orange-600 text-white font-medium py-2 px-4 rounded-md">
                    Add to Cart
                  </button>
                </div>
              ))}
            </div>
          </CardContent>
        </Card>
      </div>
    </div>
  );
};

export default RestaurantItem;