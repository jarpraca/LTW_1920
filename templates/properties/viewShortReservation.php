<section class="reservationShort">
    <?php 
        include_once("database/connection.php");
        include_once("database/habitations.php");
        $habitation=getHabitationById($reservation['idHabitacao']);
        $pictures=getHabitationPictures($habitation['idHabitacao']);
        if ($pictures != null){
            echo '<img src=' . $pictures['urlImagem'] . 'alt=' . $pictures['legenda'] . '>';
        }
        else{
            echo '<img src="images/ownerPicture.jpg"  alt="Habitation Picture">';
        }
    ?>
    <div class="rightText">
        <h3><?=getNameType($habitation['idTipo'])['nome']?></h3>
        <h1><?=$habitation['nome']?></h1>
        <p><?=$reservation['dataCheckIn']?> -> <?=$reservation['dataCheckOut']?></p>
        <?php
            $datetime1 = strtotime($reservation['dataCheckIn'] . ' 00:00:00');
            $datetime2 = strtotime($reservation['dataCheckOut'] . ' 00:00:00');
            
            $secs = $datetime2 - $datetime1;// == <seconds between the two times>
            $days = $secs / 86400;
            $total = $habitation['precoNoite']*$days+$habitation['taxaLimpeza'];
        ?>
        <div class="horizontalElements">
            <h3>Total: <?=$total?>€</h3>
            <a href="editProperty.php?id=<?=$habitation['idHabitacao']?>" class="submit"><p>Cancel</p></a>
        </div>
    </div>
</section>