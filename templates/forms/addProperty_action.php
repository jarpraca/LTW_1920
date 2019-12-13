<?php
    session_start();
    $db = new PDO('sqlite:../../database/database.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute  (PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    include_once('../../database/habitations.php');
    include_once('../../database/users.php');
    $id=insertHabitation($_POST['name'], $_POST['numberBedrooms'], $_POST['numberGuests'], $_POST['address'], $_POST['priceNight'], $_POST['cleaningTax'], $_POST['country'], $_POST['city'], $_POST['types'], $_POST['policies'], $_POST['description'], $_SESSION['user']);
    
    // -------- Images ---------
    foreach ($_FILES['picture']['filesToUpload'] as $file){
        $allowedExts = array("jpeg", "jpg", "png");
        $temp = explode(".", $file["name"]);
        $extension = end($temp);
        if ((($file["type"] == "image/jpeg")
                || ($file["type"] == "image/jpg")
                || ($file["type"] == "image/pjpeg")
                || ($file["type"] == "image/x-png")
                || ($file["type"] == "image/png"))
            && ($file["size"] < 500000)
            && in_array($extension, $allowedExts)) {
            if ($file["error"] > 0) {
                echo "Return Code: " . $file["error"] . "<br>";
            }
            else {
                $ext = end(explode(".", $file["name"]));
                $fileName = "images" . $user['id'] . $ext;
                if(move_uploaded_file($file['tmp_name'], $fileName)){
                    addPhotoProfile($user['idUtilizador'], $fileName, $_POST['primeiroNome'] . "'s Photo");
                }
            }   
        } 
        else {
            echo "<div class='alert alert-success'>Image type or size is not valid.</div>";
        }
    }

    $amenities_array = json_decode($_POST['amenities_array']);
    $agenda_array = json_decode($_POST['agenda_array']);
    
    foreach ($amenities_array as $amenity){
        addAmenity($id, $amenity);
    }
    foreach ($agenda_array as $agenda){
        addAgenda($id, $agenda[0], $agenda[1]);
    }

    header( 'Location: ../../listProperties.php' ) ;
?>