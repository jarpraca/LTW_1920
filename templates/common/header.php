<!DOCTYPE html>
<html>
    <head>
        <title> Amazing rentals</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="style.css" rel="stylesheet">
        <link href="layout.css" rel="stylesheet">
        <!--<link href="responsive.css" rel="stylesheet">-->
    </head>
    <body>
        <div class="content">
            <nav id="menu">
            <!-- just for the hamburguer menu in responsive layout -->
            <input type="checkbox" id="hamburger"> 
            <label class="hamburger" for="hamburger"></label> 
            <ul>
                    <li><h3>Amazing Rentals</h3></li>
                    <li>
                        <?php
                            include('search.php');
                        ?>
                    </li>
                    <li><a href="login.php"><h5>Login</h5></a></li>     
                    <li><a href="register.php"><h5>Register</h5></a> </li> 
                </ul>
            </nav>