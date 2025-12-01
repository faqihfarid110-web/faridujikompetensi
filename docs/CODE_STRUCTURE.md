Project structure and purpose — simplified overview

Root
- artisan: Laravel CLI helper
- app/: Application code; MVC controllers, models and providers
  - Http/Controllers/: Controller classes that return views/responses
  - Models/: Eloquent models for database tables
  - Providers/: Service providers
- bootstrap/: Application bootstrap scripts
- config/: Configuration files (env, app settings)
- database/: Migrations, seeders, factories
- public/: Web accessible assets (images, build, index.php)
- resources/: Blade views, CSS/JS, and data files
  - views/: All Blade template files (user-facing + admin views)
  - views/documentation/data/: Per-continent painting data files (PHP arrays) — these are editable content files
  - css/ & js/: Frontend assets compiled by Vite/Tailwind
- routes/: Route definitions for web API & admin
- storage/: Logs, cache, uploaded files
- tests/: Feature and unit tests

Key controllers and views
- SurveyController (app/Http/Controllers/SurveyController.php)
  - handles public survey form at /survey
  - stores survey entries into DB (Surveys table)
  - view: resources/views/survey/create.blade.php

- AdminSurveyController (app/Http/Controllers/AdminSurveyController.php)
  - admin page: list and delete survey entries
  - view: resources/views/admin/surveys/index.blade.php

- AdminPaintingController (app/Http/Controllers/AdminPaintingController.php)
  - admin CRUD for paintings. Reads/writes to per-continent data files.
  - views: resources/views/admin/paintings/*

- PaintingRatingController (app/Http/Controllers/PaintingRatingController.php)
  - accepts public rating/comments via AJAX for each painting
  - stores to per-painting JSON, aggregated and read by admin

- FunfactController, IdeologyController, ArticleController
  - content list/detail pages and per-topic controllers
  - views: resources/views/funfact.blade.php, resources/views/ideologi.blade.php, resources/views/articles/*.blade.php

Files to consider for cleanup (candidates)
- resources/views/backup/* — old welcome template copies used during migration (can delete if not needed)
- resources/views/welcome_backup.blade.php — duplicate of welcome.blade.php (candidate for removal)
- resources/views/ideologi/index_old.php & resources/views/ideologi/show_old.php — backup files, not referenced
- resources/views/backup/nextjs-template — (backup of Next.js project) - consider moving outside repo or removing if not used
- Anything in resources/views/backup/ or files with .bak, .original.txt suffix

Goals for cleanup
1. Remove backup and old files that are no longer referenced.
2. Minimize duplicates and unused assets.
3. Keep a single source of truth for content files (e.g., per-continent PHP data files remain as the content source).
4. Add a small `docs/CODE_STRUCTURE.md` (this file) summarizing code responsibilities & locations.

Next steps
- I can prepare a PR / set of deletions for the listed candidate files. I’ll only remove files after you confirm.
- If you want, I’ll also reorganize the `resources/views/documentation/data` files into a `data/` folder under `resources` to make it clearer (optional).

If you're OK with the cleanup plan, confirm and I’ll create a safe PR removing these files and adding the doc into `docs/CODE_STRUCTURE.md`.
