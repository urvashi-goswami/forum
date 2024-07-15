<?php
$showErr = false;
$showAlert = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include '_dbconnect.php';

    $email = $_POST['loginEmail'];
    $password = $_POST['loginPassword'];
  

    if ($email !== "" && $password !== "") {

        $sql = "SELECT * FROM `users` WHERE `user_email` = '$email'";
        $result = mysqli_query($con, $sql);

        $numRows = mysqli_num_rows($result);
        if ($numRows == 1) {
            $row = mysqli_fetch_assoc($result);

            // $name = $row['user_name']; 

            if (password_verify($password, $row['user_password'])) {
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['username'] = $row['user_name'];
                $_SESSION['useremail'] = $email;
                // echo "loggeding : " ;
                header("location: /Project/forum/index.php?signupsuccess=true");
                $showAlert = true;
                exit();
            } else {
                $showErr = "You can not Login, Please Signin First!";
            }
        }
        else{
            $showErr = "User Not Sign exist! Please Sign up.";
        }
    } else {
        $showErr = "Please Fill all the field!";
    }
    header("location: /Project/forum/index.php?signupsuccess=false&error=$showErr");
    // header("location: /Project/forum/index.php");
}
?>
