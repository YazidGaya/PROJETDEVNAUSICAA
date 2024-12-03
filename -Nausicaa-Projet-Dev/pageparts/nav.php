

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Battleships</title>
    <link rel="stylesheet" href="../style/style.css">
    <script src="script.js" defer></script>
    <script src="game.js" defer></script>
</head>

<body>
    <div class="headerall">
        <?php 
            require("database.php");
            require("form.php");

            if(isset($_COOKIE['username']) && isset($_COOKIE['password'])){
                // Connexion à un compte
                $username = wash($_COOKIE['username']);
                $password = wash($_COOKIE['password']);
            // Vérifier si le pseudo et le mot de passe correspondent et si c'est un compte utilisateur ou admin
            // vérifier la variable admin 1 si c'est un admin 0 si c'est un utilisateur
                $result = $conn->prepare('SELECT * FROM users where Username = ? AND Password = ? ');
                $result->execute(array($username, $password));
                if(validerPseudoMdp($username) == TRUE && validerPseudoMdp($password) == TRUE && $result->rowCount() > 0) {
                    $_SESSION['Username'] = $username;
                    $_SESSION['Password'] = $password;
                    $result = $conn->prepare('SELECT Admin FROM users where Username = ? AND Password = ? ');
                    $result->execute(array($username, $password));
                    $admin = $result->fetchColumn();
                    $result = $conn->prepare('SELECT Id FROM users where Username = ? AND Password = ? ');
                    $result->execute(array($username, $password));
                    $id = $result->fetchColumn();
                    $_SESSION['id'] = $id;
                    $_SESSION['admin'] = $admin;
                    $_SESSION['authentified'] = true;
                    }
            }
        ?>
        <table class="logo">
            <th id="logo"><a href="../page/index.php"><img src="images/Logo.png" alt="Logo.png"></a>
            <th id="titreheader"><h1>The BattleShips Game</h1></th>
        </table>
       

        <nav> 
            <a href="index.php" class="navbutton">Home</a>
            <a href="game.php" class="navbutton">Game</a>
            <a href="create.php" class="navbutton">Creator</a>
            <a href="generate.php" class="navbutton">Generator</a>
            <a href="rules.php" class="navbutton">Rules</a>
            <a href="statistics.php" class="navbutton">Statistics</a>

            <?php 
                if(isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
                    echo "<a href='gestion.php' class='navbutton'>Gestion</a>";
                }
                if(!isset($_SESSION['authentified'])) {
                    echo "<a href='login.php' class='navbutton'>Login</a>";
                } else {
                    echo "<a href='logout.php' class='navbutton'>Logout</a>";
                }
            ?>

        </nav>
    </div>
</body>

