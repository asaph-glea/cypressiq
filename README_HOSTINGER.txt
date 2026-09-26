========================================================================
CYPRESSIQ — HOSTINGER PRODUCTION DEPLOYMENT GUIDE
========================================================================

Congratulations! This archive contains the complete, production-ready
CypressIQ platform with all dependencies pre-installed.

------------------------------------------------------------------------
STEP 1: UPLOAD & EXTRACT IN HOSTINGER
------------------------------------------------------------------------
1. Log into your Hostinger control panel (hPanel).
2. Go to "Files" -> "File Manager".
3. Upload this ZIP file to your website directory (e.g. public_html).
4. Right-click the uploaded ZIP and click "Extract".

------------------------------------------------------------------------
STEP 2: CREATE A MYSQL DATABASE IN HOSTINGER
------------------------------------------------------------------------
1. In hPanel, go to "Databases" -> "Management" -> "MySQL Databases".
2. Create a new database and user. Note down:
   - Database Name (e.g., u123456789_cypressiq)
   - Username (e.g., u123456789_admin)
   - Password (e.g., YourStrongPassword123!)
3. (Optional) If you prefer importing the pre-seeded database directly:
   - Click "Enter phpMyAdmin" next to your database.
   - Click "Import".
   - Select the file: database/cypressiq_database.sql
   - Click "Go". (All projects, testimonials, partnerships & admin are now ready!)

------------------------------------------------------------------------
STEP 3: CONFIGURE YOUR .ENV FILE
------------------------------------------------------------------------
1. In the File Manager root of the project, find ".env.example".
2. Rename or copy it to ".env".
3. Edit ".env" with your details:

   APP_NAME="CypressIQ"
   APP_ENV=production
   APP_DEBUG=false
   APP_URL=https://yourdomain.com

   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=u123456789_cypressiq
   DB_USERNAME=u123456789_admin
   DB_PASSWORD=YourStrongPassword123!

   FILESYSTEM_DISK=public
   SESSION_DRIVER=database

   ADMIN_EMAIL=admin@cypressiq.agency
   ADMIN_PASSWORD=YourChosenAdminPassword

   # Mail (Hostinger Titan Mail / SMTP):
   MAIL_MAILER=smtp
   MAIL_HOST=smtp.titan.email
   MAIL_PORT=465
   MAIL_USERNAME=hello@yourdomain.com
   MAIL_PASSWORD=YourEmailPassword
   MAIL_ENCRYPTION=ssl
   MAIL_FROM_ADDRESS="hello@yourdomain.com"
   MAIL_FROM_NAME="CypressIQ"

------------------------------------------------------------------------
STEP 4: COMPLETE FINAL SETUP (CHOOSE ONE OPTION)
------------------------------------------------------------------------

OPTION A: VIA BROWSER (NO SSH NEEDED - SIMPLEST!)
   Open your browser and visit:
   https://yourdomain.com/hostinger-setup.php?key=cypressiq2026&seed=1
   
   This script will automatically:
   - Run database migrations (--force)
   - Seed accounts & trust data (--force)
   - Link public/storage
   - Build production route, config, and view caches
   
   *IMPORTANT: Once the script finishes, delete public/hostinger-setup.php for security.

OPTION B: VIA HOSTINGER SSH / TERMINAL
   Open Terminal in Hostinger hPanel and run:
   composer install --no-dev --optimize-autoloader
   php artisan migrate --force
   php artisan db:seed --force
   php artisan storage:link
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache

------------------------------------------------------------------------
DEPARTMENTAL ACCESS CREDENTIALS (READY TO USE)
------------------------------------------------------------------------
URL: https://yourdomain.com/admin/login

1. Super Admin (Founders / Master Governance & Audit):
   Email: admin@cypressiq.agency
   Password: admin1234

2. Growth & Marketing (Sales + Content + SEO):
   Email: growth@cypressiq.agency
   Password: admin1234

3. Product & Engineering (OPERO + ITIKIA + Product Videos):
   Email: engineer@cypressiq.agency
   Password: admin1234

========================================================================
