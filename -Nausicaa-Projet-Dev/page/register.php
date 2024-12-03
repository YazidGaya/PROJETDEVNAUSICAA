<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register </title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../style/register.css">
   
</head>
<?php
    //Barre de navigation
    require("../pageparts/nav.php");
?>

<body>
    <main>
        <form class="ring" method="post" action="form.php">
            <i style="--clr:#87CEEB;"></i>
            <i style="--clr:#FFFFFF;"></i>
            <i style="--clr:#00ff0a;"></i>
            <div class="login">
                <h2>register</h2>
                <div class="inputB">
                    <input name="Email" type="text" placeholder="Email" required>
                </div>
                <div class="inputB">
                    <input name="Username" type="text" placeholder="Username" required>
                </div>
                <div class="inputB">
                    <input id="wd" name="Password" type="password" placeholder="Password" required>
                    <i class="eye eye1" data-feather="eye"></i>
                    <i class="eye eye1" data-feather="eye-off"></i>
                </div>
                <div class="inputB">
                    <input id="cwd" name="ConfirmPassword" type="password" placeholder="Confirm password" required>
                    <i class="eye eye2" data-feather="eye"></i>
                    <i class="eye eye2" data-feather="eye-off"></i>
                </div>
                <div class="conditions">
                    <label><input name="Agree" type="checkbox" required> i agree to the terms & conditions</label>
                </div>
                <div class="inputB">
                    <input name="Submit" type="submit" value="Sign up">
                </div>
                <div class="register-link">
                    <p>You already have an account?
                        <a href="login.php">
                            <span id="zebi" class="cadre">Login</span>
                        </a>
                    </p>
                </div>
            </div>
        </form>

    </main>
    <script src="http://unpkg.com/feather-icons"></script>
    <script src="pswregist.js" type="text/javascript"></script>

</body>

</html>
