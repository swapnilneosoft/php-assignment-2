<?php
session_start();
if (!isset($_SESSION['authUser'])) {
    // header("Location : http://localhost/training/assignment/assignment2/");
    echo "<script>window.location.href = 'index.php'</script>";
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <title>Assignement 2 : Dashboard</title>
    <style>
        .sidebar {
            height: 83vh;
            overflow-y: scroll;
        }

        .sidebar::-webkit-scrollbar {
            display: none;
        }

        .main-content {
            padding: 5px;
            height: 83vh;
            overflow-y: scroll;
        }

        .main-content::-webkit-scrollbar {
            display: none;
        }

        .sidebar-ul>li {
            text-align: center;
            font-weight: bold;
            list-style: none;
            border: none;
            border-bottom: 1px solid #f0f0f0;
            padding: 10px;
        }

        .sidebar-ul>li>a {
            text-decoration: none;
            color: white;
        }

        @media (max-width:768px) {
            .sidebar {
                height: auto;
            }
        }
    </style>
</head>

<body>
    <?php
    include('nav.php');
    ?>
    <div class="container-fluid">
        <div class="row">
            <!-- sidebar -->
            <div class="col-md-2 sidebar bg-dark p-0 m-0 " id="navbarSupportedContent">
                <ul class="sidebar-ul p-0 m-0">
                    <li class="nav-item">
                        <?php
                        if (!empty($_SESSION['authUser']['profile'])) {
                            echo "<img src='" . $_SESSION['authUser']['profile'] . "' class='img-fluid rounded-circle' height='50px' width='50px'>";
                        }
                        ?>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?page=changePass">Change Password</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?page=settings">Settings</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?page=products">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
            <!-- Main content box -->
            <div class="col-md-10 main-content">
                <h5><?php
                    if (!empty($_GET['page'])) {
                        switch ($_GET['page']) {
                            case 'changePass':
                                include('changepass.php');
                                break;
                            case 'settings':
                                include("settings.php");
                                break;
                            case 'products':
                                include("products.php");
                                break;
                        }
                    } else {
                        include("welcome.php");
                    }
                    ?></h5>
            </div>
        </div>
    </div>
    <?php
    include('footer.php');
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>


</body>

</html>