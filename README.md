# Blog API with Laravel

This project is a simple blog application built using Laravel. It provides RESTful APIs for CRUD operations on blog posts. The application also uses Redis for caching to improve performance by reducing database queries.

## Features included are

-   Create Post
-   Display all Posts
-   Read a Particular Post
-   Update a Post
-   Delete a Post

## Pre-requisites

-   PHP: 8.4.3
-   Laravel: 11.31
-   Composer: 2.8.3
-   MySQL: 9.1.0
-   Redis-CLI: 7.2.7

## Installation Instructions

1. **Clone the Repository**:

    ```bash
    git clone https://github.com/bhanutwid/new_blog
    cd blog

    ```

2. **Install Dependencies**:

    ```bash
    composer install

    ```

3. **Set Up Environment Variables**:

    ```bash
        cp .env.example .env

    ```

4. **Run Migrations**:

    ```bash
      php artisan migrate

    ```

5. **Start the server**:

    ```bash
      php artisan serve

    ```

6. **Run tests (for developers)**:

    ```bash
      php artisan test

    ```
