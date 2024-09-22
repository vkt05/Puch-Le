<?php
include './partials/_connection.php';
session_start();
$comment_added=false;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php 
    $sql_question = 'select * from questions where question_id="'.$_GET['ques_id'].'"';
    $query_question = mysqli_query($connect, $sql_question);
    $question_data=mysqli_fetch_assoc($query_question);
    echo $question_data['question'];
    ?></title>
    <link rel="stylesheet" href="./public/stylesheets/basic.css">
    <link rel="stylesheet" href="./public/stylesheets/navbar.css">
    <link rel="stylesheet" href="./public/stylesheets/footer.css">
    <link rel="stylesheet" href="./public/stylesheets/question.css">
</head>

<body>
    <div class="category-wrap">
        <?php include './partials/_navbar.php'; ?>
        <div class="main-wrap">
            <?php

            function comment_id_generator()
            {
                $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
                $unique_comment_id = substr(
                    str_shuffle($str_result),
                    0,
                    7
                );
                return $unique_comment_id;
            }

            if ($connect) {

// Getting data from form to submit questions.

                if($_SERVER['REQUEST_METHOD']=="POST"){

                    $comment_id = comment_id_generator();

                    $comment_id_sql = 'select comment_id from comments';

                    try {

                     $comment_id_query = mysqli_query($connect,$comment_id_sql);
                     while ($comment_ids = mysqli_fetch_assoc($comment_id_query)) {
                         if ($comment_id == $comment_ids) {

                            $comment_id = comment_id_generator();

                            } else {
                             $comment_id = $comment_id;
                            }
                        }
                    } catch (mysqli_sql_exception) {

                    echo 'Some error occured please try again later';
                    }

                    $question_id = $_GET['ques_id'];
                    $comment=$_POST['comment-area'];
                    $userId=$_SESSION['userId'];

                    $comment_sql='insert into comments (user_id,question_id,comment_id,comment) values("'.$userId.'","'.$question_id.'","'.$comment_id.'","'.$comment.'")';
                    $comment_query=mysqli_query($connect,$comment_sql);
                    if ($comment_query) {
                        $comment_added=true;
                    }else{
                        echo mysqli_error($connect);
                    }

                }


                if ($_SERVER['REQUEST_URI']=='/PuchhLe/question.php') {
                    header('location: ./categories.php');
                }else{
                    $sql_question = 'select * from questions where question_id="'.$_GET['ques_id'].'"';
                    $query_question = mysqli_query($connect, $sql_question);
                    

                if ($query_question) {

                    while ($question_data=mysqli_fetch_assoc($query_question)) {

                        $sql_user = 'select * from users where user_id="'.$question_data['user_id'].'"';
                        $query_user = mysqli_query($connect, $sql_user);
                        $user_data=mysqli_fetch_assoc($query_user);

                        echo '<div class="topic-wrap">
                                        <h3>'.$user_data['first_name'].' '.$user_data['last_name'].'</h3>
                                        <h4>'.$question_data['question'].'</h4>
                                        
                                </div>';

                    }
                } else {
                    echo 'unable to run cat name query';
                }

// fetching questions of category:

                $sql_comment = 'select * from comments where question_id="'.$_GET['ques_id'].'"';

                $query_comment = mysqli_query($connect, $sql_comment);

                if ($query_comment) {

                    $num_row = mysqli_num_rows($query_comment);

                    if ($num_row > 0) {

                        if (isset($_SESSION['name']) && isset($_SESSION['userId'])) {
                            if($comment_added==true){
                                echo '<div><h3>Your comment is added.</h3>';
                            }

                            echo '<div class="ask-comment">
                            <form></form>
                                 <form action="/PuchhLe/question.php?ques_id='.$_GET['ques_id'].'" method="POST">
                                    <label for="comment-area">Add your comment :</label>
                                    <textarea name="comment-area" id="comment-area" placeholder="Enter your comment here."></textarea>
                                    <button type="submit" class="comment-ask-btn">Comment</button>
                                </form>
                            </div>';
                        } else {
                            echo'<div><h3>You are not logged in please login comment.</h3></div>';
                        }

                        while ($data = mysqli_fetch_assoc($query_comment)) {

                            $date_of_comment=$data['date_of_comment'];
                            $comment=$data['comment'];

                            $user_sql='select * from users where user_id="'.$data['user_id'].'"';

                            $user_query=mysqli_query($connect,$user_sql);

                            if ($user_query) {

                                $user_data=mysqli_fetch_assoc($user_query);
                                $user_fname = $user_data['first_name'];
                                $user_lname = $user_data['last_name'];

                                echo '   <div class="comment-wrap">
                                        <img src="./public/images/profile_default.svg" alt="profile-pic">
                                        <div class="user-comment-wrap">
                                            <div class="user-wrap">
                                                <h3>'.$user_fname.' '.$user_lname.'</h3>
                                                <p>'.$date_of_comment.'</p>
                                            </div>
                                            <p class="comment comment-a">'.$comment.'</a></p>
                                        </div>
                                    </div>';
                            }
                            else {
                                echo 'facing some problem in fetchting comment from server please try again later.';
                            }

                        }

                    } else {
                        if (isset($_SESSION['name']) && isset($_SESSION['userId'])) {
                            if($comment_added){
                                echo '<div><h3>Your comment is added.</h3>';
                            }
                            echo '<div class="ask-comment">
                            <form></form>
                                 <form action="/PuchhLe/question.php?ques_id='.$_GET['ques_id'].'" method="POST">
                                    <label for="comment-area">Add your comment :</label>
                                    <textarea name="comment-area" id="comment-area" placeholder="Enter your comment here."></textarea>
                                    <button type="submit" class="comment-ask-btn">Comment</button>
                                </form>
                            </div>';
                            echo '<h2>No comment : Be the one to comment.</h2>';
                        }
                        else {
                            echo'<div><h3>You are not logged in please login to comment.</h3></div>';
                        }
                    }

                } else {
                    echo 'comment fetching failed';
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

<!-- elements use if needed -->
<!-- use in line no. 101 if needed: <p>'.$question_data['date_of_asked'].'</p> -->