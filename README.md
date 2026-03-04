# Internal Supply Order System

A simple Laravel + Vue application that allows users to create product orders, automatically calculate taxes and discounts, and view order history.

---

## Features

- Select a product and enter quantity
- Real-time order summary (subtotal, tax, discount, total)
- Automatic tax calculation based on category
- 10% bulk discount for quantities greater than 10
- Order history table
- Data stored using Eloquent ORM
- SQLite database for quick setup

---

## Tech Stack

- Backend: Laravel (PHP)
- Frontend: Vue 3
- Database: SQLite
- ORM: Eloquent
- API Communication: Axios

---

## Installation Guide

### 1. Clone the Repository

```bash
git clone https://github.com/supremojvy25/supply-order-system.git
cd supply-order-system
```

### 2. Install PHP Dependencies

```bash
composer install
```

### 3. Setup Environment File

```bash
cp .env.example .env
php artisan key:generate
```

### 4. Configure Database (SQLite)

Create SQLite file:

```bash
touch database/database.sqlite
```

In `.env` make sure:

```
DB_CONNECTION=sqlite
```

### 5. Run Migrations

```bash
php artisan migrate
```

### 6. Insert Sample Products (Optional)

```bash
php artisan tinker
```

Then run:

```php
\App\Models\Product::create([
'name' => 'Laptop',
'base_price' => 1000,
'category' => 'Electronics'
]);

\App\Models\Product::create([
'name' => 'Printer Paper',
'base_price' => 20,
'category' => 'Office'
]);
```

Exit with:

```
exit
```

---

## Running the Application

### Start Backend

```bash
php artisan serve
```

### Start Frontend

```bash
npm install
npm run dev
```

Open in browser:

```
http://127.0.0.1:8000
```

---

## Business Logic Rules

### 1. Subtotal
```
Subtotal = base_price × quantity
```

### 2. Dynamic Tax Rates
- Electronics = 15%
- Office = 5%
- Default = 10%

### 3. Bulk Discount
- 10% discount applied only if quantity > 10

### 4. Total Calculation
```
Taxable Amount = Subtotal − Discount
Tax = Taxable Amount × Tax Rate
Total = Taxable Amount + Tax
```

---

## Currency Rounding

All monetary values are rounded using:

```php
round(value, 2)
```

This ensures currency precision to two decimal places.

---

## API Endpoints

| Method | Endpoint        | Description          |
|--------|-----------------|----------------------|
| GET    | /api/products   | List all products    |
| POST   | /api/orders     | Create new order     |
| GET    | /api/orders     | View order history   |

---
