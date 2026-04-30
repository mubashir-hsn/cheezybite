<<<<<<< HEAD
# CheezyBite — PHP Food Ordering Website

A lightweight PHP/MySQL food ordering site with a newly added admin panel for managing products, users and orders. Built to run on a LAMP/XAMPP stack.

## Features

- Public pages: Home, Menu, Product details, Cart, Checkout, Contact, Signup/Login
- Cart and order flows for customers
- User authentication (password_hash/password_verify)
- Admin panel (role-based access) with:
  - Dashboard (product/order/user counts + sales chart)
  - Add / Edit / Delete products (image upload)
  - View and manage users (toggle role, delete)
  - View and update orders (status updates, view order detail)
  - AJAX actions with Bootstrap modal confirmations and toast notifications

## Project Structure

- `index.php`, `menu.php`, `detail.php`, `cart.php`, `checkout.php` — public pages
- `login.php`, `signup.php`, `logout.php` — auth
- `connect.php` — MySQL connection
- `functions/` — helper functions (e.g. `getProducts.php`)
- `images/` — product and other images
- `css/`, `js/` — frontend assets
- `admin/` — admin panel
  - `index.php` — admin dashboard
  - `add_product.php`, `manage_products.php`, `edit_product.php` — product CRUD
  - `users.php`, `orders.php` — user and order management
  - `actions.php` — AJAX handler for admin actions
  - `auth.php` — admin role guard
  - `css/admin.css`, `js/admin.js` — admin UI assets

## Requirements

- XAMPP (Apache + PHP 7.4+ recommended)
- MySQL / MariaDB

## Installation / Setup

1. Place the project in your XAMPP `htdocs` folder, e.g. `C:\Xampp\htdocs\cheezybite`.
2. Create a MySQL database named `cheezybite` (or update `connect.php` with your DB name).
3. Import the SQL schema (example):

```sql
-- USERS
CREATE TABLE `users` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `first_name` VARCHAR(100),
  `last_name` VARCHAR(100),
  `email` VARCHAR(200) UNIQUE,
  `password` VARCHAR(255),
  `role` VARCHAR(50) DEFAULT 'user',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- PRODUCTS
CREATE TABLE `products` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(255),
  `description` TEXT,
  `price` DECIMAL(10,2),
  `category` VARCHAR(100),
  `image` VARCHAR(255)
);

-- ORDERS (simple example)
CREATE TABLE `orders` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `user_id` INT,
  `total_price` DECIMAL(10,2),
  `status` VARCHAR(50) DEFAULT 'pending',
  `payment_status` VARCHAR(50) DEFAULT 'pending',
  `name` VARCHAR(255),
  `email` VARCHAR(255),
  `contact` VARCHAR(50),
  `city` VARCHAR(100),
  `address` TEXT,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE `order_items` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `order_id` INT,
  `product_id` INT,
  `quantity` INT,
  `price` DECIMAL(10,2)
);

-- CART (simple)
CREATE TABLE `cart` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `user_id` INT,
  `product_id` INT,
  `quantity` INT
);
```

4. Ensure `connect.php` contains correct DB credentials.

5. Start Apache and MySQL from XAMPP control panel and open:

```
http://localhost/cheezybite/
```

## Admin Panel

- Access: `http://localhost/cheezybite/admin/index.php` (role-based)
- To create an admin user, either:
  - Register via `signup.php`, then update the `users` table and set `role='admin'` for that user, or
  - Insert an admin user directly via SQL and set a hashed password (use PHP's `password_hash`).

Example SQL to make an existing user an admin:

```sql
UPDATE users SET role='admin' WHERE email='you@domain.com';
```

## Important Notes & Security

- Input handling currently uses `mysqli_real_escape_string()` in many places. For production, migrate to prepared statements (`mysqli_stmt` or PDO) to prevent SQL injection.
- Add CSRF tokens for all state-changing forms and AJAX endpoints.
- Image uploads are stored in `images/` with original filenames — consider sanitizing filenames and storing unique names to avoid collisions.
- Enforce file-type checking for uploads and limit size.
- Passwords use `password_hash()` and `password_verify()`.

## Styling and UX

The admin panel uses Bootstrap and a custom `admin/css/admin.css` to match the site's theme colors. AJAX actions are implemented in `admin/js/admin.js` with Bootstrap modal confirmations and toasts.

## Testing

- Manual: login as admin and exercise add/edit/delete product, toggle user roles, update order status and view order details.
- For each action, ensure the DB reflects changes and images are correctly managed.

## Next Improvements

- Convert DB queries to prepared statements.
- Add CSRF protection and stricter upload validation.
- Add search/filtering on product/user/order lists.
- Add activity logging for admin actions.
- Add pagination for long lists.

## Where to find things

- Admin dashboard: `/admin/index.php`
- AJAX handlers: `/admin/actions.php`
- Styles: `/admin/css/admin.css`
- Scripts: `/admin/js/admin.js`

If you want, I can now:

- Harden security (prepared statements + CSRF), or
- Improve admin UI further (inline editing, filters, pagination).

Tell me which next step you'd like.
=======
# 🍕 CheezyBite - Online Food Website

**CheezyBite** is a dynamic **food ordering website** built using **PHP**, **MySQL**, and **Bootstrap**.  
It allows users to explore food items, view details, and place online orders through an easy-to-use interface.  
The website is designed for restaurants or small food businesses that want to bring their menu online — simple, responsive, and user-friendly.

---

## 🚀 Features

### 👨‍🍳 User Features
- 🍔 Browse food categories and items  
- 🧾 View detailed information about dishes  
- 🛒 Add items to the cart and place orders  
- 💳 Order confirmation and history pages  
- 🔐 User login and registration  
- 📱 Responsive layout for all devices  

---

## 🧩 Tech Stack

| Technology | Purpose |
|-------------|----------|
| **PHP** | Backend scripting |
| **MySQL** | Database management |
| **Bootstrap** | Frontend styling & responsive layout |
| **HTML / CSS / JS** | Structure and interactivity |

---

## ⚙️ Installation & Setup

Follow these simple steps to set up **CheezyBite** locally:

 **Clone the repository**

   ```bash
   git clone https://github.com/mubashir-hsn/cheezybite.git
   cd CheezyBite
```
---

## 👨‍💻 Developer

**Developed by:** Mubashar Hassan | 
**📧 Email:** mubazi80@gmail.com

---
>>>>>>> 0e3872af4992216407d6540c892eb9f0be48da2b
