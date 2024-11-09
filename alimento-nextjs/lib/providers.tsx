'use client';
import React from 'react';
import { SessionProvider } from 'next-auth/react';
import { GlobalDishProvider } from '@/context/dishFormContext';
import { WishlistProvider } from '@/context/customerWishlistProvider';

export const Providers = ({ children }: { children: React.ReactNode }) => {
  return <SessionProvider><GlobalDishProvider><WishlistProvider>{children}</WishlistProvider></GlobalDishProvider></SessionProvider>
};
