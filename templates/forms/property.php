<form id="property_form" class="verticalForm" action=<?=$action_form?> method="post" enctype="multipart/form-data">
    <label> Name
        <input type="text" name="name" value="<?=$name?>" required>
    </label>
    <!--          type             -->
    <label> Type
        <select name="types" value="<?=$type['idTipo']?>" required>
            <?php
            include_once('database/connection.php');
            include_once('database/habitations.php');
            $types = getTypes();

            foreach ($types as $type) {
                echo '<option value="' . $type['idTipo'] . '">' . $type['nome'] . '</option>';
            }
            ?>
        </select>
    </label>
    <!--          guests and numbers            -->
    <label> Maximum Number of Guests
        <input type="number" name="numberGuests" value="<?=$numberGuests?>" min="1" required>
    </label>
    <label> Number of Bedrooms
        <input type="number" name="numberBedrooms" value="<?=$numberBedrooms?>"min="1" required>
    </label>
    <!--          prices             -->
    <label class="currency"> Price per Night
        <input type="number" name="priceNight" value="<?=$priceNight?>" min="0.01" step="0.01" id="priceNight" />
    </label>
    <label class="currency"> Cleaning Tax
        <input type="number" name="cleaningTax" value="<?=$tax?>" min="0.01" step="0.01" id="cleaningTax" />
    </label>
    <label> Description
        <textarea name="description" rows="10"><?=$description?></textarea>
    </label>
    <!--         amenities           -->
    <script> let amenities_array_var = <?php echo json_encode($amenities_array_var); ?> </script>
    <script> let agenda_array = <?php echo json_encode($agenda_array); ?> </script>
    <script src="scripts/property.js" defer></script>
    <label>Amenity:
        <input type="text" id="amenities_input" name="amenity">
    </label>
    <input type="button" value="Add" id="amenities_button" class="submit">
    <table id="amenities_table">
    </table>
    <input type="hidden" name="amenities_array" id="amenities_array"/>
    <!--          agenda             -->
    <label>From:
        <input id="agenda_input_from" type="date" name="date_from">
    </label>
    <label>To:
        <input id="agenda_input_to" type="date" name="date_to">
    </label>
    <input type="button" value="Add" id="agenda_button" class="submit">
    <table id="agenda">
    </table>
    <input type="hidden" name="agenda_array" id="agenda_array"/>
    <!--          coordinates             -->
    <label> Latitude (Format DD)
        <input type="number" value="<?=$latitude?>" min="-90" max="90" step="0.000001" id="latitude" name="latitude">
    </label>
    <label> Longitude (Format DD)
        <input type="number" value="<?=$longitude?>" min="-180" max="180" step="0.000001" id="longitude" name="longitude">
    </label>
    <label> Address
        <input type="text" name="address" value="<?=$address?>" required>
    </label>
    <label> City
        <input type="text" name="city" value="<?=$city?>" required>
    </label>
    <label> Country
        <select name="country"  value="<?=$country['idPais']?>" required>
            <?php
            include_once('database/connection.php');
            include_once('database/users.php');
            $countries = getCountries();

            foreach ($countries as $country) {
                echo '<option value="' . $country['idPais'] . '">' . $country['nome'] . '</option>';
            }
            ?>
        </select>
    </label>
    <!--          cancelation policy             -->
    <label> Cancellation Policy 
        <select name="policies" required>
            <?php
            include_once('database/connection.php');
            include_once('database/habitations.php');
            $policys = getCancellationPolicys();

            foreach ($policys as $policyy) {
                if ($policyy==$policy)
                    echo '<option value="' . $policyy['idPolitica'] . '"selected>' . $policyy['nome'] . '</option>';
                else
                    echo '<option value="' . $policyy['idPolitica'] . '">' . $policyy['nome'] . '</option>';
            }
            ?>
        </select>
    </label>
    <!--          pictures             -->
    <label> Upload Pictures (Select All Pictures At Once)
        <input type="file" name="pictures[]" accept="image/*" multiple value="<?=$image?>" >
    </label>
    <?php
        if(isset($_GET['id'])){
            $pictures=getHabitationPictures($_GET['id']);
            foreach($pictures as $pic){
                echo '<p>' . $pic['urlImagem'] . '</p>';
            }
            $link = "templates/forms/removeAllImages_action.php?id=" . $_GET['id'];
    ?>
        <input type="button" value="Remove Pictures" id="rem_pictures_button" class="submit" onclick="window.location.replace('<?=$link?>');">
    <?php } ?>
    <input class="submit" type="submit" value="Submit" id="submitProperty">
</form>