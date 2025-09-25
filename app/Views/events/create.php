<?php
$pageTitle = 'Create Event';
ob_start();

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    echo '<script>window.location.href = "?page=login";</script>';
    exit();
}

// Include database connection
require_once CONFIG_PATH . '/database.php';

$venue_name = isset($_GET['venue']) ? $_GET['venue'] : '';

// Handle form submission
if (isset($_POST['event_name'])) {
    $event_name = stripslashes($_POST['event_name']);
    $event_name = mysqli_real_escape_string($conn, $event_name);
    $venue = stripslashes($_POST['venue']);
    $venue = mysqli_real_escape_string($conn, $venue);
    $max_capacity = (int)$_POST['max_capacity'];
    $time = stripslashes($_POST['time']);
    $date = stripslashes($_POST['date']);

    $sql = "INSERT INTO events (event_name, venue, max_capacity, time, date) VALUES ('$event_name', '$venue', '$max_capacity', '$time', '$date')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $success = "Event created successfully!";
    } else {
        $error = "Error creating event. Please try again.";
    }
}

$additionalCSS = '
<style>
.form-container{
    width:100%;
    max-width: 700px;
    margin: 50px auto;
    padding: 20px;
    background: rgba(255,255,255,0.9);
    border-radius: 10px;
}
.form-container input, .form-container select{
    width:100%;
    height:50px;
    border:1px solid navy;
    border-radius:5px;
    margin-top:20px;
    padding: 0 15px;
    font-size: 16px;
}
.form-container button {
    width:100%;
    height:50px;
    background-color:navy;
    color:#fff;
    border:none;
    border-radius:5px;
    margin-top:20px;
    font-size: 16px;
    font-weight: bold;
    cursor:pointer;
}
.form-container button:hover {
    background-color: #000080;
}
</style>';
?>

<section class="FormCon">
    <?php if (isset($error)): ?>
        <div style="color: red; text-align: center; margin: 20px;">
            <?php echo htmlspecialchars($error); ?>
        </div>
    <?php endif; ?>

    <?php if (isset($success)): ?>
        <div style="color: green; text-align: center; margin: 20px;">
            <?php echo htmlspecialchars($success); ?><br>
            <a href="?page=events" style="color: green;">View All Events</a>
        </div>
    <?php endif; ?>

    <div class="form-container">
        <h3 style="text-align:center; color: navy; margin-bottom: 30px;">Create New Event</h3>
        <?php if (!empty($venue_name)): ?>
            <h5 style="text-align:center; margin-bottom: 20px;">Creating event at: <?php echo htmlspecialchars($venue_name); ?></h5>
        <?php endif; ?>

        <form method="POST">
            <input type="text" name="event_name" placeholder="Event Name" required>
            <input type="text" name="venue" value="<?php echo htmlspecialchars($venue_name); ?>" placeholder="Venue Name" required>
            <input type="number" name="max_capacity" placeholder="Maximum Capacity" min="1" required>
            <input type="time" name="time" required>
            <input type="date" name="date" min="<?php echo date('Y-m-d'); ?>" required>
            <button type="submit">Create Event</button>
        </form>
    </div>
</section>

<?php
$content = ob_get_clean();
include APP_PATH . '/Views/layouts/main.php';
?>