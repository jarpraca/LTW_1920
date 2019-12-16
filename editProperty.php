<?php
  include('database/connection.php');
  include('database/habitations.php');
  
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
  $owner = getOwner($_GET['id'])['idUtilizador'];
  if ($_SESSION['user']!=$owner)
    header( 'Location: homepage.php' );
    
  $displaySearch = true;
  include('templates/common/header.php');
  $action_form="templates/forms/editProperty_action.php?id=" . $_GET['id'];

  $property=getHabitationById($_GET['id']);
  $name=$property['nome'];
  $type=getTypeById($property['idTipo']);
  $numberGuests=$property['maxHospedes'];
  $numberBedrooms=$property['numQuartos'];
  $priceNight=$property['precoNoite'];
  $tax=$property['taxaLimpeza'];
  $description=$property['descricao'];
  $latitude=$property['latitude'];
  $longitude=$property['longitude'];
  $address=$property['morada'];
  $city=getNameCity($property['idCidade']);
  $country=getCountryById(getCountryCity($property['idCidade']));
  $policy=getPolicy($property['idPolitica']);
  $image="";
  $amenities_array_var=getAmenitiesByHabitation($_GET['id']);
  $agenda_array=getAgendaByHabitation($_GET['id']);
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