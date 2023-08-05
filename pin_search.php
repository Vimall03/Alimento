<?php
session_start();
include 'partials/_dbconnect.php';
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: user_login.php");
    exit;
}
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $pincode = $_POST['pincode'];
    $query = "SELECT * FROM `restaurant` WHERE `r_pincode` = '$pincode' ORDER BY `r_rating` DESC";
                $result = mysqli_query($conn, $query);
                $num = mysqli_num_rows($result);
}


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Dropdown
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" aria-disabled="true">Disabled</a>
                    </li>
                </ul>
                <form class="d-flex"  action="home.php" method="post">
                    <input class="form-control me-2" type="search" name="pincode" placeholder="Search by PINCODE" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>

    <br>

    <div class="card text-center">
        <div class="card-header">
            Featured
        </div>
        <div class="card-body">
            <h5 class="card-title">loggedin</h5>
            <div>
                <?php
                
                if($num>=1){
                while ($row = mysqli_fetch_array($result)) {
                    echo'<div syle="height: 400px; width: auto" class="col-4">
                        <div class="card">
                        <img src="' . $row['r_bg'] . '" alt="" class="card-img-top">
                        <div class="card-body">
                        <h4 class="card-title">' . $row['r_name'] . '</h4>
                        <p class="card-text text-grey">' . $row['r_cuisine'] . '</p> <p class="card-text text-grey">' . $row['r_rating'] . '</p>
                        <a href="menu.php?id=' . $row['r_id'] . '" class="btn btn-btn-block bg-nav">View More</a>
                        </div>
                        </div>
                        </div>';
                }}

                ?>
            </div>
            <a href="/homemade/user_logout.php" class="btn btn-primary">Go somewhere</a>
        </div>
        <div class="card-footer text-body-secondary">
            2 days ago
        </div>
    </div>
</body>

</html>