<?php
    session_start();
    $db = new PDO('sqlite:../../database/database.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute  (PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    include_once('../../database/habitations.php');
    include_once('../../database/users.php');

    $anonimous=false;
    if (isset($_POST['anonimous'])){
        $anonimous=true;
    }
    addComment($_GET['id'], $_POST['cleaning'], $_POST['value'], $_POST['checkIn'], $_POST['location'], $_POST['description'], $anonimous);
    header( 'Location: ../../viewProperty.php?id=' . $_GET['id'] . '&' . $_GET['dateFrom'] . '&' . $_GET['dateTo'] );
?>