<?php
require 'dbConnection.php';
        $eid = @$_GET['deidquiz'];
        $r1 = mysqli_query($con, "UPDATE quiz SET status='disabled' WHERE eid='$eid' ") or die('Error');
		$r2 = mysqli_query($con, "DELETE FROM history WHERE eid='$eid'") or die('Error'.mysqli_error($con));
		$r3 = mysqli_query($con, "DELETE FROM user_answer WHERE eid='$eid'") or die('Error'.mysqli_error($con));
		$r4 = mysqli_query($con, "DELETE history.*, user_answer.*, rank.* FROM history JOIN user_answer ON user_answer.username = history.username JOIN rank ON rank.username = history.username WHERE history.eid='$eid'") or die('Error'.mysqli_error($con));
        header("location:dash.php?q=0");
?>