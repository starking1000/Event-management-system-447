
<!DOCTYPE html>
<html lang="en">
<head>
  <!--this is a comment -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Venue Management</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="icon" href="https://cdn4.iconfinder.com/data/icons/new-year-filled-1/48/events___occasion_event_fireworks_stars_shooting_new_year_new_years-512.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Benne&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
    <section class="HeaderLogoCon">
        <div class="starter">
            <div class="LogoIconContainer">
                <img src="./https://cdn4.iconfinder.com/data/icons/new-year-filled-1/48/events___occasion_event_fireworks_stars_shooting_new_year_new_years-512.png " alt="">
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
                            echo '<a href="/signup.php"><button>Sign in</button></a>';
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
           <a href="index.php" ><button class="active">Home</button> </a>
           <a href="BookVenue.php"><button>Book a venue</button> </a>
           <a href="BrowseEvents.php"><button>Browse Events</button> </a>
           <a href="Forms/createEvent.php"><button>Create Event</button> </a>
           <a href="BrowseEvents.php"><button>View RSVP's</button> </a>
           <a href="Panel.php"><button>Admin Panel</button></a> 
        </div>
        <div class="header-container-sub">
            <button id="more"> <img src="./img/burgerbtn.png " alt="" id="more-btn" style="width:100px; height:50px;">  </button> 
            <a href="index.php" ><button class="active">Home</button> </a>
            <a href="BookVenue.php"><button>Book a venue</button> </a>
            <a href="BrowseEvents.php"><button>Browse Events</button> </a>
            <a href="Forms/createEvent.php"><button>Create Event</button> </a>
            <a href="BrowseEvents.php"><button>View RSVP's</button> </a>
            <a href="Panel.php"><button>Admin Panel</button></a> 
        </div>
    </section>
    <?php
    include("./Database/db.php");
    session_start();

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);

        // Prepared statement for security
        $stmt = $conn->prepare("SELECT id, username, hashed_password, role FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows === 1) {
            $user = $result->fetch_assoc();

            if (password_verify($password, $user['hashed_password'])) {
                // Successful login
                $_SESSION['id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];

                if ($user['role'] === 'admin') {
                    header("Location: Panel.php");
                } else {
                    header("Location: BookVenue.php");
                }
                exit;
            } else {
                echo "<script>alert('Invalid password');</script>";
            }
        } else {
            echo "<script>alert('User not found');</script>";
        }
        $stmt->close();
    }
    ?>
    <section class="FormCon">
        <form action="" method="POST" style="margin:auto; max-width:500px; width:80vw;">
            <div style="font-size: 20px;margin: 10px; color:white;">Login Here</div><br><br>
            <input id="text" type="text" placeholder="Your name here :" name="username" style="width:100%; height:50px; border:1px solid blue; border-radius:5px" ><br><br>
            <input id="text" type="password" placeholder=" Enter password " name="password" style="width:100%; height:50px; border:1px solid blue; border-radius:5px"><br><br>
            <input id="button" style="width:50%; height:50px; background-color:blue; color:#fff; font-weight:bold; border:none; border-radius:5px;margin:auto; cursor:pointer;" type="submit" value = "Login"> <br><br>
            <a href="signup.php">Signup Here</a>
        </form>
    </section>

    <section class="FooterContainer">
        <div class="footer-home">
            <div class="footer-main">
                <div class="footer-main-sub">
                    <h3>Contact Us</h3>
                    <p>Contact EventsIo Auto Body Today for the quality service at best prices.</p>
                    <p style="color:black">Email: <a href="#"> customercare@EventsIo.com</a></p>
                    <p style="color:black">Phone <a href="#">+255745365345</a></p>
                    <p style="color:black">Address : <a href="#"> 605, Nyambadwe</a></p>
                    <p style="color:black">Emergency Number : <a href="#">+255745365345</a> </p>
                </div>
                <div class="footer-main-sub">
                    <h3>Our Services</h3>
                    <p><a href="Service.html">Panel Beating</a></p>
                    <p><a href="Service.html">Towing and Vehicle Recovery</a></p>
                    <p><a href="Service.html">Mechanics</a></p>
                    <p><a href="Service.html">spray Painting</a></p>
                    <p><a href="Service.html">Motor Electrical Repair</a></p>
                    <p><a href="Service.html">Vehicle customization</a></p>
                </div>
                <div class="footer-main-sub">
                    <h3>Information</h3>
                    <p><a href="">Warranty Information</a></p>
                    <p><a href="">Excess Payment</a></p>
                    <p><a href="">On-site Quotation Requests</a></p>
                    <p><a href="">Contact Customer Care</a> </p>

                </div>
            </div>
            <div class="footer-sub">
                <h3>&copy;  &amp; EventsIo 2021 All rights reserved</h3>
            </div>
        </div>
    </secttion>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
  <script src="{% static 'js/script.js' %}"></script>  
</body>
</html>