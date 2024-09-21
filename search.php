<?php
include './partials/_connection.php';
 session_start();
function sanitize($input){
    $input = trim($input);
    $input = stripcslashes($input);
    $input = htmlspecialchars($input);
    return $input;
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
    <link rel="stylesheet" href="./public/stylesheets/search.css">
</head>

<body>
    <?php include './partials/_navbar.php'; ?>
    <div id="search-wrap">
    <?php

        $search_query=$_GET['search_query'];
        echo'<div id="search-for-wrap"><h1>Searched result for: <em>`'.$search_query.'`</em></h1></div>';
        if (empty($_GET["search_query"]) || sanitize($_GET["search_query"])==""){
            echo 'Search field can not leave empty.';
        }
        else{
            $search_sql='select * from questions where match (question) against ("'.$search_query.'")';
            $search_query=mysqli_query($connect,$search_sql);
            $num_row=mysqli_num_rows($search_query);
            if($num_row>0){
            while($search_row=mysqli_fetch_assoc($search_query)){

                $question=$search_row['question'];
                $question_id=$search_row['question_id'];
                $date_of_asked=$search_row['date_of_asked'];
                $user_id=$search_row['user_id'];
                $user_sql='select * from users where user_id="'.$user_id.'"';
                $user_query=mysqli_query($connect,$user_sql);
                $user_row=mysqli_fetch_assoc($user_query);
                $user_fname=$user_row['first_name'];
                $user_lname=$user_row['last_name'];

                echo' <div class="question-wrap">
                            <img src="./public/images/profile_default.svg" alt="profile-pic">
                            <div class="user-question-wrap">
                                <div class="user-wrap">
                                     <h3>'.$user_fname.' '.$user_lname.'</h3>
                                    <p>'.$date_of_asked.'</p>
                                </div>
                                <p class="question"><a class="question-a" href="./question?ques_id='.$question_id.'">'.$question.'</a></p>
                             </div>
                        </div>';
            }
        }else {
            echo 'NOT FOUND';
        }
        }

    ?>
    </div>
    <?php include './partials/_footer.php'; ?>
</body>

</html>