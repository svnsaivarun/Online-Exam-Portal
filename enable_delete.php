<?php
include_once 'dbConnection.php';
ob_start();
$eid   = $_GET['eid'];
$cid   = $_GET['cid'];

$q1 = mysqli_query($con, "DELETE FROM `enable_options` WHERE cid='$cid'");

if ($q1) {
echo "<script type='text/javascript'>
alert('Removed');
window.location.href = 'enable.php?eid=$eid';
</script>"  ;
}
ob_end_flush();
?>