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
import { checkWishlistExists } from '@/actions/customer/wishlist/EXISTS_wishlist';
import { useWishlist } from '@/context/customerWishlistProvider';

interface DishCardProps {
  id: string;
  name: string;
  price: number;
  description: string;
  images: ImageInterface[];
  isStatic?: boolean
}

const DishCardFE: React.FC<DishCardProps> = ({
  id,
  name,
  price,
  description,
  images,
  isStatic

}) => {
  const { addToWishlists, isWishlisted } = useWishlist();
  const session = useSession();
  const customerId = session.data?.user.id;

  // State to track if the Dish is Wishlisted
  const [isAlreadyWishlisted, setIsAlreadyWishlisted] = useState<boolean>(false);


  useEffect(() => {
    const checkWishlistStatus = async () => {
      if (customerId) {
        const Wishlisted = await isWishlisted(customerId, id);
        setIsAlreadyWishlisted(Wishlisted);
      }
    };

    if (customerId && id) {
      checkWishlistStatus();
    }
  }, []);

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
        {isStatic&&(<>
        <div className="flex justify-between">
          <Button variant="outline" className="text-blue-600">
            Add
          </Button>
          {customerId && session.data?.user.role === 'customer' && !isAlreadyWishlisted && (
            <Button
            onClick={() => {
              addToWishlists(customerId, id);
              setIsAlreadyWishlisted(true); // Update the state to reflect the Wishlist status
            }}
              variant="outline"
              className="text-red-600"
            >
              Wishlist
            </Button>
          )}
          {customerId && session.data?.user.role === 'customer' && isAlreadyWishlisted && (
            <Button variant="outline" className="text-green-600">
              Wishlisted
            </Button>
          )}
        </div>
        </>)}
      </div>
    </div>
  );
};

export default DishCardFE;
