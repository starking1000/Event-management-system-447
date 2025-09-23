<?php 
// session_start();

// include("connection.php");
// include("functions.php");

// if(isset($_POST['submit']))
// {
//     //WHEN SOMEONE HAS POSTED 
//     $user_name = $_POST[ 'user_name'];
//     $password = $_POST['password'];
//     if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
//     { 
//         $user_id = random_num; 
//         $query = "Insert into users(user_id,user_name,password) values ('$user_id','$user_name','$password')";    
//         $res=mysqli_query($con, $query);
//         header("Location: login.php");
//         //die;
//     }else
//     {
//         echo "Please enter some valid information"; 
//     }
    


// }
?>
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
           <a href="Service.html"><button>Services</button> </a>
           <a href="Team.html"><button>Our Team</button> </a>
           <a href="Gallery.html"><button>Gallery</button> </a>
           <a href="Recovery.html"><button>UNIQ Recovery</button> </a>
           <a href="Contact.html"><button>Contact Us</button></a> 
        </div>
        <div class="header-container-sub">
            <button id="more"> <img src="./img/burgerbtn.png " alt="" id="more-btn" style="width:100px; height:50px;">  </button> 
            <a href="/"><button class="active">Home</button></a>
            <a href="Service.html"><button>Services</button></a>
            <a href="Team.html"><button>Our Team</button></a> 
            <a href="Gallery.html"><button>Gallery</button> </a>
            <a href="Recovery.html"><button>UNIQ Recovery</button> </a>
            <a href="Contact.html"><button>Contact Us</button></a> 
        </div>
    </section>
    <?php
        include("./Database/db.php");
        if (isset($_POST['username'])){//Check if username is set or is null
            $username = stripslashes($_POST['username']);//escapes lashes are reads them as texts
            $username = mysqli_real_escape_string($conn, $username);//escapes any other special characters and reads them as texts
            $email = stripslashes($_POST['email']);//$request is  used to collect data after submitting an HTML form.
            $email = mysqli_real_escape_string($conn, $email);
            // $role = stripslashes($_POST['role']);
            // $role = mysqli_real_escape_string($conn, $role);
            $password = stripslashes($_POST['password']);
            $password = mysqli_real_escape_string($conn, $password);
        
    
            // Performing insert query execution
            $sql = "INSERT INTO users VALUES (NULL,'$username','user','$email','".md5($password)."') ";//insert fetched data to the users table
            //check in db if the provided username and password exists in the user table
            //md5(Message digest 5) is an harshing algorithm another harshing algorithms includes SHA(Secure hash Algorithm) 
            $result = mysqli_query($conn, $sql);//store data fetched from db to $result variable
    
         if ($result)
         //If data is stored to the database, Display this message and redirect to log in page
         {
             echo " <div class='header-container'>REGISTRATION SUCCESSFUL'<br/>
             <a href='login.php'><button style='border:1px solid #fff'>log in</button></a>
             </div>";
         } 
         else 
         //if the data is not stored in the database, display the following message and redirect to register.php page
         {
             echo "<div class='header-container'>SOMETHING'S MISSING'<br/>
             <a href='register.php'>Register</a>
             </div>";
         }
        }
        //}
         else 
        //Return to the Sign up page
        {
           
    ?>
    <section class="FormCon">
            <form action="" method="POST" style="margin:auto; max-width:500px; width:80vw;">
                <div style="font-size: 20px;margin: 10px; color:white;">Sign Up Here</div><br><br>
                <input id="text" type="text" placeholder="Your name here :" style="width:100%; height:50px; border:1px solid blue; border-radius:5px"   name="username" ><br><br>
                <input id="text" type="email" placeholder="Your email here :"  style="width:100%; height:50px; border:1px solid blue; border-radius:5px"  name="email" ><br><br>
                <input id="text" type="password" placeholder=" Enter password "  style="width:100%; height:50px; border:1px solid blue; border-radius:5px"  name="password"><br><br>
                <input id="button" style="width:50%; height:50px; background-color:blue; color:#fff; font-weight:bold; border:none; border-radius:5px;margin:auto; cursor:pointer;" type="submit" value = "Sign Up"> <br><br>
                <p style="font-size:15 px;color:white">If  You Have Already Signed Up<p>
                <a href="login.php">Login Here</a>

            </form>
    </section>
    <?php
    }
    ?>
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