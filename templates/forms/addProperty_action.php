<?php
    session_start();
    $db = new PDO('sqlite:../../database/database.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute  (PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    include_once('../../database/habitations.php');
    include_once('../../database/users.php');
    $id=insertHabitation($_POST['name'], $_POST['numberBedrooms'], $_POST['numberGuests'], $_POST['address'], $_POST['priceNight'], $_POST['cleaningTax'], $_POST['country'], $_POST['city'], $_POST['types'], $_POST['policies'], $_POST['description'], $_POST['latitude'], $_POST['longitude'], $_SESSION['user']);
    
    // -------- Images ---------
    if(is_array($_FILES['pictures'])){
        for ($i = 1; $i <= count($_FILES['pictures']); $i++){
            $path = "../../images/$id.jpg";
            move_uploaded_file($_FILES['pictures']['tmp_name'][$i], $path);
            addImage($id, $path, $_POST['name'] . "'s Photo");
            
            $allowedExts = array("jpeg", "jpg", "png");
            $temp = explode(".", $_FILES['pictures']["name"][$i]);
            $extension = end($temp);
            if ((($_FILES['pictures']["type"][$i] == "image/jpeg")
                    || ($_FILES['pictures']["type"][$i] == "image/jpg")
                    || ($_FILES['pictures']["type"][$i] == "image/pjpeg")
                    || ($_FILES['pictures']["type"][$i] == "image/x-png")
                    || ($_FILES['pictures']["type"][$i] == "image/png"))
                && ($_FILES['pictures']["size"][$i] < 500000)
                && in_array($extension, $allowedExts)) {
                if ($_FILES['pictures']["error"][$i] > 0) {
                    echo "Return Code: " . $_FILES['pictures']["error"][$i] . "<br>";
                }
                else {
                    $ext = end(explode(".", $_FILES['pictures']["name"][$i]));
                    $fileName = "images" . $id . "-" . $i . $ext;
                    if(move_uploaded_file($_FILES['pictures']['tmp_name'][$i], $originalFileName)){
                        addImage($id, $originalFileName, $_POST['name'] . "'s Photo");
                    }
                    else{
                        echo 'Error uploading file.';
                    }
                }   
            } 
            else {
                echo "<div class='alert alert-success'>Image type or size is not valid.</div>";
            }
        }
    }
    else if(is_file($_FILES['pictures'])){
        $path = "images" . $id . "-1" . $ext;
        move_uploaded_file($_FILES['pictures']['tmp_name'], "../../" . $path);
        addImage($id, $path, $_POST['name'] . "'s Photo");
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