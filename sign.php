<?php
include_once 'dbConnection.php';
ob_start();
$name     = $_POST['name'];
$name     = ucwords(strtolower($name));
$gender   = $_POST['gender'];
$username = $_POST['username'];
$phno     = $_POST['phno'];
$password = $_POST['password'];
$branch   = $_POST['branch'];
$year   = $_POST['year'];
$section   = $_POST['section'];
$rollno   = $_POST['rollno'];
$email   = $_POST['email'];
$name     = stripslashes($name);
$name     = addslashes($name);
$name     = ucwords(strtolower($name));
$gender   = stripslashes($gender);
$gender   = addslashes($gender);
$username = stripslashes($username);
$username = addslashes($username);
$phno     = stripslashes($phno);
$phno     = addslashes($phno);
$password = stripslashes($password);
$password = addslashes($password);
//$password = md5($password);
$branch = stripslashes($branch);
$branch = addslashes($branch);
$year = stripslashes($year);
$year = addslashes($year);
$section = stripslashes($section);
$section = addslashes($section);
$rollno = stripslashes($rollno);
$rollno = addslashes($rollno);
$email = stripslashes($email);
$email = addslashes($email);
$file = $_POST["profile"];
$file = addslashes(file_get_contents($_FILES["profile"]["tmp_name"]));

$q3 = mysqli_query($con, "INSERT INTO user VALUES  (NULL,'$name', '$rollno','$branch', '$year', '$section' ,'$gender' ,'$username' ,'$phno', '$password','$email','$file')");
	
if ($q3) {
/*    session_start();
    $_SESSION["username"] = $username;
    $_SESSION["name"]     = $name;
    $_SESSION["email"]     = $email;   */
    $message = "Student added successfully";
        echo "<script type='text/javascript'>
        alert('$message');
        window.location.href = 'dash.php?q=1';
        </script>";
} else {
        $message = "Username already exists. Please choose another";
        echo "<script type='text/javascript'>
        alert('$message');
        window.location.href = 'dash.php?q=2';
        </script>";
}
ob_end_flush();
?>