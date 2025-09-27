<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? $pageTitle . ' - ' : ''; ?>Event Management System</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="icon" href="https://cdn4.iconfinder.com/data/icons/new-year-filled-1/48/events___occasion_event_fireworks_stars_shooting_new_year_new_years-512.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Benne&display=swap" rel="stylesheet">
    <?php if (isset($additionalCSS)) echo $additionalCSS; ?>
</head>

<body>
    <!-- Header Section -->
    <section class="HeaderLogoCon">
        <div class="starter">
            <div class="LogoIconContainer">
                <img src="https://cdn4.iconfinder.com/data/icons/new-year-filled-1/48/events___occasion_event_fireworks_stars_shooting_new_year_new_years-512.png" alt="Event Management Logo">
            </div>
            <div class="Contact-Info">
                <div class="Contact-section">
                    <h5>Call us 24/7</h5>
                    <p>+255745365345</p>
                    <p>+255745345365</p>
                    <p>+255745365345</p>
                </div>
                <div class="Contact-section">
                    <h5>Operational Hours</h5>
                    <p>Mon-Fri 9am-5pm</p>
                    <p>Sat 9am - 12pm</p>

                    <?php if (!isset($_SESSION['username']) || empty($_SESSION['username'])): ?>
                        <a href="?page=login">
                            <button style="width:150px;height:50px;border:none;background-color: navy;color:#fff;font-weight: bold;cursor:pointer;">
                                Sign in
                            </button>
                        </a>
                    <?php else: ?>
                        <div style="color: navy; font-weight: bold; margin-bottom: 10px;">
                            Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>
                        </div>
                        <a href="?page=logout">
                            <button style="width:150px;height:50px;border:none;background-color: #dc3545;color:#fff;font-weight: bold;cursor:pointer;">
                                Logout
                            </button>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Navigation Section -->
    <section class="HeaderContainer">
        <div class="header-container">
            <a href="?page=home"><button class="<?php echo ($page === 'home') ? 'active' : ''; ?>">Home</button></a>
            <a href="?page=venues"><button class="<?php echo ($page === 'venues') ? 'active' : ''; ?>">Book a venue</button></a>
            <a href="?page=events"><button class="<?php echo ($page === 'events') ? 'active' : ''; ?>">Browse Events</button></a>
            <a href="?page=create-event"><button class="<?php echo ($page === 'create-event') ? 'active' : ''; ?>">Create Event</button></a>
            <a href="?page=rsvps"><button class="<?php echo ($page === 'rsvps') ? 'active' : ''; ?>">View RSVP's</button></a>
            <a href="?page=admin"><button class="<?php echo ($page === 'admin') ? 'active' : ''; ?>">Admin Panel</button></a>
        </div>
        <div class="header-container-sub">
            <button id="more">
                <img src="assets/images/burgerbtn.png" alt="Menu" id="more-btn" style="width:100px; height:50px;">
            </button>
            <a href="?page=home"><button class="<?php echo ($page === 'home') ? 'active' : ''; ?>">Home</button></a>
            <a href="?page=venues"><button class="<?php echo ($page === 'venues') ? 'active' : ''; ?>">Book a venue</button></a>
            <a href="?page=events"><button class="<?php echo ($page === 'events') ? 'active' : ''; ?>">Browse Events</button></a>
            <a href="?page=create-event"><button class="<?php echo ($page === 'create-event') ? 'active' : ''; ?>">Create Event</button></a>
            <a href="?page=rsvps"><button class="<?php echo ($page === 'rsvps') ? 'active' : ''; ?>">View RSVP's</button></a>
            <a href="?page=admin"><button class="<?php echo ($page === 'admin') ? 'active' : ''; ?>">Admin Panel</button></a>
        </div>
    </section>

    <!-- Main Content -->
    <main>
        <?php echo $content; ?>
    </main>

    <!-- Footer Section -->
    <section class="FooterContainer">
        <div class="footer-home">
            <div class="footer-main">
                <div class="footer-main-sub">
                    <h3>Contact Us</h3>
                    <p style="color:black">Email: <a href="mailto:customercare@EventsIo.com">customercare@EventsIo.com</a></p>
                    <p style="color:black">Phone: <a href="tel:+255745365345">+255745365345</a></p>
                    <p style="color:black">Address: <a href="#">605, Nyambadwe</a></p>
                    <p style="color:black">Emergency Number: <a href="tel:+255745365345">+255745365345</a></p>
                </div>
                <div class="footer-main-sub">
                    <h3>Our Services</h3>
                    <p><a href="?page=events">Event Planning</a></p>
                    <p><a href="?page=venues">Venue Booking</a></p>
                    <p><a href="?page=rsvps">Event Reservations</a></p>
                </div>
                <div class="footer-main-sub">
                    <h3>Information</h3>
                    <p><a href="?page=events">Browse Events</a></p>
                    <p><a href="?page=venues">Browse Venues</a></p>
                    <p><a href="?page=register">Register for an account</a></p>
                </div>
            </div>
            <div class="footer-sub">
                <h3>&copy; EventsIo 2021 All rights reserved</h3>
            </div>
        </div>
    </section>

    <!-- Scripts -->
    <script src="assets/js/script.js"></script>
    <?php if (isset($additionalJS)) echo $additionalJS; ?>
</body>

</html>