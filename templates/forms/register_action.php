<?php
function generate_random_token() {
    return bin2hex(openssl_random_pseudo_bytes(32));
  }
  session_start();
  if (!isset($_SESSION['csrf'])) {
    $_SESSION['csrf'] = generate_random_token();
  }    $db = new PDO('sqlite:../../database/database.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute  (PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    include_once('../../database/users.php');
    createUser(password_hash($_POST['password'], PASSWORD_BCRYPT), $_POST['primeiroNome'], $_POST['ultimoNome'], $_POST['dateofbirth'], $_POST['email'], $_POST['phone'], $_POST['country']);
    $user=getUserByEmail($_POST['email']);
    
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

    $_SESSION['user']=$user['idUtilizador'];
    header( 'Location: ../../homepage.php' ) ;
?>