<!DOCTYPE html>
<html>
    <head>
        <title> Amazing rentals</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="style.css" rel="stylesheet">
        <link href="layout.css" rel="stylesheet">
        <link href="responsive.css" rel="stylesheet">
    </head>
    <body>
        <div class="content">
            <nav id="menu">
            <!-- just for the hamburguer menu in responsive layout -->
            <input type="checkbox" id="hamburger"> 
            <label class="hamburger" for="hamburger"></label> 
            <ul>
                <li><a href="homepage.php"><h3>Amazing Rentals</h3></a></li>
                <li>
                    <?php
                        include('templates/common/search.php');
                    ?>
                </li>
                    <?php
                    if ($logedin){ ?>
                        <li>
                            <div class="dropdown">
                                <h5>My Area</h5>
                                <div class="dropdown-content">
                                    <a href="editProfile.php"><p>Edit Profile</p></a>
                                    <a href="listProperties.php"><p>My Properties</p></a>
                                    <a href="listReservations.php"><p>My Reservations</p></a>
                                    <a href="templates/forms/logout.php"><p>Logout</p></a>
                                </div>
                            </div>
                        </li>
                    <?php }
                    else{ ?>
                        <li>
                            <a href="login.php"><h5>Login</h5></a>
                            <a href="register.php"><h5>Register</h5></a>
                        </li>
                    <?php } ?>
            </ul>
        </nav>