1. Clone the repository

2. Install dependencies(composer install)

3. Copy .env.example to .env and configure the database(cp .env.example .env)

4. Generate an application key(php artisan key:generate)

5. Run migrations and seed the database with test data

php artisan migrate
php artisan db:seed


6. Start the development server(php artisan serve)

Usage
Get categories:
Send a GET request to /api/categories.

Update a category:
Send a PUT request to /api/categories/{id} with the following JSON payload:
{
  "parent_id": 1,
  "index": 1
}

Get products:
Send a GET request to /api/products with optional query parameters:

category_id - Filter products by category ID
sort - Sort products by name (values: name_asc or name_desc)

To run the automated tests, execute the following command:
php artisan test

P.S. докерфайлы создал но не успел протестить\запустить ,
swagger не хватило время разобраться с правильным написанием аннотаций 


dwedwed
