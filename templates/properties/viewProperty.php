<section id="property">
    <header>
        <h1><?=$habitation['nome']?></h1>
        <h3><?=getNameCity($habitation['city'])?>, <?=getCountryCity($habitation['city'])?> </h3>
        <?php $picture=getUserPicture(getOwner($habiatation['idHabitacao']));
        if ($picture!=null){?>
            <img src="<?=$picture?>" alt="Owner Picture" width="5%">
        <?php }else{ ?>
            <img src="OwnerPicture.jpg" alt="Owner Picture" width="5%">
        <?php } ?>
    </header>
    <!-- fotos -->
    <aside>
        <p><?=$habitation['precoNoite']?> /night</p>
        <h5>Dates</h5>
        <p><?=$dateFrom?>  ->  <?=$dateTo?></p>
        <hr>
        <p><?=$habitation['precoNoite']?>x<?=$dateTo-$dateFrom?> nights</p>
        <p><?=$habitation['precoNoite']*$dateTo-$dateFrom?>?></p>
        <p>Cleaning Tax</p>
        <p><?=$habitation['taxaLimpeza']?></p>
        <h5>Total</h5>
        <h5><?=$habitation['precoNoite']*$dateTo-$dateFrom+$habitation['taxaLimpeza']?></h5>
        <form action="#" method="get">
            <input type="submit" class="submit" value="Reserve">
        </form>
    </aside>
    <section id="property_data">
        <h5><?=getNameType($habitation['idTipo'])?></h5>
        <p><?=$habitation['maxHospedes']?>   |   <?=$habitation['numQuartos']?></p>
        <h5>Description</h5>
        <p><?=getNameType($habitation['descricao'])?></p>
        <h5>Amenities</h5>
        <?php
        $amenities=getAmenities($habitation['id']);
        foreach ($amenities as &$value) { ?>
            <p><?=$value?></p>
        <?php } ?>
        <h5>Location</h5>
        Em construcao.
        <!--<script src="scripts/maps.js"></script>
        <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCkUOdZ5y7hMm0yrcCQoCvLwzdM6M8s5qk&callback=initMap">
        </script>-->
        <h5>Reviews</h5>
        <script src="https://kit.fontawesome.com/yourcode.js"></script>
        <?php
            $comments = getComments($habitation['id']);
            $cleaning=0;
            $location=0;
            $value=0;
            $check_in=0;
            $n=0;
            foreach($comments as &$comment){
                $cleaning+= $comment['limpeza'];
                $location+= $comment['localizacao'];
                $value+= $comment['valor'];
                $check_in += $comment['checkIn'];
                $n++;
            }
            $location=$location/$n;
            $cleaning=$cleaning/$n;
            $value=$value/$n;
            $check_in=$check_in/$n;
            $total=$location+$cleaning+$value+$check_in/4;
        ?>
        <i class="fas fa-star"></i>
        <h5><?=$total?></h5><p>(<?=$n?> Users)</p>
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