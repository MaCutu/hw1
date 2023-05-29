<?php
    require_once 'auth.php';
    if(!$userid=checkAuth()) exit;

    salvataggio();

    function salvataggio(){
        global $dbconfig, $userid;

        $conn=mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);

        $userid=mysqli_real_escape_string($conn, $userid);
        $id_movie=mysqli_real_escape_string($conn, $_POST['id']);
        $title=mysqli_real_escape_string($conn, $_POST['title']);
        $description=mysqli_real_escape_string($conn, $_POST['description']);
        $image=mysqli_real_escape_string($conn, $_POST['image']);
        //anche se nel js ho un controllo che fa in modo che avvenga la fetch solo se 
        //il film non è stato aggiunto tra i preferiti, faccio in modo che ci sia un secondo controllo all'interno della tabella
        $query="SELECT * FROM preferiti WHERE id_user='$userid' AND id_movie='$id_movie'";
        $res=mysqli_query($conn, $query) or die(mysqli_error($conn));
        if(mysqli_num_rows($res)>0){
            echo json_encode(array('ok'=> true));
            exit;
        }

        //ora eseguo il caricamento della coppia user e film all'intenro del database
        $query="INSERT INTO preferiti(id_user, id_movie, title, info, pic) VALUES ('$userid', '".$id_movie."', '".$title."', '".$description."', '".$image."')";
        error_log($query);

        if(mysqli_query($conn, $query) or die(mysqli_error($conn))){
            echo json_encode(array('ok'=>false));
            exit;
        }

        mysqli_close($conn);
        echo json_encode(array('ok'=>false));

    }



?>