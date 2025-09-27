-- Event Management System Database Schema
-- Created: 2025-09-27
-- Description: Complete database schema for the Event Management System

-- Drop existing tables if they exist (in correct order to handle foreign keys)
DROP TABLE IF EXISTS rsvps;

DROP TABLE IF EXISTS event_venues;

DROP TABLE IF EXISTS events;

DROP TABLE IF EXISTS venues;

DROP TABLE IF EXISTS users;

DROP TABLE IF EXISTS user_roles;

-- Create user roles table
CREATE TABLE user_roles (
    id INT PRIMARY KEY AUTO_INCREMENT,
    role_name VARCHAR(50) UNIQUE NOT NULL,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create users table
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    phone VARCHAR(20),
    role_id INT DEFAULT 2, -- Default to 'user' role
    is_active BOOLEAN DEFAULT TRUE,
    email_verified BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (role_id) REFERENCES user_roles (id),
    INDEX idx_email (email),
    INDEX idx_username (username)
);

-- Create venues table
CREATE TABLE venues (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    address TEXT NOT NULL,
    city VARCHAR(50) NOT NULL,
    state VARCHAR(50),
    zip_code VARCHAR(10),
    capacity INT NOT NULL,
    description TEXT,
    amenities TEXT, -- JSON or comma-separated list
    contact_person VARCHAR(100),
    contact_phone VARCHAR(20),
    contact_email VARCHAR(100),
    hourly_rate DECIMAL(10, 2),
    is_available BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_city (city),
    INDEX idx_capacity (capacity),
    INDEX idx_available (is_available)
);

-- Create events table
CREATE TABLE events (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(200) NOT NULL,
    description TEXT,
    event_date DATETIME NOT NULL,
    end_date DATETIME,
    venue_id INT,
    created_by INT NOT NULL,
    max_attendees INT DEFAULT NULL,
    registration_deadline DATETIME,
    event_type ENUM(
        'conference',
        'workshop',
        'seminar',
        'party',
        'meeting',
        'other'
    ) DEFAULT 'other',
    status ENUM(
        'draft',
        'published',
        'cancelled',
        'completed'
    ) DEFAULT 'draft',
    is_public BOOLEAN DEFAULT TRUE,
    registration_fee DECIMAL(10, 2) DEFAULT 0.00,
    requirements TEXT, -- Special requirements or notes
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (venue_id) REFERENCES venues (id) ON DELETE SET NULL,
    FOREIGN KEY (created_by) REFERENCES users (id) ON DELETE CASCADE,
    INDEX idx_event_date (event_date),
    INDEX idx_status (status),
    INDEX idx_type (event_type),
    INDEX idx_created_by (created_by)
);

-- Create RSVPs table
CREATE TABLE rsvps (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    event_id INT NOT NULL,
    status ENUM(
        'attending',
        'not_attending',
        'maybe',
        'cancelled'
    ) DEFAULT 'attending',
    guests_count INT DEFAULT 0,
    dietary_requirements TEXT,
    special_requests TEXT,
    registration_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE,
    FOREIGN KEY (event_id) REFERENCES events (id) ON DELETE CASCADE,
    UNIQUE KEY unique_rsvp (user_id, event_id),
    INDEX idx_status (status),
    INDEX idx_event_id (event_id),
    INDEX idx_user_id (user_id)
);

-- Create event_venues junction table (for events that might use multiple venues)
CREATE TABLE event_venues (
    id INT PRIMARY KEY AUTO_INCREMENT,
    event_id INT NOT NULL,
    venue_id INT NOT NULL,
    booking_start DATETIME NOT NULL,
    booking_end DATETIME NOT NULL,
    setup_time TIME,
    cleanup_time TIME,
    cost DECIMAL(10, 2),
    status ENUM(
        'booked',
        'confirmed',
        'cancelled'
    ) DEFAULT 'booked',
    notes TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (event_id) REFERENCES events (id) ON DELETE CASCADE,
    FOREIGN KEY (venue_id) REFERENCES venues (id) ON DELETE CASCADE,
    INDEX idx_event_venue (event_id, venue_id),
    INDEX idx_booking_dates (booking_start, booking_end)
);

-- Create admin settings table (for system configuration)
CREATE TABLE admin_settings (
    id INT PRIMARY KEY AUTO_INCREMENT,
    setting_key VARCHAR(100) UNIQUE NOT NULL,
    setting_value TEXT,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Create notifications table (for future email/SMS notifications)
CREATE TABLE notifications (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    event_id INT,
    type ENUM('email', 'sms', 'system') DEFAULT 'system',
    subject VARCHAR(200),
    message TEXT NOT NULL,
    status ENUM('pending', 'sent', 'failed') DEFAULT 'pending',
    sent_at TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE,
    FOREIGN KEY (event_id) REFERENCES events (id) ON DELETE SET NULL,
    INDEX idx_user_notifications (user_id, status),
    INDEX idx_status (status)
);

-- Insert default user roles
INSERT INTO
    user_roles (role_name, description)
VALUES (
        'admin',
        'System administrator with full access'
    ),
    (
        'user',
        'Regular user with standard permissions'
    ),
    (
        'organizer',
        'Event organizer with event management permissions'
    );

-- Insert default admin settings
INSERT INTO
    admin_settings (
        setting_key,
        setting_value,
        description
    )
VALUES (
        'site_name',
        'Event Management System',
        'Name of the application'
    ),
    (
        'admin_email',
        'admin@eventmanagement.local',
        'Administrator email address'
    ),
    (
        'max_events_per_user',
        '10',
        'Maximum events a user can create'
    ),
    (
        'default_rsvp_deadline_days',
        '7',
        'Default days before event for RSVP deadline'
    ),
    (
        'timezone',
        'America/New_York',
        'Default timezone for the application'
    );