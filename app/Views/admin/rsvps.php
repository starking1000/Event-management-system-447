<?php
$pageTitle = 'All RSVPs - Admin';
ob_start();

// Check if user is logged in (basic authentication check)
if (!isset($_SESSION['username'])) {
    echo '<script>window.location.href = "?page=login";</script>';
    exit();
}

// Include database connection
require_once CONFIG_PATH . '/database.php';

// Get all RSVPs
$sql = "SELECT * FROM reservations ORDER BY timestamp DESC";
$result = mysqli_query($conn, $sql);

$additionalCSS = '
<style>
table {
  width: 100%;
  border-collapse: collapse;
  margin: 20px auto;
  max-width: 1200px;
}
tr:nth-of-type(odd) {
  background: navy;
  color: #fff;
}
th {
  background: rgb(100, 100, 255);
  color: white;
  font-weight: bold;
}
td, th {
  padding: 12px;
  border: 1px solid #ccc;
  text-align: left;
}
.admin-header {
  text-align: center;
  margin: 20px 0;
}
.back-link {
  text-align: center;
  margin: 20px;
}
.back-link a {
  background: navy;
  color: white;
  padding: 10px 20px;
  text-decoration: none;
  border-radius: 5px;
}
</style>';
?>

<section class="panel-main">
    <div class="admin-header">
        <h2>All Reservations (RSVPs)</h2>
    </div>

    <div class="back-link">
        <a href="?page=admin">← Back to Admin Panel</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>User Name</th>
                <th>Event Name</th>
                <th>Registration Date</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result && mysqli_num_rows($result) > 0): ?>
                <?php while ($rsvp = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($rsvp['id'] ?? 'N/A'); ?></td>
                        <td><?php echo htmlspecialchars($rsvp['user_name'] ?? 'N/A'); ?></td>
                        <td><?php echo htmlspecialchars($rsvp['event_name'] ?? 'N/A'); ?></td>
                        <td><?php echo htmlspecialchars($rsvp['timestamp'] ?? 'N/A'); ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" style="text-align: center;">No RSVPs found</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</section>

<?php
$content = ob_get_clean();
include APP_PATH . '/Views/layouts/main.php';
?>