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

  foreach ($reservations as $reservationId){
    $reservation = getReservationById($reservationId['idReserva']);
    include("templates/properties/viewShortReservation.php");
  }

  include('templates/common/footer.php');
?>