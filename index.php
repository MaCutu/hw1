<?php 
    require_once 'auth.php';
    if(checkAuth()){
        header('Location: home.php');
        exit;
    }
?>


<html>
    <head>
        <title>YourMovie</title>
        <link rel="stylesheet" href="home.css">
        <script src='media.js' defer></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>


    <body>
                    <div class="menulaterale">
                        <a>Chi Siamo</a>
                        <div class=barra></div>
                        <a>Supporto</a>
                        <div class=barra></div>
                        <a>FAQ</a>
                        <div class=barra></div>
                        <div class=accesso>
                        <a href="login.php" class='button'>Accedi</a>
                        <div class=barra></div>
                        <a href="signup.php" class='button'>Iscriviti</a>
                        </div>
                    </div> 
        <header>
            <nav>
                <div id="box-logo">
                    <img src="./pics/logo.png">
                </div>
                    <a>Chi Siamo</a>
                    <div id=barra></div>
                    <a>Supporto</a>
                    <div id=barra></div>
                    <a>FAQ</a>
                    <div id=barra></div>
                    <div id=accesso>
                    <a href="login.php" class='button'>Accedi</a>
                    <a href="signup.php" id='iscriviti'>Non sei ancora iscritto? Iscriviti</a>
                    </div>

                    <div id=icona_sidebar>
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>


            </nav>

            <h1>Esplora, condividi ed espandi<br>la tua passione per i film</h1>

        </header>

        <footer>Created by Matteo Cutuli 1000014832</footer>
    </body>
</html>