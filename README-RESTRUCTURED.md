# Event Management System - Restructured

A comprehensive web-based event management system for organizing and managing events, venues, and reservations.

## 📁 New Project Structure

The project has been re---

## 🧹 **Cleanup Complete!**

All legacy files and directories have been removed. The project now contains only the new, organized structure:

### **Removed Legacy Items:**

- ❌ Old PHP files from root directory (`login.php`, `register.php`, `BookVenue.php`, etc.)
- ❌ Old asset directories (`css/`, `js/`, `img/`, `logos/`)
- ❌ Legacy forms and table directories (`Forms/`, `Tables/`, `Database/`)
- ❌ Scattered image files from root directory

### **Current Clean Structure:**

- ✅ `public/` - Web-accessible files only
- ✅ `app/Views/` - Organized view templates
- ✅ `config/` - Configuration files
- ✅ `includes/` - Shared utilities
- ✅ `storage/` - Ready for file uploads

---

**Migration & Cleanup Complete!** 🎉

The Event Management System has been successfully restructured and cleaned up following modern PHP development practices while maintaining all existing functionality. The codebase is now production-ready and maintainable.tured to follow modern PHP development practices:

```
event-management-system/
├── public/                    # Public web root (Document root should point here)
│   ├── index.php             # Main entry point with routing
│   ├── .htaccess             # URL rewriting rules
│   └── assets/               # Static assets
│       ├── css/              # Stylesheets
│       ├── js/               # JavaScript files
│       ├── images/           # Images
│       └── logos/            # Logo files
├── app/                      # Application logic
│   ├── Controllers/          # Request handlers (future expansion)
│   ├── Models/              # Data models (future expansion)
│   ├── Views/               # View templates
│   │   ├── layouts/         # Common layouts (main.php)
│   │   ├── auth/            # Authentication views (login, register)
│   │   ├── events/          # Event-related views
│   │   ├── venues/          # Venue-related views
│   │   └── admin/           # Admin panel views
│   └── Services/            # Business logic (future expansion)
├── config/                  # Configuration files
│   └── database.php        # Database configuration
├── includes/                # Common includes and utilities
│   ├── functions.php       # Helper functions
│   └── auth.php           # Authentication helpers
├── storage/                 # File uploads, logs (future)
├── .htaccess               # Root htaccess for public directory redirect
└── README-RESTRUCTURED.md  # This documentation
```

## 🚀 Key Improvements

### 1. **Proper Separation of Concerns**

- **Public Directory**: All web-accessible files are in `/public/`
- **Application Logic**: Business logic separated into `/app/` directory
- **Configuration**: Centralized in `/config/` directory
- **Assets**: Organized in `/public/assets/` with subdirectories

### 2. **Security Enhancements**

- Sensitive directories (`app/`, `config/`, `includes/`) are not web-accessible
- Database credentials and configuration isolated
- Input sanitization and validation improved

### 3. **Clean URL Structure**

The application now uses clean URLs via a simple routing system:

- `?page=home` - Homepage
- `?page=login` - Login page
- `?page=register` - Registration page
- `?page=events` - Browse events
- `?page=venues` - Browse/book venues
- `?page=admin` - Admin panel
- `?page=logout` - Logout

### 4. **Template System**

- Common layout in `/app/Views/layouts/main.php`
- No code duplication for headers, navigation, and footers
- Easy to maintain and update site-wide elements

### 5. **Organized Views**

- Authentication views: `app/Views/auth/`
- Event management: `app/Views/events/`
- Venue management: `app/Views/venues/`
- Admin functions: `app/Views/admin/`

## 🔧 Setup Instructions

### 1. **Database Setup (Quick Start)**

The easiest way to set up the database is using the automated script:

```bash
cd database/
./setup.sh
```

This will:

- Check MySQL service status
- Create the `eventmanagement` database
- Apply the complete schema
- Optionally load sample data for testing

#### Manual Database Setup

If you prefer manual setup:

