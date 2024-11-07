"use client";
import { useState, FormEvent } from "react";
import Image from "next/image";
import signinImage from "../../../../../public/signin.jpg";
import Link from "next/link";
import { toast, Toaster } from "react-hot-toast";
import { VendorVerify } from "@/actions/vendor/login-action";
import { OtpForm } from "../../components/otpForm";

const SignInPage: React.FC = () => {
  const [email, setEmail] = useState<string>("");
  const [isSignUp, setIsSignUp] = useState<boolean>(false);
  const [otpOpen, setOTPOpen] = useState(false);
  const [isLoading, setIsLoading] = useState(false);

  const handleSendOTP = async (e: FormEvent) => {
    e.preventDefault();

    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
      toast.error("Please enter a valid email address.");
      return;
    }

    setIsLoading(true);

    const res = await VendorVerify({ email });

    if (!res.success && res.error) {
      toast.error(res.error);
    } else {
      toast.success("OTP sent to email");
      setOTPOpen(true);
    }

    setIsLoading(false);
  };

  return (
    <div className="min-h-screen flex items-center justify-center bg-gradient-to-r from-pink-200 to-pink-400">
      <Toaster/>
      <div className="w-full max-w-4xl grid grid-cols-1 md:grid-cols-2 bg-white shadow-lg rounded-lg overflow-hidden transform transition duration-500 ease-in-out hover:scale-105">
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
        {!otpOpen && (
        <div className="p-8 md:p-10 flex flex-col justify-center bg-white">
          <h2 className="text-3xl font-semibold text-center text-blue-700 mb-3">
            {isSignUp ? "Sign Up" : "Sign In"}
          </h2>
          <p className="text-center text-gray-600 mb-6">
            Enter your email to{" "}
            {isSignUp ? "create an account" : "receive an OTP"}
          </p>
          <form className="space-y-6" onSubmit={handleSendOTP}>
            <div>
              <label
                htmlFor="email"
                className="block text-sm font-medium text-blue-600 mb-1"
              >
                Email
              </label>
              <input
                type="email"
                id="email"
                placeholder="yourname@example.com"
                value={email}
                onChange={(e) => setEmail(e.target.value)}
                className="w-full px-4 py-2 rounded-md bg-blue-50 border border-blue-200 text-blue-900 focus:ring-2 focus:ring-blue-400"
                required
              />
            </div>

            <div>
              <button
                type="submit"
                className="w-full py-2 bg-gradient-to-r from-green-500 to-blue-500 hover:from-blue-500 hover:to-green-500 text-white rounded-md font-semibold transition"
              >
                {isLoading?"Loading...":"SignIn"}
              </button>
            </div>
          </form>
          <div className="text-center mt-4 space-y-2">
            <p className="text-sm text-black">
              Don’t have an account?{" "}
              <a
                href="/auth/Vendor/SignUp"
                onClick={() => setIsSignUp(true)}
                className="text-green-500 hover:underline"
              >
                Sign Up
              </a>
            </p>
            <p className="text-sm">
              <Link
                href="/auth/Customer/SignIn"
                className="text-blue-600 hover:underline"
              >
                Sign In as a Customer
              </Link>
            </p>
          </div>
        </div>
        )}
         {otpOpen && (
          <OtpForm email={email} roleType="vendor" setOtpOpen={setOTPOpen} />
        )}
      </div>
    </div>
  );
};

export default SignInPage;
