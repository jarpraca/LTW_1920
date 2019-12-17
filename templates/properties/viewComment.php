<article class="comment">
    <?php
        if ($comment['anonimo']==true){ ?>
            <div class="align-left">
                <img src="images/ownerPicture.jpg" width="20px" height="20px" alt="Anonimous">
                <h5>Anonimous User</h5>
            </div>
        <?php
        }
        else{ ?>
            <div class="align-left">
                <img src="images/ownerPicture.jpg" width="20px" height="20px" alt="Anonimous">
                <h5><?=getUserById($comment['idUtilizador'])['primeiroNome']?> <?=getUserById($comment['idUtilizador'])['ultimoNome']?></h5>
            </div>
    <?php } ?> 
    <h6><?=date('F, Y', strtotime($comment['dataCheckOut']))?></h6>
    <h5 class="rating"><?=($comment['limpeza']+$comment['localizacao']+$comment['valor']+$comment['checkIn'])/4?> Total</h5>
    <div class="classification">
        <p class="star"> <b><?=$comment['limpeza']?></b> Cleaning</p>
        <p class="star"> <b><?=$comment['localizacao']?></b> Location</p>
        <p class="star"> <b><?=$comment['valor']?></b> Price</p>
        <p class="star"> <b><?=$comment['checkIn']?></b> Check In</p>
    </div>
    <p><?=$comment['outros']?></p>
</article>