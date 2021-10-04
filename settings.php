<?php
if (isset($_POST['update'])) {
    
    $uname = $_POST['name'];
    $email = $_SESSION['authUser']['email'];
    $username = $_POST['username'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $file = $_FILES['profile'];
    $password = $_SESSION['authUser']['password'];
    if (!empty($uname) && !empty($username) && !empty($age) && !empty($gender)) {
        $upldFile = null;

        if ($file['name'] != '') {
            $tmp = $file['tmp_name'];
            $name = $file['name'];
            $extn = pathinfo($name, PATHINFO_EXTENSION);
            $newName = $email . ".$extn";
            $dest = "user/$email/$newName";

            if ($extn == 'png' || $extn == 'jpg' || $extn == "jpeg") {
                if (move_uploaded_file($tmp, $dest)) {
                    $resUnlink = unlink($_SESSION['authUser']['profile']);
                   
                    $upldFile = $dest;
                } else {
                    $upldFile = "404";
                }
            } else {
                echo "Invalit file format File should be *.jpg .png .jpeg";
            }
        } else {
            $upldFile = $_SESSION['authUser']['profile'];
        }
        $fo = fopen("user/$email/details.txt", 'w');
        fwrite($fo, "$password\n$username\n$email\n$uname\n$age\n$gender\n$upldFile");
        fclose($fo);
        $_SESSION['authUser']['profile'] = $upldFile;
        $_SESSION['authUser']['username'] = $username;
        $_SESSION['authUser']['name'] = $uname;
        $_SESSION['authUser']['age'] = $age;
        $_SESSION['authUser']['gender'] = $gender;


        echo "<h1> Updated succss</h1>";
    } else {
        echo "all fields are mandatory !           
            ";
    }
}

?>



<div class="container">
    <div class="row">
        <div class="col ">
            <h2>Settings</h2>
        </div>
    </div>
</div>

<div class="container">

    <form action="" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" value="<?php echo $_SESSION['authUser']['email']; ?>" class="form-control muted" disabled>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="email">Name</label>
                    <input type="text" value="<?php echo $_SESSION['authUser']['name']; ?>" name="name" class="form-control ">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="email">username</label>
                    <input type="text" value="<?php echo $_SESSION['authUser']['username']; ?>" class="form-control muted" name="username">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="email">age</label>
                    <input type="text" value="<?php echo $_SESSION['authUser']['age']; ?>" class="form-control muted" name="age">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group p-3">
                    <label for="email">gender
                    </label>
                    <input type="radio" class="radio-input" name="gender" value="male" <?php if ($_SESSION['authUser']['gender'] == 'male') {
                                                                                            echo 'checked ';
                                                                                        }  ?>><label for="">Male</label>
                    <input type="radio" class="radio-input" name="gender" value="male" <?php if ($_SESSION['authUser']['gender'] == 'female') {
                                                                                            echo 'checked ';
                                                                                        }  ?>><label for="">Female</label>
                </div>
            </div>
            <div class="col-md-6"></div>
            <div class="col-md-6 p-3">
                <div class="form-group">
                    <label for="">Profile</label>
                    <img src="<?php echo $_SESSION['authUser']['profile'] ?>" alt="" class="img-fluid">
                </div>
            </div>
            <div class="col-md-6 p-3">
                <div class="form-group">
                    <label for="">Profile Image</label>
                    <input type="file" name="profile" value="" class="form-control mt-5">
                </div>
            </div>
            <div class="col-md-12">
                <button class="btn btn-primary form-control" name="update">Update</button>
            </div>
    </form>

</div>