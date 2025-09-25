<?php
$pageTitle = 'Book a Venue';
ob_start();

// Include database connection
require_once CONFIG_PATH . '/database.php';

// Get all venues
$sql = "SELECT * FROM venues ORDER BY venue_name ASC";
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
            <?php while ($venue = $result->fetch_assoc()): ?>
                <div class="service-container">
                    <div class="service-img">
                        <img src="https://cdn1.iconfinder.com/data/icons/leto-travel-vacation/64/__hotel_resort_vacation-512.png" alt="Venue">
                    </div>
                    <div class="service-text">
                        <h2><?php echo htmlspecialchars($venue['venue_name']); ?></h2>
                        <p><?php echo htmlspecialchars($venue['description'] ?? 'Beautiful venue for your events'); ?></p>
                        <p><strong>Location:</strong> <?php echo htmlspecialchars($venue['location']); ?></p>
                        <p><strong>Capacity:</strong> <?php echo htmlspecialchars($venue['capacity']); ?> people</p>
                        <?php if (!empty($venue['price'])): ?>
                            <p><strong>Price:</strong> KSh <?php echo htmlspecialchars($venue['price']); ?></p>
                        <?php endif; ?>

                        <a href="?page=create-event&venue=<?php echo urlencode($venue['venue_name']); ?>">
                            <button style="width:120px; height:40px;border:none;border-radius:5px;color:#fff;background-color:navy;">
                                Book Now
                            </button>
                        </a>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div style="text-align: center; width: 100%; padding: 50px;">
                <h2>No venues available at the moment.</h2>
                <p>Please contact us for custom venue arrangements.</p>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php
$content = ob_get_clean();
include APP_PATH . '/Views/layouts/main.php';
?>