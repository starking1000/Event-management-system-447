<?php 
$conn = mysqli_connect("localhost", "root", "", "eventmanagement");
if(mysqli_connect_error()){
    echo "failed to connect to db".mysqli_connect_error();
}
?>