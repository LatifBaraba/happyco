<?php 
require 'function.php';

$id = $_GET["id"];

if(deletealbum($id) > 0){
    header("Location: gallery.php");
    // $_SESSION['deletepartnersuccess'] = 1 ;
    return false;
} else {
    // $_SESSION['deleteusergagal'] = 1 ;
}
?>