<?php
    session_start();
    include_once "config.php";
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if (!empty($email) && !empty($password)) { //check user's email and password matched or not with save in DB
        $sql = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}' AND password = '{$password}'");
        if (mysqli_num_rows($sql)) { //if user credentials matched
            $row = mysqli_fetch_assoc($sql);
            $status = "Active Now";
            //updating user status when user login 
            $sql2 = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE unique_id = {$row['unique_id']}");
            if ($sql2) {
                $_SESSION['unique_id'] = $row['unique_id']; //creating session user unique id for other Php file 
                echo "success";
            }
        } else {
            echo "Incorrect Email or Password";
        }
    } else {
        echo "Something went wrong";
    }

?>