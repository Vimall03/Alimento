import { Metadata } from 'next';
import Image from 'next/image';
import { AdminLoginForm } from '@/app/admin/auth/components/login-form';

export const metadata: Metadata = {
  title: 'Authentication',
  description: 'Authentication forms built using the components.',
};

export default function AuthenticationPage() {
  return (
    <>
      <div className="flex flex-col md:flex-row items-center justify-center min-h-screen bg-gradient-to-r from-purple-600 via-blue-600 to-indigo-600">
        {/* Background Image Section for larger screens */}
     
          <Image
            src="/adminLogin.png"
            width={1280}
            height={843}
            alt="Authentication"
            className="object-contain w-2/4 h-2/4 rounded-xl"
          />


        {/* Main Content Section */}
        <div className="z-10 w-full max-w-2xl px-6 py-8 mx-auto text-white  rounded-xl bg-black bg-opacity-70">
          <div className="space-y-6">
            {/* Title and Description */}
            <div className="text-center">
              <h1 className="text-3xl font-semibold">Welcome Back, Admin!</h1>
              <p className="text-sm text-muted-foreground">Enter your credentials to access your admin panel.</p>
            </div>

            {/* Admin Login Form */}
            <AdminLoginForm className='w-full' authType="login" />

            {/* Alternative Links
            <div className="flex justify-between text-sm text-center text-white">
            </div> */}
          </div>
        </div>
      </div>
    </>
  );
}
