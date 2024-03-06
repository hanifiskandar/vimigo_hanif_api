# Technical Assessment Muhammad Hanif Bin Iskandar

## Description
This project consists of a Vue.js frontend and a Laravel backend. The frontend handles the user interface and interactions, while the backend manages data storage and business logic.

## Installation

### Frontend (Vue.js)
1. Clone the Vue.js repository: `git clone https://github.com/hanifiskandar/vimigo_hanif_web.git`
2. Navigate to the Vue.js directory: `cd <vue_directory>`
3. Install dependencies: `npm install`
4. Start the development server: `npm run dev`
5. The Vue.js frontend should now be accessible at `http://localhost:3000`

### Backend (Laravel)
1. Clone the Laravel repository: `git clone https://github.com/hanifiskandar/vimigo_hanif_api.git`
2. Navigate to the Laravel directory: `cd <laravel_directory>`
3. Install dependencies: `composer install`
5. Set up your database configuration in the `.env` file // or can use mine #vimigo_hanif_db.sql
6. Migrate the database: `php artisan migrate`
6. Run seeder for user: `hp artisan db:seed --class=DatabaseSeeder`
6. Run seeder for music: `hp artisan db:seed --class=MusicSeeder`
7. Serve the application: `php artisan serve`
8. The Laravel backend should now be accessible at `http://localhost:8000`


## Technologies Used
- Vue 3
- Laravel 10


## Contact Information
Name: Muhammad Hanif Bin Iskandar
Email: muhdhanif0096@gmail.com
Phone: 011-3680 4874
