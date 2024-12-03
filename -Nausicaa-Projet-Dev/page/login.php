<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BattleShips - Login</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../style/login.css">
    <script src="script.js" defer></script>
</head>


<?php
    //Barre de navigation
    require("../pageparts/nav.php");
?>

<body>
    <main id="imagebg">

       <form class="ring" method="post" action="#">
            <i style="--clr:#87CEEB;"></i>
            <i style="--clr:#FFFFFF;"></i>
            <i style="--clr:#00ff0a;"></i>
            <div class="login">
                <h2>Login</h2>
                <div class="inputBx">
                    <input name="Username" type="text" placeholder="Username" required>
                </div>
                <div class="inputBx">
                    <input id="wd" name="Password" type="password" placeholder="Password" required>
                    <i class="eye" data-feather="eye"></i>
                    <i class="eye" data-feather="eye-off"></i>
                </div>
                <div class="remember-for" required>
                    <label><input name="Remember" type="checkbox"> Remember me</label>
                    <a href="forgotpass.php">Forgot Password?</a>
                </div>
                <div class="inputBx">
                    <input name="Connect" type="submit" value="Sign in" required>
                </div>
                <div class="register-link" required>
                    <p>Don't have an account?
                        <a href="register.php">
                            <span class="cadre">Register</span>
                        </a>
                    </p>
                </div>
            </div>

        </form>

    </main>
    <script src="http://unpkg.com/feather-icons"></script>
    <script src="pswd.js" type="text/javascript"></script>

</body>

</html>
