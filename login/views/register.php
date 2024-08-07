<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travelquartet Register</title>
    <link rel="stylesheet" href="views/style_register.css">
</head>
<body>
    <div class="login-container">
        <img class="logo" src="LOGO.jpg" alt="Logo Travelquartet"/>
        <h2>Daftar untuk mengakses fitur terbaik TRAVELQUARTET</h2>

        <?php
        if (isset($registration)) {
            if ($registration->errors) {
                foreach ($registration->errors as $error) {
                    echo $error;
                }
            }
            if ($registration->messages) {
                foreach ($registration->messages as $message) {
                    echo $message;
                }
            }
        }
        ?>

        <form method="post" action="register.php" name="registerform">
            <label for="login_input_username">Username (only letters and numbers, 2 to 64 characters)</label>
            <input id="login_input_username" class="login_input" type="text" pattern="[a-zA-Z0-9]{2,64}" name="user_name" required />

            <label for="login_input_email">User's email</label>
            <input id="login_input_email" class="login_input" type="email" name="user_email" required />

            <label for="login_input_password_new">Password (min. 6 characters)</label>
            <input id="login_input_password_new" class="login_input" type="password" name="user_password_new" pattern=".{6,}" required autocomplete="off" />

            <label for="login_input_password_repeat">Repeat password</label>
            <input id="login_input_password_repeat" class="login_input" type="password" name="user_password_repeat" pattern=".{6,}" required autocomplete="off" />
            
            <input type="submit" name="register" value="Register" />
        </form>

        <a href="index.php">Back to Login Page</a>
    </div>
</body>
</html>
