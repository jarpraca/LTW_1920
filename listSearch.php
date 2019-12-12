<?php
    include('database/connection.php');
    include('database/habitations.php');

    session_start();
    $logedin=false;
    if (isset($_SESSION['user']))
        $logedin=true;

    include('templates/common/header.php');

    echo '<h2 class="subtitle">Searched for "'.$_GET['location'].'" between '.$_GET['dateFrom'].' and '.$_GET['dateTo'].'.</h2>';

    echo '<div class="list_properties_options">';
    echo '<a href="editProfile.php"><h5>Filter</h5></a>';
    echo '</div>';

    $properties = getHabitations($_GET['location']);

    $datetime1 = strtotime($_GET['dateFrom'] . ' 00:00:00');
    $datetime2 = strtotime($_GET['dateTo'] . ' 00:00:00');
    $secs = $datetime2 - $datetime1;// == <seconds between the two times>
    $days = $secs / 86400;

    foreach ($properties as $habitation){
        include("templates/properties/viewSearchProperty.php");
    }

    include('templates/common/footer.php');
?>