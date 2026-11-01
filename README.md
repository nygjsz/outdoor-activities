# Adventure & Outdoor Activities

A Laravel web application for managing outdoor adventure activities (hiking, kayaking, camping and more). Customers browse activities and make bookings. The admin manages activities, guides, bookings and contact messages.

Course: CSC1413 Web Programming, Final Project (Session 2 2026/2027)

## Features

- Register, login and logout
- Browse and search activities
- Customer: book activities, view, edit and delete own bookings
- Admin: manage activities and guides, view all bookings and change their status, read contact messages
- Two user levels (admin and customer) using a role column and middleware
- JavaScript and Laravel validation, CSRF protection
- Contact form saved to the database


## Tech Stack

**Server:** Laravel (PHP 8.3), MySQL

**Client:** Blade templates, HTML, CSS, JavaScript

**Tools:** Laragon, VS Code, Git, GitHub

## Run Locally

Requirements: PHP 8.2 or newer, Composer, MySQL (Laragon includes all of these).

Clone the project

    git clone https://github.com/nygjsz/outdoor-activities.git

Go to the project folder and install the packages

    cd outdoor-activities
    composer install

Create the settings file and the app key

    copy .env.example .env
    php artisan key:generate

Create an empty database named `adventure_db` in phpMyAdmin, then create the tables and sample data

    php artisan migrate --seed

(Or import `database/adventure_db.sql` in phpMyAdmin.)

Start the server

    php artisan serve

Open http://127.0.0.1:8000/home

## Environment Variables

Set these in the `.env` file:

`DB_CONNECTION=mysql`

`DB_HOST=127.0.0.1`

`DB_PORT=3306`

`DB_DATABASE=adventure_db`

`DB_USERNAME=root`

`DB_PASSWORD=` (empty)

## Login Accounts

| Role | Email | Password |
|---|---|---|
| Admin | admin@outdoor.activity | admin123 |
| Customer | Register a new account on the Register page | your own |
## Database Design

| Table | Purpose | Key columns |
|---|---|---|
| users | Accounts for admin and customers | id, name, email, password, role |
| guides | Guides who lead activities | guide_id (PK), name, phone, experience_years |
| activities | Activities offered | code (PK), name, location, price, activity_date, difficulty, guide_id |
| bookings | A customer booking an activity | id, user_id, activity_code, participants, safety_notes, status |
| contact_messages | Messages from the Contact form | id, name, email, message |

Relationships: one guide has many activities, one user has many bookings, one activity has many bookings.

## Testing

The functions were tested manually. The test cases and results are in the testing table of the project report.


## Author

[@nygjsz](https://github.com/nygjsz)

