<?php
// Secure cookie and session configuration
session_set_cookie_params([
    'lifetime' => 0, // Expires when the browser closes
    'path' => '/',
    'domain' => '', // Leave empty for localhost or specify domain, e.g., 'example.com'
    'secure' => isset($_SERVER['HTTPS']), // True only if using HTTPS
    'httponly' => true, // Prevent JavaScript access to the cookie
    'samesite' => 'Strict' // Mitigates CSRF attacks
]);
include('./Database/db.php');
session_start();


// Secure SQL query with JOIN to show event + venue info
$sql = "
SELECT 
    e.id,
    e.event_name,
    e.event_date,
    e.start_time,
    e.event_time,
    v.venue_name
FROM events e
JOIN venues v ON e.id = v.id
ORDER BY e.event_date ASC
";

$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Venue Management</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="icon" href="https://cdn4.iconfinder.com/data/icons/new-year-filled-1/48/events___occasion_event_fireworks_stars_shooting_new_year_new_years-512.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Benne&display=swap" rel="stylesheet">
    <style>
        .service-container {
            width: 50%;
            height: auto;
            display: flex;
            flex-wrap: wrap;
            padding: 75px;
        }
        .service-container .service-img {
            width: 40%;
            height: 350px;
            padding: 50px;
        }
        .service-container .service-text {
            width: 60%;
            height: auto;
            padding: 50px;
            line-height: 30px;
        }
        .service-container .service-text h2 {
            padding-bottom: 30px;
            color: navy;
            font-size: 2em;
        }
        @media screen and (max-width: 800px) {
            .service-container .service-img,
            .service-text {
                width: 100%;
            }
        }
        .service-container .service-img img {
            width: 100px;
            height: 100px;
            border-radius: 10px;
        }
        .flexa {
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
        }
    </style>
</head>
<body>
    <section class="HeaderLogoCon">
        <div class="starter">
            <div class="LogoIconContainer">
                <img src="https://cdn4.iconfinder.com/data/icons/new-year-filled-1/48/events___occasion_event_fireworks_stars_shooting_new_year_new_years-512.png" alt="">
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
                    <?php
                        if(!isset($_SESSION['username'])){
                            echo '<a href="/login.php"><button>Sign in</button></a>';
                        } else {
                            echo "<strong>Welcome, " . htmlspecialchars($_SESSION['username']) . "</strong>";
                        }
                    ?>
                </div>
            </div>
        </div>
    </section>

    <section class="HeaderContainer">
        <div class="header-container">
            <a href="index.php"><button>Home</button></a>
            <a href="BookVenue.php"><button>Book a venue</button></a>
            <a href="BrowseEvents.php"><button class="active">Browse Events</button></a>
            <a href="Forms/createVenue.php"><button>Create Venue</button></a>
            <a href="BrowseEvents.php"><button>View RSVP's</button></a>
            <a href="Panel.php"><button>Admin Panel</button></a> 
        </div>
    </section>

    <section class="ServicesContainer">
        <div class="flexa">
        <?php while ($rows = $result->fetch_assoc()) { ?>
            <div class="service-container">
                <div class="service-img">
                    <img src="https://cdn4.iconfinder.com/data/icons/office-and-business-conceptual-flat/169/34-512.png" alt="">
                </div>
                <div class="service-text">
                    <h2><?php echo htmlspecialchars($rows['event_name']); ?></h2>
                    <p>Venue: <?php echo htmlspecialchars($rows['venue_name']); ?></p>
                    <p>Date: <?php echo htmlspecialchars($rows['event_date']); ?></p>
                    <p>Time: <?php echo htmlspecialchars($rows['start_time'] . ' - ' . $rows['event_time']); ?></p>

                    <?php
                    $currentDate = date("Y-m-d");
                    $eventDate = $rows['event_date'];
                    $diff = abs(round((strtotime($eventDate) - strtotime($currentDate)) / 86400));
                    echo "<p>Event in " . ($diff == 0 ? "less than a day" : $diff . " days") . "</p>";
                    ?>
                    
                    <a href="./Forms/CreateReservation.php?id=<?php echo urlencode($rows['id']); ?>">
                        <button style="width:90px; height:40px; border:none; border-radius:5px; color:#fff; background-color:navy;">
                            Book Now
                        </button>
                    </a>
                </div>
            </div>
        <?php } ?>
        </div>
    </section>

    <section class="FooterContainer">
        <div class="footer-home">
            <div class="footer-main">
                <div class="footer-main-sub">
                    <h3>Contact Us</h3>
                    <p style="color:black">Email: <a href="#">customercare@EventsIo.com</a></p>
                    <p style="color:black">Phone <a href="#">+255745365345</a></p>
                    <p style="color:black">Address: <a href="#">605, Nyambadwe</a></p>
                    <p style="color:black">Emergency Number: <a href="#">+255745365345</a></p>
                </div>
                <div class="footer-main-sub">
                    <h3>Our Services</h3>
                    <p><a href="">Event Planning</a></p>
                    <p><a href="">Venue Booking</a></p>
                    <p><a href="">Event Reservations</a></p>
                </div>
                <div class="footer-main-sub">
                    <h3>Information</h3>
                    <p><a href="">Browse Events</a></p>
                    <p><a href="">Register for an Event</a></p>
                </div>
            </div>
            <div class="footer-sub">
                <h3>&amp; EventsIo &copy; 2025 All rights reserved</h3>
            </div>
        </div>
    </section>

</body>
</html>
