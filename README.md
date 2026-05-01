# 🍕 CheezyBite — PHP MySQL Food Ordering App

CheezyBite is a food ordering web application built with PHP, MySQL and Bootstrap. It's intended as a small restaurant or takeaway  site with a customer-facing menu, cart and checkout plus a simple admin panel for managing products, users and orders.

This README documents how to set up the project locally, database schemas, key pages and admin workflows so you can run, modify and extend the app.

---

## Quick Features

- Browse food categories and items  
- View detailed information about dishes  
- Add items to the cart and place orders  
- Order confirmation and history pages  
- User login and registration  
- Responsive layout for all devices  
- Admin panel: products, users, orders, support tickets
- Contact form backed by a support table (viewable in admin)
- Small, dependency-free PHP codebase — runs on XAMPP/LAMP/MAMP

---

## Requirements

- PHP 7.4+ (with mysqli extension)
- MySQL / MariaDB
- Web server (Apache recommended — XAMPP on Windows)
- Modern browser for admin UI

---

## Setup (Local)

1. Place the project folder inside your web server document root (for XAMPP on Windows: `C:\xampp\htdocs\cheezybite`).
2. Create a MySQL database (example name: `database_name`).
3. Import the database schema (see SQL below).
4. Update database connection in [connect.php](connect.php) if needed (default uses `root` / empty password / `cheezybite`).
5. Start Apache + MySQL and open `http://localhost/cheezybite` in your browser.

---


---

## Key Files / Structure

- `index.php` — home page
- `menu.php` — menu with category filters
- `detail.php` — product detail
- `cart.php` / `addToCart.php` — cart and add endpoints
- `checkout.php` — place order
- `orders.php` / `order_detail.php` — user orders and order detail
- `contact.php` — contact form (stores messages in `support` table)
- `connect.php` — MySQL connection
- `functions/` — helper functions (e.g., `getProducts.php`)
- `admin/` — admin panel (manage products, users, orders, support)
  - `admin/index.php` — dashboard
  - `admin/orders.php` — orders list
  - `admin/support.php` — support ticket list
  - `admin/support_view.php` — view/edit ticket
  - `admin/actions.php` — admin AJAX/actions router

---

## Styling and Assets

- Uses `./css/style.css` and `./css/bootstrap.css`.
- Admin styles are in `admin/css/admin.css`.
- Images are stored in `images/`, product images referenced by filename in the DB.

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
