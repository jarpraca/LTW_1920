<?php
  session_start();
  $logedin=true;
  include('templates/common/header.php');
  $action_form="templates/formseditProfile_action.php";
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