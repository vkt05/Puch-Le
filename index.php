<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PuchhLe - A forum were you can ask question on defined topics. </title>
    <link rel="stylesheet" href="./public/stylesheets/index.css">
    <link rel="stylesheet" href="./public/stylesheets/navbar.css">
    <link rel="stylesheet" href="./public/stylesheets/basic.css">
    <link rel="stylesheet" href="./public/stylesheets/footer.css">

</head>

<body>
    <div id="body-wrap">
        <div id="nav-wrap">
            <?php
            include './partials/_navbar.php';
            ?>
        </div>
        <div id="main-wrap">
            <main>

                <div class="section">
                    <div class="ani-image-what">
                        <img id="what-img" src="./public/animations/Girl Finding No Document In An Empty Folder 3D Illustration (HD).png" alt="Image">
                    </div>
                    <div class="text-wrap">
                        <h1>What is PuchhLe ?</h1>
                        <p>PucchLe is forum where anyone can ask questions about <strong>WEB DEVELOPMENT</strong> and anyone can answer these questions which helps in troubleshooting problems more quickly.</p>
                    </div>
                </div>

                <div class="section">
                    <div class="text-wrap">
                        <h1>How to use PucchLe ?</h1>
                        <p>
                        <ol>
                            <li>LogIn to PucchLe by clicking on login button.</li>
                            <li> Go to categories tab.</li>
                            <li> Now you can ask or reply an answer for any question.</li>
                            <li class="login-sign-home-btn"> <button><a href="./login.php">Log In</a></button><button><a href="./signup.php">Sign Up</a></button></li>
                        </ol>
                        </p>
                    </div>

                    <div class="ani-image-how">
                        <img id="how-img" src="./public/animations/Learn Together.png" alt="Image">
                    </div>

                </div>
            </main>
        </div>
        <div id="footer-wrap">
            <?php
            include './partials/_footer.php';
            ?>
        </div>
    </div>
</body>

</html>