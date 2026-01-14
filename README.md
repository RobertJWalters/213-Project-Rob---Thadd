README File
# COSC 213 Final Project - Rhad Cameras

# Project Report:

## Executive Summary

Rhad Cameras is an E-commerce website built on a LAMP stack (Linux, Apache, MySql and PHP). The website allows users to browse the site's inventory of cameras, add products to cart, make an account and fill out a checkout page. The following summarizes the architecture, the database, work distribution and the challenges faced during development.

## Architecture

### Technology Stack

Rhad Cameras follows a mixed architecture pattern, with some parts being three-tier elements.

- **Frontend:** HTML, CSS and Bootstrap for styling, and JS for modals
- **Backend:** PHP for handling requests and accessing the database
- **Database:** MySQL
- **Mixed Architecture:** In some of the frontend layer files, there is PHP code for accessing the database

### High-Level Architecture

**Frontend:** The HTML frontend is styled with CSS and Bootstrap. JavaScript handles client-side interactivity such as opening modals. PHP is embedded within frontend files to render dynamic content and, in some cases, directly access the database.

**Backend:** The PHP backend includes business logic files, classes (for users, products and carts) and a product repo class for accessing the database. A repo interface was also made and was intended for cart and user repo classes to implement. Due to time constraints, database access is inconsistently implemented. Some features use repo classes while others query the database directly from frontend files.

**Database Layer:** MySQL stores all of the website's data including products, users, carts and cart items.

### Authentication

User authentication is done by users signing up and logging in, passwords are hashed using password_hash and verified using password_verify. The hashed passwords are stored in the users table. Sessions are maintained using PHP sessions.

## Database Schema

### Tables

The application uses the following tables:

- **Products Table:** Stores individual products and their quantities, with details such as name, description, price and category.
- **Carts Table:** Stores carts for users.
- **Cart Items Table:** Represents an item in the user's cart and references the products table.
- **Users Table:** Stores user information; name, address, password, and email as the table's primary key.

### Entity Relationship Diagram

ERD made using dbdiagram.io

## Design Decisions

During development, multiple schema versions were tested, including iterations with separate orders, order items, and stock tables. The orders and order items tables were designed to support a feature allowing users to view their order history, but this was not implemented due to time constraints and the tables were removed. Similarly, the stock table, intended to track product IDs and quantities, was replaced with a simpler approach: storing stock quantity directly in the products table.

## Work Distribution

### Thadd McLeod

**Frontend:** Navbar separation, login/signup PHP, About page, Product page layout

**Backend:** User class, Checkout PHP, user session logic, Inventory update after purchase

### Robert Walters

**Frontend:** Dashboard, Shop, Cart, Checkout, image gathering (all images generated using Adobe Firefly), Cart session logic

**Backend:** Cart and Product Classes, Product Repo, Update, add and delete stock logic, Update and add to cart logic

**Database:** MySQL schema design, init.sql file (product content made with help of AI)

## Challenges and Their Solutions

### Making Content Dynamic

One of the first challenges tackled was making the shop page dynamic. The thought process was that this would make the site not limited to just a number of products, would make loading content from the database simpler and would make the code much cleaner. This turned out to be quite difficult due to PHP and html code not always collaborating in the most elegant way. However after lots of attempts, the shop page was working dynamically. After this it was much easier to make the product, cart and dashboard pages dynamic.

### Using Sessions

Sessions turned out to be one of the biggest problems for this project. A full understanding of how stateless HTTP is and exactly how sessions work turned out to not be fully grasped. So learning how sessions work ended up eating a large amount of time. However after going back and studying how they work, and some trial and error, the sessions were made functional.

### Setting up PHP

Attempting to run PHP from the VS Code terminal worked fine at first. Until one day it just completely stopped for no reason. Reinstalling the newest PHP version and redoing the setup didn't fix it. While it was working, the project couldn't be viewed at all, and there was concern it wouldn't work again. After consulting AI about what might have caused the issue, the solution ended up being as simple as just grabbing an older version of PHP that had fewer bugs. Additionally, using PHP Storm proved to be easier and just a nicer IDE overall.

### User Persistence

Before our database was set up, we stored users in a JSON file just so login would work. But JSON couldn't save carts, shipping info, or anything tied to a real account. Once we finally got PHP and MySQL working properly on both our devices, we switched everything to the database, and the whole login/cart system became way easier and actually worked the way we wanted.

### Technical Debt

A big challenge faced was tech debt. Due to unfamiliar technology and not large amounts of time to get the project done, poor planning decisions were made. Despite good intentions, like wanting to make the website follow a three-tier architecture, thorough planning and work distribution was not expediently done from the start. The end result was that when the deadline was approaching the team still hadn't got some of the basic functionality to work and had to abandon some of their plans for separating concerns and just try get the project done. Though this was not ideal, the developers did end up finishing the project on time.

