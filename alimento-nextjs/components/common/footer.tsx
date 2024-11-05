'use client';

import {
  ChevronRight,
  Facebook,
  Heart,
  Instagram,
  Twitter,
} from 'lucide-react';
import Link from 'next/link';
import { useState } from 'react';

const Links = [
  { name: 'About us', id: 1, href: '/about' },
  { name: 'Our Teams', id: 2, href: '/team' },
  { name: 'Terms of service', id: 3, href: '/terms' },
  { name: 'Our Contributors', id: 4, href: '/contributors' },
  { name: 'Privacy and Policy', id: 5, href: '/policy' },
];

const Helpdesk = [
  { name: 'Help Center', id: 1, href: '/HelpCenter' },
  { name: 'FAQ', id: 2, href: '/FAQ' },
  { name: 'Contact Us', id: 3, href: '/ContactUs' },
  { name: 'Support', id: 4, href: '/Support' },
];

const Footer = () => {
  const [hoveredId, setHoveredId] = useState(0);

  return (
    <footer className="flex flex-col items-center bg-gray-50 text-gray-700 dark:bg-gray-900 dark:text-gray-300 py-10 px-5">
      <div className="w-full max-w-screen-lg grid grid-cols-1 lg:grid-cols-4 gap-8 border-t border-gray-200 dark:border-gray-800 pt-8">
        
        {/* About Section */}
        <div className="flex flex-col items-start gap-3">
          <Link href="/" className="text-2xl font-semibold text-black dark:text-white">
            Alimento
          </Link>
          <p className="text-sm leading-relaxed">
            Alimento brings you a refined platform for buying, selling, and discovering quality goods and services. Experience community connection with ease and trust.
          </p>
        </div>

        {/* Quick Links Section */}
        <div className="flex flex-col gap-3">
          <h2 className="font-semibold text-lg">Quick Links</h2>
          <nav className="flex flex-col gap-2">
            {Links.map(link => (
              <Link
                key={link.id}
                href={link.href}
                onMouseOver={() => setHoveredId(link.id)}
                onMouseLeave={() => setHoveredId(0)}
                className="flex items-center gap-2 text-sm transition-colors duration-300 hover:text-primary"
              >
                <ChevronRight className="h-4 w-4" />
                <span className={hoveredId === link.id ? 'underline' : ''}>
                  {link.name}
                </span>
              </Link>
            ))}
          </nav>
        </div>

        {/* Helpdesk Section */}
        <div className="flex flex-col gap-3">
          <h2 className="font-semibold text-lg">Helpdesk</h2>
          <nav className="flex flex-col gap-2">
            {Helpdesk.map(link => (
              <Link
                key={link.id}
                href={link.href}
                onMouseOver={() => setHoveredId(link.id)}
                onMouseLeave={() => setHoveredId(0)}
                className="flex items-center gap-2 text-sm transition-colors duration-300 hover:text-primary"
              >
                <ChevronRight className="h-4 w-4" />
                <span className={hoveredId === link.id ? 'underline' : ''}>
                  {link.name}
                </span>
              </Link>
            ))}
          </nav>
        </div>

        {/* Follow Us Section */}
        <div className="flex flex-col gap-3">
          <h2 className="font-semibold text-lg">Follow Us</h2>
          <div className="flex gap-4">
            <a href="#" className="rounded-full bg-gray-100 dark:bg-gray-700 p-2">
              <Facebook className="text-gray-600 dark:text-gray-400" />
            </a>
            <a href="#" className="rounded-full bg-gray-100 dark:bg-gray-700 p-2">
              <Twitter className="text-gray-600 dark:text-gray-400" />
            </a>
            <a href="#" className="rounded-full bg-gray-100 dark:bg-gray-700 p-2">
              <Instagram className="text-gray-600 dark:text-gray-400" />
            </a>
          </div>
        </div>
      </div>

      {/* Footer Bottom */}
      <div className="w-full max-w-screen-lg flex flex-col lg:flex-row items-center justify-between text-sm mt-8 text-center lg:text-left">
        <p>&copy; 2024 Alimento. All rights reserved.</p>
        <div className="flex items-center gap-1">
          Made with <Heart fill="red" className="w-4 h-4 mx-1" /> by Team Alimento
        </div>
      </div>
    </footer>
  );
};

export default Footer;
