<?php
// Secure cookie and session configuration
if (session_status() === PHP_SESSION_NONE) {
    session_set_cookie_params([
        'lifetime' => 0,
        'path' => '/',
        'domain' => '',
        'secure' => isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on',
        'httponly' => true,
        'samesite' => 'Strict'
    ]);
    session_start();
}

include('./Database/db.php');
include('./csrf.php');

// Generate CSRF token only once per session
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = generateCSRFToken();
}
$csrf_token = $_SESSION['csrf_token'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Venue Management</title>
    <link rel="stylesheet" href="./css/style.css">

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
        @media screen and (max-width:800px) {
            .service-container .service-img, .service-text {
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
        button {
            width: 100px;
            height: 40px;
            border: none;
            border-radius: 5px;
            color: #fff;
            background-color: navy;
            cursor: pointer;
        }
        button:hover {
            background-color: darkblue;
        }
    </style>
</head>
<body>

    <!-- Header Section -->
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

    <!-- Navbar -->
    <section class="HeaderContainer">
        <div class="header-container">
           <a href="index.php"><button>Home</button></a>
           <a href="BookVenue.php"><button class="active">Book a venue</button></a>
           <a href="BrowseEvents.php"><button>Browse Events</button></a>
           <a href="Forms/createVenue.php"><button>Create Venue</button></a>
           <a href="Panel.php"><button>Admin Panel</button></a>
        </div>
    </section>

    <!-- Venue List -->
    <section class="ServicesContainer">
        <div class="flexa">
        <?php
        $sql = "SELECT * FROM venues";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            while ($rows = $result->fetch_assoc()) {
        ?>
        <div class="service-container">
            <div class="service-img">
                <img src="https://cdn1.iconfinder.com/data/icons/leto-travel-vacation/64/__hotel_resort_vacation-512.png" alt="">
            </div>
            <div class="service-text">
                <h2><?php echo htmlspecialchars($rows['venue_name']); ?></h2>
                <p><?php echo htmlspecialchars($rows['description'] ?? 'No description available.'); ?></p>
                <p>Location: <?php echo htmlspecialchars($rows['location']); ?></p>
                <p>Capacity: <?php echo htmlspecialchars($rows['capacity']); ?></p>
                <p>Price: <?php echo isset($rows['price']) ? 'Ksh ' . htmlspecialchars($rows['price']) : 'N/A'; ?></p>

                <!-- Include CSRF token in hidden form -->
                <form action="./Forms/createEvent.php" method="GET">
                    <input type="hidden" name="venue_name" value="<?php echo htmlspecialchars($rows['venue_name']); ?>">
                    <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrf_token); ?>">
                    <button type="submit">Book Now</button>
                </form>
            </div>
        </div>
        <?php
            }
        } else {
            echo "<p style='padding:50px;'>No venues available at the moment.</p>";
        }
        $conn->close();
        ?>
        </div>
    </section>

</body>
</html>
