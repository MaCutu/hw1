<?php
//ritornerà un json con i risultati della richiesta API
require_once 'auth.php';

if(!checkAuth()) exit;

//imposto header risposta
header('Content-Type: application/json');

chiamaimdb();

function chiamaimdb(){
    //ricorda che per effettuare richieste api si utilizza questa libreria curl
    $query=$_GET["q"];
    $url='https://imdb-api.com/en/API/SearchTitle/k_qq144nlj/'.$query;
    $ch=curl_init();
    //imposta l'url
    curl_setopt($ch, CURLOPT_URL, $url);
    //Restituisci il risultato come stringa
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $res=curl_exec($ch);
    curl_close($ch);
    echo $res;

}

?>