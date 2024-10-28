# 🍲 Alimento - Homemade Food Delivery Platform [PROTOTYPE]

Alimento is an online homemade food delivery platform that connects passionate home chefs with food enthusiasts. This platform allows home chefs to showcase their culinary skills by offering a variety of homemade dishes to users, who can easily order and enjoy delicious meals from the comfort of their homes.

<table align="center">
    <thead align="center">
        <tr border: 2px;>
            <td><b>🌟 Stars</b></td>
            <td><b>🍴 Forks</b></td>
            <td><b>🐛 Issues</b></td>
            <td><b>🔔 Open PRs</b></td>
            <td><b>🔕 Close PRs</b></td>
        </tr>
     </thead>
    <tbody>
         <tr>
            <td><img alt="Stars" src="https://img.shields.io/github/stars/Vimall03/Alimento?style=flat&logo=github"/></td>
             <td><img alt="Forks" src="https://img.shields.io/github/forks/Vimall03/Alimento?style=flat&logo=github"/></td>
            <td><img alt="Issues" src="https://img.shields.io/github/issues/Vimall03/Alimento?style=flat&logo=github"/></td>
            <td><img alt="Open Pull Requests" src="https://img.shields.io/github/issues-pr/Vimall03/Alimento?style=flat&logo=github"/></td>
           <td><img alt="Close Pull Requests" src="https://img.shields.io/github/issues-pr-closed/Vimall03/Alimento?style=flat&color=critical&logo=github"/></td>
        </tr>
    </tbody>
</table>
<img src="https://user-images.githubusercontent.com/74038190/212284100-561aa473-3905-4a80-b561-0d28506553ee.gif" width="900">

## Featured In

<table>
<tr>
      <th>Event Logo</th>
      <th>Event Name</th>
      <th>Event Description</th>
    </tr>
    <tr>
        <td><img src="https://user-images.githubusercontent.com/63473496/213306279-338f7ce9-9a9f-4427-8c2a-3e344874498f.png#gh-dark-mode-only" width="200" height="auto" loading="lazy" alt="GSSoC Ext 24"/></td>
        <td>GirlScript Summer of Code Ext 2024</td>
        <td>GSSOC Ext is a one-month-long open-source program by the GirlScript Foundation that runs from October 1 to November 10, 2024</td> 
    </tr>
   <tr>
        <td><img src="https://cdn.prod.website-files.com/63bc83b29094ec80844b6dd5/66fc35d92c74c4e4103f3673_Flyte-at-Hacktoberfest-2024.png" width="200" height="auto" loading="lazy" alt="Hacktoberfest 24"/></td>
        <td>Hacktoberfest 2024</td>
        <td>Hacktober Fest is an annual celebration of open-source software development. It's a month-long event encouraging developers to contribute to open-source projects.</td> 
    </tr>
</table>
<img src="https://user-images.githubusercontent.com/74038190/212284100-561aa473-3905-4a80-b561-0d28506553ee.gif" width="900">

## 🌟  Key Features

- ⭐ **Average Restaurant Rating**: Users can view the average rating of each restaurant, helping them make informed decisions when selecting their desired dishes.

-  📦 **Order Tracking**: Track the status of your food order in real-time, ensuring a seamless and transparent delivery experience.

- 📦  **Razor API Integration**: Securely handle payments with Razorpay API integration, offering users a convenient and reliable payment method.

-  🤝 **Direct Vendor-Client System**: Alimento enables direct communication between vendors and clients, fostering a personalized experience and building a strong community.

-  📍 **Location-Based Sorting**: Users can sort vendors based on their location or Pincode, making it easy to find homemade food options nearby.
  
<img src="https://user-images.githubusercontent.com/74038190/212284100-561aa473-3905-4a80-b561-0d28506553ee.gif" width="900">

##  🚀 How It Works

1. **Browse** 🍽️: Users can browse through a diverse range of homemade dishes and explore different cuisines.

2. **Sort by Location** 📍: Users can enter their location or PIN to find vendors offering homemade food nearby.

3. **Order** 🛒: Select your desired dishes, customize your order, and proceed to checkout.

