<?php
include './partials/_connection.php';
 session_start();
function sanitize($input){
    $input = trim($input);
    $input = stripcslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}

if (empty($_GET["search_query"]) || sanitize($_GET["search_query"])==""){

    $fname_err = "Cannot be empty";
    echo $fname_err;
}
else{
    echo "not empty :)";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./public/stylesheets/basic.css">
    <link rel="stylesheet" href="./public/stylesheets/navbar.css">
    <link rel="stylesheet" href="./public/stylesheets/footer.css">
</head>

<body>
    <?php include './partials/_navbar.php'; ?>
    
    <?php include './partials/_footer.php'; ?>
</body>

</html>