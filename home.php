
    
<?php 
    require_once 'auth.php';
    if (!$userid = checkAuth()) {
        header("Location: login.php");
        exit;
    }
?>


<html>
    <head>
        <title>YourMovie</title>
        <link rel="stylesheet" href="home_login.css">
        <script src="home.js" defer="true"></script>
        <script src='media.js' defer></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
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
                        <a href="profilo.php" class='button'>Il mio profilo</a>
                        <div class=barra></div>
                        <a href="logout.php" class='button'>Logout</a>
                        </div>
                    </div> 
    <header>
        <nav>
            <img src="./pics/logo.png">
            <a>Home</a>
            <div id=barra></div>
            <a>Chi siamo</a>
            <div id=barra></div>
            <a>Contattaci</a>
            <div id=barra></div>
            <a href="profilo.php" class='button'>Il mio profilo</a>
            <a href="logout.php" class='button'>Logout</a>


            <div id=icona_sidebar>
                <div></div>
                <div></div>
                <div></div>
            </div>

        </nav>
        <h1>Bentornato <?php echo $userinfo['name']." ".$userinfo['surname']?></h1>
        <h2>Eccoti nella homepage di YourMovie, cerca un film o una serie tv inserendo il titolo nella barra di ricerca e aggiungilo ai preferiti</h2>
    </header>

    <form autocomplete="off">
        <div class="search">
            <label for='search'>Cerca un film:</label>
            <input type='text' name="search" class="searchbar">
            <input type="submit" class="cerca" value="VAI">
        </div>
    </form>
    <section class="container">

            <div id="results">
                
            </div>
    </section>


    <footer>Created by Matteo Cutuli 1000014832</footer>
</body>

</html>

<?php mysqli_close($conn);?>