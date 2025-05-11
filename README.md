# Event Booking System

Event booking system is used to book events tickets.

# Postman Collection Link

https://documenter.getpostman.com/view/44838918/2sB2jAa7va

## Installation

Use composer, PHP 8.2 or above and node to run this project.

Follow below steps to run this project
```
# clone repository
git clone https://github.com/vaibhavparakh/event-booking-system.git

# install composer
composer install

# create env file
composer run-script post-root-package-install

# install db and run migration and seeder
composer run-script post-create-project-cmd

# test application
php artisan test

# run Laravel application
php artisan serve
```
