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
    if(isset($_REQUEST['name'])){
        $name = $_REQUEST['name'];
        $role = $_REQUEST['role'];
        $email = $_REQUEST['email'];

        $sql = "INSERT INTO users VALUES (null, '$name','$role','$email')";
        $result = mysqli_query($conn, $sql);

        if ($result){
            echo " <div class='container'> SUCCESSFULLY SAVED THE DATA'<br/>
            <a href='../Dashboard/index.php'>log in</a>
            </div>";
        } else {
            echo " <div class='container'>Error saving data <br/>
            <a href='../Dashboard/index.php'>Try again</a>
            </div>";
        }
    } else {
?>
 <div class="container">
        <h3>Event Creation Form</h3>
        <form method="POST">
            <input type="text" name="name" id="name">
            <input type="text" name="role" id="role">
            <input type="email" name="email" id="email">
            <input type="submit" value="submit"/>
        </form>
    </div>
<?php

}
?>
   
    <script src="../js/script.js"></script>
</body>
</html>