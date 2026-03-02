# supply-order-system

Internal Supply Order System
- A simple order system that calculates product totals, tax, and discounts while handling currency rounding accurately.

Features
- Real-time order summary
- Accurate currency calculations with rounding
- Discount and tax support
- Easy-to-use Laravel backend and Vue frontend

Setup Instructions
1. Clone the repository
   - git clone https://github.com/supremojvy25/supply-order-system.git
   - cd supply-order-system
2. Install dependencies
   - If using Composer for PHP/Laravel:
       - composer install
   - If using npm for frontend assets:
       - npm install
3. Configure environment
   - Copy the example environment file and update your settings:
       - cp .env.example .env  
4. Run migrations
   - php artisan migrate
5. Serve the application
   - PHP/Laravel
       - php artisan serve
   - Frontend
       - npm run dev

How Currency Calculations and Rounding Are Handled

- Subtotal, Tax, and Total Calculation:
    - All calculations are performed in decimal numbers using fixed precision to avoid floating-point errors.

- Rounding:
    - Currency values are rounded to two decimal places using standard rounding rules (round half up).

Example in PHP:

$subtotal = round($subtotal, 2);

$tax = round($subtotal * $taxRate, 2);

$total = round($subtotal + $tax - $discount, 2);

- Reasoning:
    - This ensures that displayed totals match actual charges in currency units, preventing small discrepancies due to floating-point arithmetic.
 
Optional Notes

- All numeric inputs are sanitized and validated before performing calculations.

- Discounts are applied before tax, in accordance with standard retail calculation practices.
