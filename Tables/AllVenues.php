<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="../css/style.css" />
    <link
      rel="icon"
      href="https://cdn4.iconfinder.com/data/icons/new-year-filled-1/48/events___occasion_event_fireworks_stars_shooting_new_year_new_years-512.png"
    />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Benne&display=swap"
      rel="stylesheet"
    />
  </head>
  <style>
    table {
      width: 100%;
      border-collapse: collapse;
    }
    /* Zebra striping */
    tr:nth-of-type(odd) {
      background: navy;
      color: #fff;
    }
    th {
      background: rgb(100, 100, 255);
      color: white;
      font-weight: bold;
    }
    td,
    th {
      padding: 6px;
      border: 1px solid #ccc;
      text-align: left;
    }
  </style>
  <body>
    <section class="HeaderLogoCon">
      <div class="starter">
        <div class="LogoIconContainer">
          <img
            src="https://cdn4.iconfinder.com/data/icons/new-year-filled-1/48/events___occasion_event_fireworks_stars_shooting_new_year_new_years-512.png"
            alt=""
          />
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
                    session_start();
                        if(!$_SESSION['username']){
                            echo '<a href="/login.html"><button style="width:150px;height:50px;border:none;background-color: navy;color:#fff;font-weight: bold;cursor:pointer;">Sign in </button></a>';
                        } else {
                            echo $_SESSION['username'];
                        }
                    ?>
          </div>
        </div>
      </div>
    </section>
    <section class="HeaderContainer">
        <div class="header-container">
          <a href="../"><button class="active">Home</button> </a>
          <a href="../BookVenue.php"><button>Book a venue</button> </a>
          <a href="../BrowseEvents.php"><button>Browse Events</button> </a>
          <a href="../Forms/createEvent.php"><button>Create Event</button> </a>
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
    <section class="panle-main">
      <h3>All users</h3>
      <table>
        Venues
        <thead>
          <tr>
            <th>Venue Name</th>
            <th>Location</th>
            <th>capacity</th>
            <th>description</th>
          </tr>
        </thead>
        <tbody>
          <?php 
        include('../Database/db.php');
        $qry =  "SELECT * FROM venues";
        $result = mysqli_query($conn, $qry);
        $conn->close(); while($rows=mysqli_fetch_assoc($result)){ ?>
          <tr>
            <td><?php echo $rows['venue_name']?></td>
            <td><?php echo $rows['location']?></td>
            <td><?php echo $rows['capacity']?></td>
            <td><?php echo $rows['description']?></td>
          </tr>
          <?php
     } 
    ?>
        </tbody>
      </table>
    </section>
    <secttion class="FooterContainer">
      <div class="footer-home">
        <div class="footer-main">
          <div class="footer-main-sub">
            <h3>Contact Us</h3>
            <p style="color: black">
              Email: <a href="#"> customercare@EventsIo.com</a>
            </p>
            <p style="color: black">Phone <a href="#">+255745365345</a></p>
            <p style="color: black">
              Address : <a href="#"> 605, Nyambadwe</a>
            </p>
            <p style="color: black">
              Emergency Number : <a href="#">+255745365345</a>
            </p>
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
          <h3>&amp; EventsIo &copy; 2021 All rights reserved</h3>
        </div>
      </div>
    </secttion>
    <script src="./js/script.js "></script>
  </body>
</html>
