<?php
include('../Database/db.php');
include('../csrf.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Validate CSRF Token
if (!isset($_GET['csrf_token']) || !validateCSRFToken($_GET['csrf_token'])) {
    die("CSRF validation failed. Please reload the page.");
}

// If validation passes, continue as normal
$venue_name = $_GET['venue_name'] ?? '';
if (empty($venue_name)) {
    die("Invalid venue selected.");
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Event</title>
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
                if (empty($_SESSION['username'])) {
                    echo '<a href="/login.html"><button style="width:150px;height:50px;border:none;background-color: navy;color:#fff;font-weight: bold;cursor:pointer;">Sign in</button></a>';
                } else {
                    echo htmlspecialchars($_SESSION['username']);
                }
              ?>
          </div>
      </div>
  </div>
</section>

<section class="HeaderContainer">
  <div class="header-container">
    <a href="../"><button>Home</button></a>
    <a href="../BookVenue.php"><button>Book a venue</button></a>
    <a href="../BrowseEvents.php"><button>Browse Events</button></a>
    <a href="../Forms/createVenue.php"><button>Create Venue</button></a>
    <a href="../Tables/AllRsvps.php"><button>View RSVP's</button></a>
    <a href="../Panel.php"><button>Admin Panel</button></a>
  </div>
</section>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // --- CSRF Validation ---
    if (!validateCSRFToken($_POST['csrf_token'] ?? '')) {
        die("<div class='container' style='color:red;'>CSRF validation failed. Please reload the page.</div>");
    }

    // Collect form data safely
    $event_name   = trim($_POST['event_name'] ?? '');
    $description  = trim($_POST['description'] ?? '');
    $venue        = trim($_POST['venue'] ?? '');
    $max_capacity = intval($_POST['max_capacity'] ?? 0);
    $time         = trim($_POST['time'] ?? '');
    $date         = trim($_POST['date'] ?? '');

    // Validation
    if (empty($event_name) || empty($venue) || empty($time) || empty($date) || $max_capacity <= 0) {
        echo "<div class='container' style='color:red;'>Please fill in all required fields correctly.</div>";
    } else {
        // Use prepared statement to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO events (event_name, description, venue, max_capacity, start_time, event_date) VALUES (?, ?, ?, ?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param("sssiss", $event_name, $description, $venue, $max_capacity, $time, $date);
            if ($stmt->execute()) {
                echo "<div class='container' style='color:green;'>Event created successfully! Redirecting...</div>";
                header("Refresh:2; url=./makePayment.php?event_name=" . urlencode($event_name));
                exit;
            } else {
                echo "<div class='container' style='color:red;'>Error saving data. {$stmt->error}</div>";
            }
            $stmt->close();
        } else {
            echo "<div class='container' style='color:red;'>SQL error: {$conn->error}</div>";
        }
    }
}
?>

<div class="container">
    <h3 style="text-align:center; margin-top:30px;">Event Creation Form</h3>
    <h5 style="text-align:center; margin-top:10px;">Create an event at <?php echo htmlspecialchars($_GET['venue_name'] ?? ''); ?></h5>

    <form method="POST">
        <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrf_token); ?>">

        <input type="text" name="event_name" id="event_name" placeholder="Event Name" required>
        <input type="text" name="description" id="description" placeholder="Description" required>

        <!-- Disabled inputs don’t submit, so add hidden field -->
        <input type="text" disabled value="<?php echo htmlspecialchars($_GET['venue_name'] ?? ''); ?>" placeholder="Venue">
        <input type="hidden" name="venue" value="<?php echo htmlspecialchars($_GET['venue_name'] ?? ''); ?>">

        <input type="number" name="max_capacity" id="max_capacity" placeholder="Max Capacity" required>
        <input type="time" name="time" id="time" required>
        <input type="date" name="date" id="date" required>

        <input type="submit" value="Submit">
    </form>
</div>

<script src="../js/script.js"></script>
</body>
</html>
