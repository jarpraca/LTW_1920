<?php
function generate_random_token() {
    return bin2hex(openssl_random_pseudo_bytes(32));
  }
  session_start();
  session_regenerate_id(true);

  if (!isset($_SESSION['csrf'])) {
    $_SESSION['csrf'] = generate_random_token();
  }
      $db = new PDO('sqlite:../../database/database.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute  (PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    include_once('../../database/habitations.php');
    include_once('../../database/users.php');

    if ($_SESSION['csrf'] !== $_POST['csrf']) {
        header('Location: ../../homepage.php');
    }

    $anonimous=false;
    if (isset($_POST['anonimous'])){
        $anonimous=true;
    }
    addComment($_GET['id'], $_POST['cleaning'], $_POST['value'], $_POST['checkIn'], $_POST['location'], $_POST['description'], $anonimous);
    
    if (isset($_GET['dateFrom']) && isset($_GET['dateTo']))
        header( 'Location: ../../viewProperty.php?id=' . $_GET['id'] . '&dateFrom=' . $_GET['dateFrom'] . '&dateTo=' . $_GET['dateTo'] );
    else
    header( 'Location: ../../viewProperty.php?id=' . $_GET['id']);
?>