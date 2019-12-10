<?php
  include('database/connection.php');
  include('database/habitations.php');
  
  session_start();
  $logedin=true;
  if (!isset($_SESSION['user']))
    header( 'Location: homepage.php' );
  
  include('templates/common/header.php');

  $properties = getProperties($_SESSION['user']);

  foreach ($properties as $habitation){
    include("templates/properties/viewShortProperty.php");
  }

  include('templates/common/footer.php');
?>