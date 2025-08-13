# U-Reg Coding Challenge

A Laravel application to view daily currency exchange rates with a live date picker powered by AJAX.  
All exchange rates are based on USD.

---

## Features

- **Date Picker** to select rates for a specific day.
- **Dynamic Title** — shows `Rates for [date]`.
- **Subtitle** — indicates all rates are based on USD.
- **AJAX Updates** — no page reload when selecting a new date.
- **Error Handling** — shows “No rates found for this date” if empty.
- **Clean Blade Template** layout.

---

## Requirements

- PHP >= 8.0
- Composer
- MySQL
- Laravel 10+
- Node.js & npm (for frontend assets)

---

## Installation

1. **Clone the repository**
   ```sh
   https://github.com/faace96/u-reg.git
   ```

2. **Install PHP dependencies**
    ```sh
    composer install
    ```

3. **Copy .env file**
    ```sh
    cp .env.example .env
    ```

4. **Update the database credentials in .env**
    ```sh
    DB_DATABASE=your_db_name
    DB_USERNAME=your_db_user
    DB_PASSWORD=your_db_password
    ```

5. **Generate application key**
    ```sh
    php artisan key:generate
    ```

6. **Run migrations**
    ```sh
    php artisan migrate
    ```
    
7. **Seed test data**
    ```sh
    php artisan db:seed --class=CurrencySeeder
    php artisan db:seed --class=RateSeeder
    ```

