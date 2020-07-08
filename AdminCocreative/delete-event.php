<?php 
require 'function.php';

$id = $_GET["id"];

if(deleteevent($id) > 0){
    header("Location: event.php");
    $_SESSION['delete_eventsuccess'] = 1 ;
    return false;
} else {
    // $_SESSION['deleteusergagal'] = 1 ;
}
?>