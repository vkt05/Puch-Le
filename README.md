Author: Vishal Tiwari

What is puchh_le?
puchh_le is a forum application in which you can ask web development related questions and answer also to the question other people asked.

how to use?
first you have to login and then you can go to categories section by click on navbar (At top) then you can choose which category related question you are going to ask select that category and ask your question.

*************** FOR DEVELOPERS WHO WANT TO USE THIS AS A PROJECT ***************

-> It is open to use no need to pay anything.
-> Just follow these steps to configure thyis app:
    1. Pull repo. in your folder and open in code editor.
    2. Install XAMPP.(start your php and mysql)
    3. Go to phpmyadmin and create a database named as "pucch-le".
    4. Now inside this database you have to create tables with fields:
      TABLES:
        a. categories
          fields(columns):
            ->category_id
            ->category_name
            ->category_description
            ->category_img
        b.comments
          fields(columns):
            ->user_id	
            ->question_id	
            ->comment_id	
            ->comment	
            ->date_of_comment	
        c.questions
          fields(columns):
            ->user_id
            ->category_id
            ->question_id
            ->question
            ->date_of_asked
        d.users
          fields(columns):
            ->user_id
            ->first_name
            ->last_name
            ->user_email
            ->user_password
            
