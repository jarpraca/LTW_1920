<section class="propertyShort">
        <?php 
            include_once("database/connection.php");
            include_once("database/habitations.php");
            $picture=getHabitationPictures($habitation['idHabitacao']);
            if ($picture != null){
                echo '<img src=' . $picture['urlImagem'] . 'alt=' . $picture['legenda'] . '>';
            }
            else{
                echo '<img src="images/ownerPicture.jpg"  alt="Habitation Picture">';
            }
        ?>
        <div class="rightText">
            <h3><?=getNameType($habitation['idTipo'])['nome']?></h3>
            <h1><?=$habitation['nome']?></h1>     
            <div class="horizontalElements">
                <a href="#" class="submit"><p>Remove</p></a>
                <a href="editProperty.php?id=<?=$habitation['idHabitacao']?>" class="submit"><p>Edit</p></a>
                <a href="listReservationsByProperty.php?id=<?=$habitation['idHabitacao']?>" class="submit"><p>View Reservations</p></a>
            </div>
        </div>
</section>