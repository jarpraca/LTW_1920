<button class="submit" id="cancel_button"> <p>Cancel </p></button>

<div id="cancelModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>        
        <form id="reservation_form" class="commentForm verticalForm" action="templates/forms/cancel_action.php?idReserva=<?=$reservation['idReserva']?>" method="post" enctype="multipart/form-data">
        <div> 
            <p> Are you sure you want to cancel your reservation? </p>
        </div>
        <button class="submit" type="submit">  Yes </button>
        <button class="submit" id="no"> No </button>
</form>
    </div>
</div>

<script>
    // Get the modal
    var modal_cancel = document.getElementById("cancelModal");
    // Get the button that opens the modal
    var btn_cancel = document.getElementById("cancel_button");
    var no = document.getElementById("no");

    // When the user clicks the button, open the modal 
    btn_cancel.onclick = function() {
        modal_cancel.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    no.onclick = function() {
        modal_cancel.style.display = "none";
    }
    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal_cancel) {
            modal_cancel.style.display = "none";
        }
    }
</script>
