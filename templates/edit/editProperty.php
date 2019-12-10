<section id="editProperty">
    <header>
        <h1> Edit Property </h1>
    </header>
    <form action="#" method="get">
        <label> Name <br>
            <input type="text" name="firstname">
        </label>
        <br>
        <br>
        <label> Type <br>
            <select name="types">
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
        <br>
        <br>
        <label> Date of Birth <br>
            <input type="date" name="dateofbirth">
        </label>
        <br>
        <br>
        <label> Username <br>
            <input type="text" name="username">
        </label>
        <br>
        <br>
        <label> Email <br>
            <input type="email" name="email">
        </label>
        <br>
        <br>
        <label> Password <br>
            <input type="password" name="password">
        </label>
        <br>
        <br>
        <label> Confirm Password <br>
            <input type="password" name="confirmpassword">
            <br>
            <br>
            <label> Upload Picture <br>
                <input type="file" name="picture" accept="image/*">
                <br>
                <br>
                <input type="submit" value="Register">
    </form>
</section>