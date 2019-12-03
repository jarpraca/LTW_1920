<form class="verticalForm" action="#" method="post">
    <label> First Name
        <input type="text" name="firstname" required>
    </label>
    <label> Last Name
        <input type="text" name="lastname" required>
    </label>
    <label> Date of Birth
        <input type="date" name="dateofbirth" required>
    </label>
    <label> Username
        <input type="text" name="username" required>
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
        <input type="password" name="password" required>
    </label>
    <label> Confirm Password 
        <input type="password" name="confirmpassword" required>
    </label>
    <label> Upload Picture 
        <input type="file" name="picture" accept="image/*">
    </label>
    <input class="submit" type="submit" value="Submit">
</form>