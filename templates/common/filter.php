<button id="filter_button">Filter</button>

<div id="filterModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <form class="verticalForm" id="filter_form" method="post" action=<?=$action_form?>>    
        <!--          type             -->
            <label> Type
                <select name="types">
                    <?php
                    include_once('database/connection.php');
                    include_once('database/habitations.php');
                    $types = getTypes();

                    echo '<option></option>';
                    foreach ($types as $type) {
                        echo '<option value="' . $type['idTipo'] . '">' . $type['nome'] . '</option>';
                    }
                    ?>
                </select>
            </label>
            <!--          guests and numbers            -->
            <label> Minimum Number of Guests
                <input type="number" name="minNumberGuests" value="1" min="1">
            </label>
            <label> Minimum Number of Bedrooms
                <input type="number" name="minNumberBedrooms" value="1" min="1">
            </label>
            <!--          prices             -->
            <label class="currency"> Min Price per Night
                <input type="number" name="minPriceNight" value="0" min="0" id="minPriceNight" />
            </label>
            <label class="currency"> Max Price per Night
                <input type="number" name="maxPriceNight" value="99999" min="0" max="99999" id="maxPriceNight" />
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