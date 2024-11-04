"use client"

import { cn } from '@/lib/utils';
import {Button} from '@/components/ui/button'
import {Card} from "@/components/ui/card"
import {Input} from "@/components/ui/input"
import Image from 'next/image';
import Link from 'next/link';
import { ShoppingCart, Truck, Award, ChevronLeft, ChevronRight } from 'lucide-react';

const services = [
  { icon: ShoppingCart, title: 'Easy to order', text: 'Our user-friendly UI makes it easier for you to order seamlessly.' },
  { icon: Truck, title: 'Safe Delivery', text: 'Assured no damage to food with our safe delivery service.' },
  { icon: Award, title: 'Best Quality', text: 'Collections of best-rated restaurants maintain our quality standards.' }
];

function ServiceSection() {
  return (
    <div className="flex flex-wrap justify-center gap-8 mt-10">
      {services.map((service, index) => (
        <div key={index} className="flex items-center flex-col text-center">
          <div className="bg-[#E6E8DD] w-32 h-32 rounded-full flex items-center justify-center">
            <service.icon size={40} color="#5C5F50" /> {/* Adjust size and color as needed */}
          </div>
          <h2 className="text-gray-800 font-semibold text-2xl mt-2 sm:text-xl lg:text-2xl xl:text-3xl">
            {service.title}
          </h2>
          <p className="text-gray-600 text-base mt-1 w-3/4 mx-auto sm:text-sm lg:text-lg">
            {service.text}
          </p>
        </div>
      ))}
    </div>
  );
}

