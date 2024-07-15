<?php $showAlert = false; ?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>iDiscuss - coding forum</title>
</head>

<body>

    <?php include 'partial/_dbconnect.php'   ?>
    <?php include 'partial/_header.php'   ?>

    <?php
    $id = $_GET['threadid'];

    $sql = "SELECT * FROM `thread` WHERE thread_id = $id ";
    $result = mysqli_query($con, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        $title = $row['thread_title'];
        $desc = $row['thread_desc'];
        $commented = $row['thread_user_id']; 

        $sql2 = "SELECT `user_email`,`user_name` FROM `users` WHERE user_id = '$commented'";
        $result2 = mysqli_query($con, $sql2);
        $row2 = mysqli_fetch_assoc($result2);
        $postedby = $row2['user_name'];  
    }

    ?>

    <?php
    $method = $_SERVER['REQUEST_METHOD'];

    if ($method == 'POST') {
        //insert comment into comment db
        $comment = $_POST['comment'];
        $user_id = $_POST["user_id"];

        // replace the <> in the word 
        $comment = str_replace("<","&lt;",$comment);
        $comment = str_replace(">","&gt;",$comment);

        $sql = "INSERT INTO `comments` ( `comment_content`, `thread_id`, `comment_by`) VALUES ( '$comment', '$id', '$user_id')";

        $result = mysqli_query($con, $sql);
        $showAlert = true;
        if ($showAlert) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> Your Comment has been added!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
        }
    }
    ?>

<div class="container my-5">
        <div class="jumbotron">
            <h1 class="display-4"> <?php echo $title; ?> </h1>
            <p class="lead mt-3"><?php echo $desc; ?></p>
            <hr class="">
            <p>This is a perr to perr forum.
                This is a Civilized Place for Public Discussion.
                Please treat this discussion forum with the same respect you would a public park.
                Improve the Discussion.
                Be Agreeable, Even When You Disagree.
                Always Be Civil.
                Keep It Tidy.
            </p>
            <p>Posted By :<b> <?php echo $postedby; ?></b></p>
        </div>
    </div>
    <?php
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                echo '<div class="container">
                    <h1 class="my-4">Post Comments</h1>
                    <form action="'.$_SERVER["REQUEST_URI"].'" method="post">
                        <div class="form-group">
                            <textarea class="form-control" id="comment" name="comment" placeholder="Type your Comments  ..." rows="3"></textarea>
                            <input type="hidden" name="user_id" value="'.$_SESSION['user_id'].'">
                        </div>
                        <button type="submit" class="btn btn-primary">Post Comment</button>
                    </form>
                </div>';
        }
        else{
            echo '<div class="container">
                    <h1 class="my-4">Post Comments</h1>
                    <p class="display-6">You are not Logged in.Please Login to be able post comments .</p>
                </div>';
        }
    ?>

    <div class="container my-4">
        <h1>Disscussion</h1>

        <?php

        $sql = "SELECT * FROM `comments` WHERE thread_id = $id ";
        $result = mysqli_query($con, $sql);
        $noResult = true;
        while ($row = mysqli_fetch_assoc($result)) {
            $noResult = false;

            $content = $row['comment_content'];
            $comment_time = $row['comment_time'];
            $comment_user_id = $row['comment_by'];

            // Query the user table to find out the name of original poster.
            $sql2 = "SELECT `user_email`,`user_name` FROM `users` WHERE user_id = '$comment_user_id'";
            $result2 = mysqli_query($con, $sql2);
            $row2 = mysqli_fetch_assoc($result2);
            $name = $row2['user_name'];  

            echo '<div class="media my-2">
                    <img src="https://static.vecteezy.com/system/resources/thumbnails/009/292/244/small/default-avatar-icon-of-social-media-user-vector.jpg" width="30" class="mr-4" alt="">
                    <div class="media-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <p class="font-weight-bold my-0">'.$name.'</p> 
                            <p class="text-black-50 small ">At '.$comment_time.'</p>
                        </div>
                        <p class="py-0">' . $content . '</p>
                    </div>
                </div>';
        }
        if ($noResult) {
            echo '<div class="jumbotron jumbotron-fluid">
                    <div class="container">
                        <p class="display-4">No Comments Found</p>
                        <p class="lead">Be the first person to Comment!</p>
                    </div>
                </div>';
        }
        ?>

    </div>
    <?php include 'partial/_footer.php'   ?>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>