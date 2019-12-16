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

  echo '<section class="listPropertiesMap">';
  echo '<aside id="map">';
  include('templates/properties/map.php');
  echo '</aside>';
  echo '<section id="propertiesSection">';
  foreach ($properties as $habitation){
    include("templates/properties/viewShortProperty.php");
  }
  echo '</section>';
  echo '</section>';

  include('templates/common/footer.php');
?>