# GeoQuestions

## Description

GeoQuestions is a Laravel web application where users can register, log in, post questions, and answer existing questions.

## Tech Stack

- Laravel
- PHP
- PostgreSQL
- Tailwind CSS

## Features Implemented

- User authentication
    - Register
    - Login
    - Logout
- Questions module
    - Create question
    - List questions
    - View question details
- Answers module
    - Submit answers
    - Display answers under question details

## Installation

1. Clone the repository
2. Run `composer install`
3. Copy `.env.example` to `.env`
4. Configure the database connection
5. Run `php artisan key:generate`
6. Run `php artisan migrate`
7. Run `npm install`
8. Run `npm run dev`
9. Run `php artisan serve`

## Usage

- Register a new account
- Log in
- Create a question
- Open a question
- Submit an answer

## Project Status

The project is currently under development. Authentication, questions, and answers modules are implemented.

## Planned Features

- Favorites / Likes
- Profile improvements
- Additional question enhancements
