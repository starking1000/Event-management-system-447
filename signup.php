<?php
include("./Database/db.php");
session_start();

include('./csrf.php');
$csrf_token = generateCSRFToken();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email format.');</script>";
        exit();
    }

    // Validate username (letters, numbers, underscores, 3–20 chars)
    if (!preg_match("/^[A-Za-z0-9_]{3,20}$/", $username)) {
        echo "<script>alert('Username must be 3–20 characters long and contain only letters, numbers, or underscores.');</script>";
        exit();
    }

    // Strong password validation (min 8 chars, 1 uppercase, 1 lowercase, 1 number, 1 special char)
    if (!preg_match("/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/", $password)) {
        echo "<script>alert('Password must be at least 8 characters long, include uppercase, lowercase, number, and a special character.');</script>";
        exit();
    }

    if (!empty($username) && !empty($email) && !empty($password)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $role = 'user';

        $stmt = $conn->prepare("INSERT INTO users (username, email, hashed_password, role) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $username, $email, $hashed_password, $role);

        if ($stmt->execute()) {
            header("Location: login.php");
            exit();
        } else {
            echo "<script>alert('Registration failed. Email or username may already exist.');</script>";
        }

        $stmt->close();
    } else {
        echo "<script>alert('All fields are required.');</script>";
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up | Venue Management</title>
  <link rel="stylesheet" href="./css/style.css">
  <link rel="icon" href="https://cdn4.iconfinder.com/data/icons/new-year-filled-1/48/events___occasion_event_fireworks_stars_shooting_new_year_new_years-512.png">
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
          </div>
          <div class="Contact-section">
              <h5>Operational Hours</h5>
              <p>Mon-Fri 9am-5pm</p>
              <p>Sat 9am - 12pm</p>
          </div>
      </div>
  </div>
</section>

<section class="HeaderContainer">
  <div class="header-container">
     <a href="index.php"><button class="active">Home</button></a>
     <a href="BookVenue.php"><button>Book a venue</button></a>
     <a href="BrowseEvents.php"><button>Browse Events</button></a>
     <a href="Forms/createEvent.php"><button>Create Event</button></a>
     <a href="BrowseEvents.php"><button>View RSVP's</button></a>
     <a href="Panel.php"><button>Admin Panel</button></a>
  </div>
</section>

<section class="FormCon">
  <h1>Sign up here</h1>
  <form action="" method="POST" id="signupForm" style="margin:auto; max-width:500px; width:80vw;">
    <div style="font-size:20px; margin:10px; color:white;">Create an Account</div><br><br>
    <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">

    <input type="text" name="username" placeholder="Username" required pattern="[A-Za-z0-9_]{3,20}" title="3–20 characters, letters, numbers, or underscores only" style="width:100%; height:50px; border:1px solid blue; border-radius:5px"><br><br>
    
    <input type="email" name="email" placeholder="Email Address" required style="width:100%; height:50px; border:1px solid blue; border-radius:5px"><br><br>
    
    <input type="password" name="password" id="password" placeholder="Password" required 
      pattern="^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&]).{8,}$" 
      title="At least 8 characters, with uppercase, lowercase, number, and special character"
      style="width:100%; height:50px; border:1px solid blue; border-radius:5px">
      <small id="passwordHelp" style="color:white; display:block; margin-top:5px;">
        Must contain at least 8 characters, one uppercase, one lowercase, one number, and one special character.
      </small><br><br>

    <input type="submit" value="Sign Up" style="width:50%; height:50px; background-color:blue; color:#fff; font-weight:bold; border:none; border-radius:5px; margin:auto; cursor:pointer;"> <br><br>
    
    <a href="login.php" style="color:white;">Already have an account? Login</a><br><br>
    <a href="adminlogin.php" style="color:white;">Login as Admin</a>
  </form>
</section>

<script>
  // Optional JS live validation feedback
  const passwordField = document.getElementById('password');
  const helpText = document.getElementById('passwordHelp');

  passwordField.addEventListener('input', () => {
    const strongPassword = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&]).{8,}$/;
    if (!strongPassword.test(passwordField.value)) {
      helpText.style.color = 'red';
    } else {
      helpText.style.color = 'lime';
    }
  });
</script>

</body>
</html>
