<?php
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
        <div id="nav-search">
        <ul><li class="login-sign-nav-btn"> <button><a href="./login.php">Log In</a></button><button><a href="./signup.php">Sign Up</a></button></li></ul>
            <input id="search-input" type="text" placeholder="Search">
            <button id="search-btn">Search</button>
        </div>
    </nav>
</header>';
?>