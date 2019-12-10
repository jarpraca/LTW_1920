<?php
  session_start();
  $logedin=false;
  if (isset($_SESSION['user']))
    header( 'Location: homepage.php' );
  include('templates/common/header.php');
  include('templates/forms/login.php');
  include('templates/common/footer.php');
?>