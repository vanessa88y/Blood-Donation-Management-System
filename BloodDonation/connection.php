<?php
$servername="localhost";
$username="root";
$password="";
$database="BDMS";
//create connection
$con=new mysqli($servername,$username,$password,$database);
//check connection
if(mysqli_connect_errno()) {  
    die("Connection failed ". mysqli_connect_error());  
}  

?>



