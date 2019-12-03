<form  class="verticalForm" action="#" method="post">
    <label> Name
        <input type="text" name="firstname" required>
    </label>
    <!--          type             -->
    <label> Type
        <select name="types" required>
            <?php
            include_once('database/connection.php');
            include_once('database/habitations.php');
            $types = getTypes();

            foreach ($types as $type) {
                echo '<option value="' . $type . '">' . $type['nome'] . '</option>';
            }
            ?>
        </select>
    </label>
    <!--          guests and numbers            -->
    <label> Maximum Number of Guests
        <input type="number" name="numberGuests" min="1" required>
    </label>
    <label> Number of Bedrooms
        <input type="number" name="numberBedrooms" min="1" required>
    </label>
    <!--          prices             -->
    <label class="currency"> Price per Night
        <input type="number" value="0" min="0" step="0.01" id="priceNight" />
    </label>
    <label class="currency"> Cleaning Tax
        <input type="number" value="0" min="0" step="0.01" id="cleaningTax" />
    </label>
    <label> Description
        <textarea rows="10"></textarea>
    </label>
    <!--         amenities           -->
    <script src="scripts/amenities.js" defer></script>
    <label>Amenity:
        <input type="text" id="amenities_input" name="amenity">
    </label>
    <button type="submit" id="amenities_button" class="submit">Add</button>
    <table id="amenities_table">
    </table>
    <!--          agenda             -->
    <script src="scripts/agenda.js" defer></script>
    <label>From:
        <input id="date_from" id="agenda_input_from" type="date" name="date_from">
    </label>
    <label>To:
        <input id="date_to" id="agenda_input_to" type="date" name="date_to">
    </label>
    <button id="agenda_button" class="submit">Add</button>
    <table id="agenda">
    </table>
    <!--          coordinates             -->
    <label> Latitude (Format DD)
        <input type="number" value="0" min="-90" max="90" step="0.000001" id="latitude" />
    </label>
    <label> Longitude (Format DD)
        <input type="number" value="0" min="-180" max="180" step="0.000001" id="longitude" />
    </label>
    <!--          cancelation policy             -->
    <label> Cancellation Policy
        <select name="policies" required>
            <?php
            include_once('database/connection.php');
            include_once('database/habitations.php');
            $policys = getCancellationPolicys();

            foreach ($policys as $policy) {
                echo '<option value="' . $policy . '">' . $policy['nome'] . '</option>';
            }
            ?>
        </select>
    </label>
    <!--          pictures             -->
    <label> Upload Pictures (Select All Pictures At Once)
        <input type="file" name="pictures" accept="image/*" multiple>
    <label>
    <input class="submit" type="submit" value="Submit" onsubmit="return copyFromForm2Function()">
</form>
