<?php
include './partials/_connection.php';
session_start();
$connectionErr = false;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>categories</title>
    <link rel="stylesheet" href="./public/stylesheets/basic.css">
    <link rel="stylesheet" href="./public/stylesheets/navbar.css">
    <link rel="stylesheet" href="./public/stylesheets/footer.css">
    <link rel="stylesheet" href="./public/stylesheets/categories.css">
</head>

<body>
    <div id="cat-body-wrap">
        <?php
        include './partials/_navbar.php';
        ?>
        <div id="categories-wrapper">

            <?php
            if ($connect) {
                $sql = "select * from categories";
                
                $query = mysqli_query($connect, $sql);

                while ($row = mysqli_fetch_assoc($query)) {

                    echo ' <div class="category">
                  <div class="img">
                      <img src="'.$row['category_img'].'" alt="image">
                  </div>
                  <h2>'.$row['category_name'].'</h2>
                  <button class="lets-go"><a href="/PuchLe/category.php?category_name='.$row['category_name'].'&category_id='.$row['category_id'].'">Let\'s Go</a></button>
              </div>';
                }
            } else {
                echo "connection problem try again later.";
            }
            ?>

        </div>
        <?php
        include './partials/_footer.php';
        ?>
    </div>
</body>

</html>