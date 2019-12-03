<?php
  session_start();
  $logedin=false;
  if (isset($_SESSION))
    $logedin=true;
  include('templates/common/header.php');
?>
  <section id="editProperty">
  <header>
        <h1> Edit Property </h1>
  </header>
<?php
  include('templates/forms/property.php');
?>
  </section>
<?php
  include('templates/common/footer.php');
?>