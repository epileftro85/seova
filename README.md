# Seova Deployment Guide

Seova is a data-driven virtual assistant for SEO implementation. Use this checklist to publish the production site with confidence. Each item is designed to be verifiable on the target environment.

## Prerequisites

- PHP 8.2+
- Composer 2.x
- Node.js 18+ and npm
- MySQL 8 / MariaDB 10.6+ (or another supported database)
- Redis (optional, recommended for queues/cache)
- Mailgun account with a verified sending domain
- Web server configured to serve the `public/` directory (Nginx, Apache, etc.)

## Publish Checklist

### Repository & Dependencies
- [ ] Clone the repository: `git clone git@github.com:epileftro85/seova.git`
- [ ] Install PHP dependencies: `composer install --no-dev --optimize-autoloader`
- [ ] Install frontend dependencies: `npm ci`

### Environment Configuration
- [ ] Copy `.env.example` to `.env`
- [ ] Set `APP_ENV=production`
- [ ] Set `APP_URL=https://your-domain.com`
- [ ] Set `APP_DEBUG=false`
- [ ] Set `APP_LOCALE` and `APP_FALLBACK_LOCALE` if localization differs
- [ ] Generate application key (run once per environment): `php artisan key:generate`
- [ ] Confirm timezone and logging values match infrastructure requirements

### Database & Cache
- [ ] Create a production database and user with required privileges
- [ ] Update `.env` with `DB_CONNECTION`, `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`
- [ ] Configure `CACHE_STORE`/`SESSION_DRIVER`/`QUEUE_CONNECTION` (Redis recommended)
- [ ] Run migrations: `php artisan migrate --force`
- [ ] (Optional) Seed demo data if needed: `php artisan db:seed --force`

### Mailgun & Email Delivery
- [ ] Create or select a verified Mailgun domain
- [ ] Add DNS records so Mailgun verifies sending and tracking
- [ ] Generate Mailgun API credentials
- [ ] Update `.env` with:
  - `MAIL_MAILER=mailgun`
  - `MAILGUN_DOMAIN=your.mailgun.domain`
  - `MAILGUN_SECRET=mailgun_api_key`
  - `MAILGUN_ENDPOINT=api.mailgun.net`
- [ ] Set `MAIL_FROM_ADDRESS=hello@seova.pro` (or your support inbox)
- [ ] Set `MAIL_FROM_NAME="Seova"`
- [ ] Verify a test email using `php artisan tinker` or by submitting the quote form

### Application Branding & Legal Links
- [ ] Confirm `config('mail.from.address')` resolves to the production sender
- [ ] Ensure footer links to `/privacy-policy` and `/terms-of-service` load successfully
- [ ] Review `resources/views/privacy-policy.blade.php` and `resources/views/terms-of-service.blade.php` for jurisdiction-specific updates

### Assets & Build
- [ ] Build production assets: `npm run build`
- [ ] Publish storage symlink if needed: `php artisan storage:link`
- [ ] Cache configuration and routes:
  - `php artisan config:cache`
  - `php artisan route:cache`
  - `php artisan view:cache`

### Queue & Scheduler
- [ ] Start a queue worker (supervisor/systemd): `php artisan queue:work --sleep=3 --tries=1`
- [ ] Add a cron to run every minute: `* * * * * php /path/to/project/artisan schedule:run >> /dev/null 2>&1`

### Verification
- [ ] Hit the homepage and confirm hero/services sections render correctly
- [ ] Submit the quote form and confirm Mailgun delivers the notification
- [ ] Check browser console/network for JS/CSS build errors
- [ ] Verify analytics and Google Ads tags (if configured) fire as expected
- [ ] Enable monitoring/alerts (uptime, logs, queue failures)

## Useful Commands

```bash
# Clear caches safely
php artisan optimize:clear

# Run automated tests before deploying
php artisan test

# Tail log channel (requires Laravel Pail)
php artisan pail --timeout=0
```

Keep this checklist in sync with changes to infrastructure, legal requirements, or third-party integrations. Document deviations directly in the `.env` or infrastructure-as-code repository.
