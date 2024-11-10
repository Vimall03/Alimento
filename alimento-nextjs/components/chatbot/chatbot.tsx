import { useState } from "react";
import ChatBot from "react-simple-chatbot";

const Chatbot = () => {
  const [userMessage, setUserMessage] = useState("");

  const handleMessage = (msg) => {
    setUserMessage(msg); // Update user message on each interaction
  };

  const flow = [
    {
      id: "1",
      message: "Welcome to **Alimento**, your local food connection! What is your name?",
      trigger: "2", // Proceed to step 2 after the question
    },
    {
      id: "2",
      user: true, // Wait for user input (name)
      trigger: "3", // Proceed to step 3 once the user responds
    },
    {
      id: "3",
      message: "Hi {previousValue}, nice to meet you! How can I assist you today?",
      trigger: "4", // Proceed to step 4 after greeting
    },
    {
      id: "4",
      message: "Please choose an option below to proceed:",
      trigger: "5", // Provide options to the user
    },
    {
      id: "5",
      options: [
        { value: "Request a dish from a local vendor", label: "Request a dish", trigger: "6" },
        { value: "Find a recipe to make your favorite dish", label: "Find a recipe", trigger: "8" },
        { value: "Explore vendor details", label: "Explore vendors", trigger: "16" },
      ],
    },
    // ------------------- Request a dish flow -------------------
    {
      id: "6",
      message: "Great! What type of dish would you like to request from a local vendor?",
      trigger: "7", // Go to step 7 to choose the dish
    },
    {
      id: "7",
      options: [
        { value: "Indian", label: "Indian", trigger: "9" },
        { value: "Chinese", label: "Chinese", trigger: "9" },
        { value: "Italian", label: "Italian", trigger: "9" },
        { value: "Vegetarian", label: "Vegetarian", trigger: "9" },
        { value: "Non-Vegetarian", label: "Non-Vegetarian", trigger: "9" },
      ],
    },
    {
      id: "9",
      message: "Awesome! We will connect you to a vendor specializing in {previousValue} dishes. Please wait a moment.",
      trigger: "10",
    },
    {
      id: "10",
      message: "Your request has been forwarded! A vendor will contact you shortly. Is there anything else I can help you with?",
      trigger: "5", // Give another set of options or end the chat
    },
    // ------------------- Find a recipe flow -------------------
    {
      id: "8",
      message: "Here are some recipes to try out! Which one would you like to explore?",
      trigger: "11", // Proceed to recipe options
    },
    {
      id: "11",
      options: [
        { value: "Indian", label: "Indian", trigger: "12" },
        { value: "Chinese", label: "Chinese", trigger: "12" },
        { value: "Italian", label: "Italian", trigger: "12" },
      ],
    },
    {
      id: "12",
      message: "Here's a popular {previousValue} recipe:\n\n**Ingredients**:\n - 1 cup rice\n - 1 tbsp soy sauce\n - 1 egg\n - 1 cup mixed veggies\n**Method**:\n 1. Heat oil and sauté veggies. \n 2. Add cooked rice and soy sauce. \n 3. Scramble egg and mix it in. Serve hot!",
      trigger: "13",
    },
    {
      id: "13",
      message: "Would you like to try another recipe or request a dish from a vendor?",
      trigger: "5", // Give the user the option to go back to the menu
    },
    // ------------------- Explore Vendor Flow -------------------
    {
      id: "16",
      message: "Here are some popular vendors on Alimento:",
      trigger: "17",
    },
    {
      id: "17",
      options: [
        { value: "Rajesh's Diner", label: "Rajesh's Diner (Indian)", trigger: "18" },
        { value: "Chen's Kitchen", label: "Chen's Kitchen (Chinese)", trigger: "18" },
        { value: "Bella's Pizzeria", label: "Bella's Pizzeria (Italian)", trigger: "18" },
      ],
    },
    {
      id: "18",
      message: "{previousValue} specializes in {previousValue.split(' ')[1]} cuisine. Here are some of their offerings:\n - Butter Chicken (₹300)\n - Chicken Biryani (₹250)\n - Tandoori Roti (₹40)\n\nRating: 4.5/5\nWould you like to request a dish or explore other vendors?",
      trigger: "5",
    },
    // ------------------- Thank you message -------------------
    {
      id: "14",
      message: "Thank you for using Alimento! Enjoy your food adventures!",
      end: true, // End the chat
    },
  ];

  return (
    <div>
      <ChatBot
        steps={flow}
        onUserMessage={handleMessage}
        userMessage={userMessage}
      />
    </div>
  );
};

export default Chatbot;
