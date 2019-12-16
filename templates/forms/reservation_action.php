<?php
function generate_random_token() {
    return bin2hex(openssl_random_pseudo_bytes(32));
  }
  session_start();
  session_regenerate_id(true);

  if (!isset($_SESSION['csrf'])) {
    $_SESSION['csrf'] = generate_random_token();
  }    
  if ($_SESSION['csrf'] !== $_POST['csrf']) {
    header('Location: ../../homepage.php');
  }
  $db = new PDO('sqlite:../../database/database.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute  (PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    include_once('../../database/habitations.php');
    include_once('../../database/users.php');

    addReservation($_POST['dateFrom'], $_POST['dateTo'], $_POST['guests'], $_POST['precoTotal'], $_GET['idHabitacao'], $_SESSION['user']);
    
    header('Location: ../../homepage.php');
?>