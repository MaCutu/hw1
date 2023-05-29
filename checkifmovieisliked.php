<?php
//ritornerà un json con i risultati della richiesta API
require_once 'auth.php';

if(!$userid=checkAuth()) exit;

//imposto header risposta
header('Content-Type: application/json');

controllo();

function controllo(){
    global $dbconfig, $userid;
    
    $conn=mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
    $userid=mysqli_real_escape_string($conn, $userid);
    $id_movie=mysqli_real_escape_string($conn, $_GET["q"]);
    $query="SELECT * FROM preferiti WHERE id_user='$userid' AND id_movie='$id_movie'";
    $res=mysqli_query($conn, $query) or die(mysqli_error($conn));
    if(mysqli_num_rows($res)>0){
        echo json_encode(true);
    }else{
        echo json_encode(false);
    }
    
}


?>