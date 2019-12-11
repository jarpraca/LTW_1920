<section class="propertySearch">
    <?php 
        include_once("database/connection.php");
        include_once("database/habitations.php");
        $picture=getHabitationPictures($habitation['idHabitacao']);
        if ($picture != null){
            echo '<img src=' . $picture['urlImagem'] . 'alt=' . $picture['legenda'] . '>';
        }
        else{
            echo '<img src="images/ownerPicture.jpg" alt="Habitation Picture">';
        }
    ?>
    <div class="rightText">
        <h3><?=getNameType($habitation['idTipo'])['nome']?></h3>
        <h1><?=$habitation['nome']?></h1>
        <p>No. Rooms: <?=$habitation['numQuartos']?></p>  
        <p>No. Max Guests: <?=$habitation['maxHospedes']?></p>  
        <?php
            $total = $habitation['precoNoite']*$days+$habitation['taxaLimpeza'];
        ?> 
        <div class="horizontalElements">
            <h3>Total: <?=$total?>€</h3> 
            <a href="viewProperty.php?id=<?=$habitation['idHabitacao']?>&dateFrom=<?=$_GET['dateFrom']?>&dateTo=<?=$_GET['dateTo']?>" class="submit"><p>View</p></a>
        </div>
    </div>
</section>