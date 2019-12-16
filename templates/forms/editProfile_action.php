<?php
    session_start();
    $db = new PDO('sqlite:../../database/database.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute  (PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    include_once('../../database/users.php');
    $id=$_SESSION['user'];
    modifyUser($id, $_POST['password'], $_POST['primeiroNome'], $_POST['ultimoNome'], $_POST['dateofbirth'], $_POST['email'], $_POST['phone'], $_POST['country']);
    
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
                    $fileName = "images/" . $id . "." . $ext;
                    if(move_uploaded_file($_FILES['pictures']['tmp_name'][$i], "../../" . $fileName)){
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

    header( 'Location: ../../homepage.php' ) ;
?>