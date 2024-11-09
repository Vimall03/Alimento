"use client";

import { createWishlist } from "@/actions/customer/wishlist/CREATE_wishlist";
import { deleteWishlist } from "@/actions/customer/wishlist/DELETE_wishlist";
import { checkWishlistExists } from "@/actions/customer/wishlist/EXISTS_wishlist";
import { getWishlistsBycustomer, WishlistWithDish } from "@/actions/customer/wishlist/GETBYCUSTOMER_wishlist";
import React, { createContext, useContext, useState, useEffect } from "react";



type WishlistContextType = {
  Wishlists: WishlistWithDish[];
  loading: boolean;
  error: string | null;
  fetchWishlists: (customerId: string) => Promise<void>;
  addToWishlists: (customerId: string, dishId: string) => Promise<void>;
  removeFromWishlists: (customerId: string, dishId: string) => Promise<void>;
  isWishlisted: (customerId: string, dishId: string) => Promise<boolean>;
};

// Create context with an initial value of null
const WishlistContext = createContext<WishlistContextType | null>(null);

export function WishlistProvider({ children }: { children: React.ReactNode }) {
  const [Wishlists, setWishlists] = useState<WishlistWithDish[]>([]);
  const [loading, setLoading] = useState<boolean>(false);
  const [error, setError] = useState<string | null>(null);

  // Fetch all Wishlists for a specific customer
  const fetchWishlists = async (customerId: string) => {
    setLoading(true);
    setError(null);
    try {
      const response = await getWishlistsBycustomer({ customerId });
      if (response.success) {
        console.log(response.data)

        if(!response.data){
          return
        }
        setWishlists(response.data);
      } else {
        setError(response.error || "Unknown error");
      }
    } catch (err) {
      console.error("[Wishlist_FETCH_ERROR]", err);
      setError("Error fetching Wishlists");
    } finally {
      setLoading(false);
    }
  };

  // Add a Wishlist
  const addToWishlists = async (customerId: string, dishId: string) => {
    setLoading(true);
    setError(null);
    try {
      const response = await createWishlist({ customerId, dishId });
      if (response.success && response.data) {
        setWishlists((prev) => [...prev, response.data as WishlistWithDish]);
      } else {
        setError(response.error || "Unknown error");
      }
    } catch (err) {
      console.error("[Wishlist_ADD_ERROR]", err);
      setError("Error adding Wishlist");
    } finally {
      setLoading(false);
    }
  };

  // Remove a Wishlist
  const removeFromWishlists = async (customerId: string, dishId: string) => {
    setLoading(true);
    setError(null);
    try {
      // console.log(customerId,dishId)
      const response = await deleteWishlist({ customerId, dishId });
      if (response.success && response.data) {
        setWishlists((prev) =>
          prev.filter((Wishlist) => Wishlist.dishId !== dishId)
        );
      } else {
        setError(response.error || "Unknown error");
      }
    } catch (err) {
      console.error("[Wishlist_REMOVE_ERROR]", err);
      setError("Error removing Wishlist");
    } finally {
      setLoading(false);
    }
  };

  // Check if a Wishlist exists
  const isWishlisted = async (customerId: string, dishId: string) => {
    setLoading(true);
    setError(null);
    try {
      const response = await checkWishlistExists({ customerId, dishId });
      return response.success && response.exists;
    } catch (err) {
      console.error("[Wishlist_CHECK_ERROR]", err);
      setError("Error checking Wishlist");
      return false;
    } finally {
      setLoading(false);
    }
  };

  return (
    <WishlistContext.Provider
      value={{
        Wishlists,
        loading,
        error,
        fetchWishlists,
        addToWishlists,
        removeFromWishlists,
        isWishlisted,
      }}
    >
      {children}
    </WishlistContext.Provider>
  );
}

// Custom hook for accessing the Wishlist context
export function useWishlist() {
  const context = useContext(WishlistContext);
  if (!context) {
    throw new Error("useWishlist must be used within a WishlistProvider");
  }
  return context;
}
