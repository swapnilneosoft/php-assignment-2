<?php
        if(isset($_POST['submit']))
        {
            $email = $_POST['email'];
            $password = $_POST['password'];
            if(empty($email) || empty($password))
            {
                echo "please check the fields !";   
            }else{
                if(is_dir("user/$email"))
                {
                    $fo = fopen("user/$email/details.txt","r");
                   $res =  trim(fgets($fo));    
                   if($password == $res)
                   {    session_start();
                        $_SESSION['authUser']=[
                            'email'=>$email,
                            'password'=>$res,
                        ];

                        $res = fgets($fo);
                        $_SESSION['authUser']['username'] = trim($res);
                        $res = fgets($fo);
                        $_SESSION['authUser']['email'] = trim($res);
                        $res = fgets($fo);
                        $_SESSION['authUser']['name'] = trim($res);
                        $res = fgets($fo);
                        $_SESSION['authUser']['age'] = trim($res);
                        $res = fgets($fo);
                        $_SESSION['authUser']['gender'] = trim($res);
                        $res = fgets($fo);
                        $_SESSION['authUser']['profile'] = trim($res);
                        setcookie("user",$email,time()+3600);
                        if($_POST['remember'])
                        {
                            setcookie("email",$email,time()+3600*24);
                        setcookie("pass",$password,time()+3600*24);
                        }
                       header("Location: http://localhost/training/assignment/assignment2/dashboard.php");
                   }else{
                       echo "Password does not match !";
                   }
                   fclose($fo);
                }else{
                    echo "<h1>email is not register </h1>";
                }
                
            }
        }   
?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <title>Assignement 2 : Home (Login)</title>
    <style>
        body {
            background-color: #f0f0f0;
        }
    </style>
</head>

<body>
    <div class="container" style="margin-top: 100px;">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4 card mt-5 p-0">
                <div class="card-header bg-white text-center">
                    <h3 class="">Login</h3>
                </div>
                <div class="card-body p-3">
                    <form action="" method="POST">
                        <div class="form-group">
                            <label for="Email">Email</label>
                            <input type="text" class="form-control" onblur="deploy()" id="email" name="email">
                        </div>
                        <div class="form-group">
                            <label for="Email">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <div class="form-group p-2">
                            <input type="checkbox" name="remember" id="" class="form-checkbox">
                            <label for="checkbox">Remember me</label>
                        </div>
                        <div class="form-group">
                            <button name="submit" class="btn btn-success form-control mt-2">
                                Login
                            </button>
                        </div>
                        <div class="form-group">
                            <a href="register.php" class="" style="text-decoration: none;float:right;margin:10px;">New User ?</a>
                        </div>

                    </form>
                </div>
            </div>
            <div class="col-md-4"></div>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

    <script>
    function deploy(){
        if(undefined != "<?php echo $_COOKIE['email'];?>")
        {
            if(document.getElementById('email').value == "<?php echo $_COOKIE['email'];?>")
            {
                document.getElementById('password').value = "<?php echo $_COOKIE['pass']; ?>"
            }else{
                console.log("nan")
                document.getElementById('password').value = ""
            }
        }
    }
</script>
</body>

</html>