"use client"; // This should be the first line

import { useState } from "react";
import Image from "next/image";
import signinImage from "../../../../../public/signin.png";
import { OtpForm } from "../../components/otpForm";
import { CustomerCreate } from "@/actions/customer/signup-action";
import {toast, Toaster } from "react-hot-toast";

const SignUpPage: React.FC = () => {
  const [email, setEmail] = useState<string>("");
  const [firstName, setFirstName] = useState<string>("");
  const [otpOpen, setOTPOpen] = useState(false);
  const [isLoading,setIsLoading] = useState(false);

  const handleSignUp = async(e: React.FormEvent) => {
    e.preventDefault();

    if (!firstName || !email) {
      toast.error("All fields are required.");
      return;
    }
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
      toast.error("Please enter a valid email address.");
      return;
    }

    setIsLoading(true);

    const res=await CustomerCreate({name:firstName,email});

    if(!res.success&&res.error){
      toast.error(res.error);
    }else{
      toast.success("OTP sent to email")
      setOTPOpen(true);
    }

    setIsLoading(false);
  };

  return (
    <div className="min-h-screen flex items-center justify-center bg-gradient-to-r from-pink-200 to-pink-400">
      <Toaster/>
      <div className="w-full max-w-4xl grid grid-cols-1 md:grid-cols-2 bg-white shadow-lg rounded-lg overflow-hidden transform transition duration-500 ease-in-out hover:scale-105">
        {!otpOpen && (
          <div className="p-10 flex flex-col justify-center">
            <h2 className="text-4xl font-bold text-center text-blue-600 mb-4">
              Join Us Today!
            </h2>
            <p className="text-center text-gray-600 mb-8">
              Create your account to get started
            </p>

            <form className="space-y-4" onSubmit={handleSignUp}>
              <div>
                <label
                  htmlFor="firstName"
                  className="block text-sm font-medium text-blue-600"
                >
                  First Name
                </label>
                <input
                  type="text"
                  id="firstName"
                  placeholder="John"
                  value={firstName}
                  onChange={(e) => setFirstName(e.target.value)}
                  className="w-full px-4 py-2 mt-1 rounded-md bg-blue-100 text-blue-800 focus:ring focus:ring-blue-400"
                  required
                />
              </div>
              <div>
                <label
                  htmlFor="email"
                  className="block text-sm font-medium text-blue-600"
                >
                  Email
                </label>
                <input
                  type="email"
                  id="email"
                  placeholder="john@example.com"
                  value={email}
                  onChange={(e) => setEmail(e.target.value)}
                  className="w-full px-4 py-2 mt-1 rounded-md bg-blue-100 text-blue-800 focus:ring focus:ring-blue-400"
                  required
                />
              </div>
              <div>
                <button
                  type="submit"
                  className="w-full py-2 bg-gradient-to-r from-green-500 to-blue-500 hover:from-blue-500 hover:to-green-500 text-white rounded-md font-bold"
                >
                  {isLoading?"Loading...":"Sign Up"}
                </button>
              </div>
            </form>

            <p className="text-center text-sm mt-4 text-black">
              Already have an account?{" "}
              <a
                href="/auth/Customer/SignIn"
                className="text-blue-500 hover:underline"
              >
                Sign In
              </a>
            </p>
            <p className="text-sm">
              <a
                href="/auth/Vendor/SignUp"
                className="text-blue-600 hover:underline"
              >
                Join as a Vendor
              </a>
            </p>
          </div>
        )}

        {otpOpen && (
          <OtpForm email={email} roleType="customer" setOtpOpen={setOTPOpen} />
        )}
        <div className="hidden md:flex items-center justify-center bg-blue-50 p-6">
          <Image
            src={signinImage}
            alt="Signup Illustration"
            layout="responsive"
            width={350}
            height={350}
            className="rounded-lg"
          />
        </div>
      </div>
    </div>
  );
};

export default SignUpPage;
