"use client"

import Link from 'next/link';
import { useState } from 'react';

export default function TermsAndConditions() {
  const [menuOpen, setMenuOpen] = useState(false);

  return (
    <div className="flex">
      {/* Sidebar Navigation */}
      <div className="w-1/4 p-5 hidden md:block bg-blue-50">
        <ul className="text-blue-600">
          <li className="mb-3"><a href="#acceptance" className="hover:underline">Acceptance of Terms</a></li>
          <li className="mb-3"><a href="#use" className="hover:underline">Use of Platform and Services</a></li>
          <li className="mb-3"><a href="#property" className="hover:underline">Intellectual Property</a></li>
          <li className="mb-3"><a href="#guidelines" className="hover:underline">Posting Guidelines</a></li>
          <li className="mb-3"><a href="#security" className="hover:underline">Account Security</a></li>
          <li className="mb-3"><a href="#links" className="hover:underline">External Links</a></li>
          <li className="mb-3"><a href="#limitations" className="hover:underline">Limitation of Liability</a></li>
          <li className="mb-3"><a href="#policy" className="hover:underline">Privacy Policy</a></li>
        </ul>
      </div>

      {/* Main Content */}
      <div className="w-full md:w-3/4 p-5">
        <h1 className="text-4xl font-bold mb-5 text-blue-700">Terms and Conditions for Alimento</h1>
        <p className="text-gray-600 mb-5">
          Welcome to Alimento, a platform for discovering the best restaurants and ordering delicious food. By accessing and using Alimento, you agree to the following Terms & Conditions.
        </p>

        <section id="acceptance" className="mb-10">
          <h2 className="text-2xl font-semibold text-blue-800 mb-3">Acceptance of Terms</h2>
          <p className="text-gray-700">
            By using Alimento, you agree to these Terms & Conditions. If you do not accept any of these terms, please refrain from using our platform.
          </p>
        </section>

        <section id="use" className="mb-10">
          <h2 className="text-2xl font-semibold text-blue-800 mb-3">Use of Platform and Services</h2>
          <p className="text-gray-700">
            Alimento provides a marketplace for users to explore local restaurants and order food. Users are responsible for all transactions, including contacting restaurants directly.
          </p>
        </section>

        <section id="property" className="mb-10">
          <h2 className="text-2xl font-semibold text-blue-800 mb-3">Intellectual Property</h2>
          <p className="text-gray-700">
            All content on Alimento, including logos and trademarks, is owned by Alimento and protected under copyright laws. Unauthorized use is prohibited.
          </p>
        </section>

        <section id="guidelines" className="mb-10">
          <h2 className="text-2xl font-semibold text-blue-800 mb-3">Posting Guidelines</h2>
          <p className="text-gray-700">
            Users are responsible for the content they post and must ensure it complies with our guidelines, which prohibit spam, inappropriate content, and illegal activities.
          </p>
        </section>

        <section id="security" className="mb-10">
          <h2 className="text-2xl font-semibold text-blue-800 mb-3">Account Security</h2>
          <p className="text-gray-700">
            Users must maintain the confidentiality of their account information. Alimento is not liable for any unauthorized access to your account.
          </p>
        </section>

        <section id="links" className="mb-10">
          <h2 className="text-2xl font-semibold text-blue-800 mb-3">External Links</h2>
          <p className="text-gray-700">
            Alimento may contain links to external websites. We are not responsible for the content or reliability of these sites.
          </p>
        </section>

        <section id="limitations" className="mb-10">
          <h2 className="text-2xl font-semibold text-blue-800 mb-3">Limitation of Liability</h2>
          <p className="text-gray-700">
            Alimento is not liable for any damages resulting from the use of our platform. All services are provided "as is" without any guarantees.
          </p>
        </section>

        <section id="policy" className="mb-10">
          <h2 className="text-2xl font-semibold text-blue-800 mb-3">Privacy Policy</h2>
          <p className="text-gray-700">
            We value your privacy. Please refer to our Privacy Policy for information on how we collect, use, and protect your data.
          </p>
        </section>
      </div>
    </div>
  );
}
