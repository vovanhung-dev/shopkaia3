# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

ShopKaia3 is a Vietnamese e-commerce platform specializing in gaming services, particularly for "Liên Quân" (Arena of Valor). The application handles gaming account sales, boosting services, and top-up services with integrated payment systems.

## Technology Stack

- **Backend**: Laravel 10.x (PHP 8.1+)
- **Frontend**: Blade templates with TailwindCSS 3.4+ and Vite
- **Database**: MySQL
- **Authentication**: Laravel Sanctum
- **Payment**: SePay (bank transfers) and TheSieuRe (prepaid cards)

## Common Commands

### Development
```bash
# Setup
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed

# Development server
php artisan serve
npm run dev

# Asset building
npm run build        # Production build
npm run dev         # Development build with hot reload

# Database operations
php artisan migrate --seed
php artisan migrate:rollback
php artisan db:seed --class=AdminSeeder

# Cache and optimization
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan cache:clear

# Custom commands
php artisan accounts:release-expired  # Release expired account reservations
```

### Testing
```bash
php artisan test
php artisan test --filter=specific_test
vendor/bin/phpunit
```

## Architecture & Key Concepts

### Core Business Models
- **Account**: Gaming accounts with 15-minute reservation system
- **User**: Role-based access (admin/customer)
- **Order**: Transaction management with status tracking
- **Wallet**: Internal digital wallet system
- **Game/GameService**: Multi-service architecture (accounts, boosting, top-ups)

### Payment Integration
- **SePay**: Vietnamese bank transfers with webhook at `/api/sepay/webhook`
- **TheSieuRe**: Prepaid cards with webhook at `/api/webhook/thesieure`
- Internal wallet system for transactions

### Route Structure
- **Public**: Home, games, account browsing (`routes/web.php:1-139`)
- **Authenticated**: Orders, payments, services (`routes/web.php:32-139`)
- **Admin**: Full CRUD operations (`routes/web.php:140-222`)

### Key Directories
- `app/Http/Controllers/Admin/`: Admin panel controllers (10 files)
- `app/Models/`: Business entities (20 models)
- `app/Services/`: Business logic services
- `database/migrations/`: 49 migration files
- `resources/views/`: 97 Blade templates

### Custom Middleware
- `AdminMiddleware`: Role-based access control for admin routes

### Configuration Files
- `config/sepay.php`: SePay payment gateway settings
- `config/payment.php`: General payment configuration
- `tailwind.config.js`: UI styling with custom components

## Database Architecture

### Key Relationships
- Users have Wallets and Orders
- Accounts belong to Games and AccountCategories
- Orders contain multiple service types (accounts, boosting, top-ups)
- Transactions track all financial operations

### Account Reservation System
Accounts have a built-in 15-minute reservation system managed through:
- `reserved_at` timestamp
- `reserved_by` user reference
- Automatic cleanup via custom artisan command

## Development Patterns

### Service Layer
Business logic is encapsulated in service classes under `app/Services/`

### Event-Driven Architecture
- Events: `app/Events/` (payment completion, order updates)
- Listeners: `app/Listeners/` (automated responses to business events)

### API Design
RESTful APIs for webhooks and internal operations, following Laravel resource conventions

### Frontend Components
- TailwindCSS for responsive design
- Blade components for reusable UI elements
- Vite for modern asset compilation
- Swiper.js for product carousels

## Environment Configuration

- Timezone: `Asia/Ho_Chi_Minh`
- Database: MySQL with utf8mb4 collation
- Queue driver configured for background jobs
- File storage for account images and documents