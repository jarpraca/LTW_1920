<?php
  session_start();
  $logedin=true;
  if (!isset($_SESSION['user']))
    header( 'Location: homepage.php' );
  include('templates/common/header.php');
  $action_form="templates/forms/addProperty_action.php";

  $name="";
  $type="";
  $numberGuests="1";
  $numberBedrooms="1";
  $priceNight="0";
  $tax="0";
  $description="";
  $latitude="0";
  $longitude="0";
  $address="";
  $city="";
  $country="";
  $policy="";
  $image="";
  $amenities_array_var=[];
  $agenda_array=[];
?>
  <section id="addProperty">
  <header>
        <h1> Add Property </h1>
  </header>
<?php
  include('templates/forms/property.php');
?>
  </section>
<?php
  include('templates/common/footer.php');
?>