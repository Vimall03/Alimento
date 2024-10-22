# Contributing to Alimento

Welcome to our project! We're thrilled to have you contribute. Your efforts, big or small, make a difference. Please ensure that you follow our [Code of Conduct](CODE_OF_CONDUCT.md) in all interactions.

<br>

# Need Help with the Basics? 🤔

If you're new to Git and GitHub, no worries! Here are some useful resources:

- [Forking a Repository](https://help.github.com/en/github/getting-started-with-github/fork-a-repo)
- [Cloning a Repository](https://help.github.com/en/desktop/contributing-to-projects/creating-an-issue-or-pull-request)
- [How to Create a Pull Request](https://opensource.com/article/19/7/create-pull-request-github)
- [Getting Started with Git and GitHub](https://towardsdatascience.com/getting-started-with-git-and-github-6fcd0f2d4ac6)
- [Learn GitHub from Scratch](https://docs.github.com/en/get-started/start-your-journey/git-and-github-learning-resources)

<br>

# Project Structure 📂

```bash
Alimento/
├── .github/
│   ├── ISSUE_TEMPLATE/                          # Issue templates for GitHub
│   ├── workflows/                               # CI/CD workflows
│   ├── pull_request_template.md                 # Template for pull requests
│   └── test.md                                  # Test documentation
├── .vscode/
│   ├── settings.json                            # VS Code settings
├── contributors/
│   ├── contributor.css                          # CSS for contributor page
│   ├── contributor.html                         # HTML for contributor page
│   └── contributor.js                           # JavaScript for contributor page
├── images/
│   ├── favicons/                               # Favicon images
│   ├── img-comp/                               # Image components
│   ├── logo/                                   # Logo images
│   ├── 360_F_228295461_Zs8colbBO9pgaYjLwnDNLXkSCauyRFUr.webp # Restaurant image
│   ├── default_profile.webp                     # Default profile image
│   ├── dish1-hero.webp                          # Hero image for dish
│   ├── download (1).webp                       # Downloadable image
│   ├── download.webp                            # Another downloadable image
│   ├── hf1zrcnicac6dbcmxt0y.webp                # Image for a specific use
│   ├── istockphoto-1318824826-612x612.webp     # Stock photo image
│   ├── pizza-hero.webp                          # Hero image for pizza
│   ├── pizza-img-membership.webp                # Membership pizza image
│   ├── pngtree-location-icon-in-orange-color-png-image_11377881.webp # Location icon
│   ├── restaurant.webp                          # Restaurant image
│   └── review.webp                              # Review image
├── js/
│   ├── darkMode.js                              # JavaScript for dark mode
│   ├── external.js                              # External scripts
│   └── index.js                                 # Main index script
├── partials/
│   ├── _dbconnect.php                           # Database connection
├── phpmailer/
│   ├── Exception.php                            # Exception handling
│   ├── PHPMailer.php                            # PHPMailer library
│   └── SMTP.php                                 # SMTP functionality
├── razorpay-php/
│   ├── libs/                                   # Libraries for Razorpay
│   │   └── Requests-1.6.1                      # Requests library
│   └── src/                                    # Source files for Razorpay
│       ├── Errors/
│       │   ├── BadRequestError.php              # Bad request error handling
│       │   ├── Error.php                        # General error handling
│       │   ├── ErrorCode.php                    # Error codes
│       │   ├── GatewayError.php                 # Gateway errors
│       │   ├── ServerError.php                  # Server errors
│       │   ├── SignatureVerificationError.php    # Signature verification errors
│       ├── Api.php                              # API functionality
│       ├── ArrayableInterface.php               # Interface for arrayable resources
│       ├── Card.php                             # Card handling
│       ├── Collection.php                        # Collection handling
│       ├── Customer.php                          # Customer data handling
│       ├── Entity.php                           # Entity handling
│       ├── Invoice.php                          # Invoice management
│       ├── Order.php                            # Order management
│       ├── Payment.php                          # Payment processing
│       ├── Refund.php                           # Refund management
│       ├── Request.php                          # Request handling
│       ├── Resource.php                         # Resource management
│       ├── Token.php                            # Token management
│       └── Utility.php                          # Utility functions
├── README.md                                    # Project README
├── Razorpay.php                                 # Razorpay integration file
├── composer.json                                # Composer dependencies
├── composer.lock                                # Locked dependencies
├── doc.md                                       # Documentation
├── version.txt                                  # Versioning information
├── vendor/                                      # Vendor packages
├── .gitignore                                   # Git ignore file
├── CONTRIBUTING.md                              # Contribution guidelines
├── Code_Of_Conduct.md                           # Code of conduct
├── Contribution.md                              # Contribution information
├── LICENSE                                      # Project license
├── change_password.php                          # Change password functionality
├── chatbot.css                                  # Chatbot styles
├── chatbot.html                                 # Chatbot HTML
├── chatbot.js                                   # Chatbot JavaScript
├── chatboticon.webp                             # Chatbot icon
├── checkout.css                                 # Checkout styles
├── checkout.php                                 # Checkout functionality
├── config.php                                   # Configuration settings
├── contact.php                                   # Contact page functionality
├── edit_profile.php                             # Edit profile functionality
├── email_verify.php                             # Email verification
├── global.css                                   # Global styles
├── home.css                                     # Home page styles
├── home.php                                     # Home page functionality
├── homemadedb.sql                               # Homemade database schema
├── icons8-message-bot-64.webp                   # Message bot icon
├── index.php                                    # Main index page functionality
├── main.css                                     # Main styles
├── menu.css                                     # Menu styles
├── menu.php                                     # Menu functionality
├── new_track_order.css                          # New track order styles
├── new_track_order.php                          # New track order functionality
├── order_success.php                            # Order success functionality
├── orders.php                                   # Orders management
├── output.css                                   # Output styles
├── package.json                                 # Package dependencies
├── pay.php                                      # Payment functionality
├── pin_search.php                               # Pin search functionality
├── profile.php                                   # User profile functionality
├── readme.md                                    # Additional README
├── styles.css                                   # Styles for the application
├── tailwind.config.js                           # Tailwind CSS configuration
├── track_order.php                              # Track order functionality
├── user_login.php                               # User login functionality
├── user_logout.php                              # User logout functionality
└── user_signup.php                              # User signup functionality
```

# First Pull Request ✨

1. **Star this repository**
    Click on the top right corner marked as **Stars** at last.

2. **Fork this repository**
    Click on the top right corner marked as **Fork** at second last.

3. **Clone the forked repository**                   

```bash
git clone https://github.com/<your-github-username>/Alimento.git
```
  
4. **Navigate to the project directory**

```bash
cd Alimento
```

5. **Create a new branch**

```bash
git checkout -b <your_branch_name>
```

6. **To make changes**

```bash
git add .
```

7. **Now to commit**

```bash
git commit -m "add comment according to your changes or addition of features inside this"
```

8. **Push your local commits to the remote repository**

```bash
git push -u origin <your_branch_name>
```

9. **Create a Pull Request**

10. **Congratulations! 🎉 you've made your contribution**

<br>

# Alternatively contribute using GitHub Desktop 🖥️

1. **Open GitHub Desktop:**
   Launch GitHub Desktop and log in to your GitHub account if you haven't already.

2. **Clone the Repository:**
   - If you haven't cloned the repository yet, you can do so by clicking on the "File" menu and selecting "Clone Repository."
   - Choose the repository from the list of repositories on GitHub and clone it to your local machine.

3. **Switch to the Correct Branch:**
   - Ensure you are on the branch that you want to submit a pull request for.
   - If you need to switch branches, you can do so by clicking on the "Current Branch" dropdown menu and selecting the desired branch.

4. **Make Changes:**
   Make your changes to the code or files in the repository using your preferred code editor.

5. **Commit Changes:**
   - In GitHub Desktop, you'll see a list of the files you've changed. Check the box next to each file you want to include in the commit.
   - Enter a summary and description for your changes in the "Summary" and "Description" fields, respectively. Click the "Commit to <branch-name>" button to commit your changes to the local branch.

6. **Push Changes to GitHub:**
   After committing your changes, click the "Push origin" button in the top right corner of GitHub Desktop to push your changes to your forked repository on GitHub.

7. **Create a Pull Request:**
   - Go to the GitHub website and navigate to your fork of the repository.
   - You should see a button to "Compare & pull request" between your fork and the original repository. Click on it.

8. **Review and Submit:**
   - On the pull request page, review your changes and add any additional information, such as a title and description, that you want to include with your pull request.
   - Once you're satisfied, click the "Create pull request" button to submit your pull request.

9. **Wait for Review:**
    Your pull request will now be available for review by the project maintainers. They may provide feedback or ask for changes before merging your pull request into the main branch of the repository.

<br>


# Good Coding Practices 🧑‍💻

1. **Follow the Project's Code Style**

   - Maintain consistency with the existing code style (indentation, spacing, comments).
   - Use meaningful and descriptive names for variables, functions, and classes.
   - Keep functions short and focused on a single task.
   - Avoid hardcoding values; instead, use constants or configuration files when possible.

2. **Write Clear and Concise Comments**

   - Use comments to explain why you did something, not just what you did.
   - Avoid unnecessary comments that state the obvious.
   - Document complex logic and functions with brief explanations to help others understand your thought -process.

3. **Keep Code DRY (Don't Repeat Yourself)**

   - Avoid duplicating code. Reuse functions, methods, and components whenever possible.
   - If you find yourself copying and pasting code, consider creating a new function or component.

4. **Write Tests**

   - Write unit tests for your functions and components.
   - Ensure your tests cover both expected outcomes and edge cases.
   - Run tests locally before making a pull request to make sure your changes don’t introduce new bugs.

5. **Code Reviews and Feedback**

   - Be open to receiving constructive feedback from other contributors.
   - Conduct code reviews for others and provide meaningful suggestions to improve the code.
   - Always refactor your code based on feedback to meet the project's standards.

<br>

# Pull Request Process 🚀

When submitting a pull request, please adhere to the following:

1. **Self-review your code** before submission. 
2. Include a detailed description of the functionality you’ve added or modified.
3. Comment your code, especially in complex sections, to aid understanding.
4. Add relevant screenshots to assist in the review process.
5. Submit your PR using the provided template and hang tight; we'll review it as soon as possible! 🚀

<br>          

# Issue Report Process 📌

To report an issue, follow these steps:

1. Navigate to the project's issues section :- [Issues](https://github.com/Vimall03/Alimento/issues)
2. Provide a clear and concise description of the issue.
3. **Avoid spamming** to claim an issue. Patience is key! 
4. Wait until someone looks into your report.
5. Begin working on the issue only after you have been assigned to it. 🚀

<br>

# Thank you for contributing 💗

We truly appreciate your time and effort to help improve our project. Feel free to reach out if you have any questions or need guidance. Happy coding! 🚀

##
