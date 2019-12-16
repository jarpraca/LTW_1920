<?php
  function generate_random_token() {
    return bin2hex(openssl_random_pseudo_bytes(32));
  }
  session_start();
  if (!isset($_SESSION['csrf'])) {
    $_SESSION['csrf'] = generate_random_token();
  }  
  $logedin=true;
  if (!isset($_SESSION['user']))
    header( 'Location: homepage.php' );
  
  $displaySearch = true;
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