<?php
  include('database/connection.php');
  include('database/habitations.php');
  
  session_start();
  $logedin=true;
  if (!isset($_SESSION['user']))
    header( 'Location: homepage.php' );
  $owner = getOwner($_GET['id'])['idUtilizador'];
  if ($_SESSION['user']!=$owner)
    header( 'Location: homepage.php' );
  
    $displaySearch = true;
  
  include('templates/common/header.php');

  $reservations = getReservationsByProperty($_GET['id']);

  foreach ($reservations as $reservationId){
    $reservation = getReservationById($reservationId['idReserva']);
    include("templates/properties/viewShortReservation.php");
  }

  include('templates/common/footer.php');
?>