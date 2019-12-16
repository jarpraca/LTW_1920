<?php
    session_start();
    $db = new PDO('sqlite:../../database/database.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute  (PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    include_once('../../database/habitations.php');
    include_once('../../database/users.php');

    $id = $_GET['id'];
    updateHabitation($id, $_POST['name'], $_POST['numberBedrooms'], $_POST['numberGuests'], $_POST['address'], $_POST['priceNight'], $_POST['cleaningTax'], $_POST['country'], $_POST['city'], $_POST['types'], $_POST['policies'], $_POST['description'], $_POST['latitude'], $_POST['longitude']);
    
    print_r($_FILES);

    // -------- Images ---------
   
    if(is_array($_FILES['pictures'])){
        for ($i = 0; $i < count($_FILES['pictures']["name"]); $i++){
         
            $allowedExts = array("jpeg", "jpg", "png");
            $temp = explode(".", $_FILES['pictures']["name"][$i]);
            $extension = end($temp);
            if ((($_FILES['pictures']["type"][$i] == "image/jpeg")
                    || ($_FILES['pictures']["type"][$i] == "image/jpg")
                    || ($_FILES['pictures']["type"][$i] == "image/pjpeg")
                    || ($_FILES['pictures']["type"][$i] == "image/x-png")
                    || ($_FILES['pictures']["type"][$i] == "image/png"))
                && ($_FILES['pictures']["size"][$i] < 50000000)
                && in_array($extension, $allowedExts)) {
                if ($_FILES['pictures']["error"][$i] > 0) {
                    echo "Return Code: " . $_FILES['pictures']["error"][$i] . "<br>";
                }
                else {
                    $name = $_FILES['pictures']["name"][$i];
                    $ext = explode(".", $name)[1];
                    $fileName = "images/" . $id . "-" . $i . "." . $ext;
                    if(move_uploaded_file($_FILES['pictures']['tmp_name'][$i], "../../".$fileName)){
                        addImage($id, $fileName, $_POST['name'] . "'s Photo");
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

    $amenities_array = json_decode($_POST['amenities_array']);
    $agenda_array = json_decode($_POST['agenda_array']);

    if(is_array($amenities_array)){
        foreach ($amenities_array as $amenity){
            addAmenity($_GET['id'], $amenity);
        }
    }

    if(is_array($agenda_array)){
        foreach ($agenda_array as $agenda){
            addAgenda($_GET['id'], $agenda[0], $agenda[1]);
        }
    }

    //header( 'Location: ../../listProperties.php');
?>