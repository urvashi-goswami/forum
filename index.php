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

    <!-- slider start -->
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="https://cdn.shopify.com/s/files/1/0070/5901/3716/files/coding_background.jpg?v=1688538955" height="450" alt="First slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="https://www.zdnet.com/a/img/resize/a4c8436e7e3adf6dfb14266ca1aa83b8157ad0c2/2021/07/19/8a337c80-5ed6-43a1-98fb-b981d420890f/programming-languages-shutterstock-1680857539.jpg?auto=webp&fit=crop&height=675&width=1200" height="450" alt="Second slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="https://t4.ftcdn.net/jpg/05/18/87/23/360_F_518872338_ZqBuCYeJ58AIalKfikVfEk6IIYnvpA6S.jpg" height="450" alt="Third slide">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <!-- slider end -->


    <!-- category container start-->
    <div class="container my-4" id="ques">
        <h2 class="my-4">iDiscuss - Catagories</h2>

        <div class="row">
            <!-- fetch all the category -->

            <?php
            $sql = "SELECT * FROM `category`";
            $result = mysqli_query($con, $sql);

            //Use a for loop to iterate the category 



            while ($row = mysqli_fetch_assoc($result)) {
                // echo $row['category_id'];
                // echo $row['category_name'];
                
                $id = $row["category_id"];
                $title = $row["category_name"];
                $desc = $row["category_description"];

                echo '<div class="col-md-4 my-4">
                            <div class="card" style="width: 18rem;">
                                <img class="card-img-top" src="img/'.$id.'.jpg" alt="Card image cap" height="160">
                                <div class="card-body">
                                    <h5 class="card-title"><a href="threads_list.php?catid='.$id.'">' . $title . '</a></h5>
                                    <p class="card-text">' . substr($desc, 0, 110) . '...</p>
                                    <a href="threads_list.php?catid='.$id.'" class="btn btn-info">View Thread</a>
                                </div>
                            </div>
                        </div>';
            }

            ?>
        </div>
        <!-- category container end -->

    </div>

    <?php include 'partial/_footer.php'   ?>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>