<?php
    $db = new PDO('sqlite:../../database/database.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute  (PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    include_once('../../database/users.php');
    $user=getUserByEmail($_POST['email']);
    $password_read=$_POST['password'];
    $hashedPassword=getUserPassword($user['idUtilizador']);
    if (password_verify($password_read, $hashedPassword)){
        $_SESSION['user']=$user['idUtilizador'];
        header( 'Location: ../../homepage.php' ) ;
    }
    else{
        echo "<script type='text/javascript'>alert('Username and/or Password incorrect.\\nTry again.');</script>";
        echo '<script type="text/javascript">
        window.location = "../../login.php";
            </script>';
    }
?>