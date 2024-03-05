# Laravel Project Setup Guide

This guide will walk you through the steps to set up the User Management System API, run migrations and seed the database, start the server, and run tests.

## Prerequisites

- [PHP](https://www.php.net/) installed on your machine
- [Composer](https://getcomposer.org/) installed
- [Node.js](https://nodejs.org/) installed (for Laravel Mix)
- [MySQL](https://www.mysql.com/) or another database system of your choice

## Installation

1. **Clone the repository:**

   ```bash
   git clone https://github.com/vitechsys/your-laravel-project.git

Navigate to the project directory in the terminal
  ##  cd your-laravel-project

Run the following to install dependencies
  ##  composer install
  ##  npm install

Copy the .env.example file to .env and update the database and other relevant configurations.
  ##  cp .env.example .env

Generate application key
  ##  php artisan key:generate

Run Migrations
  ##  php artisan migrate

Seed the database
  ##  php artisan db:seed

Start the server
  ##  php artisan serve

You can run all the test files using
  ##  php artisan test

Or run individual files using (testfilename.phpis the test file to run)
   ## php artisan test tests/Feature/testfilename.php

