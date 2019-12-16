<button id="reservation_button">Book</button>

<div id="reservationModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>        
        <?php $action_form = "templates/forms/reservation_action.php?idHabitacao=". $habitation['idHabitacao'] ?>

        <form id="reservation_form" class="commentForm verticalForm" action=<?= $action_form ?> method="post" enctype="multipart/form-data">
            <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
            <label> Type
                <input type="text" name="type" value= <?= getNameType($habitation['idTipo'])['nome'] ?> readonly >
            </label>
            <!--          guests and numbers            -->
            <label> Number of Guests
                <input type="number" name="guests"  value="<?=$_GET['guests'] ?>" min="1" max=<?=$habitation['maxHospedes']?>>
            </label>
            
            <label> Number of Bedrooms
                <input type="number" name="bedrooms"  value="<?= $habitation['numQuartos'] ?>" readonly>
            </label>
            <label> Dates
                <input type="text" name="dateFrom"  value=" <?=$dateFrom?>" readonly>
            -> 
            <input type="text" name="dateTo"  value=" <?=$dateTo?>" readonly>
            </label>
            <!--          prices             -->
            <label class="currency"> Total
                <input type="number" name="precoTotal"  value="<?=$habitation['precoNoite']*$days+$habitation['taxaLimpeza'] ?>" readonly>
            </label>
            <input class="submit" type="submit" value="Submit">
        </form>
    </div>
</div>

<script>
    // Get the modal
    var modal = document.getElementById("reservationModal");

    // Get the button that opens the modal
    var btn = document.getElementById("reservation_button");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks the button, open the modal 
    btn.onclick = function() {
        modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>
