<?php
// session_start();
echo '<header>
    <nav>
        <div id="logo">
            <h2><a href="./index.php">PuchhLe</a></h2>
        </div>
        <div id="nav-items">
            <ul>
                <li><a href="/PuchLe/categories.php">Categories</a></li>
                <li><a href="/PuchLe/about.php">About Us</a></li>
                <li><a href="/PuchLe/contact.php">Contact Us</a></li>
            </ul>
        </div>
        <div id="nav-search">';
        if (!isset($_SESSION['name']) && !isset($_SESSION['userId'])) {
           echo '<ul><li class="login-sign-nav-btn"> <button><a href="./login.php">Log In</a></button><button><a href="./signup.php">Sign Up</a></button></li></ul>';
        }else{
            echo '<ul><li class="login-sign-nav-btn"> <button><a href="./logout.php">Log Out</a></button></li></ul>';
        }
        echo '<form action="./search.php?" method="GET" id="nav-form">
            <input name="search_query" id="search-input" type="text" placeholder="Search">
            <button id="search-btn">Search</button>
        </div>
    </nav>
</header>';
?>