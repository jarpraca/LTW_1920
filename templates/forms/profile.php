<form class="verticalForm" action=<?=$action_form?> method="post">
    <label> First Name
        <input type="text" name="primeiroNome" value="<?=$firstName?>" required>
    </label>
    <label> Last Name
        <input type="text" name="ultimoNome" value="<?=$lastName?>" required>
    </label>
    <label> Date of Birth
        <input type="date" name="dateofbirth" value="<?=$birth?>" required>
    </label>
    <label> Email 
        <input type="email" name="email" value="<?=$email?>" required>
    </label>
    <label> Phone Number
        <input type="tel" name="phone" value="<?=$phone?>" required>
    </label>
    <label> Country
        <select name="country" value="<?=$country['idPais']?>" required>
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
        <label> Password 
            <input type="password" id="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
        </label>
        <label> Confirm Password 
            <input type="password" name="confirmpassword" id="confirmpassword"  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
        </label>
    <label> Upload Picture 
        <input type="file" name="picture" value="<?=$picture?>" accept="image/*">
    </label>
    <input class="submit" type="submit" id="profileSubmit" value="Submit">
    <script language='javascript' type='text/javascript'>
        var password = document.getElementById("password"), confirm_password = document.getElementById("confirmpassword");

        function validatePassword(){
        if(password.value != confirm_password.value) {
            confirm_password.setCustomValidity("Passwords Don't Match");
        } else {
            confirm_password.setCustomValidity('');
        }
        }

        password.onchange = validatePassword;
        confirm_password.onkeyup = validatePassword;
    </script>
</form>