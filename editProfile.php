<?php
  session_start();
  $logedin=false;
  if (isset($_SESSION))
    $logedin=true;
  include('templates/common/header.php');
?>
  <section id="profile">
    <header>
          <h1> Edit Profile </h1>
    </header>
<?php
  include('templates/forms/profile.php');
?>
  </section>
<?php
  include('templates/common/footer.php');
?>