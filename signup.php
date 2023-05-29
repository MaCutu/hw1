<?php
    require_once 'auth.php';

    if (checkAuth()){
        header("Location: home.php");
        exit;
    }

    //verifico che sia avvenuto il totale riempimento e che esistano tutti i dati POST
    if(!empty($_POST["name"]) && !empty($_POST["surname"]) && !empty($_POST["username"]) && !empty($_POST["password"]) && !empty($_POST["conf_password"]) && !empty($_POST["allow"])){
        $error=array();
        $conn=mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn));

        //controlli username
        if(!preg_match('/^[a-zA-Z0-9_]{1,15}$/', $_POST['username'])){
            $error[]="Inserisci l'username per un massimo di 15 caratteri";
        }else{
            $username=mysqli_real_escape_string($conn, $_POST['username']);
            $query="SELECT username FROM users WHERE username= '$username'";
            $res=mysqli_query($conn, $query);
            if(mysqli_num_rows($res)>0){
                $error[]="Username già utilizzato";
            }
        }

        //controlli password
        if(strlen($_POST["password"])<8){
            $error[]= "Inserisci almeno 8 caratteri";
        }

        if(strcmp($_POST["password"], $_POST["conf_password"])!=0){
            $error[]="Le password non coincidono";
        }

        //email
        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
            $error[]="Email non valida";
        } else{
            $email=mysqli_real_escape_string($conn, strtolower($_POST['email']));
            $res=mysqli_query($conn, "SELECT email FROM users WHERE email = '$email'");
            if(mysqli_num_rows($res)>0){
                $error[]="Email già utilizzata";
            }
        }

        //condizioni d'uso
        if (!isset($_POST['allow']) || $_POST['allow'] != 1) {
            $error[] = "Devi accettare i termini e le condizioni d'uso.";
        }

        //passiamo alla registrazione nel database
        if(count($error)==0){
            $name=mysqli_real_escape_string($conn, $_POST['name']);
            $surname=mysqli_real_escape_string($conn, $_POST['surname']);
            $password=mysqli_real_escape_string($conn, $_POST['password']);
            $password=password_hash($password, PASSWORD_BCRYPT);

            $query="INSERT INTO users(username, password, name, surname, email) VALUES('$username', '$password', '$name', '$surname', '$email')";

            if(mysqli_query($conn, $query)){
        //Adesso salvo la sessione e reindirizzo verso la home
                $_SESSION["user_sessione"]= $_POST["username"];
                $_SESSION["user_sessione_id"]=mysqli_insert_id($conn);
                mysqli_close($conn);
                header("Location: home.php");
                exit;
            }else{
                $error[]="Errore di connessione al database";
            }
        }

        mysqli_close($conn);
    }
    else{
        $error=array("Riempi tutti i campi prima di andare avanti");
    }



?>








<html>
    <head>
        <link rel='stylesheet' href='signup.css'>
        <script src='signup.js' defer></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title> Iscriviti a YourMovie </title>
    </head>

    <body>
        <div id="logo"><img src="./pics/logo.png"></div>
        <main>
            <h1>Inserisci i tuoi dati ed inizia ad usare YourMovie</h1>
            <form name='signup' method='post' enctype="multipart/form-data">
                
                <div class="name">
                    <label for='name'>Nome</label>
                    <input type='text' name='name' <?php if(isset($_POST["name"])){echo "value=".$_POST["name"];}?>>
                    <div><img src="./pics/xrossa.jpg"><span>Inserisci un nome!</span></div>
                </div>

                <div class="surname">
                    <label for='surname'>Cognome</label>
                    <input type='text' name='surname' <?php if(isset($_POST["surname"])){echo "value=".$_POST["surname"];}?>>
                    <div><img src="./pics/xrossa.jpg"><span>Inserisci un cognome!</span></div>
                </div>

                <div class="username">
                    <label for='username'>Username</label>
                    <input type='text' name='username' <?php if(isset($_POST["username"])){echo "value=".$_POST["username"];}?>>
                    <div><img src="./pics/xrossa.jpg"><span>Inserisci l'username per un massimo di 15 caratteri</span></div>
                </div>

                <div class="email">
                    <label for='email'>Email</label>
                    <input type='text' name='email' <?php if(isset($_POST["email"])){echo "value=".$_POST["email"];}?>>
                    <div><img src="./pics/xrossa.jpg"><span>Email non valida</span></div>
                </div>

                <div class="password">
                    <label for='password'>Password</label>
                    <input type='password' name='password' <?php if(isset($_POST["password"])){echo "value=".$_POST["password"];}?>>
                    <div><img src="./pics/xrossa.jpg"><span>Inserisci almeno 8 caratteri</span></div>
                </div>

                <div class="conf_password">
                    <label for='conf_password'>Conferma Password</label>
                    <input type='password' name='conf_password' <?php if(isset($_POST["conf_password"])){echo "value=".$_POST["conf_password"];}?>>
                    <div><img src="./pics/xrossa.jpg"><span>Le password non coincidono</span></div>
                </div>

                <div class="allow">
                    <input type='checkbox' name='allow' value="1" <?php if(isset($_POST["allow"])){echo $_POST["allow"] ? "checked" : "";}?>>
                    <label for='allow'>Accetto i termini e le condizioni d'uso.</label>
                </div>

                <?php if(isset($error)){
                    foreach($error as $err){
                        echo "<div class='errorinsert'><img src='./pics/xrossa.jpg'><span>".$err."</span></div>";
                    }
                }
                ?>
                <div class="submit">
                    <input type='submit' value="Registrati" id="submit">
                </div>



            </form>
            
                <div class=iscriviti>
                    <h3>Hai già un profilo?</h3>
                </div>

                <div class="signup_button">
                    <a href="login.php" class='button'>ACCEDI</a>
                </div>
        </main>
    </body>
</html>