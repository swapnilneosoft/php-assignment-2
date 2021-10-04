<?php
session_start();        
session_destroy();
setcookie("user","");
header("Location: http://localhost/training/assignment/assignment2/");
?>