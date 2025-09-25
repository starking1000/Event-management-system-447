<?php
$pageTitle = 'Browse Events';
ob_start();

// Include database connection
require_once CONFIG_PATH . '/database.php';

// Get all events
$sql = "SELECT * FROM events ORDER BY date ASC";
$result = $conn->query($sql);

$additionalCSS = '
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
</style>';
?>

<section class="ServicesContainer">
    <div class="flexa">
        <?php if ($result && $result->num_rows > 0): ?>
            <?php while ($event = $result->fetch_assoc()): ?>
                <div class="service-container">
                    <div class="service-img">
                        <img src="https://cdn4.iconfinder.com/data/icons/office-and-business-conceptual-flat/169/34-512.png" alt="Event">
                    </div>
                    <div class="service-text">
                        <h2><?php echo htmlspecialchars($event['event_name']); ?></h2>
                        <p><strong>Venue:</strong> <?php echo htmlspecialchars($event['venue']); ?></p>
                        <p><strong>Time:</strong> <?php echo htmlspecialchars($event['time']); ?></p>
                        <p><strong>Date:</strong> <?php echo htmlspecialchars($event['date']); ?></p>

                        <?php
                        $currentDate = date("Y-m-d");
                        $eventDate = $event['date'];
                        $diff = abs(round((strtotime($currentDate) - strtotime($eventDate)) / 86400));

                        if (strtotime($eventDate) >= strtotime($currentDate)) {
                            if ($diff <= 1) {
                                echo "<p><strong>Status:</strong> Event is today or tomorrow!</p>";
                            } else {
                                echo "<p><strong>Status:</strong> Event in " . $diff . " days</p>";
                            }
                            echo '<a href="?page=rsvp&event=' . urlencode($event['event_name']) . '">';
                            echo '<button style="width:100px; height:40px;border:none;border-radius:5px;color:#fff;background-color:navy;">RSVP Now</button>';
                            echo '</a>';
                        } else {
                            echo "<p><strong>Status:</strong> Event has passed</p>";
                        }
                        ?>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div style="text-align: center; width: 100%; padding: 50px;">
                <h2>No events available at the moment.</h2>
                <p>Check back later for upcoming events!</p>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php
$content = ob_get_clean();
include APP_PATH . '/Views/layouts/main.php';
?>