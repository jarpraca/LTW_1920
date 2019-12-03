<?php
  session_start();
  session_destroy();
  $_SESSION['id']='1';
  $logedin=false;
  if (isset($_SESSION['id']))
    $logedin=true;
  include('templates/common/header.php');
?>
  <div id="homepage">
<?php
  include('templates/common/search.php');
?>
  </div>
<?php
  include('templates/common/footer.php');
?>