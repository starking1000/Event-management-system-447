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

session_start();

include('../csrf.php');
$csrf_token = generateCSRFToken();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="../css/style.css">
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
        <a href="../index.php"><button>Home</button> </a>
        <a href="../BookVenue.php"><button>Book a venue</button> </a>
        <a href="../BrowseEvents.php"><button>Browse Events</button> </a>
        <a href="../Forms/createVenue.php" class="active"><button>Create Venue</button> </a>
        <a href="../BrowseEvents.php"><button>View RSVP's</button> </a>
        <a href="../Panel.php"><button>Admin Panel</button></a>
      </div>
      <div class="header-container-sub">
        <button id="more">
          <img
            src="./img/burgerbtn.png "
            alt=""
            id="more-btn"
            style="width: 100px; height: 50px"
          />
        </button>
        <a href="../"><button class="active">Home</button> </a>
        <a href="../BookVenue.php"><button>Book a venue</button> </a>
        <a href="../BrowseEvents.php"><button>Browse Events</button> </a>
        <a href="../Forms/createEvent.php"><button>Create Event</button> </a>
        <a href="../BrowseEvents.php"><button>View RSVP's</button> </a>
        <a href="../Panel.php"><button>Admin Panel</button></a>
      </div>
    </section>
 <?php
    include("../Database/db.php");

    if (isset($_POST['venue_name'])) {
        $venue_name = trim($_POST['venue_name']);
        $location = trim($_POST['location']);
        $capacity = intval($_POST['capacity']);
        $price = floatval($_POST['price']);
          

        // Prepared statement
        $stmt = $conn->prepare("INSERT INTO venues (venue_name, location, capacity, price) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssid", $venue_name, $location, $capacity, $price, );

        if ($stmt->execute()) {
            echo "<div class='container' style='color:green; text-align:center;'>
                    ✅ Venue successfully added!<br>
                    <a href='../BrowseEvents.php'>View Events</a>
                  </div>";
        } else {
            echo "<div class='container' style='color:red; text-align:center;'>
                    ❌ Error: " . htmlspecialchars($stmt->error) . "
                  </div>";
        }

        $stmt->close();
    } else {
    ?>
 <div class="container">
        <h3 style="text-align:center; margin-top:30px;">Event Creation Form</h3>
        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
            <input type="text" name="venue_name" id="venue_name" placeholder="Venue Name">
            <input type="text" name="location" id="location" placeholder="Location">
            <input type="number" name="capacity" id="capacity" placeholder="Capacity">
            <input type="number" name="price" id="price" placeholder="Price in Ksh"/>
            <input type="submit" value="submit"/>
        </form>
    </div>
<?php

}
?>
   
    <script src="../js/script.js"></script>
</body>
</html>