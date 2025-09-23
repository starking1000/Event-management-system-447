<?php 
include('./Database/db.php');
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Venue Management</title>
    <link rel="stylesheet" href=" ./css/style.css  ">
    <link rel="icon" href=" ./https://cdn4.iconfinder.com/data/icons/new-year-filled-1/48/events___occasion_event_fireworks_stars_shooting_new_year_new_years-512.png  ">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Benne&display=swap" rel="stylesheet">
    <style>
        .service-container{
            width:50%;
            height:auto;
            display:flex;
            flex-wrap:wrap;
            padding:75px;
        }
        .service-container .service-img{
            width:40%;
            height:350px;
            padding:50px;
        }
        .service-container .service-text{
            width:60%;
            height:auto;
            padding:50px;
            line-height: 30px;
        }
        .service-container .service-text h2{
            padding-bottom:30px;
            color:navy;
            font-size:2em;
        }
        @media screen and (max-width:800px){
            .service-container .service-img,.service-text{
                width:100%;
            }
        }
        .service-container .service-img img{
            width:100px;
            height:100px;
            border-radius:10px;
        }
        .flexa{
            display:flex;
            flex-direction:row;
            flex-wrap:wrap;
        }
    </style>
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
           <a href="/" ><button>Home</button> </a>
           <a href="BookVenue.php"><button>Book a venue</button> </a>
           <a href="BrowseEvents.php"><button class="active">Browse Events</button> </a>
           <a href="Forms/createVenue.php"><button>Create Venue</button> </a>
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
    <section class="ServicesContainer">
        <div class="flexa">
        <?php
        $sql = "SELECT * FROM events";
        $result = $conn->query($sql);
        $conn->close();
        while($rows=$result->fetch_assoc()){
        ?>
        <div class="service-container">
            <div class="service-img">
                <img src="https://cdn4.iconfinder.com/data/icons/office-and-business-conceptual-flat/169/34-512.png" alt="">
            </div>
            <div class="service-text">
                <h2><?php echo $rows['event_name'];?></h2>
                <p>venue :<?php echo $rows['venue'];?></p>
                <p>Time : <?php echo $rows['time'];?></p>
                <p>Date : <?php echo $rows['date'];?></p>
                <p><?php 
                $earlier = date('Y-m-d');
                $later = $rows['date'];
                $currentDate = date("Y-m-d");
                $diff = abs(round((strtotime($currentDate) - strtotime($later))/86400));

                if($diff <= 1){ 
                    echo "event in a less than a day";
                }else{
                    echo "event in ".$diff." days";
                };
                ?></p>
                <a href="./Forms/CreateReservation.php?venue_name=<?php echo $rows['event_name']?>"><button style="width:70px; height:40px;border:none;border-radius:5px;color:#fff;background-color:navy;"> book now</button></a>
            </div>
        </div>
        <?php
        }
        ?>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
  <script src=" ./js/script.js  "></script>  
</body>
</html>