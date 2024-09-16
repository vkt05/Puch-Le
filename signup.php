<?php
include './partials/_connection.php';
$submitted=false;
$server_issue=false;
$empty_field=false;
$wrong_password=false;
$duplicate=false;
$database_connection=false;

if ($connect) {
    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        $fname = $_POST['signup-fname'];
        $lname = $_POST['signup-lname'];
        $email = $_POST['signup-email'];
        $password = $_POST['signup-password'];
        $cpassword = $_POST['signup-cpassword'];

        if ($fname == "" | $lname == "" | $email == "" | $password == "") {
            $empty_field = true;
        } else {
            if ($password == $cpassword) {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $signup_sql = 'insert into users (first_name,last_name,user_email,user_password) values ("' . $fname . '","' . $lname . '","' . $email . '","' . $hashed_password . '")';
                try {
                    $signup_query = mysqli_query($connect, $signup_sql);
                    if ($signup_query) {
                        $submitted = true;
                    }
                } catch (mysqli_sql_exception) {
                    echo mysqli_error($connect);
                    $duplicate = true;
                }
            } else {
                $wrong_password = true;
            }
        }
    } 
}else{$database_connection=true;}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
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

                <form action="./signup.php" method="POST">
                    <?php
                    if($database_connection==true){
                        echo '<h3 class="stop">Sorry! we are facing some technical issue connection</h3>';
                    } elseif ($submitted == true) {
                        echo '<h3 class="go">Signed Up! now you can log in.</h3>';
                    } elseif ($empty_field == true) {
                        echo '<h3 class="wait">Please fill form properly, don\'t leave blank</h3>';
                    } elseif ($wrong_password == true) {
                        echo '<h3 class="wait">password did not match with confirm password</h3>';
                    } elseif ($duplicate == true) {
                        echo '<h3 class="stop">Email already exist, try another email or login.</h3>';
                    }
                    ?>
                    <h1>Sign Up</h1>
                    <div class="login-signup-input">
                        <label for="signup-fname">First Name</label>
                        <input type="text" placeholder="Enter your first name" name="signup-fname" id="login-signup-email">
                    </div>
                    <div class="login-signup-input">
                        <label for="signup-lname">Last Name</label>
                        <input type="text" placeholder="Enter your last name" name="signup-lname" id="login-signup-email">
                    </div>
                    <div class="login-signup-input">
                        <label for="signup-email">Email</label>
                        <input type="email" placeholder="Enter your email" name="signup-email" id="login-signup-email">
                    </div>
                    <div class="login-signup-input">
                        <label for="signup-password">Password</label>
                        <input type="password" placeholder="Enter your password" name="signup-password" id="login-signup-email">
                    </div>
                    <div class="login-signup-input">
                        <label for="signup-cpassword">Confirm Password</label>
                        <input type="password" placeholder="Confirm password" name="signup-cpassword" id="login-signup-email">
                    </div>
                    <button class="login-signup-send">Sign Up</button>
            </div>
            </form>
        </div>
        <?php include './partials/_footer.php'; ?>
    </div>
</body>

</html>