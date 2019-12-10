<?php
    session_start();
    $db = new PDO('sqlite:../../database/database.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute  (PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    include_once('../../database/users.php');
    $id=$_SESSION['user'];
    modifyUser($id, $_POST['password'], $_POST['primeiroNome'], $_POST['ultimoNome'], $_POST['dateofbirth'], $_POST['email'], $_POST['phone'], $_POST['country']);
    if($_POST['picture']!=""){
        //mising type verification
        if(is_uploaded_file($_POST['picture']))
            if(move_uploaded_file($_POST['picture'], "../../images" . $user['idUtilizador'] . ".png"))
                addPhotoProfile($user['idUtilizador'], $user['idUtilizador'] . ".png", $_POST['name'] . " Photo");
    }
    header( 'Location: ../../homepage.php' ) ;
?>