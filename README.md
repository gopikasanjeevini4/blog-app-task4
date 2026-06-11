# Blog App - Task 4 - Security Enhancements

A secure Blog Web Application built with PHP and MySQL 
as part of the 45-day Web Development Internship 
at ApexPlanet Software Pvt. Ltd.

## Technologies Used
- PHP
- MySQL
- HTML & CSS
- Bootstrap 5
- XAMPP (Apache + MySQL)
- Git & GitHub

## Security Features Implemented

### 1. Prepared Statements
- Used PDO prepared statements for all database queries
- Prevents SQL injection attacks

### 2. Form Validation
- Server-side validation for all forms
- Client-side validation for better user experience
- Email format validation
- Minimum character validation
- Password confirmation on registration

### 3. User Roles and Permissions
- Admin role - can delete any post
- Editor role - can only edit/delete their own posts
- Role badge displayed on navbar
- Role based access control on all pages

## Features
- User Registration with validation
- User Login with session management
- Password hashing using PHP password_hash()
- Create Blog Posts
- Read/View All Blog Posts
- Edit Blog Posts
- Delete Blog Posts
- Search Posts by title or content
- Pagination - 5 posts per page
- Role based access control

## Database
- Database Name: blog
- Tables: users (id, username, email, password, role, created_at)
- Tables: posts (id, title, content, user_id, created_at)

## How to Run
1. Install XAMPP
2. Start Apache and MySQL
3. Clone this repository into C:\xampp\htdocs\blog
4. Open phpMyAdmin and create database named blog
5. Create users and posts tables
6. Add role column to users table
7. Open browser and go to http://localhost/blog

## Task Progress
- [x] Task 1 - Setting Up Development Environment
- [x] Task 2 - Basic CRUD Application
- [x] Task 3 - Advanced Features
- [x] Task 4 - Security Enhancements
- [ ] Task 5 - Final Project

## Developer
- Name: Gopika Sanjeevini
- Internship: ApexPlanet Software Pvt. Ltd.
- Duration: 45 Days
