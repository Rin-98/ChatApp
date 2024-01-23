<?php
    session_start();
    include_once "config.php";
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if (!empty($fname) && !empty($lname) && !empty($email) && !empty($password)) {
        //check user email is valid or not
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            //check email already exist in database
            $sql = mysqli_query($conn, "SELECT email FROM users WHERE email = '{$email}'");
            if(mysqli_num_rows($sql) > 0) { //if email already exist
                echo "Your . $email . already exist";
            } else {
                //check user upload file
                if (isset($_FILES['image'])) { //if file is upload
                    $img_name = $_FILES['image']['name']; //getting user upload image name
                    $tmp_name = $_FILES['image']['tmp_name']; // this tempory name is used to save in folder

                    //explode image and get the last extension 
                    $img_explode = explode(".", $img_name);
                    $img_ext = end($img_explode); //take the extension of an user upload image file

                    $extensions = ["jpeg", "png", "jpg"];
                    if (in_array($img_ext, $extensions) === true) {
                        $time = time();

                        $new_img_name = $time.$img_name;
                       if (move_uploaded_file($tmp_name, "images/".$new_img_name)) {
                            $status = "Active now";
                            $ran_id = rand(time(), 100000000); // creating random id for user

                            //insert all user data to database
                            $sql2 = mysqli_query($conn, "INSERT INTO users (unique_id, fname, lname, email, password, img, status) VALUES ({$ran_id}, '{$fname}', '{$lname}', '{$email}', '{$password}', '{$new_img_name}', '{$status}')");

                            if ($sql2) { //if these data are insert
                                $sql3 = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
                                if (mysqli_num_rows($sql3) > 0) {
                                    $row = mysqli_fetch_assoc($sql3);
                                    $_SESSION['unique_id'] = $row['unique_id']; // creating session user unique id for other Php file
                                    echo "success";
                                }
                            } else {
                                echo "Something went wrong";
                            }
                        }

                    } else {
                       echo "Please Select an image file - jpg!"; 
                    }

                } else {
                    echo "Please Select an image file!";
                }
            }
        } else {
            echo "Your email . $email . is invalid";
        }
    } else {
        echo "All input field are required!";
    }

?>