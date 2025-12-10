# Laravel Stripe Payment System

A simple Laravel project demonstrating **Stripe payment integration**.  
This project allows users to enter an amount, optionally enter an email, and pay using Stripe. All payments are stored in the database.

---

## 🔹 Features
- Stripe payment integration with secure tokenization
- Email input (optional)
- Amount input
- Payment saved in database
- Success and error messages displayed
- Works with Stripe test cards (e.g., 4242 4242 4242 4242)


---

## 🔹 Installation

1. **Clone the repository**
```bash
git clone https://github.com/teckamran/laravel-stripe-payment.git
cd laravel-stripe-payment
Install PHP dependencies

bash
Copy code
composer install
Install Node dependencies (optional for assets)

bash
Copy code
npm install
npm run dev
Copy .env.example to .env

bash
Copy code
cp .env.example .env
Add Stripe keys in .env

ini
Copy code
STRIPE_KEY=your_publishable_key
STRIPE_SECRET=your_secret_key
Generate application key

bash
Copy code
php artisan key:generate
Run migrations

bash
Copy code
php artisan migrate
Serve the application

bash
Copy code
php artisan serve

Author Muhammad Kamran 
