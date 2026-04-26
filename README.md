# Book Request Management System

**GitHub Repository:** https://github.com/ali-jaffar123/ali_jaffar_22P9064

# Book Request Management System

**GitHub Repository:** https://github.com/ali-jaffar123/ali_jaffar_22P9064

## Project Description
This is an elaborate multi-level Book Request Management System implemented using PHP, MySQL, and PDO. The project contains separate functionalities based on the following three user levels: User, Admin, and Super Admin. The project uses secure password hashing, session-based authentication, and the integration of the Google Books API.

## Features
* **User Level:** Registration, login, searching books via the API, requesting books, and monitoring the request progress.
* **Admin Level:** Monitoring and managing all the requests of the users (pending, in progress, completed, rejected), viewing all the statistics about the system, and searching the local database of the system.
* **Super Admin Level:** All functions of the admin level plus managing the admin accounts.
* **Integration of API:** Search and fetch real-time information about the book from the Google Books API, along with the implementation of a rate limit of five searches within twenty-four hours.
* **Security Measures:** Prepared Statements (PDO) to avoid SQL Injection and `password_hash()`.

## Installation Guide

### 1. Move Project Folder to Local Machine
1. Make sure you have **XAMPP** installed and that Apache and MySQL are active.
2. Copy the project folder `ali_jaffar_22P9064`
3. Paste it inside `htdocs` folder inside XAMPP: `C:\xampp\htdocs\`

### 2. Install Database
1. Go to `http://localhost/phpmyadmin` in your browser.
2. Create a new database named `book_request_system` exactly.
3. Select `book_request_system` from the list on the left sidebar.
4. Press **Import** from the tabs on top of the screen.
5. Choose SQL file located in the root of the project folder `book_request_system.sql`.
6. Press Import button (Go button).

### 3. Launch Project
1. Open browser.
2. Go to `http://localhost/ali_jaffar_22P9064`.
3. You will be automatically redirected to login screen.

## Default Testing Credentials

### Super Admin (Hardcoded)
* **Username:** `superadmin`
* **Password:** `123456`

### Admin and User Roles
* **Admin:** First, log in as the Super Admin to create an admin account from the "Manage Admins" tab.
* **User:** Register a new user account from the "Register" link on the login page.

## Technical Requirements Achieved
- [x] Session management and redirection in PHP.
- [x] Database connection through PDO.
- [x] API integration with Google Books.
- [x] Rate limiting implementation.
- [x] Correct file structure and inclusion of headers and footer with `includes`.
- [x] Password security.
