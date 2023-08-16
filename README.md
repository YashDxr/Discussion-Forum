# Discussss!

Welcome to the Discussss! This web application allows users to create accounts, log in using their credentials, ask questions, and answer other people's questions. The forum is designed with security in mind, protecting it from common attacks like XSS (Cross-Site Scripting). The user interface is enhanced with Bootstrap for a more user-friendly experience.

## Features

- User Registration: Create a new account with a unique username and password.
- User Login: Log in securely using your registered credentials.
- Ask Questions: Post questions to the forum for others to answer.
- Answer Questions: Contribute by providing answers to other users' questions.
- XSS Protection: The forum is built with security measures to prevent Cross-Site Scripting attacks.
- Responsive Design: The user interface is designed using Bootstrap for optimal viewing on different devices.

## Getting Started

Follow these steps to set up and run the Secure Discussion Forum on your local environment.

### Prerequisites

- Web server (e.g., Apache)
- PHP (7.0 or higher)
- MySQL database

### Installation

1. Clone or download the repository to your local machine.
2. Create a new MySQL database for the forum.
3. Import the `database.sql` file into your database to set up the required tables.

### Configuration

1. Navigate to the `config.php` file in the root directory.
2. Update the database configuration with your database credentials.

```php
define('DB_HOST', 'your_database_host');
define('DB_USER', 'your_database_username');
define('DB_PASS', 'your_database_password');
define('DB_NAME', 'your_database_name');
```

### Usage

1. Start your web server and navigate to the project directory in your browser.
2. You will be redirected to the login page. If you don't have an account, you can register.
3. After logging in, you can post questions and answer existing ones.
4. Enjoy the secure discussion forum!

## Security Measures

To protect the forum from XSS attacks, the following security practices have been implemented:

- **Input Sanitization:** User inputs are sanitized to remove potentially harmful code before being displayed or stored in the database.
- **Output Escaping:** User-generated content is properly escaped when displayed to prevent it from being interpreted as HTML or JavaScript.
- **Validation:** User inputs are validated on the server-side to ensure they meet expected criteria.

## Technologies Used

- HTML5/CSS3
- PHP
- MySQL
- Bootstrap

## Acknowledgments

This discussion forum was developed as a sample project to demonstrate secure web development practices using PHP and Bootstrap.

---

Feel free to contribute to the project and enhance its features. If you encounter any issues or have suggestions, please submit them to the repository's issue tracker. Thank you for using the Secure Discussion Forum!
