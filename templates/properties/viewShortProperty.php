<section class="propertyShort">
    <?php 
        include_once("database/connection.php");
        include_once("database/habitations.php");
        $pictures=getHabitationPictures($habitation['idHabitacao']);

        if ($pictures != null){
            echo '<img src=' . $pictures[0]['urlImagem'] . ' alt=' . $pictures[0]['legenda'] . '>';
        }
        else{
            echo '<img src="images/ownerPicture.jpg" alt="Habitation Picture">';
        }
    ?>
    <div class="rightText">
        <h3><?=getNameType($habitation['idTipo'])['nome']?></h3>
        <h1><?=$habitation['nome']?></h1>     
        <div class="horizontalElements">
            <a href="templates/forms/removeProperty_action.php?id=<?=$habitation['idHabitacao']?>" class="submit"><p>Remove</p></a>
            <a href="editProperty.php?id=<?=$habitation['idHabitacao']?>" class="submit"><p>Edit</p></a>
            <a href="listReservationsByProperty.php?id=<?=$habitation['idHabitacao']?>" class="submit"><p>View Reservations</p></a>
        </div>
    </div>
</section>