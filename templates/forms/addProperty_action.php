<?php
    session_start();
    $db = new PDO('sqlite:../../database/database.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute  (PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    include_once('../../database/habitations.php');
    include_once('../../database/users.php');
    $id=insertHabitation($_POST['name'], $_POST['numberBedrooms'], $_POST['numberGuests'], $_POST['address'], $_POST['priceNight'], $_POST['cleaningTax'], $_POST['country'], $_POST['city'], $_POST['types'], $_POST['policies'], $_POST['description'], $_SESSION['user']);
    //Mising images processing
    /*if($_POST['picture']!=""){
        //mising type verification
        if(is_uploaded_file($_POST['picture']))
            if(move_uploaded_file($_POST['picture'], "../../images" . $user['idUtilizador'] . ".png"))
                addPhotoProfile($user['idUtilizador'], $user['idUtilizador'] . ".png", $_POST['name'] . " Photo");
    }*/
    header( 'Location: ../../homepage.php' ) ;
?>