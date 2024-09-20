<?php

include './partials/_connection.php';

session_start();

$database_connection = false;
$empty_field = false;
$wrong_credentials = false;

if ($connect) {

    if (isset($_SESSION['name']) || isset($_SESSION['userId'])) {

        header('location: ./categories.php');
    } else {

        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            $entered_email = $_POST['login-email'];
            $entered_password = $_POST['login-password'];

            if ($entered_email == "" || $entered_password == "") {
                $empty_field = true;
            } else {
                $login_sql = 'select * from users where user_email="'.$entered_email.'"';
                try {
                    $login_query = mysqli_query($connect, $login_sql);

                    $row=mysqli_num_rows($login_query);

                    if ($row==1) {

                        $login_data = mysqli_fetch_assoc($login_query);

                        if (password_verify($entered_password, $login_data['user_password'])) {

                            $_SESSION['name'] = $login_data['first_name'];
                            $_SESSION['userId'] = $login_data['user_id'];
                            header('location: ./categories.php');

                        }else {
                            $wrong_credentials = true;
                        }

                    } else {
                        $wrong_credentials = true;
                    }
                } catch (mysqli_sql_exception) {

                    $database_connection = true;
                }
            }
        }
    }
} else {
    $database_connection = true;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <link rel="stylesheet" href="./public/stylesheets/basic.css">
    <link rel="stylesheet" href="./public/stylesheets/navbar.css">
    <link rel="stylesheet" href="./public/stylesheets/footer.css">
    <link rel="stylesheet" href="./public/stylesheets/login-signup.css">
</head>

<body>
    <div id="login-signup-wrap">
        <?php include './partials/_navbar.php'; ?>
        <div class="login-signup">
            <div class="form-wrap">
            <form></form>
                <form action="./login.php" method="POST" id="login-signup-form">
                    <?php
                    if ($database_connection == true) {
                        echo '<h3 class="stop">Sorry! we are facing some technical issue.</h3>';
                    } elseif ($empty_field == true) {
                        echo '<h3 class="wait">Please fill form properly, don\'t leave blank.</h3>';
                    } elseif ($wrong_credentials == true) {
                        echo '<h3 class="wait">Sorry! Can\'t login either email or password is wrong.</h3>';
                    }
                    ?>
                    <h1>Log In</h1>
                    <div class="login-signup-input">
                        <label for="login-email">Email</label>
                        <input type="email" placeholder="Enter your email" name="login-email" class="login-signup-email">
                    </div>
                    <div class="login-signup-input">
                        <label for="login-password">Password</label>
                        <input type="password" placeholder="Enter your password" name="login-password" class="login-signup-email">
                    </div>
                    <button class="login-signup-send">Log In</button>
                </form>
            </div>
        </div>
        <?php include './partials/_footer.php'; ?>
    </div>
</body>

</html>