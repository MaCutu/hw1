<?php
//al solito inizialmente verifichiamo che l'utente sià già loggato così eventualmente andiamo direttamente alla home
    include 'auth.php';
    if(checkAuth()){
        header('Location: home.php');
        exit;
    }

//inizia il controllo
    if(!empty($_POST["username"]) && !empty($_POST["password"])){
//connessione al database
        $conn=mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn));
        $username=mysqli_real_escape_string($conn, $_POST['username']);
        $query="SELECT * FROM users WHERE username= '".$username."'";
        $res=mysqli_query($conn, $query) or die(mysqli_error($conn));

        if(mysqli_num_rows($res)>0){
            //se ritorna la riga vuol dire che abbiamo trovato l'utente, quindi verifichiamo la password
            $entry=mysqli_fetch_assoc($res);
            if(password_verify($_POST['password'], $entry['password'])){
                //imposto sessione
                $_SESSION["user_sessione"]=$entry['username'];
                $_SESSION["user_sessione_id"]=$entry['id'];
                header("Location: home.php");
                mysqli_free_result($res);
                mysqli_close($conn);
                exit;
            }
        }
        //Mettiamo questo errore se abbiamo sbagliato user o password oppure se non esistono
        $error="Username e/o password errati.";
    }
    else if(isset($_POST["username"]) || isset($_POST["password"])){
        $error="Inserisci username e password.";
    }

?>





<html>
<head>
    <link rel='stylesheet' href='login.css'>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Accedi a YourMovie</title>
</head>

<body>
    <div id=logo><img src="./pics/logo.png"></div>
    <main>
        <h2>Accedi e continua ad usare YourMovie</h2>

        <?php
            //verifica presenza di errori
            if(isset($error)){
                echo "<p class='error'>$error</p>";
            }
        ?>

        <form name='login' method='post'>

            <div class="username">
                <label for='username'>Username</label>
                <input type='text' name='username'<?php if(isset($_POST["username"])){echo "value=".$_POST["username"];}?>>
            </div>

            <div class="password">
                <label  for='password'>Password</label>
                <input type='password' name='password'<?php if(isset($_POST["password"])){echo "value=".$_POST["password"];}?>>
            </div>

            <div class="login_button">
                <input type='submit' value="ACCEDI">
            </div>
        </form>
        
        <div class=iscriviti>
            <h3>Non sei ancora iscritto?</h3>
        </div>

        <div class="signup_button">
            <a href="signup.php" class='button'>ISCRIVITI</a>
        </div>

    </main>
</body>

</html>