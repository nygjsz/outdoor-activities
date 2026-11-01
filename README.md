# Adventure & Outdoor Activities

A Laravel web application for managing outdoor adventure activities (hiking, kayaking, camping and more). Customers can browse activities and make bookings. The admin manages activities, guides, bookings and contact messages.

Course: CSC1413 Final Project (Session 2, 2026)

---

## 1. Features

**Everyone (no login)**
- Browse and search activities (by name, location or code)
- View activity details
- Register and log in
- Send a message through the Contact form

**Customer (logged in)**
- Book an activity (number of participants and safety notes)
- View, edit and delete their own bookings
- Cannot see or change other users' bookings

**Admin**
- Add, edit and delete activities
- Add, edit, delete and search guides
- View all bookings and change the booking status (pending, confirmed, cancelled)
- Read contact messages

**Other**
- Two user levels (admin and user) using a `role` column and an `admin` middleware
- Client-side validation with JavaScript, and server-side validation in the controllers
- CSRF protection on every form

---

## 2. Technology

| Part | Used |
|---|---|
| Framework | Laravel (PHP 8.3) |
| Database | MySQL |
| Templates | Blade |
| Styling | Plain CSS (`public/css/style.css`) |
| Local server | Laragon |
| Version control | Git and GitHub |

---

## 3. How to run the project

Requirements: PHP 8.2 or newer, Composer, MySQL (Laragon includes all of these).

1. Open a terminal in the project folder and install the packages:
   ```
   composer install
   ```
2. Copy the settings file and create the app key:
   ```
   copy .env.example .env
   php artisan key:generate
   ```
3. In phpMyAdmin (or HeidiSQL), create an empty database named `adventure_db`.
4. Open `.env` and set the database:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=adventure_db
   DB_USERNAME=root
   DB_PASSWORD=
   ```
5. Create the tables and the sample data:
   ```
   php artisan migrate --seed
   ```
   (Alternatively, import `database/adventure_db.sql` in phpMyAdmin.)
6. Start the server:
   ```
   php artisan serve
   ```
7. Open `http://127.0.0.1:8000/home`.

### Login accounts

| Role | Email | Password |
|---|---|---|
| Admin | `admin@outdoor.activity` | `admin123` |
| Customer | Register a new account on the Register page | (your own) |

---

## 4. Database design

| Table | Purpose | Key columns |
|---|---|---|
| `users` | Accounts for admin and customers | `id`, `name`, `email`, `password`, `role` |
| `guides` | Guides who lead activities | `guide_id` (primary key), `name`, `phone`, `experience_years` |
| `activities` | Activities offered | `code` (primary key), `name`, `location`, `price`, `activity_date`, `difficulty`, `guide_id` |
| `bookings` | A customer booking an activity | `id`, `user_id`, `activity_code`, `participants`, `safety_notes`, `status` |
| `contact_messages` | Messages from the Contact form | `id`, `name`, `email`, `message` |

**Relationships**
- One guide has many activities (`activities.guide_id` refers to `guides.guide_id`)
- One user has many bookings (`bookings.user_id` refers to `users.id`)
- One activity has many bookings (`bookings.activity_code` refers to `activities.code`)

---

## 5. Routes

| Access | URL | Purpose |
|---|---|---|
| Public | `/home` | Home page with upcoming activities |
| Public | `/activities` | List and search activities |
| Public | `/activities/{code}` | Activity details |
| Public | `/contact` | Contact form (GET shows, POST saves) |
| Guests | `/login`, `/register` | Sign in and sign up |
| Logged in | `/logout` | Sign out |
| Logged in | `/bookings` (index, create, edit, update, destroy) | Bookings (customers see only their own) |
| Admin | `/activities/create`, `/activities/{code}/edit` and delete | Manage activities |
| Admin | `/guides` (index, create, edit, update, destroy) | Manage guides |
| Admin | `/messages` | Read contact messages |

Run `php artisan route:list` to see every route.

---

## 6. Project structure (main files)

```
app/
  Http/Controllers/
    ActivityController.php   activities CRUD and search
    BookingController.php    bookings CRUD (own bookings for customers)
    GuideController.php      guides CRUD and search (admin)
    AuthController.php       register, login, logout
    ContactController.php    contact form and messages
    PageController.php       home page
  Http/Middleware/
    AdminMiddleware.php      blocks non-admin users (403)
  Models/                    User, Guide, Activity, Booking, ContactMessage
database/
  migrations/                table definitions
  seeders/DatabaseSeeder.php admin account and sample data
resources/views/
  layout/app.blade.php       shared layout (banner, navigation, footer)
  activities/ bookings/ guides/ messages/ auth/   page templates
routes/web.php               all routes
public/css/style.css         stylesheet
```

---

## 7. Testing

The functions were tested manually. The test cases, expected results and outcomes are in the testing table of the report (login, validation, CRUD, role protection and the contact form).

---

## 8. Version control

Source code is kept in Git and pushed to GitHub: https://github.com/nygjsz/outdoor-activities
