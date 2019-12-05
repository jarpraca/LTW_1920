<?php
    session_start();
    $logedin=false;
    if (isset($_SESSION['user']))
        $logedin=true;
    include('templates/common/header.php');
    include_once('database/connection.php');
    include_once('database/habitations.php');

    if (!isset($_GET['id']))
    die("No id!");

    if (!isset($_GET['dateFrom']))
    die("No dateFrom!");

    if (!isset($_GET['dateTo']))
    die("No dateTo!");

    $habitation = getHabitationById($_GET['id']);
    $dateFrom = $_GET['dateFrom'];
    $dateTo = $_GET['dateTo'];

    include('templates/properties/viewProperty.php');
    include('templates/common/footer.php');
?>