# Laravel E-commerce Platform

## Overview
A robust e-commerce platform built with Laravel, featuring product management, shopping cart functionality, secure authentication, and an admin dashboard. This application provides a complete solution for online retail businesses.

## Features

### Customer Features
- User registration and authentication
- Product browsing and searching
- Detailed product views
- Shopping cart management
- Secure checkout process
- Order history and tracking

### Admin Features
- Product management (CRUD operations)
- Order management
- User management
- Dashboard analytics
- Inventory tracking

## Technical Requirements

### Prerequisites
- PHP >= 8.1
- Composer
- MySQL >= 5.7
- Node.js & NPM
- Laravel 10.x

### Server Requirements
- Apache or Nginx
- mod_rewrite enabled
- SSL certificate (recommended for production)

## Installation

1. Clone the repository
```bash
git clone [repository-url]
cd [project-name]
```

2. Install PHP dependencies
```bash
composer install
```

3. Install JavaScript dependencies
```bash
npm install
```

4. Create environment file
```bash
cp .env.example .env
```

5. Generate application key
```bash
php artisan key:generate
```

6. Configure database in `.env` file
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password
```

7. Run migrations and seeders
```bash
php artisan migrate --seed
```

8. Build assets
```bash
npm run dev
```

9. Start the development server
```bash
php artisan serve
```

## Project Structure

### Key Directories
- `app/Http/Controllers/` - Contains all controllers
- `app/Models/` - Contains all Eloquent models
- `database/migrations/` - Contains all database migrations
- `resources/views/` - Contains all Blade views
- `routes/web.php` - Contains all web routes
- `public/` - Contains all public assets

### Routes Overview
- `/` - Home page/Login redirect
- `/login` - User login
- `/register` - User registration
- `/home` - User dashboard
- `/products` - Product listing
- `/cart` - Shopping cart
- `/admin/*` - Admin routes

## Authentication

### User Roles
- **Guest**: Can view products
- **Customer**: Can purchase products
- **Admin**: Full access to admin dashboard

### Middleware
- `auth`: Authentication check
- `admin`: Admin role check

## Database Schema

### Main Tables
- `users`
- `products`
- `orders`
- `order_items`
- `cart_items`

## Security Measures
- CSRF protection
- SQL injection prevention
- XSS protection
- Authentication middleware
- Admin route protection

## Development Guidelines

### Coding Standards
- Follow PSR-12 coding standard
- Use Laravel best practices
- Maintain proper documentation
- Write unit tests for new features

### Git Workflow
1. Create feature branch
2. Develop feature
3. Write tests
4. Create pull request
5. Code review
6. Merge to main branch

## Testing
```bash
# Run all tests
php artisan test

# Run specific test suite
php artisan test --filter=ProductTest
```

## Deployment

### Production Checklist
1. Configure environment variables
2. Optimize autoloader
```bash
composer install --optimize-autoloader --no-dev
```
3. Optimize configuration
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```
4. Set up proper permissions
5. Configure web server
6. Set up SSL certificate
7. Configure database backups

## Maintenance

### Regular Tasks
- Database backups
- Log rotation
- Security updates
- Performance monitoring

### Troubleshooting
For common issues, check:
1. Storage permissions
2. Cache configuration
3. Log files
4. Database connections

## Support
For support and bug reports, please create an issue in the repository or contact the development team.

## License
[Your License] - Please see the LICENSE file for details

## Contributors
- Steve Ongera
- InnovationHub softwares Ltd

---

*Last updated: 2/9/2025*