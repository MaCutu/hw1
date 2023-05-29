<?php
//in questo caso andiamo a controllare all'interno del database se esiste già uno username uguale a quello inserito
require_once 'dbconfig.php';

header('Content-type: application/json');//indica che il contenuto della risposta d apassare al client sarà nel formato JSON

$conn=mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
$username=mysqli_real_escape_string($conn, $_GET["q"]);
$query="SELECT username FROM users WHERE username='$username' ";
$res=mysqli_query($conn, $query) or die(mysqli_error($conn));

//json_encode converte un array associativo in formato json.
//la chiave exists ritorna true se il numero di righe restituite è maggiore di 0, viceversa ritorna false
echo json_encode(array('exists' => mysqli_num_rows($res)>0 ? true : false));

mysqli_close($conn);

?>