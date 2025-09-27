-- Event Management System Sample Data
-- Created: 2025-09-27
-- Description: Sample data for testing and development

-- Insert sample users (password is 'password123' hashed with password_hash())
INSERT INTO
    users (
        username,
        email,
        password,
        first_name,
        last_name,
        phone,
        role_id
    )
VALUES (
        'admin',
        'admin@eventmanagement.local',
        '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        'System',
        'Administrator',
        '+1-555-0101',
        1
    ),
    (
        'john_doe',
        'john.doe@example.com',
        '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        'John',
        'Doe',
        '+1-555-0102',
        2
    ),
    (
        'jane_smith',
        'jane.smith@example.com',
        '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        'Jane',
        'Smith',
        '+1-555-0103',
        3
    ),
    (
        'mike_johnson',
        'mike.johnson@example.com',
        '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        'Mike',
        'Johnson',
        '+1-555-0104',
        2
    ),
    (
        'sarah_williams',
        'sarah.williams@example.com',
        '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        'Sarah',
        'Williams',
        '+1-555-0105',
        2
    ),
    (
        'event_organizer',
        'organizer@example.com',
        '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        'Event',
        'Organizer',
        '+1-555-0106',
        3
    );

-- Insert sample venues
INSERT INTO
    venues (
        name,
        address,
        city,
        state,
        zip_code,
        capacity,
        description,
        amenities,
        contact_person,
        contact_phone,
        contact_email,
        hourly_rate
    )
VALUES (
        'Grand Conference Hall',
        '123 Main Street',
        'New York',
        'NY',
        '10001',
        500,
        'Large conference hall with state-of-the-art AV equipment',
        'Projector, Sound System, Wi-Fi, Catering Kitchen, Parking',
        'Alice Manager',
        '+1-555-1001',
        'alice@grandconference.com',
        150.00
    ),
    (
        'Tech Innovation Center',
        '456 Silicon Valley',
        'San Francisco',
        'CA',
        '94105',
        200,
        'Modern tech venue perfect for workshops and seminars',
        'High-speed Internet, Whiteboards, Laptops, Coffee Station',
        'Bob Tech',
        '+1-555-1002',
        'bob@techinnovation.com',
        200.00
    ),
    (
        'Community Center',
        '789 Oak Avenue',
        'Chicago',
        'IL',
        '60601',
        150,
        'Cozy community space for local events and meetings',
        'Kitchen, Tables, Chairs, Basic AV, Parking',
        'Carol Community',
        '+1-555-1003',
        'carol@communitycenter.com',
        75.00
    ),
    (
        'Executive Boardroom',
        '101 Business Plaza',
        'Boston',
        'MA',
        '02101',
        20,
        'Professional boardroom for corporate meetings',
        'Conference Phone, Video Conferencing, Whiteboard, Coffee Service',
        'David Executive',
        '+1-555-1004',
        'david@execboardroom.com',
        100.00
    ),
    (
        'Garden Pavilion',
        '555 Park Lane',
        'Miami',
        'FL',
        '33101',
        300,
        'Beautiful outdoor pavilion perfect for parties and celebrations',
        'Outdoor Seating, Garden Views, Catering Area, Dance Floor',
        'Eva Garden',
        '+1-555-1005',
        'eva@gardenpavilion.com',
        120.00
    );

-- Insert sample events
INSERT INTO
    events (
        title,
        description,
        event_date,
        end_date,
        venue_id,
        created_by,
        max_attendees,
        event_type,
        status,
        registration_fee
    )
