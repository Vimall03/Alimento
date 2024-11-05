"use client";
import { useState, FormEvent } from "react";
import { ToastContainer, toast } from "react-toastify";
import "react-toastify/dist/ReactToastify.css";
import Image from "next/image";
import signinImage from "../../../../../public/signin.jpg";

const SignInPage: React.FC = () => {
    const [email, setEmail] = useState < string > ("");
    const [isSignUp, setIsSignUp] = useState < boolean > (false);

    const handleSendOTP = (e: FormEvent) => {
        e.preventDefault();

        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            toast.error("Please enter a valid email address.");
            return;
        }

        console.log("OTP sent to:", email);
        toast.success("OTP sent to your email!");
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
                                Send OTP
                            </button>
                        </div>
                    </form>
                    <div className="text-center mt-4 space-y-2">
                        <p className="text-sm">
                            <a
                                href="#"
                                className="text-blue-600 hover:underline"
                            >
                                Forgot Password?
                            </a>
                        </p>
                        <p className="text-sm text-black">
                            Don’t have an account?{" "}
                            <a
                                href="#"
                                onClick={() => setIsSignUp(true)}
                                className="text-green-500 hover:underline"
                            >
                                Sign Up
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    );
};

export default SignInPage;