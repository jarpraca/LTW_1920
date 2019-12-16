<?php
function generate_random_token() {
  return bin2hex(openssl_random_pseudo_bytes(32));
}
session_start();
if (!isset($_SESSION['csrf'])) {
  $_SESSION['csrf'] = generate_random_token();
}  $logedin=false;
  $displaySearch = false;
  if (isset($_SESSION['user']))
    $logedin=true;
  include('templates/common/header.php');
?>
  <div id="homepage">
    <div class="homepageForm">
      <?php
        include('templates/common/search.php');
      ?>    
    </div>
  </div>
<?php
  include('templates/common/footer.php');
?>