"use client";
import React from "react";
import Image from "next/image";
import Sidebar from "./pages/sidebar";

const SetUpDishes = ({ VendorId }: { VendorId: string }) => {
  return (
    <>
      <main className="bg-secondary-mongolia mr-10 relative h-screen md:overflow-hidden overflow-y-auto px-10 md:flex items-center justify-center font-ubuntu">
        <div className="hidden  lg:flex  gap-20  flex-col items-center justify-center text-center text-4xl font-bold">
          Hey! Let&apos;s upload you first dish on ALIMENTO
          <Image
            src="/dishGuide.jpg"
            height={1000}
            width={1000}
            alt="storeSetuppage"
            className="hidden md:block h-3/4 w-3/4"
          />
        </div>

        <div className="md:gray-200  bg-gray-200 dark:bg-gray-700 rounded-xl shadow-md absolute md:relative p-4 flex md:flex-row flex-col md:max-h-[550px] md:max-w-[900px] h-full w-full">
          <Sidebar />
          {/* <Main VendorId={VendorId} /> */}
        </div>
      </main>
    </>
  );
};

export default SetUpDishes;
