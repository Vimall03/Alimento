'use client';

import { LogInIcon } from 'lucide-react';
import { signOut, useSession } from 'next-auth/react';
import Link from 'next/link';
import { useEffect, useState } from 'react';
import { Button } from '../ui/button';

const NavbarActions = () => {
  //prevention for hydration error

  const [isMounted, setIsMounted] = useState(false);

  const session = useSession();

  useEffect(() => {
    setIsMounted(true);
  }, []);

  if (!isMounted) return null;

  return (
    <div className="ml-auto flex items-center gap-x-4">
      {session.status == 'unauthenticated' && (
        <Link className="bg-black p-4 rounded-full" href={'/auth/user/login'}>
          <LogInIcon size={20} color="white" />
        </Link>
      )}
      {session.status == 'authenticated' && (
        <>
          <div>Hi! {session.data.user?.name}</div>
          <Button
            className="rounded-full"
            variant={'outline'}
            onClick={() => {
              signOut();
            }}
          >
            Log out
          </Button>
        </>
      )}
    </div>
  );
};

export default NavbarActions;