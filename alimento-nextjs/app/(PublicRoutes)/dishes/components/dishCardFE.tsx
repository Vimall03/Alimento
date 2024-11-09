'use client';

import React, { useEffect, useState } from 'react';
import { Image as ImageInterface } from '@prisma/client';
import {
  Carousel,
  CarouselContent,
  CarouselItem,
} from '@/components/ui/carousel';
import Image from 'next/image';
import Autoplay from 'embla-carousel-autoplay';
import { Button } from '@/components/ui/button';
import { useSession } from 'next-auth/react';

interface DishCardProps {
  id: string;
  name: string;
  price: number;
  description: string;
  images: ImageInterface[];
}

const DishCardFE: React.FC<DishCardProps> = ({
  id,
  name,
  price,
  description,
  images,
}) => {
  const session = useSession();
  const customerId = session.data?.user.id;

  // State to track if the Dish is bookmarked
  const [isAlreadyBookmarked, setIsAlreadyBookmarked] = useState<boolean>(false);


  return (
    <div className="bg-white overflow-hidden shadow-lg rounded-lg">
      <Carousel
        className="h-48"
        opts={{
          align: 'start',
          loop: true,
        }}
        plugins={[
          Autoplay({
            delay: 2000,
          }),
        ]}
      >
        <CarouselContent className="flex gap-4">
          {images.map((image, index) => (
            <CarouselItem key={index}>
              <Image
                src={image.url} // Use the image URL from the database
                alt={name}
                width={1000}
                height={1000} // Fill the parent container
                // objectFit="cover" // Cover the area while maintaining aspect ratio
                className="rounded-t-lg h-48" // Optional: Add styling for rounded corners
              />
            </CarouselItem>
          ))}
        </CarouselContent>
      </Carousel>
      <div className="p-4">
        <h3 className="text-xl font-semibold mb-2">{name}</h3>
        <p className="text-gray-600 mb-2">{description}</p>
        <p className="text-lg font-bold mb-2">Price: ₹{price}</p>
        <div className="flex justify-between">
          <Button variant="outline" className="text-blue-600">
            Add
          </Button>
          {customerId && session.data?.user.role === 'customer' && !isAlreadyBookmarked && (
            <Button
              variant="outline"
              className="text-red-600"
            >
              Bookmark
            </Button>
          )}
          {customerId && session.data?.user.role === 'customer' && isAlreadyBookmarked && (
            <Button variant="outline" className="text-green-600">
              Bookmarked
            </Button>
          )}
        </div>
      </div>
    </div>
  );
};

export default DishCardFE;
