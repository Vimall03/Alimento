'use client';

import { cn } from '@/utils/utils';
import Link from 'next/link';
import { usePathname } from 'next/navigation';
import { useEffect, useState } from 'react';

const MainNav = () => {
  const pathname = usePathname();
  const [loading, setLoading] = useState(true);

  const routes = [
    {
      href: `/`,
      label: 'Home',
      active: pathname.startsWith(`/`),
    },
    {
      href: `/orders`,
      label: 'Orders',
      active: pathname.startsWith(`/`),
    },
  ];

  useEffect(() => {
    setLoading(false);
  }, []);

  if (loading) {
    return null;
  }

  return (
    <div className="mx-40     flex items-center justify-center space-x-4 lg:space-x-6">
      {routes.map(route => (
        <Link
          key={route.href}
          href={route.href}
          className={cn(
            'text-sm font-medium transition-colours hover:text-black',
            route.active ? 'text-black' : 'text-neutral-500'
          )}
        >
          {route.label}
        </Link>
      ))}
    </div>
  );
};

export default MainNav;