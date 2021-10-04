<?php

$rand1 = rand(0, 9);
$rand2 = rand(0, 9);
$captString = $rand1 . " + " . $rand2;
$captchaRes = $rand2 + $rand1;


if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $uname = $_POST['name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $file = $_FILES['profile'];

    if ($_POST['captcha'] == $_POST['captchaSum']) {

        if (!is_dir("user/$email")) {
            mkdir("user/$email");
            $tmp = $file['tmp_name'];
            $name = $file['name'];
            $extn = pathinfo($name, PATHINFO_EXTENSION);
            $newName = $email . ".$extn";
            $dest = "user/$email/$newName";
            $upldFile = null;
            if ($extn == 'png' || $extn == 'jpg' || $extn == "jpeg") {
                if (move_uploaded_file($tmp, $dest)) {
                    $upldFile = $dest;
                } else {
                    $upldFile = "404";
                }
                $fo = fopen("user/$email/details.txt", 'w');
                fwrite($fo, "$password\n$username\n$email\n$uname\n$age\n$gender\n$upldFile");
                fclose($fo);
                echo "
                <script>window.location.href='welcome.php?id=$email&&reg=true';</script>  
            ";
            } else {
                echo "Invalit file format File should be *.jpg .png .jpeg";
            }
        } else {
            echo "email already registered";
        }
    }else{
        echo "Invalida Captcha !";
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <title>Assignement 2 : register</title>
    <style>
        body {
            background-color: #f0f0f0;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-5 card mt-4   p-0">
                <div class="card-header bg-white text-center">
                    <h3 class="">Register</h3>
                </div>
                <div class="card-body p-3">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="Email">Email</label>
                            <input type="text" class="form-control" name="email">
                        </div>
                        <div class="form-group">
                            <label for="usernme">Username</label>
                            <input type="text" class="form-control" name="username">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="text" class="form-control" name="password">
                        </div>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name">
                        </div>
                        <div class="form-group">
                            <label for="age">Age</label>
                            <input type="text" class="form-control" name="age">
                        </div>
                        <div class="form-group p-3">
                            <label for="gander">Gender</label> :
                            <input type="radio" class="form-radio" name="gender" value="male">
                            <label for="">Male</label>
                            <input type="radio" class="form-radio" name="gender" value="female">
                            <label for="">Female</label>
                            <input type="radio" class="form-radio" name="gender" value="other">
                            <label for="">Other</label>
                        </div>
                        <div class="form-group">
                            <label for="age">Profile</label>
                            <input type="file" class="form-control" name="profile">
                        </div>
                        <div class="form-group p-2">
                            <label for="age">Captcha : </label> <output class="text-muted"><h5><?php echo $captString;  ?></h5></output>
                            <input type="text" class="form-control" name="captcha">
                            <input type="hidden" class="form-control" name="captchaSum" value="<?php echo $captchaRes; ?>">
                        </div>
                        <div class="form-group">
                            <button name="submit" class="btn btn-success form-control mt-2">
                                Register
                            </button>
                        </div>
                        <div class="form-group">
                            <a href="index.php" class="" style="text-decoration: none;float:right;margin:10px;">Already Have Account ?</a>
                        </div>

                    </form>
                </div>
            </div>
            <div class="col-md-4"></div>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>


</body>

</html>