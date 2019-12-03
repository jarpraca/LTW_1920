<form  class="verticalForm" action="#" method="post">
    <label id="property_name"> Name
        <input type="text" name="firstname" required>
    </label>
    <label id="property_type"> Type
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
    <label id="property_guests"> Maximum Number of Guests
        <input type="number" name="numberGuests" min="1" required>
    </label>
    <label id="property_bedrooms"> Number of Bedrooms
        <input type="number" name="numberBedrooms" min="1" required>
    </label>
    <label class="currency" id="property_price"> Price per Night
        <input type="number" value="0" min="0" step="0.01" id="priceNight" />
    </label>
    <label class="currency"id="property_tax"> Cleaning Tax
        <input type="number" value="0" min="0" step="0.01" id="cleaningTax" />
    </label>
    <label id="property_description"> Description
        <textarea rows="10"></textarea>
    </label>
    <label  id="property_latitude"> Latitude (Format DD)
        <input type="number" value="0" min="-90" max="90" step="0.000001" id="latitude" />
    </label>
    <label  id="property_longitude"> Longitude (Format DD)
        <input type="number" value="0" min="-180" max="180" step="0.000001" id="longitude" />
    </label>
    <label  id="property_cancellation"> Cancellation Policy
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
    <label  id="property_pictures"> Upload Pictures (Select All Pictures At Once)
        <input type="file" name="pictures" accept="image/*" multiple>
    <label>
    <input id="property_submit" class="submit" type="submit" value="Submit" onsubmit="return copyFromForm2Function()">
</form>
<script src="scripts/amenities.js" defer></script>
<div id="property_amenities">
    <form id="amenities_form" action="#" method="post">
        <label>Amenity:
            <input type="text" name="amenity">
        </label>
        <input type="submit" class="submit" value="Add">
    </form>
    <table id="amenities">
    </table>
</div>
<script src="scripts/agenda.js" defer></script>
<div id="property_agenda">
    <form id="agenda_form" action="#" method="post">
        <label>From:
            <input id="date_from" type="date" name="date_from">
        </label>
        <label>To:
            <input id="date_to" type="date" name="date_to">
        </label>
        <input type="submit" class="submit" value="Add">
    </form>
    <table id="agenda">
    </table>
</div>