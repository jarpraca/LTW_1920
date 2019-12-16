<?php
    session_start();
    $db = new PDO('sqlite:../../database/database.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute  (PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    include_once('../../database/habitations.php');
    include_once('../../database/users.php');

    addReservation($_POST['dateFrom'], $_POST['dateTo'], $_POST['guests'], $_POST['precoTotal'], $_GET['idHabitacao'], $_SESSION['user']);
    
    header('Location: ../../homepage.php');
?>