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
                <form action="" method="post">
                    <h1>Log In</h1>
                    <div class="login-signup-input">
                        <label for="login-email">Email</label>
                        <input type="email" placeholder="Enter your email" name="login-email" id="login-signup-email">
                    </div>
                    <div class="login-signup-input">
                        <label for="login-password">Password</label>
                        <input type="email" placeholder="Enter your password" name="login-password" id="login-signup-email">
                    </div>
                    <button class="login-signup-send">Log In</button>
            </div>
            </form>
        </div>
        <?php include './partials/_footer.php'; ?>
    </div>
</body>
</html>