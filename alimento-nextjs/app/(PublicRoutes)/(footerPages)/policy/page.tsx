"use client";
import { useState } from 'react';
import Link from 'next/link';

export default function PrivacyPolicy() {
  const [menuOpen, setMenuOpen] = useState(false);

  return (
    <div className="container mx-auto px-4 py-10">
      {/* Header */}
      <header className="text-center mb-10">
        <h1 className="text-5xl font-bold text-gray-800">Privacy Policy</h1>
        <p className="text-lg text-gray-600 mt-4">
          We respect your privacy and are committed to protecting your personal information.
        </p>
      </header>

      {/* Main Content */}
      <div className="bg-white p-8 shadow-lg rounded-lg">
        {/* Sections */}
        <section className="mb-10">
          <h2 className="text-3xl font-semibold text-gray-700 mb-4">Information We Collect</h2>
          <p className="text-gray-600">
            We collect personal information that you provide to us, such as your name, email address, and any other details when you create an account, place an order, or contact us for support.
          </p>
        </section>

        <section className="mb-10">
          <h2 className="text-3xl font-semibold text-gray-700 mb-4">How We Use Your Information</h2>
          <p className="text-gray-600">
            We use your information to provide and improve our services, process your orders, communicate with you, and enhance your experience on our platform.
          </p>
        </section>

        <section className="mb-10">
          <h2 className="text-3xl font-semibold text-gray-700 mb-4">Cookies and Tracking Technologies</h2>
          <p className="text-gray-600">
            We use cookies and similar technologies to track the activity on our platform and collect information. You can choose to accept or refuse cookies through your browser settings.
          </p>
        </section>

        <section className="mb-10">
          <h2 className="text-3xl font-semibold text-gray-700 mb-4">Sharing Your Information</h2>
          <p className="text-gray-600">
            We do not sell your personal information to third parties. We may share your information with trusted partners who assist us in providing our services, subject to strict confidentiality agreements.
          </p>
        </section>

        <section className="mb-10">
          <h2 className="text-3xl font-semibold text-gray-700 mb-4">Security of Your Information</h2>
          <p className="text-gray-600">
            We use appropriate technical and organizational measures to protect your personal information from unauthorized access, disclosure, alteration, or destruction.
          </p>
        </section>

        <section className="mb-10">
          <h2 className="text-3xl font-semibold text-gray-700 mb-4">Your Rights</h2>
          <p className="text-gray-600">
            You have the right to access, update, or delete your personal information. If you wish to exercise these rights, please contact us at{" "}
            <Link href="mailto:support@alimento.com" className="text-blue-600 hover:underline">
              support@alimento.com
            </Link>.
          </p>
        </section>

        <section className="mb-10">
          <h2 className="text-3xl font-semibold text-gray-700 mb-4">Changes to This Policy</h2>
          <p className="text-gray-600">
            We may update this Privacy Policy from time to time. We will notify you of any changes by posting the new Privacy Policy on our website. We encourage you to review this Privacy Policy periodically for any changes.
          </p>
        </section>

        <section className="mb-10">
          <h2 className="text-3xl font-semibold text-gray-700 mb-4">Contact Us</h2>
          <p className="text-gray-600">
            If you have any questions about this Privacy Policy, please contact us at{" "}
            <Link href="mailto:support@alimento.com" className="text-blue-600 hover:underline">
              support@alimento.com
            </Link>.
          </p>
        </section>
      </div>
    </div>
  );
}
