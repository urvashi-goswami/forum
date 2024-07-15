<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>iDiscuss - coding forum</title>
    <style>
        #maincontainer{
            min-height: 81.6vh;
        }
    </style>

</head>

<body>

    <?php include 'partial/_dbconnect.php'   ?>
    <?php include 'partial/_header.php'   ?>

    <!-- search Result start from here. -->

    <div class="container my-3" id="maincontainer">
        <h1>Search Result for "<i> <?php echo $_GET['search'] ?> </i>"</h1>
        <?php
            $query = $_GET['search'];
            $sql = "SELECT * FROM thread WHERE MATCH (thread_title,thread_desc) against ('$query')";
            $result = mysqli_query($con, $sql);
            $noresults = true;

            while ($row = mysqli_fetch_assoc($result)) {
                $noresults = false;
                $title = $row['thread_title'];
                $desc = $row['thread_desc'];
                $thread_id = $row['thread_id'];
                $url = "thread.php?threadid=".$thread_id;

                // Display the search Result
                echo '<div class="result my-3">
                        <h3><a href="'.$url.'" class="text-dark">'.$title.'</a></h3>
                        <p>'.$desc.'</p>
                    </div>';
            }
            if ($noresults) {
                echo '<div class="jumbotron jumbotron-fluid">
                    <div class="container">
                        <p class="display-4">No Result Found!</p>
                        <p class="lead">Suggestions:
                            <ul>
                                <li>  Make sure that all words are spelled correctly.</li>
                                <li>Try different keywords.</li>
                                <li>Try more general keywords.</li>
                            </ul>
                        </p>
                    </div>
                </div>';
            }
        ?>    
    </div>
    
    <!-- search Result End from here. -->

    <?php include 'partial/_footer.php'   ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>