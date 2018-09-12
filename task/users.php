<?php
session_start();
if(!isset($_SESSION['name'])){
    echo "Access Denied";
    exit;
}else {
    echo $_SESSION['name']." 's session.<br/> <a href='logout.php'> Logout here. </a>";
}



?>
