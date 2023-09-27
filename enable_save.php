<?php
require 'dbConnection.php';

$eid = $_GET['eid'];
$branch= $_POST['branch'];
for($i=0;$i<sizeof($branch);$i++){
$year= $_POST['year'];
$section= $_POST['section'];
$cid = uniqid();

$sql = mysqli_query($con, "INSERT INTO enable_options (`id`, `eid`, `cid`, `branch`, `year`, `section`) VALUES (NULL, '$eid', '$cid', '$branch[$i]', '$year[$i]', '$section[$i]')")or die('Error');

if ($sql === TRUE) {
echo "Success";

} else {
echo "Error: " . $sql . "<br>" . $con->error;
echo mysql_error();
}
//$con->close();
}
header('location:enable.php?eid='.$eid.'');
?>