<section class="reservationShort">
    <?php 
        include_once("database/connection.php");
        include_once("database/habitations.php");
        $habitation=getHabitationById($reservation['idHabitacao']);
        $pictures=getHabitationPictures($habitation['idHabitacao']);
        if ($pictures != null){
            echo '<img src=' . $pictures[0]['urlImagem'] . ' alt=' . $pictures[0]['legenda'] . '>';
        }
        else{
            echo '<img src="images/ownerPicture.jpg"  alt="Habitation Picture">';
        }
    ?>
    <div class="rightText">
        <h3><?=getNameType($habitation['idTipo'])['nome']?></h3>
        <h1><?=$habitation['nome']?></h1>
        <h4><?=getStateName($reservation['idEstado'])?></h4>
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
            <?php
                $state = $reservation['idEstado'];
                if ($state == 0)
                   include_once("templates/forms/cancel.php"); 

                else if ($state == 1){
                    echo '<a href="viewProperty.php?id=' . $habitation['idHabitacao'] . '#comment_form" class="submit"><p>Comment</p></a>';
                }
            ?>
            <a href="viewProperty.php?id=<?=$reservation['idHabitacao']?>" class="submit"> <p> View </p> </a>
            
        </div>
    </div>
</section>