
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
                    {% if user.is_authenticated %}
                    <button style="width:150px;height:50px;border:none;background-color: navy;color:#fff;font-weight: bold;text-transform: uppercase;">{{user.username}}</button>
                    {% else %}
                    <a href="/login.html"><button style="width:150px;height:50px;border:none;background-color: navy;color:#fff;font-weight: bold;cursor:pointer;">Sign in </button></a>
                    {% endif %}
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
    <?php
        include("./Database/db.php");
        session_start();
        if(isset($_POST['username'])){
            $username = stripslashes($_POST['username']);//escapes any slashes from the data input and reads them as texts 
            $username = mysqli_real_escape_string($conn, $username);// escapes any other special characters from the input and reads them as texts
            $password = stripslashes($_POST['password']);
            $password =mysqli_real_escape_string ($conn, $password);
            $sql = "SELECT * FROM `users`  WHERE username='$username' AND password='".md5($password)."'";
            $result = mysqli_query($conn, $sql) or die(mysqli_error());
            $rows = mysqli_num_rows($result);
            if ($rows == 1){
            //Retrieving data from$Session variable
                $_SESSION['username'] = $username;//if username, role and email are valid 
                //redirect to user dashboard
                header("Location:./BookVenue.php");//redirects to dashboard
            
            } else {// if data provided is invalid renders an error message
                echo " <div class='form-container'>Inalid Username/Password'<br/>
                <a href='login.php'>log in</a>
                </div>";
            }
        } else {
    ?>
    <section class="FormCon">
        <form action="" method="POST" style="margin:auto; max-width:500px; width:80vw;">
            <div style="font-size: 20px;margin: 10px; color:white;">Login Here</div><br><br>
            <input id="text" type="text" placeholder="Your name here :" name="username" style="width:100%; height:50px; border:1px solid blue; border-radius:5px" ><br><br>
            <input id="text" type="password" placeholder=" Enter password " name="password" style="width:100%; height:50px; border:1px solid blue; border-radius:5px"><br><br>
            <input id="button" style="width:50%; height:50px; background-color:blue; color:#fff; font-weight:bold; border:none; border-radius:5px;margin:auto; cursor:pointer;" type="submit" value = "Login"> <br><br>
            <a href="register.php">Signup Here</a>
        </form>
        </section><?php }?>
    <
    <secttion class="FooterContainer">
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