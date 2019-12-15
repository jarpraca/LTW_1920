<?php
  include('database/connection.php');
  include('database/habitations.php');
  
  session_start();
  $logedin=true;
  if (!isset($_SESSION['user']))
    header( 'Location: homepage.php' );
  
  include('templates/common/header.php');

  echo '<h2 class="subtitle">My Properties</h2>';

  echo '<div class="list_properties_options">';
  echo '<a href="addProperty.php"><h5>Add Property</h5></a>';
  echo '</div>';

  $properties = getProperties($_SESSION['user']);

  foreach ($properties as $habitation){
    include("templates/properties/viewShortProperty.php");
  }

  include('templates/common/footer.php');
?>