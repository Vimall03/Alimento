// DOM Elements
const sendButton = document.getElementById("send-btn");
const inputField = document.getElementById("chatbot-input");
const messageArea = document.getElementById("chatbot-messages");
const refreshButton = document.querySelector(".refresh-btn");
// Clear messages when the chatbot is closed and reopened
const closeBtn = document.getElementById("close-btn");
const chatbotContainer = document.getElementById("chatbot-container");
const chatbotIcon = document.getElementById('chatbot-icon');




// Clear messages function
function clearMessages() {
    const messageArea = document.getElementById("chatbot-messages");
    messageArea.innerHTML = ""; // Clear all messages
}

// Close button logic
closeBtn.addEventListener("click", () => {
    chatbotContainer.classList.remove("visible");
    chatbotIcon.style.display = "block"; 
    clearMessages(); // Clear messages when closing
});

// Open chatbot and clear messages
chatbotIcon.addEventListener("click", () => {
    chatbotContainer.classList.add("visible");
    chatbotIcon.style.display = "none";
    clearMessages(); // Clear messages when opening
});

// Clear messages on page load
window.addEventListener('load', clearMessages);
window.addEventListener('beforeunload', () => {
    clearMessages(); // Clear messages and input when navigating away
});
// Function to append messages to the chat window
function appendMessage(message, sender) {
  const messageDiv = document.createElement("div");
  messageDiv.className = `message ${sender}`;
  messageDiv.textContent = message;
  messageArea.appendChild(messageDiv);
  messageArea.scrollTop = messageArea.scrollHeight; // Auto scroll to the latest message
}




// Function to get bot response
function getBotResponse(input) {
  input = input.toLowerCase();

  // Customize responses here
  if (input.includes("hello")) {
    return "Hello! How can I assist you today?";
  } else if (input.includes("order")) {
    return "You can place your order by visiting our menu section.";
  } else if (input.includes("payment")) {
    return "We accept credit card, debit card, and online banking.";
  } else if (input.includes("food")) {
    return "We offer a variety of homemade dishes. Check out our menu!";
  } else {
    return "Sorry, I don't understand that. Can you please rephrase?";
  }
}

// Handle Send Button Click
sendButton.addEventListener("click", () => {
  const userInput = inputField.value.trim();
  if (userInput) {
    appendMessage(userInput, "user");
    inputField.value = "";

    // Simulate bot response
    setTimeout(() => {
      const botResponse = getBotResponse(userInput);
      appendMessage(botResponse, "bot");
    }, 1000); // 1-second delay for the bot response
  }
});

// Handle pressing 'Enter' to send message
inputField.addEventListener("keypress", (e) => {
  if (e.key === "Enter") {
    sendButton.click();
  }
});

// Refresh button to clear the chat
refreshButton.addEventListener("click", () => {
  messageArea.innerHTML = "";
});
function getBotResponse(input) {
    input = input.toLowerCase().trim();  // Convert input to lowercase and trim spaces

  const aboutsite = [
      "tell me about this page","tell me about this website","tell me about alimento","what is this website about"
    ];
    const greetings = ["hello", "hi", "hey"];
    const reply =["i am good","i am fine","yes","hey","hi","hello","yeah","yup"]
    const goodmor=["good morning"];
    const goodaf=["good afternoon"];
    const goodev=["good evening"];
    const goodngt=["good night"];
    const howsyou =["how are you","what's up","How's you","what is up","kaise ho","kya haal","how are you doing"]
    const whatDoing = ["what are you doing", "what is going on","you say"];
    const howOld = ["how old are you"];
    const whoAreYou = ["who are you", "are you human", "are you bot", "are you human or bot"];
    const whoMadeYou = ["who created you", "who made you"];
    const food =["do you eat","have you eat","eat","khana","khana khaya","tum khana khate ho","khana khao"];
    const yourName = [
        "your name please",
        "your name",
        "may i know your name",
        "what is your name",
        "what do you call yourself"
    ];

    const paymentQuestions = [
        "payment methods", 
        "how can i pay", 
        "do you accept credit cards", 
        "payment options"
    ];
    const deliveryQuestions = [
      "order arrive",
      "order detail",
        "when will my order arrive",
        "how long does delivery take",
        "what is the delivery time"
    ];
    const order= [
  "how can i order",
    "how to order food",
    "how to create profile",
    "how to create accound",
    "account create"
    ];
    const companyrealted=[
        "what is the company name",
        "what is alimento", "tell me about alimento", "what is this platform",
        "how does alimento work",  
        "why this created"

];

    if (aboutsite.some((phrase) => input.includes(phrase))) {
  return "This website aims to provide food  with affordable prize. Alimento is a platform where you can order your favourite food  anywhere, anytime. ";
  }
    // Check greetings
    if (greetings.some((greeting) => input.includes(greeting))) {
      return "Hello! How can I assist you today?";
  }
  if (howsyou.some((greeting) => input.includes(greeting))) {
    return "hey I am good , you tell me , How's you? ";
}
  if (companyrealted.some((phrase) => input.includes(phrase))) {
      return "Alimento is a homemade food delivery platform that connects home chefs with food lovers like you.";
  }
  if (reply.some((phrase) => input.includes(phrase))) {
    return "Good";
}
  // Check what are you doing
  if (whatDoing.some((phrase) => input.includes(phrase))) {
      return "I'm here to assist you with any questions you have!";
  }
  if (goodaf.some((phrase) => input.includes(phrase))) {
    return "Good Afternoon!";
}
if (goodmor.some((phrase) => input.includes(phrase))) {
  return "Good Morning!";
}
if (goodev.some((phrase) => input.includes(phrase))) {
  return "Good Evening!";
}
if (goodngt.some((phrase) => input.includes(phrase))) {
  return "Good Night!";
}
  // Check how old are you
  if (howOld.some((phrase) => input.includes(phrase))) {
      return "I'm a virtual assistant, so I don't  have age!";
  }
  if (order.some((phrase) => input.includes(phrase))) {
    return "First Login to website your account will be created , Then choose food , place order. YOur order will confirm.";
}
  // Check who are you
  if (whoAreYou.some((phrase) => input.includes(phrase))) {
      return "I am your friendly chatbot here to assist you with questions about the website.";
  }

  // Check who made you
  if (whoMadeYou.some((phrase) => input.includes(phrase))) {
      return "I was created by a team of awesome developers!";
  }

  // Check what is your name
  if (yourName.some((phrase) => input.includes(phrase))) {
      return "I am your chatbot,I don't have any name!";
  }

  if (paymentQuestions.some((phrase) => input.includes(phrase))) {
      return "We accept credit cards, debit cards, and online banking.";
  }

  if (deliveryQuestions.some((phrase) => input.includes(phrase))) {
      return "Our average delivery time is 30-45 minutes.";
  }
  if (food.some((phrase) => input.includes(phrase))) {
    return "I cann't Eat. I am a your chatbot.";
}

  // General fallback
  return "I'm sorry, I don't understand that. Can you please ask another question?" ,"please ask another question";
}