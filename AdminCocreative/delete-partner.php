<?php 
require 'function.php';

$id = $_GET["id"];

if(deletepartner($id) > 0){
    header("Location: partners.php");
    $_SESSION['deletepartnersuccess'] = 1 ;
    return false;
} else {
    // $_SESSION['deleteusergagal'] = 1 ;
}
?>