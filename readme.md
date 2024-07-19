# 100 Days Challenge Daily Gratitude Journal

This project is a web application designed to facilitate daily gratitude reflection. Users can post one gratitude entry per day for 100 days, view their past entries, and receive a random motivational quote upon logging in. The primary goal is to encourage daily reflection on gratitude and provide motivational support through inspirational quotes..

## Table of Contents

- [Introduction](#introduction)
- [Demo](#demo)
- [sitemap](#sitemap)
- [Requirements](#requirements)
- [Installation](#installation)
- [Usage](#usage)
- [Features](#features)
- [Technologies Used](#technologies-used)
- [Project Structure](#project-structure)
- [Challenges and Learnings](#challenges-and-learnings)
- [Future Improvements](#future-improvements)
- [Contact](#contact)
- [License](#license)

## Introduction

I have developed a robust web application aimed at empowering users to maintain a daily gratitude journal enriched with essential features such as user authentication, profile management, and advanced security protocols. The primary objective of this application is to encourage users' daily reflection by enabling them to record a gratitude entry each day. Additionally, the application provides uplifting motivational quotes randomly to inspire and support users throughout their journey of gratitude practice

## Demo

https://user-images.githubusercontent.com/50797024/174048866-33ae403d-86d4-4477-aa01-bb81f9e2dda6.mp4

### Live Demo

Check out the live demo [here](https://your-demo-link.com).

### Sitemap

```plaintext
Home
├── Authentication
│   ├── Login
│   ├── Register
│   └── Forgot Password
├── Profile
│   ├── View Profile
│   ├── Edit Profile
│   └── Change Password
├── Gratitude Journal
│   ├── Daily Entry
│   ├── View Entries
│   └── Social Sharing (Future Enhancement)
├── Random Quotes
│   └── Display Random Quote
├── Notifications (Future Enhancement)
│   ├── Notification Settings
│   └── View Notifications
├── Settings (Future Enhancement)
│   ├── App Settings
│   └── Account Settings
├── About
│   ├── Project Information
│   └── Contact Information (if included)
├── Documentation
│   ├── README.md
│   └── License Information
└── Admin Panel (if applicable)
    ├── Dashboard
    ├── User Management
    └── Database Management

```


### Requirements
To run this project locally, you'll need the following:

WAMP or XAMPP: Depending on your operating system, install WAMP (for Windows) or XAMPP ( macOS, Linux).
Database Management: Use PHPMyAdmin for MySQL database management or a PostgreSQL GUI for PostgreSQL.

## Installation
Great, let's outline the installation steps accordingly:

### 5. Installation

Follow these steps to install and run the project locally:

1. **Clone the Repository:**

   ```bash
   # Clone the repository
   git clone https://github.com/Nada-TB/bees-gratitude.git

   ```

2. **Move Project Files:**
   - Navigate to your WAMP or XAMPP installation directory.
   - Locate the `www` folder (for WAMP) or `htdocs` folder (for XAMPP).
   - Paste the cloned project directory into the `www` or `htdocs` folder.

3. **Database Setup:**

   - **MySQL (via PHPMyAdmin):**
     - Open PHPMyAdmin in your web browser.
     - Create a new database for your project.
     - Import the database schema provided with the project (dataBase folder).
     - Ensure the database credentials (username, password) match your local environment.
   
   - **PostgreSQL (via PostgreSQL GUI):**

     - Use a PostgreSQL GUI tool (like pgAdmin) to create a new database.
     - Import the database schema provided with the project (posgres-database folder).
     - Update the database connection settings in class/class_connection.php

4. **Connect Database to Project:**
   - Update the database connection settings in your class/class_connection.php
   - Ensure the database credentials (host, username, password, database name) match your local setup.

5. **Run the Project:**
   - Open a web browser and navigate to `http://localhost/project-directory-name` (replace `project-directory-name` with the actual name of your project directory).

## Usage

To use the application:

Locally:

Open a web browser.
Navigate to http://localhost/project-directory-name (replace project-directory-name with the actual name of your project directory).

## Features

Certainly! Let's revise the features to be more comprehensive and concise:

### 7. Features

- **User Authentication**: Secure sign-up, log-in, and log-out functionality.
- **Gratitude Journal**: Daily entries to encourage self-reflection and positivity.
- **Profile Management**: Update user information and upload profile pictures.
- **Password Reset**: Secure password recovery via email tokens.
- **Animated UI Elements**: Engaging CSS and JavaScript animations.
- **Activity Tracking**: Automatic logout after inactivity for enhanced security.
- **MVC Architecture**: Structured for scalability and maintainability.
- **Quote API Integration**: Display random motivational quotes.
- **Responsive Design**: Optimal viewing experience across devices.
- **AJAX**: Smooth, asynchronous data retrieval and interaction.
- **ES6 Features**: Modern JavaScript for cleaner, more efficient code.
- **Regular Expressions**: Input validation and data formatting.
- **Performance Optimization**: Improved speed and responsiveness.
- **UX/UI Enhancements**: Intuitive design for user satisfaction.

## Technologies Used

Great! Let's structure the **Technologies Used** section based on the technologies, frameworks, and concepts you've listed:

### 8. Technologies Used

- **Frontend**:
  - HTML5, CSS3, JavaScript (ES6)
  - AJAX for asynchronous data handling
  - Responsive Design principles for optimal viewing across devices

- **Backend**:
  - PHP for server-side scripting
  - MySQL and PostgreSQL for database management
  - MVC (Model-View-Controller) architecture for structured application design
  - Object-Oriented Programming (OOP) principles for efficient code organization
  
- **Other**:
  - Random Quotes API integration for motivational content:(https://github.com/lukePeavey/quotable)
  - ES6 Modules for modular JavaScript development
  - PostgreSQL for advanced database management


## Project Structure

```plaintext

your-project/
├── class/                  # Folder for PHP classes
├── controllers/            # Controllers for handling requests and responses
├── css/                    # CSS stylesheets
│   ├── style.css           # Main stylesheet
│   └── images/             # Folder for images
├── database/               # MySQL database files
├── js/                     # JavaScript files
│   ├── modules/            # JavaScript modules
│   └── app.js              # Main JavaScript file
├── models/                 # Models for interacting with the database
├── postgres-database/      # PostgreSQL database files
├── views/                  # Views for rendering HTML templates
├── .htaccess               # Apache server configuration file
├── index.php               # Entry point and router
└── README.md               # Project documentation

```

## Challenges and Learnings

- **Architecture and File Management:**
    - Designed the application architecture using Object-Oriented Programming (OOP) and the Model-View-Controller (MVC) pattern for scalability and maintainability.
    - Managed file uploads and updates, including user profile pictures, with efficient server-side operations using PHP.
- **Security and Session Management:**
    - Enhanced security for password resets by generating and sending unique tokens to users' emails.
    - Developed a cursor activity tracker to automatically log out users after inactivity, improving session management and security.
- **Performance Optimization:**
    - Optimized JavaScript files to manage page events efficiently, reducing errors and enhancing user experience.

## Future Improvements

- Improved Design: Enhance UI/UX with modern design trends and user feedback to improve aesthetics and usability.
- Progressive Web App (PWA): Convert the application into a Progressive Web App to provide a native app-like experience, including offline access and push notifications.
- Gratitude Social Media Platform: Expand the functionality to allow users to share their gratitude entries publicly, follow others, and engage in a social network centered around positivity and gratitude.
- Notification System: Implement a notification feature to alert users about new entries, likes, comments, and other social interactions.

## Contact

Provide your contact information for questions or feedback.

- GitHub: [Nada-TB](https://github.com/Nada-TB)


## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details

---













































 
