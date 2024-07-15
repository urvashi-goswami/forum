<?php

$showErr = false;
$showAlert = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    include '_dbconnect.php';

    $user_name = $_POST['signupUsername'];
    $user_email = $_POST['signupEmail'];
    $user_password = $_POST['signupPassword'];
    $user_conpassword = $_POST['signuConpassword'];

    // check feilds are null or not
    if ($user_name !== "" && $user_email !== "" && $user_password !== "" && $user_conpassword !== "") {

        // check whether this user exits
        $existSql = "SELECT * FROM `users` WHERE `user_email` = '$user_email'";
        $result = mysqli_query($con, $existSql);
        $numRows = mysqli_num_rows($result);

        if ($numRows > 0) {
            $showErr = "Email is already in use!";
        } else {
            // check password is equel to the con password
            if ($user_password == $user_conpassword) {
                $hash = password_hash($user_password, PASSWORD_DEFAULT);

                $sql = "INSERT INTO `users` ( `user_name`, `user_email`, `user_password`, `user_conpassword` ) VALUES ('$user_name', '$user_email', '$hash', '$hash')";
                $result = mysqli_query($con, $sql);
                if ($result) {
                    $showAlert = true;
                    header("location: /Project/forum/index.php?signupsuccess=true");

                    exit();
                }
            } else {
                $showErr = "Password do not match with Confirm Password!";
            }
        }
    } else {
        $showErr = "Please Fill all the field!";
    }
    header("location: /Project/forum/index.php?signupsuccess=false&error=$showErr");
}
