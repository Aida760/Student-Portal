# PSUT Announcements & News Portal

A web application for Princess Sumaya University for Technology that serves as an announcements and news portal.

## Project Overview

This portal includes four main pages:
- Welcome/Home page
- Login page
- Registration page
- Announcements & News page

## Tech Stack

- **Frontend**: HTML, CSS, JavaScript
- **Backend**: PHP
- **Database**: MySQL

## Project Structure

```
/
├── assets/              # Static files like images, CSS, and JavaScript
│   ├── css/             # CSS stylesheets
│   ├── js/              # JavaScript files
│   └── images/          # Image files
├── includes/            # PHP includes (header, footer, db connection)
├── config/              # Configuration files
│   └── database.php     # Database connection configuration
├── auth/                # Authentication related pages
│   ├── login.php        # Login page
│   ├── register.php     # Registration page
│   ├── logout.php       # Logout functionality
│   └── auth_functions.php # Authentication helper functions
├── db/                  # Database scripts
│   └── schema.sql       # Database schema
├── index.php            # Welcome/Home page
├── announcements.php    # Announcements & News page
└── README.md            # Project documentation


Setup Instructions

1. **Clone the repository**
 
   git clone https://github.com/Aida760/Student-Portal
  

2. **Setup Database**
   - Create a MySQL database
   - Import the schema from `db/schema.sql`
   - Update database configuration in `config/database.php`

3. **Run the application**
   - Place the project in your web server directory (e.g., htdocs for XAMPP)
   - Access the application through your browser: `http://localhost/psut-portal`

## Features

- Welcome page with portal information
- User registration with validation
- User login with session management
- Announcements & News display
- Responsive design for all pages

## Security Features

- Server-side validation
- Password hashing with salt
- Session management
- Input sanitization 
