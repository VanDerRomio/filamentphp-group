# README

## Development:

App comes with docker-compose configuration for development. It is recommended to use it, as it is configured to work
with all services needed for development.

### Backend - initial setup:

NOTICE: There are 2 .env files, one in main dir, second in `/app` dir. First one is for docker, second one is for app
itself, do not mix them up ;).

1. Clone repo.
2. Copy `.env.example` to `.env` and tweak docker configuration to match your environment.
3. Run `docker-compose up -d --build` to start and build containers.
4. Run `docker-compose run filament composer install` to install dependencies.
5. Copy `app/.env.example` to `app/.env` and tweak app configuration to match your environment and settings from
   docker `.env` file from step 2.
6. Run `docker-compose run --rm filament php artisan config:clear` to clear config cache after changes.
7. Run `docker-compose run --rm filament php artisan migrate --seed` to run migrations and seed database.
8. Run `docker-compose run --rm filament php artisan key:generate` to regenerate app unique key.
9. Your app and filament admin panel is ready to go. You can access it at `http://localhost:8081/admin`.

Default user credentials are created by database seeder.
- login `filament@gmail.pl`, password: `filament` For `admin` role