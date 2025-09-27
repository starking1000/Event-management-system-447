# Event Management System - Database Setup

This directory contains all database-related files for easy management and deployment.

## 📁 Directory Structure

```
database/
├── schema.sql              # Complete database schema
├── seeds/
│   └── sample_data.sql     # Sample data for testing
├── migrations/             # Future database migrations
├── setup.sh               # Automated setup script
└── README.md              # This file
```

## 🚀 Quick Setup

### Option 1: Automated Setup (Recommended)

Run the automated setup script:

```bash
cd database/
./setup.sh
```

This will:

- Check MySQL service status
- Prompt for database credentials
- Create the database
- Apply the schema
- Optionally load sample data

### Option 2: Manual Setup

1. **Create the database:**

   ```sql
   mysql -u root -p
   CREATE DATABASE eventmanagement;
   EXIT;
   ```

2. **Apply the schema:**

   ```bash
   mysql -u root -p eventmanagement < schema.sql
   ```

3. **Load sample data (optional):**
   ```bash
   mysql -u root -p eventmanagement < seeds/sample_data.sql
   ```

## 📊 Database Schema Overview

### Core Tables

- **`users`** - User accounts and authentication
- **`user_roles`** - Role-based access control
- **`venues`** - Event venues and locations
- **`events`** - Event information and details
- **`rsvps`** - Event registrations and responses
- **`event_venues`** - Junction table for event-venue bookings

### Supporting Tables

- **`admin_settings`** - System configuration
- **`notifications`** - Email/SMS notifications (future feature)

## 🔑 Sample User Accounts

After loading sample data, you can use these test accounts:

| Username          | Email                       | Role          | Password      |
| ----------------- | --------------------------- | ------------- | ------------- |
| `admin`           | admin@eventmanagement.local | Administrator | `password123` |
| `john_doe`        | john.doe@example.com        | User          | `password123` |
| `jane_smith`      | jane.smith@example.com      | Organizer     | `password123` |
| `event_organizer` | organizer@example.com       | Organizer     | `password123` |

## 🏢 Sample Venues

The sample data includes 5 different venue types:

1. **Grand Conference Hall** - Large events (500 capacity)
2. **Tech Innovation Center** - Workshops (200 capacity)
3. **Community Center** - Local meetings (150 capacity)
4. **Executive Boardroom** - Corporate meetings (20 capacity)
5. **Garden Pavilion** - Outdoor events (300 capacity)

## 📅 Sample Events

Sample events include:

- Annual Tech Conference 2025
- PHP Development Workshop
- Community Meetup
- Corporate Strategy Meeting
- Holiday Celebration

## 🛠 Setup Script Options

```bash
# Full setup with prompts
./setup.sh

# Schema only (no sample data)
./setup.sh schema-only

# Sample data only (assumes schema exists)
./setup.sh seeds-only

# Show help
./setup.sh help
```

## 🔧 Environment Configuration

After database setup, update your `.env` file:

```env
DB_HOST=localhost
DB_USERNAME=your_username
DB_PASSWORD=your_password
DB_DATABASE=eventmanagement
```

## 🔒 Security Notes

- Sample passwords are hashed using PHP's `password_hash()`
- Change default passwords in production
- Use strong database credentials
- Consider creating a dedicated database user with limited privileges

## 📝 Database Maintenance

### Backup Database

```bash
mysqldump -u username -p eventmanagement > backup.sql
```

### Restore Database

```bash
mysql -u username -p eventmanagement < backup.sql
```

### Reset Database

```bash
# This will drop all tables and recreate them
./setup.sh schema-only
```

## 🚀 Production Deployment

For production environments:

1. **Remove sample data** - Don't run the seeds file
2. **Create dedicated database user:**
   ```sql
   CREATE USER 'eventapp'@'localhost' IDENTIFIED BY 'secure_password';
   GRANT SELECT, INSERT, UPDATE, DELETE ON eventmanagement.* TO 'eventapp'@'localhost';
   FLUSH PRIVILEGES;
   ```
3. **Update connection parameters** in your `.env` file
4. **Enable SSL** for database connections if possible

## 📋 Troubleshooting

### Common Issues

1. **"Access denied" error:**

   - Check MySQL username/password
   - Ensure MySQL service is running: `sudo systemctl start mysql`

2. **"Database doesn't exist" error:**

   - Make sure you created the database first
   - Check database name spelling

3. **"Table already exists" error:**
   - The schema will drop existing tables automatically
   - If issues persist, manually drop tables and re-run

### Logs and Debugging

Check MySQL error logs:

```bash
sudo tail -f /var/log/mysql/error.log
```

## 🔄 Future Enhancements

- Database migrations system
- Automated backup scripts
- Performance optimization scripts
- Data seeding for different environments (dev/staging/prod)
