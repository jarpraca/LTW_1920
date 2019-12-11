<section id="property">
    <header>
        <h1><?=$habitation['nome']?></h1>
        <h3><?=""/*getNameCity($habitation['idCidade'])?>, <?=getCountryCity($habitation['idCidade'])*/?> </h3>
        <?php /*$picture=getUserPicture(getOwner($habiatation['idHabitacao']));
        if ($picture!=null){?>
            <img src="<?=$picture?>" alt="Owner Picture" width="5%">
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
        <p>Guests Maximum: <?=$habitation['maxHospedes']?>   |   Bedrooms:<?=$habitation['numQuartos']?></p>
        <h3>Description</h3>
        <p><?=$habitation['descricao']?></p>
        <h3>Amenities</h3>
        <?php
        $amenities=getAmenities($habitation['idHabitacao']);
        foreach ($amenities as &$value) { ?>
            <p><?=$value?></p>
        <?php } ?>
        <h3>Location</h3>
        Em construcao.
        <!--<script src="scripts/maps.js"></script>
        <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCkUOdZ5y7hMm0yrcCQoCvLwzdM6M8s5qk&callback=initMap">
        </script>-->
        <h3>Reviews</h3>
        <script src="https://kit.fontawesome.com/yourcode.js"></script>
        <?php
            $comments = getComments($habitation['idHabitacao']);
            $cleaning=0;
            $location=0;
            $value=0;
            $check_in=0;
            $total=0;
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
                $total=$location+$cleaning+$value+$check_in/4;
            }
        ?>
        <i class="fas fa-star"></i>
        <p><?=$total?></h5><p>(<?=$n?> Users)</p>
        <i class="fas fa-star"></i>
        <p><?=$cleaning?> Cleaning</p>
        <i class="fas fa-star"></i>
        <p><?=$location?> Location</p>
        <i class="fas fa-star"></i>
        <p><?=$value?> Price</p>
        <i class="fas fa-star"></i>
        <p><?=$check_in?> Check In</p>
        <?php ?>
    </section>
    <section id="comments">
    <?php 
    ?>
    </section>
</section>