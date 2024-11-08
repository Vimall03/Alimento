import React, { useState } from 'react';
import { Button } from '@/components/ui/button'; // Import the Shadcn Button component
import Link from 'next/link';
import { DishWithImages } from '../page';
import DishCard from '@/components/vendor/dishCard';

const DishesPage = async ({
  vendorId,
  Dishes,
}: {
  vendorId: string
  Dishes: DishWithImages[];
}) => {

  return (
    <div className="min-h-screen p-8 flex flex-col gap-10 bg-gray-50">
      <div className="flex flex-col gap-5 lg:gap-0 md:flex-row justify-between mb-4 p-5 bg-gray-200 items-center rounded-xl">
        <h1 className="text-4xl font-bold text-center">Your Dishes</h1>

        <Link href={`/vendor/${vendorId}/createDish`} ><Button className="md:ml-auto">Add New Dish</Button></Link>
      </div>

      <div className="flex justify-center mb-4">
        <input
          type="text"
          placeholder="Search Dishes..."
          //   value={searchTerm}
          //   onChange={(e) => setSearchTerm(e.target.value)}
          className="p-3 border rounded-full border-gray-300 w-full md:w-1/2" // Adjusted width to make it centered
        />
      </div>

      <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        {Dishes.map((Dish, index) => (
          <DishCard
            key={index}
            vendorId={vendorId}
            DishId={Dish.id}
            name={Dish.name}
            price={Dish.price}
            description={Dish.description}
            category={Dish.category}
            tags={Dish.tags}
            images={Dish.images} 
          />
        ))}
      </div>
    </div>
  );
};

export default DishesPage;
