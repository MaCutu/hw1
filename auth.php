<?php
//Questo file serve esclusivamente a verificare che l'utente sià già autenticato, per non dover chiedere ogni volta il login
require_once 'dbconfig.php';
session_start();

function checkAuth(){
    //verifico che esista già una sessione, se non esiste ritorno 0
    if(isset($_SESSION['user_sessione_id'])){
        return $_SESSION['user_sessione_id'];
    }else
    return 0;
}

?>