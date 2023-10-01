# Leave-Management-System


# Prerequisites:

Web Server: You'll need a web server to host your PHP files. Apache, Nginx, or XAMPP (which includes Apache and MySQL) are popular choices. For this example, we'll use XAMPP.

MySQL Database: You need a MySQL database to store employee and leave request data.

Text Editor or Integrated Development Environment (IDE): Choose a text editor like Visual Studio Code, Sublime Text, or use an IDE like PHPStorm for coding.

# Instructions:

Install XAMPP:

Download and install XAMPP from the official website.
Start the Apache and MySQL services from the XAMPP control panel.
Create the Database:

Open phpMyAdmin by going to http:/localhost/phpmyadmin in your web browser.
Create a new database for your project. For example, you can name it leave_management.
Import the Database Schema:

In phpMyAdmin, select your newly created database (leave_management).
Import the database schema by selecting "Import" and uploading the SQL file that contains the schema.
Set Up the Project Files:

Create a new folder for your project in the XAMPP htdocs directory. For example, you can name it leave-management.
Place your PHP files (e.g., index.php, employee.php, admin.php, and other scripts) in this folder.
Database Connection:

In your PHP scripts, ensure that you include the correct database connection details in the db_connection.php file (as mentioned in previous responses). Replace placeholders with your database credentials.
Access the Project:

Open your web browser and navigate to http:/localhost/leave-management-system/index.php to access the login page.
You can then log in using the provided credentials.
