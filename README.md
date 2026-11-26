# MiniURL Hub

A personal **Laravel 13** web application that started as a URL shortener and is evolving into an all-in-one personal **Hub** featuring a **URL Shortener with click tracking**, an **Encrypted Password Vault**, and **User Profile management** with avatar uploads.

Built with a focus on clean backend engineering practices — **Single Responsibility Principle (SRP)**, Eloquent relationships, authorization Policies, encrypted casts, and Laravel File Storage.

---

## Tech Stack

- **Backend:** Laravel 13, PHP 8.3+
- **Frontend:** Laravel Blade Components, Tailwind CSS, Vite
- **Database:** SQLite (default) / MySQL via Eloquent ORM & Migrations
- **Auth & Security:** Session-based authentication, Laravel Policies, Eloquent `encrypted` casts, CSRF & session lifecycle management

---

## Architecture Highlights

The backend strictly separates responsibilities across dedicated layers:

- **Form Requests (`app/Http/Requests`):** Dedicated request validation classes (including `Rule::unique()->ignore()` and image upload validation).
- **Services (`app/Services`):** Business logic decoupled from HTTP/session state — link generation, encrypted password handling, file storage replacement/cleanup, and field-level change tracking (`getDirty()` / `getOriginal()`).
- **Controllers (`app/Http/Controllers`):** Thin HTTP layer handling authorization (`Gate::authorize`), authentication/session lifecycle, and responses with flash messages.
- **Policies (`app/Policies`):** Ownership authorization (`LinkPolicy`, `PasswordPolicy`) protecting user resources.

---

## Installation

1. **Clone the repository and enter the Laravel app directory:**
   ```bash
   git clone https://github.com/MONHuN23/MiniURL.git
   cd MiniURL/miniurl
   ```

2. **Install PHP dependencies:**
   ```bash
   composer install
   ```

3. **Create your environment file and app key:**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   *(Defaults to SQLite. If you prefer MySQL, update the `DB_*` variables in `.env` before migrating.)*

4. **Run database migrations and link public storage (for user avatars):**
   ```bash
   php artisan migrate
   php artisan storage:link
   ```

5. **Install and build frontend assets:**
   ```bash
   npm install
   npm run build
   ```

6. **Start the local development server:**
   ```bash
   php artisan serve
   ```

> **Quick Setup Tip:** If you're using the default SQLite setup, you can run `composer run setup` followed by `php artisan storage:link`.

---

## Features & Roadmap

### Completed
- [x] Random & custom alias URL shortening with redirect handling
- [x] Click counter tracking for shortened links
- [x] Session-based Registration, Login & Logout (`auth` / `guest` middleware)
- [x] User-owned Links CRUD (`1:N` relationship + `LinkPolicy`)
- [x] Encrypted Password Vault CRUD (auto-generated password support + `PasswordPolicy`)
- [x] Session flash messages & detailed field-level change summaries
- [x] User Profile editing, Avatar upload/replacement (`public` storage disk), and Account Deletion (with cascading cleanup)

### Planned
- [ ] Tags / Categories (`N:M` many-to-many relationships for links & passwords)
- [ ] Sharing links & passwords between users (`N:M` pivot table with read/edit permissions & Policy updates)
- [ ] Custom Middleware