```bash
# 1. Create database
mysql -u root -p -e "CREATE DATABASE eventmanagement;"

# 2. Apply schema
mysql -u root -p eventmanagement < database/schema.sql

# 3. Load sample data (optional)
mysql -u root -p eventmanagement < database/seeds/sample_data.sql
```

### 2. **Environment Configuration**

Copy and configure the environment file:

```bash
cp .env.example .env
```

Update `.env` with your database credentials:

```env
DB_HOST=localhost
DB_USERNAME=your_db_username
DB_PASSWORD=your_db_password
DB_DATABASE=eventmanagement
```

### 3. **Web Server Configuration**

#### Apache

Set your document root to the `public/` directory:

```apache
DocumentRoot /path/to/event-management-system/public
```

Or use the included `.htaccess` files for automatic redirection.

#### Nginx

```nginx
server {
    root /path/to/event-management-system/public;
    index index.php;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass php-fpm;
        include fastcgi_params;
    }
}
```

#### PHP Development Server (Quick Testing)

For quick local testing:

```bash
cd public/
php -S localhost:8000
```

### 4. **File Permissions**

Ensure proper permissions:

```bash
chmod 755 public/
chmod 644 public/assets/css/*
chmod 644 public/assets/js/*
chmod 755 storage/ (if using file uploads)
chmod +x database/setup.sh
```

## 📋 Available Routes

| URL                  | Description        | View File                     |
| -------------------- | ------------------ | ----------------------------- |
| `?page=home`         | Homepage           | `app/Views/home.php`          |
| `?page=login`        | User login         | `app/Views/auth/login.php`    |
| `?page=register`     | User registration  | `app/Views/auth/register.php` |
| `?page=events`       | Browse events      | `app/Views/events/browse.php` |
| `?page=venues`       | Browse/book venues | `app/Views/venues/book.php`   |
| `?page=create-event` | Create new event   | `app/Views/events/create.php` |
| `?page=rsvp`         | RSVP to event      | `app/Views/events/rsvp.php`   |
| `?page=admin`        | Admin panel        | `app/Views/admin/panel.php`   |
| `?page=admin-users`  | View all users     | `app/Views/admin/users.php`   |
| `?page=admin-rsvps`  | View all RSVPs     | `app/Views/admin/rsvps.php`   |
| `?page=logout`       | Logout             | Handled in `public/index.php` |

## 🛠 Features Implemented

### ✅ **Completed**

- Modern project structure with proper separation of concerns
- Centralized routing system
- Template system with common layout
- User authentication (login/register)
- Event browsing and creation
- Venue browsing and booking
- RSVP system
- Admin panel with user and RSVP management
- Responsive design maintained
- Security improvements

### 🔄 **Ready for Enhancement**

- MVC pattern implementation in Controllers/Models directories
- Database abstraction layer
- Form validation classes
- File upload handling
- Email notifications
- Advanced admin features
- API endpoints
- User roles and permissions

## 🔒 Security Features

1. **Directory Protection**: Sensitive directories are not web-accessible
2. **Input Sanitization**: All user inputs are sanitized using mysqli_real_escape_string
3. **Session Management**: Proper session handling for authentication
4. **XSS Protection**: HTML output is escaped using htmlspecialchars
5. **SQL Injection Prevention**: Parameterized queries ready for implementation

## 📱 Mobile Responsive

The restructured application maintains full mobile responsiveness:

- Responsive navigation with mobile hamburger menu
- Flexible grid layouts
- Mobile-optimized forms
- Touch-friendly interface elements

## 🚀 Future Enhancements

The new structure makes it easy to implement:

- **Composer Integration**: For dependency management
- **Environment Configuration**: Different settings for dev/staging/production
- **Database Migrations**: Structured database versioning
- **Unit Testing**: PHPUnit integration
- **Caching Layer**: Redis or Memcached integration
- **API Development**: RESTful API endpoints
- **Modern Frontend**: React/Vue.js integration

## 📞 Support

For questions about the restructured codebase:

1. Check this documentation first
2. Review the code comments in key files

---

The Event Management System has been successfully restructured following modern PHP development practices while maintaining all existing functionality.
