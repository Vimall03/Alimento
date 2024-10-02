# Alimento - Homemade Food Delivery Platform [PROTOTYPE]

Alimento is an online homemade food delivery platform that connects passionate home chefs with food enthusiasts. This platform allows home chefs to showcase their culinary skills by offering a variety of homemade dishes to users, who can easily order and enjoy delicious meals from the comfort of their homes.

## Key Features

- **Average Restaurant Rating**: Users can view the average rating of each restaurant, helping them make informed decisions when selecting their desired dishes.

- **Order Tracking**: Track the status of your food order in real-time, ensuring a seamless and transparent delivery experience.

- **Razor API Integration**: Securely handle payments with Razorpay API integration, offering users a convenient and reliable payment method.

- **Direct Vendor-Client System**: Alimento enables direct communication between vendors and clients, fostering a personalized experience and building a strong community.

- **Location-Based Sorting**: Users can sort vendors based on their location or Pincode, making it easy to find homemade food options nearby.

## How It Works

1. **Browse**: Users can browse through a diverse range of homemade dishes and explore different cuisines.

2. **Sort by Location**: Users can enter their location or PIN to find vendors offering homemade food nearby.

3. **Order**: Select your desired dishes, customize your order, and proceed to checkout.

4. **Payment**: Seamlessly complete your order with the integrated Razorpay API for secure and hassle-free payments.

5. **Track**: Keep an eye on your order's status as it's prepared and delivered by the vendor.

## Setup Guidelines 
## Prerequisites
Before starting, ensure that you have the following software installed on your machine:

- Git – Download Git
- PHP (version 7.4 or above) 
- MySQL (version 5.7 or above)
- Apache or any other local server (XAMPP, WAMP, etc.) XAMPP (for Apache, PHP, and MySQL bundled together)

## Project Setup Instructions
1. Fork and Clone the Repository
First, fork the project repository to your GitHub account. Then, clone the forked repository to your local machine.

## Clone the repository
- git clone https://github.com/<your-username>/alimento-homemade-food-delivery.git
Once the repository is cloned, navigate to the project directory.

- cd alimento-homemade-food-delivery
2. Set Up Local Server (XAMPP/WAMP)
If you're using XAMPP (or any similar stack like WAMP), follow these steps:

- Start Apache and MySQL from your local server's control panel (XAMPP/WAMP).
- Place the project folder in the htdocs directory (for XAMPP) or www (for WAMP).
For example, if using XAMPP:

## Move the project to XAMPP's htdocs directory
mv alimento-homemade-food-delivery /path-to-xampp/htdocs/
3. Configure Database
- Create a Database: Open phpMyAdmin by visiting http://localhost/phpmyadmin/ and create a new MySQL database for the project. You can name it alimento.

- CREATE DATABASE homemadedb;
- Import the Database Schema:

- Inside the project folder, look for a homemadedb.sql file.
- Import this file into your newly created database through phpMyAdmin:

4. Configure Environment Variables
If you're using different credentials for MySQL, replace root and '' with your MySQL username and password.

5. Run the Application
After completing the above steps, open your browser and visit:
- http://localhost/alimento-homemade-food-delivery
You should now see the homepage of the Alimento platform.

### Happy coding!

