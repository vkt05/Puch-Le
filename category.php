<?php
include './partials/_connection.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thread</title>
    <link rel="stylesheet" href="./public/stylesheets/basic.css">
    <link rel="stylesheet" href="./public/stylesheets/navbar.css">
    <link rel="stylesheet" href="./public/stylesheets/footer.css">
    <link rel="stylesheet" href="./public/stylesheets/category.css">
</head>

<body>
    <div class="category-wrap">
        <?php include './partials/_navbar.php'; ?>
        <div class="main-wrap">
            <?php
            if ($connect) {

                $category_name = $_GET['category_name'];
                $category_id = $_GET['category_id'];

                $sql = 'select * from categories where category_name="' . $category_name . '" and category_id=' . $category_id;
                $query = mysqli_query($connect, $sql);

                if ($query) {

                    while ($row = mysqli_fetch_assoc($query)) {
                        echo '<div class="topic-wrap">
                                        <h1>' . $row['category_name'] . '</h1>
                                        <h4>About:</h4>
                                        <p>' . $row['category_description'] . '</p>
                                </div>';
                    }
                    
                } 
                else {
                    echo 'unable to run cat name query';
                }

                $sql_question = 'select * from questions where category_id=' . $category_id;
                $query_question = mysqli_query($connect, $sql_question);
                
               if ($query_question) {

                $num_row=mysqli_num_rows($query_question);

                 if ($num_row>0) {
                    echo'<div class="ask-question">
                            <form action="./category.php" method="post">
                                <label for="question-area">Ask Question</label>
                                <textarea name="question-area" id="question-area" placeholder="Enter your question here."></textarea>
                                <button type="submit" class="question-ask-btn">Ask</button>
                            </form>
                        </div>';
                    while ($data=mysqli_fetch_assoc($query_question)) {
                        echo'   <div class="question-wrap">

                                </div>';
                    }
                 }
                 else{
                    echo'<div class="ask-question">
                            <form action="./category.php" method="post">
                                <label for="question-area">Ask Question</label>
                                <textarea name="question-area" id="question-area" placeholder="Enter your question here."></textarea>
                                <button type="submit" class="question-ask-btn">Ask</button>
                            </form>
                        </div>';
                    echo'<h2>No question : Be the one to ask</h2>';
                 }

               }
               else {
                echo'question fetchiunf failed';
               }
            }
            else {
                echo 'sorry unable to connect.';
            }
            ?>

            
        </div>
        <?php include './partials/_footer.php'; ?>
    </div>
</body>

</html>