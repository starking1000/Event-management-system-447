<?php

/**
 * Event Management System
 * Main Entry Point
 */

// Start session
session_start();

// Define root paths
define('ROOT_PATH', dirname(__DIR__));
define('PUBLIC_PATH', __DIR__);
define('APP_PATH', ROOT_PATH . '/app');
define('CONFIG_PATH', ROOT_PATH . '/config');
define('INCLUDES_PATH', ROOT_PATH . '/includes');

// Include configuration and common files
require_once CONFIG_PATH . '/database.php';
require_once INCLUDES_PATH . '/functions.php';

// Simple routing - can be enhanced later
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

// Handle logout
if ($page === 'logout') {
    session_destroy();
    header("Location: ?page=home");
    exit();
}

switch ($page) {
    case 'home':
        include APP_PATH . '/Views/home.php';
        break;
    case 'login':
        include APP_PATH . '/Views/auth/login.php';
        break;
    case 'register':
        include APP_PATH . '/Views/auth/register.php';
        break;
    case 'events':
        include APP_PATH . '/Views/events/browse.php';
        break;
    case 'venues':
        include APP_PATH . '/Views/venues/book.php';
        break;
    case 'admin':
        include APP_PATH . '/Views/admin/panel.php';
        break;
    case 'create-event':
        include APP_PATH . '/Views/events/create.php';
        break;
    case 'create-venue':
        include APP_PATH . '/Views/venues/create.php';
        break;
    case 'rsvp':
        include APP_PATH . '/Views/events/rsvp.php';
        break;
    case 'rsvps':
        include APP_PATH . '/Views/events/rsvps.php';
        break;
    case 'admin-users':
        include APP_PATH . '/Views/admin/users.php';
        break;
    case 'admin-events':
        include APP_PATH . '/Views/admin/events.php';
        break;
    case 'admin-venues':
        include APP_PATH . '/Views/admin/venues.php';
        break;
    case 'admin-rsvps':
        include APP_PATH . '/Views/admin/rsvps.php';
        break;
    default:
        include APP_PATH . '/Views/home.php';
        break;
}
