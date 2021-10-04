<?php 
    if(isset($_POST['change']))
    {
        $op = $_POST['op'];
        $np = $_POST['np'];
        $cnp = $_POST['cnp'];
        $email = $_SESSION['authUser']['email'];
        $username = $_SESSION['authUser']['username'];
        $uname = $_SESSION['authUser']['name'];
        $gender = $_SESSION['authUser']['gender'];
        $age = $_SESSION['authUser']['age'];
        $upldFile = $_SESSION['authUser']['profile'];
        if($op == $_SESSION['authUser']['password'])
        {
                if($np == $cnp){
                        $fo = fopen("user/$email/details.txt",'w');
                        fwrite($fo,"$cnp\n$username\n$email\n$uname\n$age\n$gender\n$upldFile");
                        fclose($fo);
                        echo "pasword changed !
                            <script>
                                window.location.href = 'logout.php';
                            </script>
                        ";

                }else{
                    echo"
                    <script>
                        alert('new password and confrim password does not matched !');
                        window.history.back();
                    </script>
                    "; 
                }
        }else{
            echo"
            <script>
                alert('old password does not matched !');
                window.history.back();
            </script>
            ";        }
    }

?>

<div class="container">
    <div class="row">
        <div class="col-12 p-3 bg-light">
            <h3>Change password</h3>
        </div>
    </div>
    <form action="" method="POST">
        <div class="row p-5">
            <div class="col-md-12 p-1">
                <div class="form-group">
                    <label for="op">Old Password</label>
                    <input type="password" class="form-control" name="op">
                </div>
            </div>
            <div class="col-md-6 p-1">
                <div class="form-group">
                    <label for="op">new Password</label>
                    <input type="password" class="form-control" name="np">
                </div>
            </div>
            <div class="col-md-6 p-1">
                <div class="form-group">
                    <label for="op">confirm new Password</label>
                    <input type="password" class="form-control" name="cnp">
                </div>
            </div>
            <div class="col-md-12 p-3">
                <button class="btn btn-primary form-control" name="change">Change Password</button>
            </div>

        </div>
    </form>
</div>