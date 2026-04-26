# Book Request Management System

**GitHub Repository:** https://github.com/ali-jaffar123/ali_jaffar_22P9064

## Project Overview
This is a comprehensive, multi-role Book Request Management System developed using PHP, MySQL, and PDO (PHP Data Objects). The system provides distinct functionalities for three user roles: Users, Admins, and Super Admins. It features secure password hashing, session-based access control, and integration with the Google Books API.

## Key Features
* **User Role:** Register, login, browse books fetched via API, request books, and track request status.
* **Admin Role:** Manage user requests (Pending, In Progress, Completed, Rejected), view system statistics, and browse the local book database.
* **Super Admin Role:** All admin capabilities plus management of admin accounts and full system oversight.
* **API Integration:** Real-time book fetching from Google Books API with a implemented rate limit (5 calls per 24 hours).
* **Security:** Prepared statements (PDO) to prevent SQL Injection and `password_hash()` for secure credential storage.

## Setup & Installation Instructions

### 1. Move Project to Local Server
1. Ensure **XAMPP** is installed and the Apache and MySQL modules are running.
2. Copy the `ali_jaffar_22P9064` folder.
3. Paste it into your XAMPP root directory: `C:\xampp\htdocs\`

### 2. Database Setup
1. Open your browser and go to `http://localhost/phpmyadmin`.
2. Create a new database named exactly: `book_request_system`
3. Click on the `book_request_system` database in the left sidebar.
4. Click the **Import** tab at the top.
5. Choose the file `book_request_system.sql` located in the root of the project folder.
6. Click **Import** (or **Go**).

### 3. Run the Project
1. Open your web browser.
2. Navigate to: `http://localhost/ali_jaffar_22P9064`
3. You will be automatically redirected to the login page.

## Default Testing Credentials

### Super Admin (Hardcoded)
* **Username:** `superadmin`
* **Password:** `123456`

### Admin & User Roles
* **Admin:** Log in as Super Admin first to create an Admin account via the "Manage Admins" panel.
* **User:** Use the "Register" link on the main login page to create a new user account.

## Technical Requirements Fulfilled
- [x] Use of PHP Sessions and Redirection.
- [x] Database connectivity using PDO.
- [x] Integration with Google Books API.
- [x] Implementation of Rate Limiting.
- [x] Proper folder structure and use of `includes` for header/footer.
- [x] Secure password handling.
