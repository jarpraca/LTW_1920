<section id="login">
    <header>
        <h1> Login </h1>
    </header>
    <form class="verticalForm" action="templates/forms/login_action.php" method="post">
        <label> Email
            <input type="email" name="email" required>
        </label>
        <label> Password
            <input type="password" name="password" required>
        </label>
        <input type="submit" class="submit" value="Login">
    </form>
    <p><a href="forgotPassword.php">Forgot your password?</a></p>
    <p>Don't have an account yet? <a href="register.php">Sign Up!</a></p>
</section>