## Conclusion

Rhad Cameras demonstrates a working E-commerce website built on a LAMP stack. Although the mixed architecture reflects time constraints and challenges of building a full-stack website for the first time, the site still implements the core features and two of the advanced features. This includes a public product catalog (the shop page) that can be filtered by category, a dynamic product page, user registration and login, a cart page, an admin dashboard and a checkout page that clears the user's cart and updates stock. Overall the project provided the team with valuable experience and a large amount of knowledge on how to build a full-stack website.

# Setup

## Project Overview:
Rhad Cameras is a full-featured e-commerce website built for COSC 213. The application allows users to:
- Browse products dynamically loaded from a MySQL database
- View detailed product pages
- Create user accounts and log in securely
- Add items to a shopping cart
- Adjust quantities inside the cart
- Complete a checkout process
- Have inventory automatically update after purchases

The system includes:
- Secure password hashing
- Server-side session management
- Persistent user accounts stored in the database
- Demo user account
- Admin login with elevated access

----------------------------------------------------------------------
REQUIREMENTS
----------------------------------------------------------------------
You must have:
- PHP 8+
- MySQL Server
- Apache

----------------------------------------------------------------------
### 1. SETTING UP THE PROJECT FOLDER
----------------------------------------------------------------------
1. Clone or download the repository.
2. Move the project folder into your server root (e.g., htdocs for XAMPP).
3. Ensure the following are included:
   - PHP files
   - CSS files
   - photos folder
   - db/schema.sql file
   - db/init.sql file

----------------------------------------------------------------------
### 2. CREATING THE DATABASE
----------------------------------------------------------------------
Run the following command:

```mysql -u root -p < schema.sql```

OR:

Run the following commands inside MySQL:
```
CREATE DATABASE project;
USE project;

Create required tables:

CREATE TABLE products (
    product_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    price DECIMAL(10, 2) NOT NULL,
    category VARCHAR(100),
    stock_quantity INT NOT NULL
);

CREATE TABLE users (
    email VARCHAR(255) PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    password_hash VARCHAR(255) NOT NULL
);

CREATE TABLE carts (
    cart_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id VARCHAR(255) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(email)
);

CREATE TABLE cart_items (
    cart_item_id INT AUTO_INCREMENT PRIMARY KEY,
    cart_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    FOREIGN KEY (cart_id) REFERENCES carts(cart_id),
    FOREIGN KEY (product_id) REFERENCES products(product_id)
);
```
----------------------------------------------------------------------
### 3. INSERTING DEMO PRODUCT DATA
----------------------------------------------------------------------
Example insert:
```
INSERT INTO products (name, description, price, category, stock_quantity)
VALUES ("Prism LX1", "High-end large format camera.", 8750.00, "Large Format", 12);
```
To load the full set of products, follow step 4.

----------------------------------------------------------------------
### 4. CREATING DEMO & ADMIN USERS
----------------------------------------------------------------------
Run the initialization SQL file:

```mysql -u root -p project < init.sql```

Default accounts:

ADMIN ACCOUNT
Email: admin@rhad.com
Password: helloworld

DEMO USER ACCOUNT
Email: demo@rhad.com
Password: password123

----------------------------------------------------------------------
### 5. CONFIGURING DATABASE CONNECTION
----------------------------------------------------------------------
Edit config.php:
```
class db {
    public static function getDB() {
        return new mysqli("localhost", "root", "YOUR_PASSWORD", "project");
    }
}
```

Replace YOUR_PASSWORD with your MySQL root password.

----------------------------------------------------------------------
### 6. RUNNING APACHE & MYSQL
----------------------------------------------------------------------
1. Start Apache
2. Start MySQL
3. Place the folder inside: C:\xampp\htdocs\project
4. Visit in browser:
   http://localhost/project/shop.php

----------------------------------------------------------------------
### 7. RUNNING THE APPLICATION
----------------------------------------------------------------------
Once Apache and MySQL are running:

Go to:
http://localhost/project/shop.php

----------------------------------------------------------------------
PROJECT STRUCTURE
----------------------------------------------------------------------
```
/project
│ README.md
│ config.php
│ shop.php
│ signup.php
│ login.php
│ logout.php
│ productPage.php
│ cart.php
│ checkout.php
│ processOrder.php
│ update_cart.php
│ add_to_cart.php
│
├── ProductClass.php
├── ProductRepo.php
├── CartClass.php
├── CartRepo.php
│
├── navbar.php
├── loginModal.php
│
├── /db
│    └── schema.sql
│
├── /photos
└── /styles.css
```

----------------------------------------------------------------------
END OF README
----------------------------------------------------------------------