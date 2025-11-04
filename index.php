
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <!--this is a comment -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Venue Management</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="icon" href="https://cdn4.iconfinder.com/data/icons/new-year-filled-1/48/events___occasion_event_fireworks_stars_shooting_new_year_new_years-512.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Benne&display=swap" rel="stylesheet">
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
                 <?php if (isset($_SESSION['username'])): ?>
    <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
            <?php echo htmlspecialchars($_SESSION['username']); ?>
        </button>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
        </ul>
    </div>
<?php else: ?>
    <a href="login.php" class="btn btn-primary">Sign In</a>
<?php endif; ?>
              </div>
          </div>
      </div>
  </section>
    <section class="HeaderContainer">
        <div class="header-container">
           <a href="/" ><button class="active">Home</button> </a>
           <a href="BookVenue.php"><button>Book a venue</button> </a>
           <a href="BrowseEvents.php"><button>Browse Events</button> </a>
           <a href="Forms/createEvent.php"><button>Create Event</button> </a>
           <a href="BrowseEvents.php"><button>View RSVP's</button> </a>
           <a href="Panel.php"><button>Admin Panel</button></a> 
        </div>
        <div class="header-container-sub">
            <button id="more"> <img src="./img/burgerbtn.png " alt="" id="more-btn" style="width:100px; height:50px;">  </button> 
            <a href="/" ><button class="active">Home</button> </a>
            <a href="BookVenue.php"><button>Book a venue</button> </a>
            <a href="BrowseEvents.php"><button>Browse Events</button> </a>
            <a href="Forms/createEvent.php"><button>Create Event</button> </a>
            <a href="BrowseEvents.php"><button>View RSVP's</button> </a>
            <a href="Panel.php"><button>Admin Panel</button></a> 
        </div>
    </section>
    <section class="CarouselContainer">
        <div class="carousel">
            <div class="slides">
                <img src="https://cdn.pixabay.com/photo/2018/09/05/08/05/party-3655712_640.jpg" alt="slide image" class="slide">
                <img src="https://cdn.pixabay.com/photo/2017/07/21/23/57/concert-2527495_640.jpg" alt="slide image" class="slide">
                <img src="https://images.unsplash.com/photo-1531058020387-3be344556be6?auto=format&fit=crop&w=1200&q=80" alt="slide image" class="slide">
            </div>
            <div class="controls">
                <div class="control prev-slide">&#9668;</div>
                <div class="control next-slide">&#9658;</div>
            </div>
        </div>
    </section>
    <section class="client-area">
        <div class="holder-Header">
            <h3>Our Locations</h3>
        </div>
        <div class="holder">
            <div><img src="https://cdn0.iconfinder.com/data/icons/font-awesome-solid-vol-1/640/church-512.png"><h3></h3>Church</div>
            <div><img src="https://cdn3.iconfinder.com/data/icons/education-1-1/256/School-512.png"><h3>Schools</h3></div>
            <div><img src="https://cdn4.iconfinder.com/data/icons/park-and-garden/48/vehicle-gardens-green-_nature-park-_playground-_urban_4-512.png"><h3>Parks</h3></div>
            <div><img src="https://cdn0.iconfinder.com/data/icons/hotel-vacation/33/golf-2-512.png"><h3>Golf Course</h3></div>
            <div><img src="https://cdn3.iconfinder.com/data/icons/web-and-devices-set-1/512/Hotels-512.png"><h3>Hotels</h3></div>
            <div><img src="https://cdn3.iconfinder.com/data/icons/buildings-places/512/Hotels_A-256.png"><h3>Conferrence rooms</h3></div>
        </div>
    </section>
    <section class="carProfileContainer">
        <div class="image-grid">
            <h1>Some Events</h1>
          
            <div class="grid-left">
              <img class="logo-images" src="https://images.unsplash.com/photo-1523580846011-d3a5bc25702b?auto=format&fit=crop&w=800&q=80"/>
              <span class="image-description">
                <strong>Graduation Party</strong><br>
                see Locations
              </span>
            </div>
          
          
            <div class="grid-right">
              <img class="logo-images" src="https://images.unsplash.com/photo-1520854221256-17451cc331bf?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTh8fHdlZGRpbmclMjBwbGFubmluZ3xlbnwwfHwwfHx8MA%3D%3D&auto=format&fit=crop&q=60&w=500" />
              <span class="image-description">
                <strong>Wedding Partys</strong><br>
                See Locations
              </span>
            </div>
          
          
            <div class="grid-left">
              <img class="logo-images" src="https://images.unsplash.com/photo-1492684223066-81342ee5ff30?auto=format&fit=crop&w=400&q=80" />
              <span class="image-description">
                <strong>Meet ups</strong><br>
                
                See Locations
              </span>
            </div>
          
          
            <div class="grid-right">
              <img class="logo-images" src="https://plus.unsplash.com/premium_photo-1679547202671-f9dbbf466db4?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8Y29uZmVyZW5jZXxlbnwwfHwwfHx8MA%3D%3D&auto=format&fit=crop&q=60&w=500" />
              <span class="image-description">
                <strong>Conferences</strong><br>
              
              See Locations
              </span>
            </div> 
          
          
            <div class="grid-left">
              <img class="logo-images" src="https://images.unsplash.com/photo-1527529482837-4698179dc6ce?auto=format&fit=crop&w=800&q=80" />
              <span class="image-description">
                <strong>Farewell Party's</strong><br>
                see locations
              </span>
            </div>
          
          
            <div class="grid-right">
              <img class="logo-images" src="https://images.unsplash.com/photo-1566737236500-c8ac43014a67?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8N3x8cGFydHl8ZW58MHx8MHx8fDA%3D&auto=format&fit=crop&q=60&w=500" />
              <span class="image-description">
                <strong>End year Party's</strong><br>
                See Locations
              </span>
            </div>
            <div style="clear:both"></div>
          
          
          </div>
    </section>

    <secttion class="FooterContainer">
        <div class="footer-home">
            <div class="footer-main">
                <div class="footer-main-sub">
                    <h3>Contact Us</h3>
                    <p style="color:black">Email: <a href="#"> customercare@EventsIo.com</a></p>
                    <p style="color:black">Phone <a href="#">+255745365345</a></p>
                    <p style="color:black">Address : <a href="#"> 605, Nyambadwe</a></p>
                    <p style="color:black">Emergency Number : <a href="#">+255745365345</a> </p>
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
                    <p><a href="">Browse Events</a></p>
                    <p><a href="">Register for an event</a></p>
                </div>
            </div>
            <div class="footer-sub">
                <h3>  &amp; EventsIo &copy; 2021 All rights reserved</h3>
            </div>
        </div>
    </secttion>
  <script src="./js/script.js "></script>  
</body>
</html>