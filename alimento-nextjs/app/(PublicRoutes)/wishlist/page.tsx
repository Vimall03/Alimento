"use client";
import { Button } from "@/components/ui/button";
import { useSession } from "next-auth/react";
import { useEffect } from "react";
import { Toaster } from "react-hot-toast";
import Link from "next/link";
import { Spinner } from "@/components/ui/spinner";
import WishlistItem from "./components/wishlistItem";
import { useWishlist } from "@/context/customerWishlistProvider";

const WishlistPage = () => {
  const { data: session } = useSession();
  const { Wishlists, fetchWishlists, loading } = useWishlist();

  useEffect(() => {
    if (session?.user?.id) {
      fetchWishlists(session.user.id);
    }
  }, [session]);

  if (loading) {
    return <Spinner />;
  }

  return (
    <>
      <Toaster />
      <div className="h-full dark:bg-DarkGray pb-10">
        <div className="relative flex items-center justify-center h-96 bg-cover bg-center bg-no-repeat mb-20 p-8 bg-[url('/wishlist.jpg')]">
          {/* Overlay */}
          <div className="absolute inset-0 bg-black opacity-50"></div>
          
          {/* Title Text */}
          <div className="relative z-10 text-center">
            <h1 className="text-3xl md:text-5xl lg:text-7xl text-white font-extrabold">
              Wish List
            </h1>
          </div>
        </div>

        <div className="mt-5 flex items-center justify-center">
          {Wishlists && Wishlists.length > 0 ? (
            <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 px-6 max-w-screen-xl mx-auto">
              {Wishlists.map((item) => (
                item.dish && item.dish.id && (
                  <WishlistItem
                    key={item.id}
                    dishId={item.dish.id}
                    customerId={session?.user.id || ""}
                    dish={item.dish}
                  />
                )
              ))}
            </div>
          ) : (
            <div className="text-center text-gray-700 dark:text-gray-500">
              <p className="text-lg">Your wishlist is empty!</p>
              <Link href="/shops">
                <Button className="mt-4 px-6 py-3 bg-customTeal text-white dark:bg-Green dark:hover:bg-opacity-80 transition duration-200 transform hover:scale-105">
                  Continue Shopping
                </Button>
              </Link>
            </div>
          )}
        </div>
      </div>
    </>
  );
};

export default WishlistPage;
