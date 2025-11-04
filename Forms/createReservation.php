<?php
// ------------------------------
// Secure session configuration
// ------------------------------
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

include('../Database/db.php');
include('../csrf.php');

// Generate CSRF token only once
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = generateCSRFToken();
}
$csrf_token = $_SESSION['csrf_token'];
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
        <a href="../index.html"><button class="active">Home</button> </a>
        <a href="../BookVenue.php"><button>Book a venue</button> </a>
        <a href="../BrowseEvents.php"><button>Browse Events</button> </a>
        <a href="../Forms/createVenue.php"><button>Create Venue</button> </a>
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
        <a href="../index.php"><button class="active">Home</button> </a>
        <a href="../BookVenue.php"><button>Book a venue</button> </a>
        <a href="../BrowseEvents.php"><button>Browse Events</button> </a>
        <a href="../Forms/createEvent.php"><button>Create Event</button> </a>
        <a href="../BrowseEvents.php"><button>View RSVP's</button> </a>
        <a href="../Panel.php"><button>Admin Panel</button></a>
      </div>
    </section>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $user_name = $_POST['user_name'] ?? '';
    $event_name = $_POST['event_name'] ?? '';
    $token = $_POST['csrf_token'] ?? '';

    // Validate CSRF
    if (!validateCSRFToken($token)) {
        die("<div class='container' style='color:red;'>CSRF validation failed. Please reload the page.</div>");
    }

    // Validate input
    if (empty($user_name) || empty($event_name)) {
        echo "<div class='container' style='color:red;'>Please fill in all required fields.</div>";
    } else {
        // Secure Insert
        $stmt = $conn->prepare("INSERT INTO reservations (user_name, event_name) VALUES (?, ?)");
        $stmt->bind_param("ss", $user_name, $event_name);

        if ($stmt->execute()) {
            echo "<div class='container'>Successfully added reservation!<br/>
            <a href='../BrowseEvents.php'>Browse more events</a></div>";
        } else {
            echo "<div class='container'>Error saving data.<br/>
            <a href='./createReservation.php'>Try again</a></div>";
        }

        $stmt->close();
    }
} else {
   
?>
    <div class="container">
        <h3>RSVP Creation Form</h3>
        <?php
        $venue_name = isset($_GET['venue_name']) ? $_GET['venue_name'] : '';
        ?>

        <form method="POST" action="">
            <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrf_token); ?>">
            <input type="text" name="user_name" id="user_name" placeholder="Enter User Name" required>
            <input type="text" name="event_name" id="event_name" value="<?php echo htmlspecialchars($venue_name); ?>" placeholder="Event Name" required>
            <input type="submit" value="Submit"/>
        </form>
    </div>
<?php
}
?>
   
    <script src="../js/script.js"></script>
</body>
</html>