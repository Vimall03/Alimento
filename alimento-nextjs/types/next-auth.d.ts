// next-auth.d.ts
import NextAuth, { DefaultUser, Session } from 'next-auth';
import { JWT } from 'next-auth/jwt';

declare module 'next-auth' {
  interface Session {
    user: {
      id: string;
      name?: string;
      email?: string;
      role: 'customer' | 'vendor'; // Extend with the role property
    };
  }

  interface User extends DefaultUser {
    role: 'customer' | 'vendor'; // Add role to User object
  }
}

declare module 'next-auth/jwt' {
  interface JWT {
    uid: string;
    role: 'customer' | 'vendor'; // Add role to JWT token
  }
}

declare module 'leaflet' {
  interface IconDefault {
    _getIconUrl?: () => string;
  }
}
