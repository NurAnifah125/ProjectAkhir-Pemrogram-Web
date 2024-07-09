<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travelquartet Login</title>
    <link rel="stylesheet" href="views/style_login.css">
</head>
<body>
    <div class="login-container">
        <img class="logo" src="LOGO.jpg" alt=" " style="width: 100%; height: 150px;"/>
        <h2>Masuk untuk mengakses fitur terbaik TRAVELQUARTET</h2>

        <?php
        if (isset($login)) {
            if ($login->errors) {
                foreach ($login->errors as $error) {
                    echo $error;
                }
            }
            if ($login->messages) {
                foreach ($login->messages as $message) {
                    echo $message;
                }
            }
        }
        ?>

        <form method="post" action="index.php" name="loginform">
            <label for="login_input_username">Username</label>
            <input id="login_input_username" class="login_input" type="text" name="user_name" required />

            <label for="login_input_password">Password</label>
            <input id="login_input_password" class="login_input" type="password" name="user_password" autocomplete="off" required />

            <input type="submit" name="login" value="Log in" />
        </form>

        <a href="register.php">Register new account</a>
    </div>
</body>
</html>
