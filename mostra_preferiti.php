<?php

    require_once 'auth.php';
    if (!$userid = checkAuth()) exit;

    header('Content-Type: application/json');

    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
    $userid=mysqli_real_escape_string($conn, $userid);

    $query = "SELECT * FROM preferiti WHERE id_user = $userid";
    $result = mysqli_query($conn, $query);

    $films = array();


    while ($row = mysqli_fetch_assoc($result)) {
        $film = array(
            'id'=>$row['id_movie'],
            'title' => $row['title'],
            'description' => $row['info'],
            'image' => $row['pic']
        );
    
        $films[] = $film;
    }
    
    echo json_encode($films);




?>