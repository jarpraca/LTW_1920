<?php
  session_start();
  $logedin=false;
  if (isset($_SESSION['user']))
        header( 'Location: homepage.php' );
  include('templates/common/header.php');
  $action_form="templates/forms/register_action.php";

  $firstName="";
  $lastName="";
  $birth="";
  $email="";
  $phone="";
  $country="";
  $picture="";
?>
  <section id="profile">
  <header>
        <h1> Register </h1>
  </header>
<?php
  include('templates/forms/profile.php');
?>
  </section>
<?php
  include('templates/common/footer.php');
?>