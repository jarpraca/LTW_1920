<?php 
    include('../../templates/common/header.php');
?>

<form id="reservation_form" class="verticalForm" action="templates/forms/reservation_action.php" method="post" enctype="multipart/form-data">
            <label> Type
                <div>  <?php $_GET['type'] ?>  </div>
            </label>
            <!--          guests and numbers            -->
            <label> Number of Guests
                <input type="number" name="minNumberGuests"  value="<?=$_GET['guests'] ?>" min="1">
            </label>
            <label> Number of Bedrooms
               <?=$_GET['guests'] ?>
            </label>
            <!--          prices             -->
            <label class="currency"> Total
                <?=$_GET['total'] ?>
            </label>
            <input class="submit" type="submit" value="Submit">
        </form>
    </div>
</div>

<script>
    // Get the modal
    var modal = document.getElementById("filterModal");

    // Get the button that opens the modal
    var btn = document.getElementById("filter_button");

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
</form>

<?php
  include('templates/common/footer.php');
?>