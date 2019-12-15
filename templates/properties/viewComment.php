<article class="comment">
    <?php
        if ($comment['anonimo']==true){
            echo '<h5>Anonimous User</h5>';
        }
        else{
            echo '<h5>' . getUserById($comment['idUtilizador'])['primeiroNome'] . ' ' . getUserById($comment['idUtilizador'])['ultimoNome'] . '</h5>';
        }
        echo '<h6>' . date('F, Y', strtotime($comment['dataCheckOut'])) . '</h6>';
    ?>
    <p class="rating"><?=($comment['limpeza']+$comment['localizacao']+$comment['valor']+$comment['checkIn'])/4?> Total</p>
    <p class="star"> <?=$comment['limpeza']?> Cleaning</p>
    <p class="star"> <?=$comment['localizacao']?> Location</p>
    <p class="star"> <?=$comment['valor']?> Price</p>
    <p class="star"> <?=$comment['checkIn']?> Check In</p>
    <p><?=$comment['outros']?></p>
</article>