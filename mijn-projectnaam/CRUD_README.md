# Basic CRUD System

This is a basic CRUD (Create, Read, Update, Delete) system built with Laravel. It provides a simple interface for managing items.

## Database Setup

Since you're using DB Browser for SQLite, follow these steps to set up your database:

1. Open DB Browser for SQLite
2. Open the database file at `database/mijn.db`
3. Go to the "Execute SQL" tab
4. Copy and paste the contents of `database/create_tables.sql` into the SQL editor
5. Click "Execute" to create all the necessary tables

## Features

-   **List Items**: View all items with pagination
-   **Create Items**: Add new items with validation
-   **View Item Details**: See detailed information about each item
-   **Edit Items**: Update existing items
-   **Delete Items**: Remove items from the database

## How to Use

1. Start your Laravel development server:

    ```
    php artisan serve
    ```

2. Visit `http://localhost:8000/items` in your browser

3. Use the interface to manage your items:
    - Click "Create New Item" to add a new item
    - Click "View" to see item details
    - Click "Edit" to update an item
    - Click "Delete" to remove an item

## Customizing the CRUD System

This CRUD system is designed to be easily customizable:

### Modifying Fields

1. Update the migration file at `database/migrations/YYYY_MM_DD_create_items_table.php`
2. Update the Item model at `app/Models/Item.php`
3. Update the controller validation at `app/Http/Controllers/ItemController.php`
4. Update the views in `resources/views/items/`

### Adding New Features

1. Add new methods to the ItemController
2. Create new routes in `routes/web.php`
3. Create new views in `resources/views/items/`

## Troubleshooting

If you encounter issues with the SQLite driver in Laravel, you can:

1. Edit your PHP configuration file to enable the SQLite extensions:

    - Open `php.ini`
    - Uncomment these lines:
        ```
        extension=pdo_sqlite
        extension=sqlite3
        ```
    - Restart your web server

2. Or continue using DB Browser for SQLite to manage your database directly
