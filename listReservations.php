<?php
  include('database/connection.php');
  include('database/habitations.php');
  
  function generate_random_token() {
    return bin2hex(openssl_random_pseudo_bytes(32));
  }
  session_start();
  session_regenerate_id(true);

  if (!isset($_SESSION['csrf'])) {
    $_SESSION['csrf'] = generate_random_token();
  }
    $logedin=true;
  if (!isset($_SESSION['user']))
    header( 'Location: homepage.php' );
    $displaySearch = true;
  
  include('templates/common/header.php');

  $reservations = getReservationsByClient($_SESSION['user']);

  echo '<h2 class="subtitle">My Reservations</h2>';

  $properties = array();

  foreach ($reservations as $reservationId){
    $reservation = getReservationById($reservationId['idReserva']);
    $property = getHabitationById($reservation['idHabitacao']);
    array_push($properties, $property);
  }

  echo '<section class="listPropertiesMap">';
    echo '<aside id="map">';
      include('templates/properties/map.php');
    echo '</aside>';
    echo '<section id="propertiesSection">';
      foreach ($reservations as $reservationId){
        $reservation = getReservationById($reservationId['idReserva']);
        include("templates/properties/viewShortReservation.php");
      }
    echo '</section>';
  echo '</section>';

  include('templates/common/footer.php');
?>