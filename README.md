<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Daily Blogger

Daily Blogger is a blogging platform built with Laravel, offering a robust multi-role user system, advanced content management, and comprehensive administrative capabilities. The platform is designed around the MVC architectural pattern, with a clean separation of concerns and a focus on scalability, maintainability, and user experience.

## Table of Contents

- [Overview](#overview)
- [Features](#features)
- [Technical Stack](#technical-stack)
- [Project Structure](#project-structure)
- [Database Architecture](#database-architecture)
- [Authentication & Authorization](#authentication--authorization)
- [Controllers & Routes](#controllers--routes)
- [AJAX & Real-Time Features](#ajax--real-time-features)
- [Localization](#localization)
- [Development & Setup](#development--setup)
- [Contributing](#contributing)
- [License](#license)

---

## Overview

Daily Blogger provides a full-featured blogging experience for writers, readers, and administrators. It supports secure authentication, dynamic content management, real-time notifications, and localization, making it suitable for both individual bloggers and multi-user content teams.

---

## Features

### Content Management
- Create, edit, delete, and approve/reject blog posts
- Hierarchical categories and flexible tagging system
- Image/media management with secure uploads and automatic cleanup
- Nested comment threads for user engagement

### User Management
- Multi-role authentication (admin, user, blocked)
- User registration, profile management, and blocking/unblocking
- Role-based access control and permissions

### Search & Discovery
- Keyword search, category and tag filtering
- Featured posts and recent activity highlights

### Real-Time & AJAX Features
- Live dashboard statistics and notifications (AJAX polling)
- Instant language switching without page reload
- Responsive admin panel and dynamic forms

### Administration
- Comprehensive admin panel for user/content management
- Settings management (site, mail, security)
- Notification system for user actions and events

### Localization
- Multi-language support using Laravel localization features
- Seamless language switching in the UI

---

## Technical Stack

- **Backend:** Laravel 11/12 (PHP)
- **Frontend:** Blade templates, CSS, JavaScript, AJAX (Fetch API)
- **Database:** MySQL (Eloquent ORM)
- **Other:** Composer, NPM, RESTful API routes

---

## Project Structure

```
dailyblogger/
├── app/
│   ├── Http/Controllers/   # Controllers (request handling logic)
│   ├── Models/             # Eloquent models
│   ├── Notifications/      # Notification classes
│   ├── Services/           # Business logic services
│   └── helpers.php         # Global helper functions
├── database/
│   ├── migrations/         # Database schema definitions
│   ├── seeders/            # Data seeders
│   └── factories/          # Model factories for testing
├── resources/
│   ├── views/              # Blade templates
│   ├── lang/               # Localization files
│   ├── css/                # Stylesheets
│   └── js/                 # JavaScript files
├── routes/
│   ├── web.php             # Web routes
│   ├── api.php             # API routes
└── ...
```

---

## Database Architecture

- **Users:** Handles user information and roles (admin, user, blocked)
- **Posts:** Blog posts with status, approval workflow, and author linkage
- **Categories/Tags:** Many-to-many relationships with posts
- **Comments:** Nested threading support for discussions
- **Notifications:** Real-time event tracking
- **Settings:** Dynamic site configuration

---

## Authentication & Authorization

- Secure registration and login (multi-role support)
- Middleware for route protection and role-based access
- Permission checks for sensitive operations

---

## Controllers & Routes

- Organized using MVC pattern and RESTful conventions
- Route groups for public, authenticated, and admin-only access
- Dedicated API endpoints for AJAX interactions

**Key API Endpoints:**
- `/admin/dashboard/stats`: Real-time dashboard statistics
- `/notifications/count`: Get unread notification count
- `/search/suggestions`: Live search autocomplete
- `/switch-language`: Change interface language

---

## AJAX & Real-Time Features

- Dashboard stats auto-refresh every 30 seconds
- Notification count updates without reload
- Dynamic forms and content areas for seamless UX
- Secure AJAX with CSRF protection and validation

---

## Localization

- Supports multiple languages using Laravel localization
- Language files in `resources/lang/`
- Instant language switching via AJAX

---

## Development & Setup

1. **Clone the repository**

   ```
   git clone https://github.com/akhil-kk15/dailyblogger.git
   cd dailyblogger
   ```

2. **Install dependencies**

   ```
   composer install
   npm install
   ```

3. **Configure environment**

   - Copy `.env.example` to `.env` and update database and mail settings

4. **Run migrations and seeders**

   ```
   php artisan migrate --seed
   ```

5. **Build frontend assets**

   ```
   npm run dev
   ```

6. **Start development server**

   ```
   php artisan serve
   ```

---

## Contributing

Contributions are welcome! Please open issues or submit pull requests for improvements and bug fixes.

---

## License

This project is open source and available under the [MIT License](LICENSE).
