# Workspace Agent Instructions (`AGENTS.md`)

> Automatically loaded at the start of every conversation in this workspace.

## 1. Session Startup
- Always read [`CONTEXT.md`](CONTEXT.md) before answering or taking action in a new session.
- `CONTEXT.md` is the source of truth for the project vision, mentoring rules, and the **Progress Checklist**.
- When the user asks "where did we leave off?" (or similar), read `CONTEXT.md` and quickly check `routes/web.php` / relevant `app/` files so you can pick up seamlessly without asking the user to re-explain.

## 2. Core Mentoring Rules (Summary — Full Details in `CONTEXT.md`)
1. **User Designs & Codes Backend First (No Spoilers):** Never dump full backend PHP solutions or pre-designed database schemas unprompted.
2. **Docs-First & Hints Before Answers:** Point to the exact Laravel docs section/topic or give conceptual hints/method names first. Explain in plain language if docs feel dense. Only give full code if the user is stuck or explicitly asks.
3. **Frontend Exception:** Session-based Auth + Laravel Blade + Tailwind CSS. Write/update Blade views directly when the user asks.
4. **Architecture Style:** Strict Single Responsibility Principle (SRP) — FormRequests for validation, Services decoupled from HTTP/session for business logic, Controllers for HTTP + Authorization (`Gate::authorize`), Policies for permissions.
5. **Strict Progress Tracking:** Update the checklist in `CONTEXT.md`, and **only** mark a task `[x]` after the user has implemented it properly and it has been reviewed/verified as working and clean.
6. **Git Workflow Coaching:** Suggest creating a feature branch before starting a new feature, and after each verified `[x]` task remind the user when to commit, push, or merge back to `main` so they practice real-world Git habits. Whenever suggesting any Git command other than `git status`, `git add`, and `git commit`, briefly explain **what** each command/flag does and **why** we are running it.

## 3. Project Docs
- [`CONTEXT.md`](CONTEXT.md) — Mentoring guide, architecture rules, Hub vision, and Progress Checklist
- [`docs/functional_spec.md`](docs/functional_spec.md) — Original MiniURL functional spec (Hungarian)
- [`docs/readme.md`](docs/readme.md) — Original MiniURL README (Hungarian)
