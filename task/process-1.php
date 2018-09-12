<?php

$fname = $_POST['firstname'];
$lname = $_POST['lastname'];
$uname = $_POST['username'];
$email = $_POST['email'];
$dob   = $_POST['dob'];
$pass  = $_POST['password'];
$imgname   = ($_FILES['image']['name']);

$imgpath   = "img/".$imgname;

//$image = $_POST['image'];



if ($fname && $lname && $uname && $email && $dob && $pass && $imgname) {
    
    $conn = new mysqli("localhost", "root", "", "task");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $sql = " INSERT INTO users (firstname, lastname, username, email, bod, password, image)  
VALUES ('$fname' , '$lname' , '$uname' , '$email' , '$dob' , '$pass', '$imgpath')";
    
    
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    $conn->close();
    
} else {
    
    echo "Failed to connect to Database";
}


?>

