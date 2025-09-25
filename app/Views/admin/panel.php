<?php
$pageTitle = 'Admin Panel';
ob_start();

// Check if user is logged in (basic authentication check)
if (!isset($_SESSION['username'])) {
    echo '<script>window.location.href = "?page=login";</script>';
    exit();
}

$additionalCSS = '
<style>
.panel-container{
  display: flex;
  flex-direction: row;
  width:100vw;
  justify-content: space-around;
  flex-wrap: wrap;
}
.panel-item{
  width:300px;
  height: 200px;
  border-radius:5px;
  border:1px solid blue;
  margin:30px;
  text-align:center;
  padding: 20px;
  background-color: #f8f9fa;
}
.panel-item h4 {
  color: navy;
  margin-bottom: 20px;
}
.panel-item a {
  display: block;
  margin: 10px 0;
  padding: 10px;
  background-color: navy;
  color: white;
  text-decoration: none;
  border-radius: 5px;
}
.panel-item a:hover {
  background-color: #000080;
}
</style>';
?>

<section class="panel-main">
    <div style="text-align: center; padding: 20px;">
        <h2>Admin Panel</h2>
        <p>Manage your event management system</p>
    </div>

    <div class="panel-container">
        <div class="panel-item">
            <h4>👥 Users</h4>
            <a href="?page=admin-users">View All Users</a>
            <a href="?page=admin-rsvps">View All RSVPs</a>
        </div>

        <div class="panel-item">
            <h4>📅 Events</h4>
            <a href="?page=admin-events">View All Events</a>
            <a href="?page=create-event">Create New Event</a>
        </div>

        <div class="panel-item">
            <h4>🏢 Venues</h4>
            <a href="?page=admin-venues">View All Venues</a>
            <a href="?page=create-venue">Add New Venue</a>
        </div>

        <div class="panel-item">
            <h4>💰 Payments</h4>
            <a href="?page=admin-payments">View Payments</a>
            <a href="?page=reports">Generate Reports</a>
        </div>
    </div>
</section>

<?php
$content = ob_get_clean();
include APP_PATH . '/Views/layouts/main.php';
?>