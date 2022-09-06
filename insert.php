<?php

$link = mysqli_connect("localhost:4308", "root", "", "tp");
 

if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
$first_name =  $_REQUEST['sender'];
$email = $_REQUEST['email'];
$message =  $_REQUEST['message'];

$sql = "INSERT INTO contact1 (name,email,Message) VALUES ('$first_name', '$email', '$message')";
if(mysqli_query($link, $sql)){
    header("location:done.html");
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

mysqli_close($link);
?>