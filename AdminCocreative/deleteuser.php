<?php 
require 'function.php';
$id = $_GET["id"];

if(deleteuser($id) > 0){

    header("Location: index.php");
    $_SESSION['deleteuserberhasil'] = 1 ;
    return false;
} else {

    $_SESSION['deleteusergagal'] = 1 ;
}
?>