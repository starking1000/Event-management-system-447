<?php
$pageTitle = 'RSVP to Event';
ob_start();

// Include database connection
require_once CONFIG_PATH . '/database.php';

$event_name = isset($_GET['event']) ? $_GET['event'] : '';

// Handle form submission
if (isset($_POST['user_name'])) {
    $user_name = stripslashes($_POST['user_name']);
    $user_name = mysqli_real_escape_string($conn, $user_name);
    $event_name_form = stripslashes($_POST['event_name']);
    $event_name_form = mysqli_real_escape_string($conn, $event_name_form);

    $sql = "INSERT INTO reservations (user_name, event_name, timestamp) VALUES ('$user_name', '$event_name_form', NOW())";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $success = "RSVP successful! You are registered for this event.";
    } else {
        $error = "Error registering for event. Please try again.";
    }
}

$additionalCSS = '
<style>
.form-container{
    width:100%;
    max-width: 500px;
    margin: 50px auto;
    padding: 20px;
    background: rgba(255,255,255,0.9);
    border-radius: 10px;
}
.form-container input{
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
            <a href="?page=events" style="color: green;">Browse More Events</a>
        </div>
    <?php endif; ?>

    <div class="form-container">
        <h3 style="text-align:center; color: navy; margin-bottom: 30px;">RSVP to Event</h3>

        <form method="POST">
            <input type="text" name="user_name" placeholder="Your Full Name" required>
            <input type="text" name="event_name" value="<?php echo htmlspecialchars($event_name); ?>" placeholder="Event Name" readonly>
            <button type="submit">RSVP Now</button>
        </form>
    </div>
</section>

<?php
$content = ob_get_clean();
include APP_PATH . '/Views/layouts/main.php';
?>