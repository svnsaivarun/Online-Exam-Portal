<?php
// Connecting to the Database
$servername = "127.0.0.1";
$username = "root";
$password = "";
$database = "";
 
// Create a connection
$conn = mysqli_connect($servername, $username, $password, $database);
// Die if connection was not successful
if (!$conn){
 die("Sorry we failed to connect: ". mysqli_connect_error());
}
else{
 echo "Connection was successful<br>";
}
// Create a db
$sql = "CREATE DATABASE quiz";
 
$result = mysqli_query($conn, $sql);
 
// Check for the database creation success
if($result){
 echo "The database is successfully created!<br>";
}
else{
 echo "The db creation failed because of this error ---> ". mysqli_error($conn);
}
 
?>
?