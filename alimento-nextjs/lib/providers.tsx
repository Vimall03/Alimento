'use client';
import React from 'react';
import { SessionProvider } from 'next-auth/react';
import { GlobalDishProvider } from '@/context/dishFormContext';

export const Providers = ({ children }: { children: React.ReactNode }) => {
  return <SessionProvider><GlobalDishProvider>{children}</GlobalDishProvider></SessionProvider>
};
