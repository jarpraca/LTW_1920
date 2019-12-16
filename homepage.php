<?php
  session_start();
  $logedin=false;
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