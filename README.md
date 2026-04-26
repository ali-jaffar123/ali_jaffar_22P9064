# Book Request Management System

**GitHub Repository:** [Insert your GitHub link here]

## Project Overview
This is a multi-role Book Request Management System built with PHP, MySQL, and PDO. It integrates with the Google Books API to fetch real book data and provides secure, role-based access for Users, Admins, and Super Admins.

## Setup & Installation Instructions

To run this project locally, please follow these steps using XAMPP or WAMP:

### 1. Move Project to Local Server
1. Ensure XAMPP or WAMP is installed on your system.
2. Extract the downloaded project folder (e.g., `ali_ahmed_2201234`).
3. Move the entire project folder into your server's root directory:
   * **For XAMPP:** `C:\xampp\htdocs\`
   * **For WAMP:** `C:\wamp\www\`

### 2. Database Setup
1. Open your XAMPP/WAMP Control Panel and start **Apache** and **MySQL**.
2. Open your web browser and go to `http://localhost/phpmyadmin`.
3. Create a new database named exactly: **`book_request_system`**
4. Select the newly created database, click on the **Import** tab.
5. Choose the provided `.sql` file located in the project folder and click **Import** to set up the tables (users, admins, books, book_requests).

### 3. Run the Project
1. Open a new tab in your web browser.
2. Navigate to: `http://localhost/YOUR_FOLDER_NAME` *(Replace YOUR_FOLDER_NAME with the actual name of the folder you placed in htdocs)*.
3. You will be automatically redirected to the User Login page.

## Default Testing Credentials

**Super Admin:**
* **Username:** superadmin
* **Password:** 123456

*(To test the standard Admin role, please log in as the Super Admin and create a new Admin account from the dashboard. To test the User role, please register a new account from the main application portal).*