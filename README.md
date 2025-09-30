# GermanTranslator

A Symfony-based web application for managing translation services, pricing, and client communication.

## Features

- **Static pages**: Home, Services, Conditions, Clients  
- **Pricing management** with admin panel  
- **Contact form** with message storage in database  
- **Admin dashboard** for managing pricing and viewing client messages  
- **Twig templates** for a clean and responsive UI

## Tech Stack

- **PHP** 8.4.10  
- **Symfony** 7.3.1  
- **Doctrine ORM**  
- **Twig** templating engine  
- **Bootstrap** for styling  
- **MySQL**  

## Installation

# 1) Clone the repository
git clone https://github.com/USER/GermanTranslator.git
cd GermanTranslator

# 2) Install dependencies
composer install

# 3) Copy and edit environment variables
cp .env.local.example .env.local
# edit APP_SECRET, DATABASE_URL, MAILER_DSN

# 4) Create database & run migrations
php bin/console doctrine:database:create --if-not-exists
php bin/console doctrine:migrations:migrate -n

# (optional) Load fixtures
php bin/console doctrine:fixtures:load -n

# 5) Start dev server
symfony server:start -d
# or
php -S localhost:8000 -t public