# Puch-Le

This is a forum website where people can ask questions about defined categories.

## Description

Puch-Le is a forum application where users can post questions related to web development and provide answers to questions asked by others.

## Features

- User authentication and login system
- Categories section for organizing questions
- Ability to ask and answer questions
- User-friendly interface

## Getting Started

### Prerequisites

Before you begin, ensure you have met the following requirements:

- You have installed [XAMPP](https://www.apachefriends.org/index.html)
- You have a working internet connection

### Installation

To install Puch-Le, follow these steps:

1. Clone the repository to your local machine:
   ```bash
   git clone https://github.com/vkt05/Puch-Le.git

2.Create a folder named PuchhLe and move all the cloned files into this folder:
    mkdir PuchhLe
    mv Puch-Le/* PuchhLe/

3.Open XAMPP and start Apache and MySQL.

4.Go to phpMyAdmin and create a new database named pucch-le.

5.Create the following tables within the pucch-le database:

      categories

        category_id
        category_name
        category_description
        category_img
        
    comments

        user_id
        question_id
        comment_id
        comment
        date_of_comment
        
    questions

        user_id
        category_id
        question_id
        question
        date_of_asked
        
    users

        user_id
        first_name
        last_name
        user_email
        user_password


Usage
Open your web browser and navigate to http://localhost/PuchhLe.
Register a new account or login with your credentials.
Navigate to the categories section using the navbar at the top.
Select a category and ask your question.

Contributing
Contributions are welcome! Please follow these steps:

1.Fork the repository.

2.Create a new branch:
    git checkout -b feature/your-feature
3.Make your changes and commit them:
    git commit -m 'Add some feature'
4.Push to the branch:
    git push origin feature/your-feature
5.Open a pull request.

AUTHOR: Vishal Tiwari
