### Dashboard plan (OOP practice)

Goal: implement an **admin dashboard** that shows:

- **Views count**
- **Users count**
- **Comments count**
- **Photos count**
- A **Google API** section (placeholder first, real integration later)

This plan is written to fit your current architecture (models extend `Db_object`, admin loads `admin/includes/init.php`).

---

### Current codebase baseline (what you already have)

- **Entry point**: `admin/index.php` includes `admin/includes/header.php`, which requires `admin/includes/init.php`, then includes `admin/includes/admin_content.php`.
- **OOP base**: `admin/includes/db_object.php` provides shared DB behavior for models.
- **Models**:
  - `admin/includes/user.php` → `User extends Db_object` → table `users`
  - `admin/includes/photo.php` → `Photo extends Db_object` → table `photos`
  - `admin/includes/comment.php` → `Comment extends Db_object` → table `comments`

---

### Target design (classes + responsibilities)

- **`Db_object` (base class)**
  - Add a reusable **static counting method** (ex: `count_all()`), so each model can do `User::count_all()` / `Photo::count_all()` etc.
  - Keep the method generic and use late static binding via `static::$db_table`.

- **`View` (new model)**
  - `View extends Db_object`
  - Table: `views`
  - Purpose: store each view event (for a photo page and/or generic page view).
  - Provide a convenience method like `View::record_view($photo_id, $page_url)` (optional, but good OOP practice).

- **`Dashboard` (new “service” / aggregator class)**
  - A single place to gather dashboard metrics.
  - Example responsibilities:
    - `Dashboard::stats()` returns an array of counts.
    - `Dashboard::googleApiStatus()` returns “configured/not configured” (placeholder first).

---

### Database additions (views tracking)

You’ll need a new table to support **Views count**.

#### Minimal table

```sql
CREATE TABLE IF NOT EXISTS views (
  id INT(11) AUTO_INCREMENT PRIMARY KEY,
  page_url VARCHAR(255) DEFAULT NULL,
  photo_id INT(11) DEFAULT NULL,
  viewed_at DATETIME DEFAULT CURRENT_TIMESTAMP
);
```

Notes:

- If you only care about photo views, you can store only `photo_id` (+ timestamp).
- If you also want generic page views, store `page_url`.
- Keep it simple for learning; add indexes later if you need them.

---

### Where to record a view (so the views count increases)

Pick one (or both):

- **Photo page views**
  - When you display a photo in `photo.php`, record a view event (ex: with `photo_id`).

- **Admin page views (optional)**
  - Not usually what dashboards track, but can be a learning exercise.

Implementation detail:

- Recording should happen **after** you’ve validated that the photo exists (avoid counting invalid IDs).

---

### Dashboard UI layout (admin)

In `admin/includes/admin_content.php` build:

- **Header**
  - Title: “Dashboard”
  - Breadcrumb: Dashboard → Overview

- **Stat cards / panels (4 tiles)**
  - Views
  - Users
  - Comments
  - Photos

- **Google API section**
  - Start with a simple panel that says “Not configured yet”.
  - Later: replace with a chart/map/widget powered by Google.

---

### Google API integration plan (choose one)

Pick ONE to keep scope tight:

- **Google Analytics Data API (recommended for “view” learning)**
  - Use it to show sessions/pageviews for a real website.
  - Requires OAuth/service account, property setup.

- **Google Maps JavaScript API**
  - Show a map (e.g. where photos were taken, or admin location).
  - Requires API key and billing.

Start with:

- A config placeholder (e.g. `GOOGLE_API_KEY`) and a “not configured” state.
- Do not hardcode secrets into the repo.

---

### Step-by-step implementation checklist

- **Step 1: Counting in OOP**
  - Add `Db_object::count_all()` and use `static::$db_table`.
  - Verify you can print:
    - `User::count_all()`
    - `Photo::count_all()`
    - `Comment::count_all()`

- **Step 2: Views table + View model**
  - Create the `views` table in MySQL.
  - Add `View` model with the correct table/fields.
  - Test: insert one view and verify `View::count_all()` increases.

- **Step 3: Dashboard aggregator**
  - Add `Dashboard` class (pure PHP class) that returns all stats in one call.
  - Keep `admin_content.php` mostly “dumb” (display-only).

- **Step 4: Admin dashboard UI**
  - Implement the stat tiles and Google API placeholder panel.

- **Step 5: Record views**
  - Add a call on `photo.php` to record views for the displayed photo.
  - Refresh the photo page a few times and confirm the dashboard updates.

---

### Test plan (manual)

- **Counts render**
  - Visit `admin/index.php` and confirm each count prints a number.

- **Views**
  - Before recording: `views_count` should stay 0.
  - After recording: refreshing a photo page increases the views count.

- **No fatal errors**
  - Ensure `init.php` loads any new classes you add.

---

### Clean OOP boundaries (guidelines)

- **Models**: talk to the DB and represent rows.
- **Dashboard**: coordinates multiple models and returns simple data structures.
- **Views/templates** (`admin_content.php`): only render the data, avoid SQL there.
