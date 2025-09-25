<?php
$pageTitle = 'Home';
ob_start();
?>

<!-- Carousel Section -->
<section class="CarouselContainer">
    <div class="carousel">
        <div class="slides">
            <img src="https://source.unsplash.com/1000x200/?school" alt="slide image" class="slide">
            <img src="https://source.unsplash.com/1000x200/?hotel" alt="slide image" class="slide">
            <img src="https://source.unsplash.com/1000x200/?park" alt="slide image" class="slide">
        </div>
        <div class="controls">
            <div class="control prev-slide">&#9668;</div>
            <div class="control next-slide">&#9658;</div>
        </div>
    </div>
</section>

<!-- Our Locations Section -->
<section class="client-area">
    <div class="holder-Header">
        <h3>Our Locations</h3>
    </div>
    <div class="holder">
        <div>
            <img src="https://cdn0.iconfinder.com/data/icons/font-awesome-solid-vol-1/640/church-512.png" alt="Church">
            <h3>Church</h3>
        </div>
        <div>
            <img src="https://cdn3.iconfinder.com/data/icons/education-1-1/256/School-512.png" alt="Schools">
            <h3>Schools</h3>
        </div>
        <div>
            <img src="https://cdn4.iconfinder.com/data/icons/park-and-garden/48/vehicle-gardens-green-_nature-park-_playground-_urban_4-512.png" alt="Parks">
            <h3>Parks</h3>
        </div>
        <div>
            <img src="https://cdn0.iconfinder.com/data/icons/hotel-vacation/33/golf-2-512.png" alt="Golf Course">
            <h3>Golf Course</h3>
        </div>
        <div>
            <img src="https://cdn3.iconfinder.com/data/icons/web-and-devices-set-1/512/Hotels-512.png" alt="Hotels">
            <h3>Hotels</h3>
        </div>
        <div>
            <img src="https://cdn3.iconfinder.com/data/icons/buildings-places/512/Hotels_A-256.png" alt="Conference rooms">
            <h3>Conference rooms</h3>
        </div>
    </div>
</section>

<!-- Event Types Section -->
<section class="carProfileContainer">
    <div class="image-grid">
        <h1>Some Events</h1>

        <div class="grid-left">
            <img class="logo-images" src="https://source.unsplash.com/200x150/?graduation" alt="Graduation Party" />
            <span class="image-description">
                <strong>Graduation Party</strong><br>
                <a href="?page=venues">See Locations</a>
            </span>
        </div>

        <div class="grid-right">
            <img class="logo-images" src="https://source.unsplash.com/200x150/?wedding" alt="Wedding Party" />
            <span class="image-description">
                <strong>Wedding Parties</strong><br>
                <a href="?page=venues">See Locations</a>
            </span>
        </div>

        <div class="grid-left">
            <img class="logo-images" src="https://source.unsplash.com/200x150/?party" alt="Meet ups" />
            <span class="image-description">
                <strong>Meet ups</strong><br>
                <a href="?page=venues">See Locations</a>
            </span>
        </div>

        <div class="grid-right">
            <img class="logo-images" src="https://source.unsplash.com/200x150/?cocktails" alt="Conferences" />
            <span class="image-description">
                <strong>Conferences</strong><br>
                <a href="?page=venues">See Locations</a>
            </span>
        </div>

        <div class="grid-left">
            <img class="logo-images" src="https://source.unsplash.com/200x150/?birthday" alt="Farewell Party" />
            <span class="image-description">
                <strong>Farewell Parties</strong><br>
                <a href="?page=venues">See Locations</a>
            </span>
        </div>

        <div class="grid-right">
            <img class="logo-images" src="https://source.unsplash.com/200x150/?graduation" alt="End year Party" />
            <span class="image-description">
                <strong>End Year Parties</strong><br>
                <a href="?page=venues">See Locations</a>
            </span>
        </div>
        <div style="clear:both"></div>
    </div>
</section>

<?php
$content = ob_get_clean();
include APP_PATH . '/Views/layouts/main.php';
?>