# Piraeus Music Forum

A music community in Piraeus, Greece located just at the center of the meat market.

Piraeus Music Forum is a community-focused music platform based in Piraeus, the port of
Athens. It brings local musicians and listeners together to discover artists, share music, and
participate in the local music scene.

Artists can showcase their tracks for the community, while members can explore music
and learn through community-provided lessons. The forum gives people a place to share instrument
listings, announce gatherings, and organize open jams.

## What the project aims to offer

- **Artist track showcases:** A place for artists to share music with the Piraeus community and local broadcasters.
- **Community lessons:** Learning resources and lessons contributed by members of the music community.
- **Music forum:** Community posts for instruments, local gatherings, open jams, and related activities.
- **Community profiles:** Accounts and dashboards for participating artists and members.

## Built with

- Laravel 10
- PHP 8.1+
- Blade, Alpine.js, and Tailwind CSS

## Local development

Install PHP and JavaScript dependencies, configure the environment, and run migrations:

```powershell
composer install
Copy-Item .env.example .env
php artisan key:generate
php artisan migrate
npm install
npm run dev
```

In another terminal, start the Laravel development server:

```powershell
php artisan serve
```

Configure the database and other services in `.env` before running the application.

## License

This project uses the MIT license.
