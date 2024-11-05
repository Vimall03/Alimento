"use client";

import { useState } from "react";
import { useRouter } from "next/navigation";
import { toast, ToastContainer } from "react-toastify";
import Image from "next/image";
import signinImage from "../../../../../public/signin.jpg";

const SignUpPage: React.FC = () => {
    const router = useRouter();
    const [email, setEmail] = useState < string > ("");
    const [firstName, setFirstName] = useState < string > ("");
    const [otp, setOTP] = useState < string > ("");

    const handleSignUp = (e: React.FormEvent) => {
        e.preventDefault();

        if (!firstName || !email || !otp) {
            toast.error("All fields are required.");
            return;
        }

        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            toast.error("Please enter a valid email address.");
            return;
        }

        console.log("User Data:", { firstName, email, otp });
        toast.success("Form submitted successfully!");

        router.push("/verify-email");
    };

    return (
        <div className="min-h-screen flex items-center justify-center bg-gradient-to-r from-pink-200 to-pink-400">
            <ToastContainer
                position="top-center"
                autoClose={5000}
                hideProgressBar
                newestOnTop
                closeOnClick
                rtl={false}
                pauseOnFocusLoss
                draggable
                pauseOnHover
                className="mt-16"
            />
            <div className="w-full max-w-4xl grid grid-cols-1 md:grid-cols-2 bg-white shadow-lg rounded-lg overflow-hidden transform transition duration-500 ease-in-out hover:scale-105">
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
                            <label
                                htmlFor="otp"
                                className="block text-sm font-medium text-blue-600"
                            >
                                OTP
                            </label>
                            <input
                                type="text"
                                id="otp"
                                placeholder="Enter your OTP"
                                value={otp}
                                onChange={(e) => setOTP(e.target.value)}
                                className="w-full px-4 py-2 mt-1 rounded-md bg-blue-100 text-blue-800 focus:ring focus:ring-blue-400"
                                required
                            />
                        </div>
                        <div>
                            <button
                                type="submit"
                                className="w-full py-2 bg-gradient-to-r from-green-500 to-blue-500 hover:from-blue-500 hover:to-green-500 text-white rounded-md font-bold"
                            >
                                Sign Up
                            </button>
                        </div>
                    </form>
                    <p className="text-center text-sm mt-4 text-black">
                        Already have an account?{" "}
                        <a
                            href="/login"
                            className="text-blue-500 hover:underline"
                        >
                            Log In
                        </a>
                    </p>
                </div>
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