<?php
  include('database/connection.php');
  include('database/habitations.php');
  
  session_start();
  $logedin=true;
  if (!isset($_SESSION['user']))
    header( 'Location: homepage.php' );
  
  include('templates/common/header.php');

  $reservations = getReservationsByClient($_SESSION['user']);

  echo '<h2 class="subtitle">My Reservations</h2>';

  $properties = array();

  foreach ($reservations as $reservationId){
    $reservation = getReservationById($reservationId['idReserva']);
    $property = getHabitationById($reservation['idHabitacao']);
    array_push($properties, $property);
  }

  echo '<section id="listPropertiesMap">';
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