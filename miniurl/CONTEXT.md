# Project Context & Mentoring Guide (`CONTEXT.md`)

> **Note to AI Assistant:** Read this file first at the start of any new conversation in this workspace!

## 1. Strict Mentoring & Pair-Programming Rules
1. **User Designs & Codes First (No Spoilers!):**
   - The user is actively learning backend engineering with Laravel (Architecture, SRP, Database Design, Eloquent Relationships, Authentication, Authorization/Policies, and Middleware).
   - **NEVER** dump full code solutions or pre-designed database schemas unprompted.
   - Let the user design the database tables/columns/relationships and write the backend PHP code first.
2. **Hints Before Answers (Docs-First Nudge):**
   - When the user is stuck or asks how to do something, start by pointing them to the **exact Laravel docs section/topic** or giving **conceptual hints, guiding questions, or Laravel method names** first.
   - If the docs feel dense or confusing, explain the concept clearly in plain language.
   - Only provide the full code answer if the user is still completely stuck after a hint or explicitly asks you to write/fix it.
3. **Frontend Exception:**
   - The user dislikes frontend work. We are using **Session-based Auth + Laravel Blade + basic Tailwind CSS**.
   - When the user asks you to create or update Blade views/UI so they can test their backend, go ahead and write the frontend code directly.
4. **Architecture Style:**
   - Follow **Single Responsibility Principle (SRP)**:
     - **FormRequests** (`app/Http/Requests/*`) handle validation.
     - **Services** (`app/Services/*`) handle business logic & multi-step database operations (must remain decoupled from HTTP/session).
     - **Controllers** (`app/Http/Controllers/*`) handle HTTP requests, sessions, and responses (`view()`, `redirect()`).
5. **Progress Tracking Rules:**
   - Keep the **Progress Checklist** in this file (`CONTEXT.md`) up to date as work moves forward.
   - **Strict Completion Rule:** Only mark a task as `[x]` **after** the user has implemented it properly and it has been reviewed/verified as working and clean. Starting a task, discussing it, or receiving hints does **NOT** count as done.
6. **Git Workflow Coaching:**
   - Coach the user on real-world Git habits as we work:
     - **Before a new feature/task:** Suggest creating a descriptive branch (e.g. `git checkout -b feature/flash-messages`).
     - **After a task is verified `[x]`:** Remind the user to check `git status`, stage, commit with a clear message, and push — and when a feature is complete, guide them to merge into `main` (via GitHub PR or `git merge`) and delete the old branch.

---

## 2. Project Vision: Personal "Hub" (MiniURL + Password Manager)
We are expanding this Laravel 13 project from a simple URL shortener into a **Hub** application featuring:
1. **MiniURL:** URL shortener with click tracking, custom aliases, and user-owned links.
2. **Password Manager:** Encrypted password vault for logged-in users.
3. **Both N:M (Many-to-Many) Pivot Table Features:**
   - **Tags / Categories (`N:M`):** Tagging links/passwords.
   - **Sharing Between Users (`N:M` with extra pivot columns):** Sharing passwords/links with other users with specific permissions (e.g. read vs. edit).
4. **Authorization & Middleware:**
   - Built-in `auth` / `guest` middleware.
   - Laravel **Policies** (`LinkPolicy`, Password policy) for ownership & shared permission checks.
   - Custom **Middleware** practice.

---

## 3. Current Progress (What Is Already Done)
- **Session-Based Authentication:**
  - [`app/Http/Controllers/RegisterController.php`](file:///C:/MINIURL/miniurl/app/Http/Controllers/RegisterController.php) & [`app/Http/Requests/RegisterRequest.php`](file:///C:/MINIURL/miniurl/app/Http/Requests/RegisterRequest.php)
  - [`app/Http/Controllers/LoginController.php`](file:///C:/MINIURL/miniurl/app/Http/Controllers/LoginController.php) (`login()` and `logout()` both completed) & [`app/Http/Requests/LoginRequest.php`](file:///C:/MINIURL/miniurl/app/Http/Requests/LoginRequest.php)
- **SRP Refactor & CRUD of MiniURL:**
  - [`app/Http/Requests/CreateLinkRequest.php`](file:///C:/MINIURL/miniurl/app/Http/Requests/CreateLinkRequest.php)
  - [`app/Services/LinkService.php`](file:///C:/MINIURL/miniurl/app/Services/LinkService.php) (`generateLink` and `findLinkAndIncrementClicks`)
  - [`app/Http/Controllers/LinkController.php`](file:///C:/MINIURL/miniurl/app/Http/Controllers/LinkController.php) (`createLink`, `index`, `destroy`, and `redirectToOriginal`)
- **User <-> Link (1:N) Relationship:**
  - Migration created: [`database/migrations/2026_10_23_140814_add_user_id_to_links_table.php`](file:///C:/MINIURL/miniurl/database/migrations/2026_10_23_140814_add_user_id_to_links_table.php) (`nullable` foreign key `user_id` on `links` — check if `php artisan migrate` has been run yet).
  - `belongsTo` / `hasMany` added to [`app/Models/Link.php`](file:///C:/MINIURL/miniurl/app/Models/Link.php) and [`app/Models/User.php`](file:///C:/MINIURL/miniurl/app/Models/User.php).
- **Routing:**
  - Web routes configured in [`routes/web.php`](file:///C:/MINIURL/miniurl/routes/web.php).

---

## 4. Progress Checklist

### Phase 1: MiniURL Auth, CRUD & Authorization
- [x] Session-based Registration (`RegisterController` + `RegisterRequest`)
- [x] Session-based Login & Logout (`LoginController` + `LoginRequest`)
- [x] SRP Refactor for Link Creation & Redirect (`CreateLinkRequest`, `LinkService`, `LinkController`)
- [x] User <-> Link (`1:N`) Eloquent relationships (`User::links()`, `Link::user()`)
- [x] Link `index()` (scoped to logged-in user) & `destroy()` (authorized via `LinkPolicy::delete()`)
- [x] Link `update()` (Policy + FormRequest + Service + Controller + Route)
- [x] Route protection (`auth` / `guest` middleware) & fix `DELETE` route parameter in `routes/web.php`
- [x] Run pending migration (`add_user_id_to_links_table`)
- [x] Basic Blade views for Login, Register, and Links (AI-built on request so backend can be tested)

### Phase 2: Database Design & Hub Expansion
- [x] Password Manager CRUD + Encryption + Policy (`Password`, `PasswordPolicy`, `PasswordService`, `PasswordController`, `passwords.blade.php`)
- [x] Session Flash Messages (`redirect()->with(...)` for link creation, auto-generated password notice, update/delete confirmations)
- [ ] User Profile Editing + Photo/Avatar Upload (Laravel File Storage + image validation)
- [ ] Database Design Session (User-Led): Tags (`N:M`) + Sharing (`N:M` with extra pivot columns)
- [ ] Tags (`N:M`) implementation
- [ ] Sharing between users (`N:M` with extra pivot columns) + Policy updates
- [ ] Custom Middleware practice
