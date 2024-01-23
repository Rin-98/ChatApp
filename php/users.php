<?php 
    session_start();
    include_once "config.php";
    $outgoing_id = $_SESSION['unique_id'];
    $sql = mysqli_query($conn, "SELECT * FROM users WHERE NOT unique_id = {$outgoing_id}"); //taking all users data at database
    $output = "";

    if (mysqli_num_rows($sql) == 1) { //check if one user at DB
        $output .= "There is no one avaliable to chat";
    } elseif (mysqli_num_rows($sql) > 0) {  //check if there is more than one user at DB 
        include "data.php";
    }
    echo $output;
?>