VALUES (
        'Annual Tech Conference 2025',
        'Join us for the biggest tech conference of the year featuring keynotes, workshops, and networking opportunities.',
        '2025-12-15 09:00:00',
        '2025-12-15 18:00:00',
        1,
        3,
        400,
        'conference',
        'published',
        99.99
    ),
    (
        'PHP Development Workshop',
        'Hands-on workshop covering modern PHP development practices, frameworks, and best practices.',
        '2025-11-20 10:00:00',
        '2025-11-20 16:00:00',
        2,
        3,
        150,
        'workshop',
        'published',
        49.99
    ),
    (
        'Community Meetup',
        'Monthly community meetup for local developers and tech enthusiasts. Free pizza and networking!',
        '2025-10-25 18:00:00',
        '2025-10-25 21:00:00',
        3,
        6,
        100,
        'meeting',
        'published',
        0.00
    ),
    (
        'Corporate Strategy Meeting',
        'Quarterly strategy meeting for department heads and senior management.',
        '2025-11-05 14:00:00',
        '2025-11-05 17:00:00',
        4,
        1,
        15,
        'meeting',
        'published',
        0.00
    ),
    (
        'Holiday Celebration',
        'End-of-year holiday party for all employees and their families. Food, music, and fun activities!',
        '2025-12-20 17:00:00',
        '2025-12-20 22:00:00',
        5,
        1,
        250,
        'party',
        'published',
        25.00
    ),
    (
        'Beginner Web Design Seminar',
        'Learn the basics of web design including HTML, CSS, and responsive design principles.',
        '2025-11-10 13:00:00',
        '2025-11-10 17:00:00',
        2,
        3,
        80,
        'seminar',
        'draft',
        29.99
    );

-- Insert sample RSVPs
INSERT INTO
    rsvps (
        user_id,
        event_id,
        status,
        guests_count,
        dietary_requirements
    )
VALUES (
        2,
        1,
        'attending',
        1,
        'Vegetarian'
    ),
    (2, 2, 'attending', 0, NULL),
    (2, 3, 'maybe', 0, NULL),
    (
        4,
        1,
        'attending',
        2,
        'No allergies'
    ),
    (4, 3, 'attending', 0, NULL),
    (
        4,
        5,
        'attending',
        3,
        'Gluten-free'
    ),
    (
        5,
        1,
        'not_attending',
        0,
        NULL
    ),
    (5, 2, 'attending', 0, 'Vegan'),
    (5, 3, 'attending', 1, NULL),
    (6, 1, 'attending', 0, NULL),
    (6, 2, 'attending', 0, NULL),
    (6, 4, 'attending', 0, NULL);

-- Insert sample event venue bookings
INSERT INTO
    event_venues (
        event_id,
        venue_id,
        booking_start,
        booking_end,
        setup_time,
        cleanup_time,
        cost,
        status
    )
VALUES (
        1,
        1,
        '2025-12-15 08:00:00',
        '2025-12-15 19:00:00',
        '01:00:00',
        '01:00:00',
        1650.00,
        'confirmed'
    ),
    (
        2,
        2,
        '2025-11-20 09:00:00',
        '2025-11-20 17:00:00',
        '01:00:00',
        '01:00:00',
        1600.00,
        'confirmed'
    ),
    (
        3,
        3,
        '2025-10-25 17:00:00',
        '2025-10-25 22:00:00',
        '01:00:00',
        '01:00:00',
        375.00,
        'booked'
    ),
    (
        4,
        4,
        '2025-11-05 13:00:00',
        '2025-11-05 18:00:00',
        '01:00:00',
        '01:00:00',
        500.00,
        'confirmed'
    ),
    (
        5,
        5,
        '2025-12-20 16:00:00',
        '2025-12-20 23:00:00',
        '01:00:00',
        '01:00:00',
        840.00,
        'booked'
    );

-- Insert sample notifications
INSERT INTO
    notifications (
        user_id,
        event_id,
        type,
        subject,
        message,
        status
    )
VALUES (
        2,
        1,
        'email',
        'Event Confirmation - Annual Tech Conference 2025',
        'Thank you for registering for the Annual Tech Conference 2025. We look forward to seeing you there!',
        'sent'
    ),
    (
        2,
        2,
        'email',
        'Workshop Reminder - PHP Development Workshop',
        'This is a reminder that your PHP Development Workshop is scheduled for tomorrow at 10:00 AM.',
        'pending'
    ),
    (
        4,
        1,
        'email',
        'Event Confirmation - Annual Tech Conference 2025',
        'Thank you for registering for the Annual Tech Conference 2025. We look forward to seeing you there!',
        'sent'
    ),
    (
        5,
        2,
        'email',
        'Event Confirmation - PHP Development Workshop',
        'Thank you for registering for the PHP Development Workshop. Please bring a laptop for hands-on activities.',
        'sent'
    );