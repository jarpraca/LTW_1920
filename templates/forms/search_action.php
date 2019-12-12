<?php
    session_start();
    $db = new PDO('sqlite:../../database/database.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute  (PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    include_once('../../database/habitations.php');
    include_once('../../database/users.php');
    header( 'Location: ../../listSearch.php?location='.$_GET['location'].'&dateFrom='.$_GET['dateFrom'].'&dateTo='.$_GET['dateTo'].'&types='.$_POST['types'].'&minNumberGuests='.$_POST['minNumberGuests'].'&minNumberBedrooms='.$_POST['minNumberBedrooms'].'&minPriceNight='.$_POST['minPriceNight'].'&maxPriceNight='.$_POST['maxPriceNight'] );
?>