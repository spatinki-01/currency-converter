# Currency Converter Laravel Project

This is a Laravel-based currency converter application.

## Deployment Instructions

1. **Clone the repository**:
    ```sh
    git clone https://github.com/spatinki-01/currency-converter.git
    cd your-repository-name
    ```

2. **Copy `.env.example` to `.env`**:
    ```sh
    cp .env.example .env
    ```

3. **Configure the environment**:
    - Open the `.env` file and fill in your database details.
    - Add your `CURRENCY_API_KEY` from [Free Currency API](https://app.freecurrencyapi.com).

    Example `.env` additions:
    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database_name
    DB_USERNAME=your_database_username
    DB_PASSWORD=your_database_password

    CURRENCY_API_KEY=your_api_key_here
    ```

4. **Install dependencies**:
    ```sh
    composer install
    ```

5. **Generate application key**:
    ```sh
    php artisan key:generate
    ```

6. **Run database migrations**:
    ```sh
    php artisan migrate
    ```

7. **Start the development server**:
    ```sh
    php artisan serve
    ```

8. **Access the application**:
    - Open your web browser and go to [http://127.0.0.1:8000/](http://127.0.0.1:8000/)

## Summary

- Clone the repository.
- Copy `.env.example` to `.env`.
- Configure the environment variables.
- Install dependencies.
- Generate the application key.
- Run database migrations.
- Start the development server.
- Access the application at [http://127.0.0.1:8000/](http://127.0.0.1:8000/).
- Get and set the `CURRENCY_API_KEY` from [Free Currency API](https://app.freecurrencyapi.com).

With these steps, the application should be running and ready to use.