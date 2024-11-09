"use client";
import { deleteWishlist } from "@/actions/customer/wishlist/DELETE_wishlist";
import { DishWithImages } from "@/app/vendor/[vendorId]/page";
import { Button } from "@/components/ui/button";
import { useWishlist } from "@/context/customerWishlistProvider";
import Image from "next/image";
import { useEffect } from "react";
import toast from "react-hot-toast";

interface wishlistItemProps {
  dish: DishWithImages;
  dishId: string;
  customerId: string;
}
// WishlistItem.js
const WishlistItem: React.FC<wishlistItemProps> = ({
  dish,
  dishId,
  customerId,
}) => {
  const { removeFromWishlists, loading, error } = useWishlist();


  return (
    
    <div className="border flex items-center justify-center flex-col dark:border-gray-200 max-w-full p-4 rounded-lg shadow-md hover:shadow-lg transition">
      {error? toast.error(error):null}
      <Image
        width={1000}
        height={1000}
        src={dish.images[0].url}
        alt={dish.name}
        className="w-full h-full object-cover rounded border-b"
      />
      <h2 className="mt-2 text-xl dark:text-gray-200 font-semibold">
        {dish.name}
      </h2>
      <p className="text-lg text-gray-600">₹{dish.price}</p>
      <div className="mt-4 flex justify-between gap-2">
        <Button
          disabled={loading}
          onClick={() => {
            removeFromWishlists(customerId, dishId);
          }}
          variant="outline"
          className="dark:text-gray-200 dark:hover:bg-[#f8f8f8] dark:hover:text-gray-700"
        >
          Remove
        </Button>
      </div>
    </div>
  );
};

export default WishlistItem;
