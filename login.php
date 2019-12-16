<?php
  function generate_random_token() {
    return bin2hex(openssl_random_pseudo_bytes(32));
  }
  session_start();
  if (!isset($_SESSION['csrf'])) {
    $_SESSION['csrf'] = generate_random_token();
  }
  $logedin=false;
  if (isset($_SESSION['user']))
    header( 'Location: homepage.php' );
    $displaySearch = true;

  include('templates/common/header.php');
  include('templates/forms/login.php');
  include('templates/common/footer.php');
?>