export default function Home() {
  return (
    <>
      {/* Hero Section */}
      <div className={cn("mx-5 bg-[#E6E8DD] p-3 rounded-3xl font-poppins flex flex-wrap-reverse md:flex-nowrap md:py-10 lg:max-w-5xl lg:mx-auto lg:gap-10 lg:justify-around xl:max-w-7xl xl:mx-auto mt-4")}>
        {/* Left Section */}
        <div className={cn("mt-14 px-5 md:w-2/3 lg:w-1/2 xl:mt-20 xl:pt-10 xl:w-1/2")}>
          <div className="mb-4">
            <h1 className="font-bold text-3xl text-gray-800 sm:text-4xl lg:text-5xl lg:leading-tight">
              Discover the best food at your place
            </h1>
            <p className="text-[#919388] mt-4 text-base font-medium lg:text-lg">
              Craving something delicious? Explore the best food around you, from local favorites to hidden gems all just a tap away!
            </p>
          </div>
          {/* Search Form and Buttons */}
          <div className="mt-10">
            <form action="/pin_search" method="post" className="flex px-4 md:px-5 py-3 bg-white w-full rounded-lg md:rounded-full lg:px-6 lg:py-4">
              <Input
                type="number"
                placeholder="Search by pincode"
                name="pincode"
                required
                className="w-full focus:border-none focus:outline-none text-gray-700 lg:text-lg"
              />
              <button type="submit" className="ml-2">
                <i className="bi bi-crosshair select-none text-xl text-gray-700 lg:text-2xl"></i>
              </button>
            </form>
            <div className="flex justify-between w-full mt-4 items-center mb-4">
              <Link
                href="/home"
                className={cn("bg-[#6E725E] flex justify-center items-center w-full text-[#FDFFF5] py-3 rounded-lg border border-[#585b4d] md:rounded-full hover:bg-[#585b4d] lg:px-6 lg:py-4 lg:text-lg")}
              >
                Delivery
              </Link>
              <p className="mx-3 lg:text-lg text-center">Or</p>
              <Link
                href="/home"
                className={cn("bg-[#FDFFF5] flex justify-center items-center w-full py-3 rounded-lg md:rounded-full border border-[#585b4d] hover:bg-white lg:px-6 lg:py-4 lg:text-lg")}
              >
                Dine in
              </Link>
            </div>
          </div>
        </div>
        {/* Right Section */}
        <div className="flex flex-col w-full md:w-auto md:gap-5 lg:w-auto xl:w-2/5">
          <Image
            src="/pizza-hero.webp"
            alt="hero-image"
            className="w-40 self-end rounded-full p-1 sm:w-52 md:w-36 lg:w-40 xl:w-52"
            width={160}
            height={160}
          />
          <Image
            src="/dish1-hero.webp"
            alt="hero-image"
            className="w-72 self-start rounded-full md:w-52 lg:w-80 xl:w-96"
            width={288}
            height={288}
          />
      </div>

      </div>

      {/* Services Section */}
        <ServiceSection />

      {/* Reviews Section */}
      <div className={cn("flex flex-wrap-reverse mx-5 my-10 sm:mt-16 sm:max-w-xl sm:mx-auto md:max-w-4xl md:px-5 md:flex-nowrap md:grid md:grid-cols-2 md:mt-32 lg:max-w-5xl xl:max-w-7xl")}>
        <div className="font-poppins">
          <h2 className="font-semibold text-2xl text-gray-800 md:text-3xl lg:text-4xl">Our lovely customer loves our food!</h2>
          <p className="text-gray-700 text-base mt-2 md:text-lg">
            “Donec euismod a mauris ornare posuere. Donec porttitor ex vitae ipsum tincidunt auctor. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas”
          </p>
          <div className="mt-2 flex gap-3 md:mt-16">
            {Array(4).fill(null).map((_, i) => (
              <i key={i} className="bi bi-star-fill md:text-lg text-[#FFCC01]"></i>
            ))}
            <i className="bi bi-star-half md:text-lg text-[#FFCC01]"></i>
          </div>
          <div>
            <h3 className="font-semibold text-lg text-gray-800 md:text-xl">Martin Robbin</h3>
            <p className="text-gray-500 text-sm md:text-lg">Delhi, India</p>
          </div>
          <div className="mt-5 flex items-center gap-2">
          <Button variant="outline" className="w-10 h-10 p-2 rounded-full shadow shadow-gray-300">
            <ChevronLeft size={20} className="text-gray-600" />
          </Button>
          <Button variant="outline" className="w-10 h-10 p-2 rounded-full shadow shadow-gray-300">
            <ChevronRight size={20} className="text-gray-600" />
          </Button>
         </div>
        </div>
        <div className="mx-auto">
          <Image src="/review.webp" alt="review-image" className="w-96 sm:w-80 md:w-96 lg:w-[500px]" width={384} height={384} />
        </div>
      </div>

      {/* Membership Section */}
      <div className={cn("bg-white")}>
      <Card className={cn("my-10 mx-5 rounded-3xl p-5 font-poppins text-black bg-[rgba(230,232,221,var(--tw-bg-opacity))] sm:max-w-xl md:max-w-3xl lg:max-w-5xl xl:max-w-7xl sm:mx-auto sm:h-80 lg:h-96")}>
        <div className="mt-10 text-center sm:px-10 sm:py-7 md:px-16 lg:px-64">
          <h2 className="font-semibold text-xl sm:text-2xl md:text-3xl lg:text-4xl">
            Join our membership and get discount up to 50%
          </h2>
          <form className={cn("bg-white flex items-center justify-between py-1 mt-9 px-2 rounded-xl sm:mt-16 sm:py-2 sm:px-3 sm:rounded-2xl lg:rounded-full lg:px-5")}>
            <Input
              type="email"
              placeholder="Enter your email"
              required
              className="w-full border-none outline-none text-gray-700 text-sm sm:text-base sm:ml-2 lg:text-lg"
            />
            <Button type="submit" className="bg-gray-800 text-white rounded-xl py-2 px-4 text-sm sm:text-base sm:py-2 sm:px-3 lg:rounded-full lg:px-5 lg:py-3 lg:text-lg">
              Subscribe
            </Button>
          </form>
        </div>
      </Card>
      </div>

    </>
  );
}
