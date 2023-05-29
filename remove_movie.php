<?php
    require_once 'auth.php';
    if(!$userid=checkAuth()) exit;

    elimina();

    function elimina(){
        global $dbconfig, $userid;

        $conn=mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);

        $userid=mysqli_real_escape_string($conn, $userid);
        $id_movie=mysqli_real_escape_string($conn, $_GET["q"]);
        $query="SELECT * FROM preferiti WHERE id_user='$userid' AND id_movie='$id_movie'";
        $res=mysqli_query($conn, $query) or die(mysqli_error($conn));
        if(mysqli_num_rows($res)>0){
            $elimina="DELETE FROM preferiti WHERE id_user = '$userid' AND id_movie = '$id_movie'";
            if(mysqli_query($conn, $elimina) or die(mysqli_error($conn))){
                echo json_encode(array('ok'=>true));
                exit;
            }
        }

        mysqli_close($conn);
        echo json_encode(array('ok'=>false));
    }

?>