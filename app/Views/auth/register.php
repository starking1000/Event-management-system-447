<?php
$pageTitle = 'Register';
ob_start();

// Include database connection
require_once CONFIG_PATH . '/database.php';

// Check if form is submitted
if (isset($_POST['username'])) {
    $username = stripslashes($_POST['username']);
    $username = mysqli_real_escape_string($conn, $username);
    $email = stripslashes($_POST['email']);
    $email = mysqli_real_escape_string($conn, $email);
    $password = stripslashes($_POST['password']);
    $password = mysqli_real_escape_string($conn, $password);

    // Check if username already exists
    $checkUser = "SELECT * FROM users WHERE username='$username' OR email='$email'";
    $result = mysqli_query($conn, $checkUser);

    if (mysqli_num_rows($result) > 0) {
        $error = "Username or email already exists";
    } else {
        // Insert new user
        $sql = "INSERT INTO users (username, role, email, password) VALUES ('$username', 'user', '$email', '" . md5($password) . "')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $success = "Registration successful! You can now log in.";
        } else {
            $error = "Something went wrong. Please try again.";
        }
    }
}
?>

<section class="FormCon">
    <?php if (isset($error)): ?>
        <div class="alert alert-error" style="color: red; text-align: center; margin: 20px;">
            <?php echo htmlspecialchars($error); ?>
        </div>
    <?php endif; ?>

    <?php if (isset($success)): ?>
        <div class="alert alert-success" style="color: green; text-align: center; margin: 20px;">
            <?php echo htmlspecialchars($success); ?><br>
            <a href="?page=login" style="color: lightgreen;">Go to Login</a>
        </div>
    <?php else: ?>
        <form action="?page=register" method="POST" style="margin:auto; max-width:500px; width:80vw;">
            <div style="font-size: 20px;margin: 10px; color:white;">Sign Up Here</div><br><br>
            <input id="text" type="text" placeholder="Your username here" name="username"
                style="width:100%; height:50px; border:1px solid blue; border-radius:5px" required><br><br>
            <input id="text" type="email" placeholder="Your email here" name="email"
                style="width:100%; height:50px; border:1px solid blue; border-radius:5px" required><br><br>
            <input id="text" type="password" placeholder="Enter password" name="password"
                style="width:100%; height:50px; border:1px solid blue; border-radius:5px" required><br><br>
            <input id="button" style="width:50%; height:50px; background-color:blue; color:#fff; font-weight:bold; border:none; border-radius:5px; margin:auto; cursor:pointer;"
                type="submit" value="Sign Up"><br><br>
            <p style="text-align: center; color: white;">
                Already have an account? <a href="?page=login" style="color: lightblue;">Login here</a>
            </p>
        </form>
    <?php endif; ?>
</section>

<?php
$content = ob_get_clean();
include APP_PATH . '/Views/layouts/main.php';
?>