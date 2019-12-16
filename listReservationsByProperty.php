<?php
  include('database/connection.php');
  include('database/habitations.php');
  
  function generate_random_token() {
    return bin2hex(openssl_random_pseudo_bytes(32));
  }
  session_start();
  if (!isset($_SESSION['csrf'])) {
    $_SESSION['csrf'] = generate_random_token();
  }

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