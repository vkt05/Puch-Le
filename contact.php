<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="./public/stylesheets/basic.css">
    <link rel="stylesheet" href="./public/stylesheets/navbar.css">
    <link rel="stylesheet" href="./public/stylesheets/footer.css">
    <link rel="stylesheet" href="./public/stylesheets/contact.css">
</head>

<body>
    <div id="contact-wrap">
        <?php include './partials/_navbar.php'; ?>
        <div class="contact">
            <div class="form-wrap">
                <form action="">
                    <h1>Contact Us</h1>
                    <div class="contact-input">
                        <label for="conatact-email">Email</label>
                        <input type="email" placeholder="Email" name="conatact-email" id="contact-email">
                    </div>
                    <div class="contact-textarea">
                        <label for="conatact-textarea">Feedback</label>
                        <textarea name="conatact-textarea" id="contact-textarea" placeholder="Enter your problem here."></textarea>
                    </div>
                    <button class="contact-send">Send</button>
            </div>
            </form>
        </div>
        <?php include './partials/_footer.php'; ?>
    </div>
</body>

</html>