4. **Payment** 💳: Seamlessly complete your order with the integrated Razorpay API for secure and hassle-free payments.

5. **Track** 🕒: Keep an eye on your order's status as it's prepared and delivered by the vendor.
   
<img src="https://user-images.githubusercontent.com/74038190/212284100-561aa473-3905-4a80-b561-0d28506553ee.gif" width="900">

## 🛠️ Technology Stack
- **Frontend**: HTML, CSS, JavaScript, **Tailwind CSS**
- **Backend**: PHP
- **Payment Gateway**: Razorpay API
- **Database**: MySQL

## Setup tour
1. [**Setup Tailwind CSS**](#setup-tailwind)



## 🤔 Why Choose Alimento?

1. **Freshly Prepared Meals** 🍲: Savor nutritious, home-cooked dishes made with passion and care by talented home chefs.
2. **Support Local Communities** 🌍: Help empower local entrepreneurs by ordering authentic, homemade food directly from your community.
3. **Personalized Options** 📝: Enjoy meals tailored to your taste and dietary preferences, with direct communication for special requests.
4. **Prompt Deliveries** 🚚: Get your food delivered quickly and efficiently, maintaining its freshness.
5. **Convenient Location Sorting** 📍: Easily find nearby home chefs, ensuring fast, reliable service based on your location.
   
<img src="https://user-images.githubusercontent.com/74038190/212284100-561aa473-3905-4a80-b561-0d28506553ee.gif" width="900">

## Setup Guidelines 🛠️
## Prerequisites ✅
Before starting, ensure that you have the following software installed on your machine:

- Git – Download Git
- PHP (version 7.4 or above) 
- MySQL (version 5.7 or above)
- Apache or any other local server (XAMPP, WAMP, etc.) XAMPP (for Apache, PHP, and MySQL bundled together)

## Project Setup Instructions 📦
1. Fork and Clone the Repository
First, fork the project repository to your GitHub account. Then, clone the forked repository to your local machine.

## Clone the repository
- git clone https://github.com/Vimall03/Alimento.git
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
- http://localhost/alimento
You should now see the homepage of the Alimento platform.

<img src="https://user-images.githubusercontent.com/74038190/212284100-561aa473-3905-4a80-b561-0d28506553ee.gif" width="900">

<h1 id="setup-tailwind">Setup Tailwind css</h1>

1. Go to alimento directory in your terminal
2. You should have [node.js](https://nodejs.org/en/download/package-manager) installed. 

- Run the following command:
```
npm install -D tailwindcss
```
3. Run the following command to see the tailwind css changes:
- Without running this command you will not see the changes made by tailwind css. Everytime you start the project, you need to run this command in background.
```
npx tailwindcss -i global.css -o output.css --watch
```

Congrats, you've completed the tailwind css setup.

## 👀 Our Contributors

- We extend our heartfelt gratitude for your invaluable contribution to our project! Your efforts play a pivotal role in elevating this project to greater heights.
- Make sure you show some love by giving ⭐ to our repository.

<div align="center">
<a href="https://github.com/Vimall03/Alimento/graphs/contributors">
  <img src="https://contrib.rocks/image?repo=Vimall03/Alimento" />
</a>
</div>

<img src="https://user-images.githubusercontent.com/74038190/212284100-561aa473-3905-4a80-b561-0d28506553ee.gif" width="900">

## Stargazers ❤️

<div align='left'>

[![Stargazers repo roster for @Vimall03/Alimento](https://reporoster.com/stars/dark/Vimall03/Alimento)](https://github.com/Vimall03/Alimento/stargazers)


</div>

## Forkers ❤️

[![Forkers repo roster for @Vimall03/Alimento](https://reporoster.com/forks/dark/Vimall03/Alimento)](https://github.com/Vimall03/Alimento/network/members)



<img src="https://user-images.githubusercontent.com/74038190/212284100-561aa473-3905-4a80-b561-0d28506553ee.gif" width="900">

## ⭐ Star the Repo!
If you find this project useful and would like to support the project, please consider giving it a ⭐ star on GitHub! Your support helps us grow and improve. Thank you! 🙌

Keep learning and exploring! 🚀

### Happy coding! 👩‍💻🎉

