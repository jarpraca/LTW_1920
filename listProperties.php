<?php
  include('database/connection.php');
  include('database/habitations.php');
  
  function generate_random_token() {
    return bin2hex(openssl_random_pseudo_bytes(32));
  }
  session_start();
  if (!isset($_SESSION['csrf'])) {
    $_SESSION['csrf'] = generate_random_token();
  }  $logedin=true;
  if (!isset($_SESSION['user']))
    header( 'Location: homepage.php' );
    $displaySearch = true;
  
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