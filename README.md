# PHP and JavaScript AJAX Project

## Project Overview

This repository contains a web application built with PHP and JavaScript (AJAX) that demonstrates interactive web development techniques. The project integrates dynamic server-side scripting with client-side interactivity to deliver a seamless user experience.

---

## Features

1. **Custom Pizza Ordering System**:
   - Users can customize pizzas by selecting crusts, sizes, and toppings.
   - Real-time updates to the cart using AJAX.

2. **Order Management**:
   - Customers can view, edit, and confirm their orders.
   - Employees can log in to manage orders and toppings.

3. **Dynamic Web Interaction**:
   - AJAX is used to fetch and display available crusts, sizes, and toppings without reloading the page.

4. **Database Integration**:
   - A MySQL database (`pizzadb.sql`) is used to manage customers, orders, and pizza configurations.

5. **User Authentication**:
   - Login and logout functionality for customers and employees.

---

## Technical Details

- **Programming Languages**: PHP, JavaScript
- **Frontend**: HTML, CSS, AJAX
- **Backend**: PHP with modular includes for functionality
- **Database**: MySQL (schema provided in `pizzadb.sql`)
- **Key Files**:
  - `index.php`: Main landing page.
  - `cart.php`: Displays the current cart items.
  - `checkout.php`: Checkout process for customers.
  - `order_summary.php`: Summary of placed orders.
  - `api/`: AJAX endpoints for fetching crusts, sizes, and toppings.
  - `employee/`: Pages for employees to manage orders and toppings.
  - `includes/`: Reusable PHP scripts for database connections, orders, and other utilities.
  - `styles/custom.css`: Custom CSS for styling the application.

---

## How to Run

1. **Clone the repository**:
   ```bash
   git clone https://github.com/RicoRF/PHPProject.git
   ```

2. **Set up the database**:
   - Import the `pizzadb.sql` file into your MySQL server.

3. **Configure database connection**:
   - Update the `includes/conn.php` file with your database credentials.

4. **Launch the application**:
   - Place the files in a PHP-compatible server (e.g., XAMPP, WAMP, or a live server).
   - Access the application via `http://localhost/<project-folder>`.

5. **Explore features**:
   - Customize and order pizzas as a customer.
   - Log in as an employee to manage orders and toppings.

---

## Lessons Learned

1. **AJAX Integration**:
   - Learned to update the frontend dynamically without full-page reloads.

2. **Database Design**:
   - Designed and implemented a normalized database schema for managing dynamic content.

3. **Modular Development**:
   - Built reusable PHP modules for common functionality like database connections and user management.

4. **Web Application Workflow**:
   - Gained experience in the end-to-end workflow of a dynamic web application.

---

## Future Enhancements

- Implement user authentication for customers with registration.
- Add an analytics dashboard for employees to track order statistics.
- Improve UI/UX with modern JavaScript frameworks like Vue.js or React.
- Integrate payment gateways for online payments.

---

This project demonstrates a comprehensive understanding of web development using PHP and AJAX, combining server-side scripting with client-side interactivity for a rich user experience.
