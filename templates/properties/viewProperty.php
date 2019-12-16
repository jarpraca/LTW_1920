<section id="property">
    <header>
        <h1><?=$habitation['nome']?></h1>
        <h3><?=""/*getNameCity($habitation['idCidade'])?>, <?=getCountryCity($habitation['idCidade'])*/?> </h3>
        <?php /*$pictures=getUserPicture(getOwner($habitation['idHabitacao']));
        if ($pictures!=null){?>
            <img src="<?=$pictures?>" alt="Owner Picture" width="5%">
        <?php }else{ ?>
            <img src="OwnerPicture.jpg" alt="Owner Picture" width="5%">
        <?php } */?>
    </header>
    <!-- fotos -->
    <aside>
        <p><?=$habitation['precoNoite']?> /night</p>
        <h3>Dates</h3>
        <p><?=$dateFrom?> -> <?=$dateTo?></p>
        <!--<hr>-->
        <?php
            $datetime1 = strtotime($dateFrom . ' 00:00:00');
            $datetime2 = strtotime($dateTo . ' 00:00:00');
            
            $secs = $datetime2 - $datetime1;// == <seconds between the two times>
            $days = $secs / 86400;
        ?>
        <p><?=$habitation['precoNoite']?>x<?=$days?> nights</p>
        <p><?=$habitation['precoNoite']*$days?>€</p>
        <p>Cleaning Tax</p>
        <p><?=$habitation['taxaLimpeza']?>€</p>
        <h3>Total</h3>
        <h3><?=$habitation['precoNoite']*$days+$habitation['taxaLimpeza']?>€</h3>
        <form action="#" method="get">
            <input type="submit" class="submit" value="Book">
        </form>
    </aside>
    <section id="property_data">
        <h3><?=getNameType($habitation['idTipo'])['nome'] ?></h3>
        <p>Maximum Guests: <?=$habitation['maxHospedes']?></p>
        <p>Bedrooms: <?=$habitation['numQuartos']?></p>
        <p>Cancelling Policy: <?=getPolicy($habitation['idPolitica'])['nome']?></p>
        <h3>Description</h3>
        <p><?=$habitation['descricao']?></p>
        <h3>Amenities</h3>
        <?php
        $amenities=getAmenities($habitation['idHabitacao']);
        foreach ($amenities as $value) { ?>
            <p id="amenity">   <?=$value['nome']?></p>
        <?php } ?>
        <h3>Location</h3>
            <?php  
                $properties = array($habitation);
                include('templates/properties/map.php'); ?>

        <h3>Reviews</h3>
        <?php
            $photos = getHabitationPictures($habitation['idHabitacao']);
            $comments = getComments($habitation['idHabitacao']);
            $cleaning=0;
            $location=0;
            $value=0;
            $check_in=0;
            $rating=0;
            $n=0;
            foreach($comments as &$comment){
                $cleaning+= $comment['limpeza'];
                $location+= $comment['localizacao'];
                $value+= $comment['valor'];
                $check_in += $comment['checkIn'];
                $n++;
            }
            if ($n!=0){
                $location=$location/$n;
                $cleaning=$cleaning/$n;
                $value=$value/$n;
                $check_in=$check_in/$n;
                $rating=$location+$cleaning+$value+$check_in/4;
            }
        ?>
        <p class="rating"><?=$rating?> (<?=$n?> users)</p>
        <p class="star"> <?=$cleaning?> Cleaning</p>
        <p class="star"> <?=$location?> Location</p>
        <p class="star"> <?=$value?> Price</p>
        <p class="star"> <?=$check_in?> Check In</p>
        <?php ?>
        <section id="comments">
            <?php 
                foreach($comments as $comment){
                    include("templates/properties/viewComment.php");
                }
                if (isset($_SESSION['user'])){
                    $reservationsByUser = getResNotCommentedByUser($habitation['idHabitacao'], $_SESSION['user']);
                    if (!empty($reservationsByUser)){
                        $idReserva = $reservationsByUser[0]['idReserva'];
                        include("templates/forms/comment.php");
                    }
                }
            ?>
        </section>
    </section>
</section>