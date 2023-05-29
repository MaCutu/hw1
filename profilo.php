<?php 
    require_once 'auth.php';
    if (!$userid = checkAuth()) {
        header("Location: login.php");
        exit;
    }
?>

<html>


<head>
    <link rel='stylesheet' href='profilo.css'>
    <script src='profilo.js' defer></script>
    <script src='media.js' defer></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Il tuo profilo</title>
</head>

<?php
        $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
        $userid = mysqli_real_escape_string($conn, $userid);
        $query = "SELECT * FROM users WHERE id = '$userid'";
        $res_saluto = mysqli_query($conn, $query);
        $userinfo = mysqli_fetch_assoc($res_saluto);
    ?>

<body>

                    <div class="menulaterale">
                        <a>Chi Siamo</a>
                        <div class=barra></div>
                        <a>Supporto</a>
                        <div class=barra></div>
                        <a>FAQ</a>
                        <div class=barra></div>
                        <div class=accesso>
                        <a href="home.php" class='button'>Torna alla home</a>
                        <div class=barra></div>
                        <a href="logout.php" class='button'>Logout</a>
                        </div>
                    </div> 
    <header>
        <nav>
            <img src="./pics/logo.png">            
            <a href="home.php">Torna alla Home</a>
            <div id=barra></div>
            <a>Chi siamo</a>
            <div id=barra></div>
            <a>Contattaci</a>
            <div id=barra></div>
            <a href="logout.php">Logout</a>

            <div id=icona_sidebar>
                <div></div>
                <div></div>
                <div></div>
            </div>

        </nav>
        <div id="info-bio">
        <h1>Il tuo profilo:</h1>
        <h2><?php echo "Nome: ".$userinfo['name'];?></h2>
        <h2><?php echo "Cognome: ".$userinfo['surname'];?></h2>
        <h2><?php echo "Username: ".$userinfo['username'];?></h2>
        <h2><?php echo "Email: ".$userinfo['email'];?></h2>
        </div>
    </header>

    <h1 id=lista>Ecco la lista dei tuoi film preferiti:</h1>

    <section class="container">

        <div id="results">
    
        </div>
    </section>

</body>



</html>

<?php mysqli_close($conn);?>