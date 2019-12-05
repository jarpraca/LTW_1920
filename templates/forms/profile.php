<form class="verticalForm" action=<?=$action_form?> method="post">
    <label> First Name
        <input type="text" name="primeiroNome" required>
    </label>
    <label> Last Name
        <input type="text" name="ultimoNome" required>
    </label>
    <label> Date of Birth
        <input type="date" name="dateofbirth" required>
    </label>
    <label> Email 
        <input type="email" name="email" required>
    </label>
    <label> Phone Number
        <input type="tel" name="phone" required>
    </label>
    <label> Country
        <select name="country" required>
            <?php
            include_once('database/connection.php');
            include_once('database/users.php');
            $countries = getCountries();

            foreach ($countries as $country) {
                echo '<option value="' . $country . '">' . $country['nome'] . '</option>';
            }
            ?>
        </select>
    </label>
    <label> Password 
        <input type="password" id="password" name="password" required>
    </label>
    <label> Confirm Password 
        <input type="password" name="confirmpassword" required>
        <script language='javascript' type='text/javascript'>
            function check(input) {
                if (input.value != document.getElementById('password').value) {
                    input.setCustomValidity('Password Must be Matching.');
                } else {
                    // input is valid -- reset the error message
                    input.setCustomValidity('');
                }
            }
        </script>
    </label>
    <label> Upload Picture 
        <input type="file" name="picture" accept="image/*">
    </label>
    <input class="submit" type="submit" value="Submit">
</form>