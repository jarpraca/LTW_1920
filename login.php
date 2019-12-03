<?php
  session_start();
  $logedin=false;
  if (isset($_SESSION))
    $logedin=true;
  include('templates/common/header.php');
  include('templates/forms/login.php');
  include('templates/common/footer.php');
?>