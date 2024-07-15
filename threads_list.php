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
    $id = $_GET['catid'];

    $sql = "SELECT * FROM `category` WHERE category_id = $id ";
    $result = mysqli_query($con, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        $catName = $row['category_name'];
        $catDesc = $row['category_description'];
    }
    ?>

    <?php
    $method = $_SERVER['REQUEST_METHOD'];
    $showAlert = false;
    // echo $method;
    if ($method == 'POST') {
        //insert thread into db
        $th_title = $_POST['title'];
        $th_desc = $_POST['desc'];
        $user_id = $_POST["user_id"];


        $th_title = str_replace("<", "&lt;", $th_title);
        $th_title = str_replace(">", "&gt;", $th_title);

        $th_desc = str_replace("<", "&lt;", $th_desc);
        $th_desc = str_replace(">", "&gt;", $th_desc);


        $sql = "INSERT INTO `thread` ( `thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`) VALUES ( '$th_title', '$th_desc', '$id', '$user_id')";

        $result = mysqli_query($con, $sql);
        $showAlert = true;
    }
    ?>

    <?php
    if ($showAlert) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> Your Thread has been added! Please wait for community respond.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>';
    }
    ?>

    <div class="container my-5">
        <div class="jumbotron">
            <h1 class="display-4">Welcome to <?php echo $catName; ?> forum!</h1>
            <p class="lead"><?php echo $catDesc; ?></p>
            <hr class="my-4">
            <p>This is a perr to perr forum.
                This is a Civilized Place for Public Discussion.
                Please treat this discussion forum with the same respect you would a public park.
                Improve the Discussion.
                Be Agreeable, Even When You Disagree.
                Always Be Civil.
                Keep It Tidy.
            </p>
        </div>
    </div>

    <?php

    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        echo '<div class="container">
                <h1>Start Discussion</h1>
                <form action="' . $_SERVER["REQUEST_URI"] . '" method="post">
                    <div class="form-group">
                        <label for="title">Problem Title : </label>
                        <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp" placeholder="Title...">
                        <small id="emailHelp" class="form-text text-muted">keep your title as short and crisp and as possible.</small>
                    </div>
                    <input type="hidden" name="user_id" value="' . $_SESSION['user_id'] . '">
                    <div class="form-group">
                        <label for="desc">Elaborate Your Consern</label>
                        <textarea class="form-control" id="desc" name="desc" placeholder="Description..." rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>';
    } else {
        echo '<div class="container">
                    <h1>Start Discussion</h1>
                    <p class="display-6">You are not Logged in.Please Login to start a Discussion.</p>
                </div>';
    }
    ?>
    <div class="container my-4">
        <h1 class="mb-4">Browse Quations</h1>

        <?php
        $id = $_GET['catid'];

        $sql = "SELECT * FROM `thread` WHERE thread_cat_id = $id ";
        $result = mysqli_query($con, $sql);
        $noResult = true;
        while ($row = mysqli_fetch_assoc($result)) {
            $noResult = false;
            $id = $row['thread_id'];
            $title = $row['thread_title'];
            $desc = $row['thread_desc'];
            $timestamp = $row['timestamp'];
            $thread_user_id = $row['thread_user_id'];

            $sql2 = "SELECT `user_email`,`user_name` FROM `users` WHERE user_id = '$thread_user_id'";
            $result2 = mysqli_query($con, $sql2);
            $row2 = mysqli_fetch_assoc($result2);
            $name = $row2['user_name'];              // name of the user

            echo '<div class="media my-3 ">
                    <img src="https://static.vecteezy.com/system/resources/thumbnails/009/292/244/small/default-avatar-icon-of-social-media-user-vector.jpg" width="30" class="mr-4" alt="">
                    <div class="media-body">
                       <div class=" d-flex justify-content-between my-0 align-items-center">
                        <p class="font-weight-bold my-0">' . $name . '</p>
                        <p class="text-black-50 small">At ' . $timestamp . '</p>
                       </div>
                       <h6 class="m-0"><a href="thread.php?threadid=' . $id . '">' . $title . '</a></h6>
                        <p>' . $desc . '</p>
                    </div>
                    
                </div>';
        }
        if ($noResult) {
            echo '<div class="jumbotron jumbotron-fluid">
                    <div class="container">
                        <p class="display-4">No Threads Found</p>
                        <p class="lead">Be the first person to ask the Quations!</p>
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





<!--  -->