<?php
    include 'dbconfig.php';

    //se viene chiamato questo file chiudo la sessione e torno alla pagina di login
    session_start();
    session_destroy();

    header('Location: index.php');
?>