<?php
$pageTitle = 'Login';
ob_start();

// Include database connection
require_once CONFIG_PATH . '/database.php';

// Check if form is submitted
if (isset($_POST['username'])) {
    $username = stripslashes($_POST['username']);
    $username = mysqli_real_escape_string($conn, $username);
    $password = stripslashes($_POST['password']);
    $password = mysqli_real_escape_string($conn, $password);

    $sql = "SELECT * FROM `users` WHERE username='$username' AND password='" . md5($password) . "'";
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    $rows = mysqli_num_rows($result);

    if ($rows == 1) {
        $_SESSION['username'] = $username;
        header("Location: ?page=venues");
        exit();
    } else {
        $error = "Invalid Username/Password";
    }
}
?>

<section class="FormCon">
    <?php if (isset($error)): ?>
        <div class="alert alert-error" style="color: red; text-align: center; margin: 20px;">
            <?php echo htmlspecialchars($error); ?>
        </div>
    <?php endif; ?>

    <form action="?page=login" method="POST" style="margin:auto; max-width:500px; width:80vw;">
        <div style="font-size: 20px;margin: 10px; color:white;">Login Here</div><br><br>
        <input id="text" type="text" placeholder="Your username here" name="username"
            style="width:100%; height:50px; border:1px solid blue; border-radius:5px" required><br><br>
        <input id="text" type="password" placeholder="Enter password" name="password"
            style="width:100%; height:50px; border:1px solid blue; border-radius:5px" required><br><br>
        <input id="button" style="width:50%; height:50px; background-color:blue; color:#fff; font-weight:bold; border:none; border-radius:5px; margin:auto; cursor:pointer;"
            type="submit" value="Login"><br><br>
        <p style="text-align: center; color: white;">
            Don't have an account? <a href="?page=register" style="color: lightblue;">Sign up here</a>
        </p>
    </form>
</section>

<?php
$content = ob_get_clean();
include APP_PATH . '/Views/layouts/main.php';
?>