<?php
include './partials/_connection.php';
session_start();
$question_added=false;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php $category_name = $_GET['category_name'];  echo $category_name;?></title>
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

            function question_id_generator()
            {
                $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
                $unique_question_id = substr(
                    str_shuffle($str_result),
                    0,
                    7
                );
                return $unique_question_id;
            }

            if ($connect) {

// Getting data from form to submit questions.

                if($_SERVER['REQUEST_METHOD']=="POST"){

                    $question_id = question_id_generator();

                    $question_id_sql = 'select question_id from questions';

                    try {

                     $question_id_query = mysqli_query($connect,$question_id_sql);
                     while ($question_ids = mysqli_fetch_assoc($question_id_query)) {
                         if ($question_id == $question_ids) {

                            $question_id = question_id_generator();

                            } else {
                             $question_id = $question_id;
                            }
                        }
                    } catch (mysqli_sql_exception) {

                    echo 'Some error occured please try again later';
                    }

                    $question=$_POST['question-area'];
                    $category_id = $_GET['category_id'];
                    $userId=$_SESSION['userId'];
                    $question_sql='insert into questions (user_id,category_id,question_id,question) values("'.$userId.'","'.$category_id.'","'.$question_id.'","'.$question.'")';
                    $question_query=mysqli_query($connect,$question_sql);
                    if ($question_query) {
                        $question_added=true;
                    }else{
                        echo mysqli_error($connect);
                    }

                }


                if ($_SERVER['REQUEST_URI']=='/PuchhLe/category.php') {
                    header('location: ./categories.php');
                }else{
                $category_name = $_GET['category_name'];
                $category_id = $_GET['category_id'];

// fetching category name and description and showing on category page for questions showing:

                $sql = 'select * from categories where category_name="'.$category_name.'" and category_id="'.$category_id.'"';
                $query = mysqli_query($connect, $sql);
                if ($query) {

                    while ($row = mysqli_fetch_assoc($query)) {
                        echo '<div class="topic-wrap">
                                        <h1>' . $row['category_name'] . '</h1>
                                        <h4>About:</h4>
                                        <p>' . $row['category_description'] . '</p>
                                </div>';

                    }
                } else {
                    echo 'unable to run cat name query';
                }

// fetching questions of category:

                $sql_question = 'select * from questions where category_id="'.$category_id.'"';

                $query_question = mysqli_query($connect, $sql_question);

                if ($query_question) {

                    $num_row = mysqli_num_rows($query_question);

                    if ($num_row > 0) {

                        if (isset($_SESSION['name']) && isset($_SESSION['userId'])) {
                            if($question_added==true){
                                echo '<div><h3>Your question is added.</h3>';
                            }

                            echo '<div class="ask-question">
                            <form></form>
                                 <form action="/PuchhLe/category.php?category_name='.$category_name.'&category_id='.$category_id.'" method="POST">
                                    <label for="question-area">Ask Question</label>
                                    <textarea name="question-area" id="question-area" placeholder="Enter your question here."></textarea>
                                    <button type="submit" class="question-ask-btn">Ask</button>
                                </form>
                            </div>';
                        } else {
                            echo'<div><h3>You are not logged in please login to ask question.</h3></div>';
                        }

                        while ($data = mysqli_fetch_assoc($query_question)) {

                            $date_of_asked=$data['date_of_asked'];
                            $question=$data['question'];
                            $question_id=$data['question_id'];

                            $user_sql='select * from users where user_id="'.$data['user_id'].'"';

                            $user_query=mysqli_query($connect,$user_sql);

                            if ($user_query) {

                                $user_data=mysqli_fetch_assoc($user_query);
                                $user_fname = $user_data['first_name'];
                                $user_lname = $user_data['last_name'];

                                echo '   <div class="question-wrap">
                                        <img src="./public/images/profile_default.svg" alt="profile-pic">
                                        <div class="user-question-wrap">
                                            <div class="user-wrap">
                                                <h3>'.$user_fname.' '.$user_lname.'</h3>
                                                <p>'.$date_of_asked.'</p>
                                            </div>
                                            <p class="question"><a class="question-a" href="./question.php?ques_id='.$question_id.'">'.$question.'</a></p>
                                        </div>
                                    </div>';
                            }
                            else {
                                echo 'facing some problem in fetchting questions from server please try again later.';
                            }

                        }

                    } else {
                        if (isset($_SESSION['name']) && isset($_SESSION['userId'])) {
                            if($question_added){
                                echo '<div><h3>Your question is added.</h3>';
                            }
                            echo '<div class="ask-question">
                            <form></form>
                                <form action="/PuchhLe/category.php?category_name='.$category_name.'&category_id='.$category_id.'" method="POST">
                                    <label for="question-area">Ask Question</label>
                                    <textarea name="question-area" id="question-area" placeholder="Enter your question here."></textarea>
                                    <button type="submit" class="question-ask-btn">Ask</button>
                                </form>
                            </div>';
                            echo '<h2>No question : Be the one to ask</h2>';
                        }
                        else {
                            echo'<div><h3>You are not logged in please login to ask question.</h3></div>';
                        }
                    }

                } else {
                    echo 'question fetching failed';
                }
            }
                
            } else {
                echo 'sorry unable to connect.';
            }
            ?>

        </div>
        <?php include './partials/_footer.php'; ?>
    </div>
</body>

</html>