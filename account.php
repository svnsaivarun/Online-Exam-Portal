<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="icon" href="image/logo.png" type="image/icon" sizes="16x16">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Online Exam </title>
<link  rel="stylesheet" href="css/bootstrap.min.css"/>
 <link  rel="stylesheet" href="css/bootstrap-theme.min.css"/>    
 <link rel="stylesheet" href="css/main.css">
 <link  rel="stylesheet" href="css/font.css">
 <script src="js/jquery.js" type="text/javascript"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
 
  <script src="js/bootstrap.min.js"  type="text/javascript"></script>
<link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
<script type="text/javascript">
 function printPage(){
        var tableData = '<table border="1" class="table">'+document.getElementsByTagName('table')[0].innerHTML+'</table>';
        var data = '<button onclick="window.print()">Print this page</button>'+tableData;       
        myWindow=window.open('','','width=430,height=600');
        myWindow.innerWidth = screen.width;
        myWindow.innerHeight = screen.height;
        myWindow.screenX = 0;
        myWindow.screenY = 0;
        myWindow.document.write(data);
        myWindow.focus();
    };
 </script>
<?php
if (@$_GET['w']) {
    echo '<script>alert("' . @$_GET['w'] . '");</script>';
}
?>

</head>
<?php
include_once 'dbConnection.php';
?>

<body>
<div class="header" style="height: 100px;">
<div class="row">
<div class="col-lg-6">
<span class="logo">ONLINE EXAM </span></div>
<div class="col-md-4 col-md-offset-2">
 <?php
include_once 'dbConnection.php';
session_start();
if (!(isset($_SESSION['username']))) {
    header("location:index.php");
} else {
    $name     = $_SESSION['name'];
    $username = $_SESSION['username'];
    
    include_once 'dbConnection.php';
	$result = mysqli_query($con, "SELECT * FROM user WHERE username='$username'") or die('Error');
    while ($row = mysqli_fetch_array($result)) {
    $profile   = $row['profile'];
	if($profile != NULL){
    echo '<span class="pull-right top title1" ><span style="color:white"><img src="data:image/jpeg;base64,'.base64_encode($profile).'" style="width:70px;height:80px;border:1px solid #eeeeee;border-radius:8px;" />';//<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
	echo'&nbsp;&nbsp;&nbsp;&nbsp;Hello,</span> <span class="log log1" style="color:lightyellow">' . $username . '&nbsp;&nbsp;|&nbsp;&nbsp;<a href="logout.php?q=account.php" style="color:lightyellow"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>&nbsp;Logout</button></a></span>';
		} else {
    echo '<span class="pull-right top title1" ><span style="color:white"><img src="image/NO-IMAGE-AVAILABLE.jpg" style="width:70px;height:80px;border:1px solid #eeeeee;border-radius:8px;" />';//<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
	echo'&nbsp;&nbsp;&nbsp;&nbsp;Hello,</span> <span class="log log1" style="color:lightyellow">' . $username . '&nbsp;&nbsp;|&nbsp;&nbsp;<a href="logout.php?q=account.php" style="color:lightyellow"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>&nbsp;Logout</button></a></span>';
		}
	}
}
?>
</div>
</div></div>
<div class="bg">
<nav class="navbar navbar-default title1">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></a>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li <?php
if (@$_GET['q'] == 1)
    echo 'class="active"';
?> ><a href="account.php?q=1"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>&nbsp;Home<span class="sr-only">(current)</span></a></li>
        <li <?php
if (@$_GET['q'] == 2)
    echo 'class="active"';
?>><a href="account.php?q=2"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>&nbsp;My History</a></li>
   
	<!--
	<li <?php
if (@$_GET['q'] == 3)
    echo 'class="active"';
?>><a href="account.php?q=3"><span class="glyphicon glyphicon-stats" aria-hidden="true"></span>&nbsp;Leaderboard</a></li>
-->

</ul>
            
      </div>
  </div>
</nav>
<div class="container">
<div class="row">
<div class="col-md-12">
<?php
if (@$_GET['q'] == 1) {
	$query = mysqli_query($con, "SELECT * FROM user WHERE username='$username'") or dir('Error');
	while ($row = mysqli_fetch_array($query)) {
	  $branch = $row['branch'];
	  $year = $row['year'];
	  $section = $row['section'];
    //$result = mysqli_query($con, "SELECT * FROM quiz WHERE status = 'enabled' && branch = '$branch' && year = '$year' && section = '$section' ORDER BY date DESC") or die('Error');
    $result = mysqli_query($con, "SELECT * from quiz JOIN enable_options ON quiz.eid = enable_options.eid WHERE quiz.status = 'enabled' && enable_options.branch = '$branch' && enable_options.year = '$year' && enable_options.section = '$section' ORDER BY date DESC") or die('Error');
    echo '<div class="panel table-responsive"><table class="table table-striped title1"  style="vertical-align:middle">
<tr><td style="vertical-align:middle"><b>S.N.</b></td><td style="vertical-align:middle"><b>Name</b></td><td style="vertical-align:middle"><b>Total question</b></td><td style="vertical-align:middle"><b>Correct Answer</b></td><td style="vertical-align:middle"><b>Wrong Answer</b></td><td style="vertical-align:middle"><b>Total Marks</b></td><td style="vertical-align:middle"><b>Time limit</b></td><td style="vertical-align:middle"><b>Action</b></td></tr>';
    $c = 1;
    while ($row = mysqli_fetch_array($result)) {
        $title   = $row['title'];
        $total   = $row['total'];
        $correct = $row['correct'];
        $wrong   = $row['wrong'];
        $time    = $row['time'];
        $eid     = $row['eid'];
        $q12 = mysqli_query($con, "SELECT score FROM history WHERE eid='$eid' AND username='$username'") or die('Error98');
        $rowcount = mysqli_num_rows($q12);
        if ($rowcount == 0) {
            echo '<tr><td style="vertical-align:middle">' . $c++ . '</td><td style="vertical-align:middle">' . $title . '</td><td style="vertical-align:middle">' . $total . '</td><td style="vertical-align:middle">+' . $correct . '</td><td style="vertical-align:middle">-' . $wrong . '</td><td style="vertical-align:middle">' . $correct * $total . '</td><td style="vertical-align:middle">' . $time . '&nbsp;min</td>
  <td style="vertical-align:middle"><b><a href="account.php?q=quiz&step=2&eid=' . $eid . '&n=1&t=' . $total . '&start=start" class="btn" style="color:#FFFFFF;background:darkgreen;font-size:12px;padding:7px;padding-left:10px;padding-right:10px"><span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>&nbsp;<span><b>Start</b></span></a></b></td></tr>';
        } else {
            $q = mysqli_query($con, "SELECT * FROM history WHERE username='$_SESSION[username]' AND eid='$eid' ") or die('Error197');
            while ($row = mysqli_fetch_array($q)) {
                $timec  = $row['timestamp'];
                $status = $row['status'];
            }
            $q = mysqli_query($con, "SELECT * FROM quiz WHERE eid='$eid' ") or die('Error197');
            while ($row = mysqli_fetch_array($q)) {
                $ttimec  = $row['time'];
                $qstatus = $row['status'];
            }
            $remaining = (($ttimec * 60) - ((time() - $timec)));
            if ($remaining > 0 && $qstatus == "enabled" && $status == "ongoing") {
                echo '<tr style="color:darkgreen"><td style="vertical-align:middle">' . $c++ . '</td><td style="vertical-align:middle">' . $title . '&nbsp;<span title="This quiz is already solve by you" class="glyphicon glyphicon-ok" aria-hidden="true"></span></td><td style="vertical-align:middle">' . $total . '</td><td style="vertical-align:middle">+' . $correct . '</td><td style="vertical-align:middle">-' . $wrong . '</td><td style="vertical-align:middle">' . $correct * $total . '</td><td style="vertical-align:middle">' . $time . '&nbsp;min</td>
  <td style="vertical-align:middle"><b><a href="account.php?q=quiz&step=2&eid=' . $eid . '&n=1&t=' . $total . '&start=start" class="btn" style="margin:0px;background:darkorange;color:white">&nbsp;<span class="title1"><b>Continue</b></span></a></b></td></tr>';
            } else {
                echo '<tr style="color:darkgreen"><td style="vertical-align:middle">' . $c++ . '</td><td style="vertical-align:middle">' . $title . '&nbsp;<span title="This quiz is already solve by you" class="glyphicon glyphicon-ok" aria-hidden="true"></span></td><td style="vertical-align:middle">' . $total . '</td><td style="vertical-align:middle">+' . $correct . '</td><td style="vertical-align:middle">-' . $wrong . '</td><td style="vertical-align:middle">' . $correct * $total . '</td><td style="vertical-align:middle">' . $time . '&nbsp;min</td>
  <td style="vertical-align:middle"><b><a href="account.php?q=result&eid=' . $eid . '" class="btn" style="margin:0px;background:darkred;color:white">&nbsp;<span class="title1"><b>View Result</b></span></a></b></td></tr>';
            }
        }
    }}
    $c = 0;
    echo '</table></div><div class="panel" style="padding-top:1px;padding-left:15%;padding-right:15%;word-wrap:break-word"><h3 align="center" style="font-family:calibri">:: General Instructions ::</h3><br /><ul type="circle"><font style="font-size:14px;font-family:calibri">';
    $file = fopen("instructions.txt", "r");
    while (!feof($file)) {
        echo '<li>';
        $string = fgets($file);
        $num    = strlen($string) - 1;
        $c      = str_split($string);
        for ($i = 0; $i < $num; $i++) {
            $last = $c[$i];
            if ($c[$i] == ' ' && $last == ' ') {
                echo '&nbsp;';
            } else {
                echo $c[$i];
            }
        }
        echo "</li><br />";
    }
    
    fclose($file);
    echo '</font></ul></div>';
    
}
?>
<?php
if (@$_GET['q'] == 'quiz' && @$_GET['step'] == 2 && isset($_SESSION['6e447159425d2d']) && $_SESSION['6e447159425d2d'] == "6e447159425d2d" && isset($_GET['endquiz'])== 'end') {
    unset($_SESSION['6e447159425d2d']);
    $q = mysqli_query($con, "UPDATE history SET status='finished' WHERE username='$_SESSION[username]' AND eid='$_GET[eid]' ") or die('Error197');
        $q = mysqli_query($con, "SELECT * FROM history WHERE eid='$_GET[eid]' AND username='$_SESSION[username]'") or die('Error156');
                while ($row = mysqli_fetch_array($q)) {
                    $s = $row['score'];
                    $scorestatus = $row['score_updated'];
                }
                 if($scorestatus=="false"){
                    $q = mysqli_query($con, "UPDATE history SET score_updated='true' WHERE username='$_SESSION[username]' AND eid='$_GET[eid]' ") or die('Error197');
                    $q = mysqli_query($con, "SELECT * FROM rank WHERE username='$username'") or die('Error161');
                    $rowcount = mysqli_num_rows($q);
                    if ($rowcount == 0) {
                        $q2 = mysqli_query($con, "INSERT INTO rank VALUES(NULL,'$username','$s',NOW())") or die('Error165');
                    } else {
                        while ($row = mysqli_fetch_array($q)) {
                            $sun = $row['score'];
                        }
                        
                        $sun = $s + $sun;
                        $q = mysqli_query($con, "UPDATE `rank` SET `score`=$sun ,time=NOW() WHERE username= '$username'") or die('Error174');
                    }
                }
            header('location:account.php?q=result&eid=' . $_GET[eid]);
}

if (@$_GET['q'] == 'quiz' && @$_GET['step'] == 2 && isset($_GET['start']) && $_GET['start'] == "start" && (!isset($_SESSION['6e447159425d2d']))) {
    $q = mysqli_query($con, "SELECT * FROM history WHERE username='$username' AND eid='$_GET[eid]' ") or die('Error197');
    
    if (mysqli_num_rows($q) > 0) {
        $q = mysqli_query($con, "SELECT * FROM history WHERE username='$_SESSION[username]' AND eid='$_GET[eid]' ") or die('Error197');
        while ($row = mysqli_fetch_array($q)) {
            $timel  = $row['timestamp'];
            $status = $row['status'];
        }
        $q = mysqli_query($con, "SELECT * FROM quiz WHERE eid='$_GET[eid]' ") or die('Error197');
        while ($row = mysqli_fetch_array($q)) {
            $ttimel  = $row['time'];
            $qstatus = $row['status'];
        }
        $remaining = (($ttimel * 60) - ((time() - $timel)));
        if ($status == "ongoing" && $remaining > 0 && $qstatus == "enabled") {
            $_SESSION['6e447159425d2d'] = "6e447159425d2d";
            header('location:account.php?q=quiz&step=2&eid=' . $_GET[eid] . '&n=' . $_GET[n] . '&t=' . $_GET[t]);
            
        } else {
                $q = mysqli_query($con, "UPDATE history SET status='finished' WHERE username='$_SESSION[username]' AND eid='$_GET[eid]' ") or die('Error197');
        $q = mysqli_query($con, "SELECT * FROM history WHERE eid='$_GET[eid]' AND username='$_SESSION[username]'") or die('Error156');
                while ($row = mysqli_fetch_array($q)) {
                    $s = $row['score'];
                    $scorestatus = $row['score_updated'];
                }
                 if($scorestatus=="false"){
                    $q = mysqli_query($con, "UPDATE history SET score_updated='true' WHERE username='$_SESSION[username]' AND eid='$_GET[eid]' ") or die('Error197');
                    $q = mysqli_query($con, "SELECT * FROM rank WHERE username='$username'") or die('Error161');
                    $rowcount = mysqli_num_rows($q);
                    if ($rowcount == 0) {
                        $q2 = mysqli_query($con, "INSERT INTO rank VALUES(NULL,'$username','$s',NOW())") or die('Error165');
                    } else {
                        while ($row = mysqli_fetch_array($q)) {
                            $sun = $row['score'];
                        }
                        
                        $sun = $s + $sun;
                        $q = mysqli_query($con, "UPDATE `rank` SET `score`=$sun ,time=NOW() WHERE username= '$username'") or die('Error174');
                    }
                }
            header('location:account.php?q=result&eid=' . $_GET[eid]);
        }
        
    } else {
        $time = time();
        $q = mysqli_query($con, "INSERT INTO history VALUES(NULL,'$username','$_GET[eid]' ,'0','0','0','0',NOW(),'$time','ongoing','false')") or die('Error137');
        $_SESSION['6e447159425d2d'] = "6e447159425d2d";
        header('location:account.php?q=quiz&step=2&eid=' . $_GET["eid"] . '&n=' . $_GET["n"] . '&t=' . $_GET["t"]);
    }
}


if (@$_GET['q'] == 'quiz' && @$_GET['step'] == 2 && isset($_SESSION['6e447159425d2d']) && $_SESSION['6e447159425d2d'] == "6e447159425d2d") {
    $q = mysqli_query($con, "SELECT * FROM history WHERE username='$username' AND eid='$_GET[eid]' ") or die('Error197');
    
    if (mysqli_num_rows($q) > 0) {
        $q = mysqli_query($con, "SELECT * FROM history WHERE username='$_SESSION[username]' AND eid='$_GET[eid]' ") or die('Error197');
        while ($row = mysqli_fetch_array($q)) {
            $time   = $row['timestamp'];
            $status = $row['status'];
        }
        $q = mysqli_query($con, "SELECT * FROM quiz WHERE eid='$_GET[eid]' ") or die('Error197');
        while ($row = mysqli_fetch_array($q)) {
            $ttime   = $row['time'];
            $qstatus = $row['status'];
        }
        $remaining = (($ttime * 60) - ((time() - $time)));
        if ($status == "ongoing" && $remaining > 0 && $qstatus == "enabled") {
            $q = mysqli_query($con, "SELECT * FROM history WHERE username='$_SESSION[username]' AND eid='$_GET[eid]' ") or die('Error197');
            while ($row = mysqli_fetch_array($q)) {
                $time = $row['timestamp'];
            }
            $q = mysqli_query($con, "SELECT * FROM quiz WHERE eid='$_GET[eid]' ") or die('Error197');
            while ($row = mysqli_fetch_array($q)) {
                $ttime = $row['time'];
            }
            $remaining = (($ttime * 60) - ((time() - $time)));
            echo '<script>
var seconds = ' . $remaining . ' ;
function end(){
  data = prompt("Are you sure to end this Exam? Remember, once finished, you wont be able to continue anymore and final results will be displayed. If you want to continue then enter \\"yes\\" in the textbox below and press enter");
  if(data=="yes"){
    window.location ="account.php?q=quiz&step=2&eid=' . $_GET["eid"] . '&n=' . $_GET["n"] . '&t=' . isset($_GET["total"]) . '&endquiz=end";
  }
}
function enable(){
  document.getElementById("sbutton").removeAttribute("disabled");

}
function frmreset(){
  document.getElementById("sbutton").setAttribute("disabled","true");
  document.getElementById("qform").reset();
}
    function secondPassed() {
    var minutes = Math.round((seconds - 30)/60);
    var remainingSeconds = seconds % 60;
    if (remainingSeconds < 10) {
        remainingSeconds = "0" + remainingSeconds; 
    }
    document.getElementById(\'countdown\').innerHTML = minutes + ":" +    remainingSeconds;
    if (seconds <= 0) {
        clearInterval(countdownTimer);
        document.getElementById(\'countdown\').innerHTML = "Buzz Buzz...";
        window.location ="account.php?q=quiz&step=2&eid=' . $_GET["eid"] . '&n=' . $_GET["n"] . '&t=' . isset($_GET["total"]) . '&endquiz=end";
    } else {    
        seconds--;
    }
    }
var countdownTimer = setInterval(\'secondPassed()\', 1000);
</script>';
            echo '<font size="3" style="margin-left:100px;font-family:\'typo\' font-size:20px; font-weight:bold;color:darkred">Time Left : </font><span class="timer btn btn-default" style="margin-left:20px;"><font style="font-family:\'typo\';font-size:20px;font-weight:bold;color:darkblue" id="countdown"></font></span><span class="timer btn btn-primary" style="margin-left:50px" onclick="end()"><span class=" glyphicon glyphicon-off"></span>&nbsp;&nbsp;<font style="font-size:12px;font-weight:bold">Finish Exam</font></span>';
            $eid   = @$_GET['eid'];
            $sn    = @$_GET['n'];
            $total = @$_GET['t'];
            $q     = mysqli_query($con, "SELECT * FROM questions WHERE eid='$eid' AND sn='$sn' ");
            //$q     = mysqli_query($con, "SELECT * FROM questions WHERE eid='$eid'");
            echo '<div class="panel" style="margin-right:5%;margin-left:5%;margin-top:10px;border-radius:10px">';
            while ($row = mysqli_fetch_array($q)) {
                $qns = stripslashes($row['qns']);
                $qid = $row['qid'];
		        $qnsi   = $row['qnsi'];
                echo '<b><pre style="background-color:white"><div style="font-size:20px;font-weight:bold;font-family:calibri;margin:10px;width:200px;word-break:break-all;white-space: pre-wrap;">' . $sn . ' : ' . htmlentities(wordwrap($qns,30,"\n")) . '';	if(!empty($qnsi)){
		echo '<img src="data:image/jpeg;base64,'.base64_encode($qnsi).'" style="width:70px;height:80px;border:1px solid #eeeeee;border-radius:8px;" />';}
		echo '</div></pre></b>';
           }
		  /* 	$q1     = mysqli_query($con, "SELECT anstype FROM quiz WHERE eid='$eid'");
		    while ($row = mysqli_fetch_array($q1)) {
			$type = $row['anstype'];
			if($type == 'D'){
				echo '<br />';
  			    echo '<textarea rows="3" cols="5" name="ans" class="form-control" placeholder="Write your answer here..."></textarea>';

			  }//else if($type == 'M'){
            } 
            */
            echo '<form id="qform" action="update.php?q=quiz&step=2&eid=' . $eid . '&n=' . $sn . '&t=' . $total . '&qid=' . $qid . '" method="POST"  class="form-horizontal">
<br />';
            $q = mysqli_query($con, "SELECT * FROM user_answer WHERE qid='$qid' AND username='$_SESSION[username]' AND eid='$_GET[eid]'") or die("Error222");
            if (mysqli_num_rows($q) > 0) {
                $row = mysqli_fetch_array($q);
                $ans = $row['ans'];
                $q = mysqli_query($con, "SELECT * FROM options WHERE qid='$qid' AND optionid='$ans'") or die("Error222");
                $row = mysqli_fetch_array($q);
                $ans = $row['option'];
            } else {
                $ans = "";
            }
            if (strlen($ans) > 0) {
				 echo "<font style=\"color:green;font-size:12px;font-weight:bold\">Selected answer: </font><font style=\"color:#565252;font-size:12px;\">" . htmlentities($ans) . "</font>&nbsp;&nbsp;<a href=update.php?q=quiz&step=2&eid=$eid&n=$sn&t=$total&qid=$qid&delanswer=delanswer><span class=\"glyphicon glyphicon-trash\" aria-hidden='true' title='Delete selected answer' style=\"font-size:12px;color:blue\"></span></a><br /><br />";
                //echo "<font style=\"color:green;font-size:12px;font-weight:bold\">Selected answer: </font><font style=\"color:#565252;font-size:12px;\">" . $ans . "</font>&nbsp;&nbsp;<a href=update.php?q=quiz&step=2&eid=$eid&n=$sn&t=$total&qid=$qid&delanswer=delanswer><span class=\"glyphicon glyphicon-remove\" style=\"font-size:12px;color:darkred\"></span></a><br /><br />";
            }
            echo '<div class="funkyradio">';
	    	$q1     = mysqli_query($con, "SELECT anstype FROM quiz WHERE eid='$eid'");
		    while ($row = mysqli_fetch_array($q1)) {
			$type = $row['anstype'];
			if($type == 'D'){
				echo '<br />';
  			    echo '<textarea rows="7" cols="5" id="ans" name="ans" class="form-control" placeholder="Write your answer here..." onclick="enable()"></textarea>';

			  }//else if($type == 'M'){
			else{
            $q = mysqli_query($con, "SELECT * FROM options WHERE qid='$qid' ");
            while ($row = mysqli_fetch_array($q)) {
                $option   = stripslashes($row['option']);
                $optionid = $row['optionid'];

                echo '<div class="funkyradio-success"><input type="radio" id="' . $optionid . '" name="ans" value="' . $optionid . '" onclick="enable()"> <label for="' . $optionid . '" style="width:50%"><div style="color:black;font-size:12px;word-wrap:break-word">&nbsp;&nbsp;' . htmlentities(wordwrap($option,10,"\n")) . '</div></label></div>';
            }}}
            echo '</div>';
            if ($_GET["t"] > $_GET["n"] && $_GET["n"] != 1) {
                echo '<br /><a href="account.php?q=quiz&step=2&eid=' . $eid . '&n=' . ($sn - 1) . '&t=' . $total . '" class="btn btn-primary" style="height:30px"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"  style="font-size:12px"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" class="btn btn-default" disabled="true" id="sbutton" style="height:30px"><span class="glyphicon glyphicon-lock" style="font-size:12px" aria-hidden="true"></span><font style="font-size:12px;font-weight:bold"> Lock</font></button>&nbsp;&nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-default" onclick="frmreset()" style="height:30px"></span><font style="font-size:12px;font-weight:bold">Reset</font></button>&nbsp;&nbsp;&nbsp;&nbsp;<a href="account.php?q=quiz&step=2&eid=' . $eid . '&n=' . ($sn + 1) . '&t=' . $total . '" class="btn btn-primary" style="height:30px"><span class="glyphicon glyphicon-arrow-right" aria-hidden="true"  style="font-size:12px"></span></a></form><br><br>';
            } else if ($_GET["t"] == $_GET["n"]) {
                echo '<br /><a href="account.php?q=quiz&step=2&eid=' . $eid . '&n=' . ($sn - 1) . '&t=' . $total . '" class="btn btn-primary" style="height:30px"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"  style="font-size:12px"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" class="btn btn-default" disabled="true" id="sbutton" style="height:30px"><span class="glyphicon glyphicon-lock" style="font-size:12px" aria-hidden="true"></span><font style="font-size:12px;font-weight:bold"> Lock</font></button>&nbsp;&nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-default" onclick="frmreset()" style="height:30px"></span><font style="font-size:12px;font-weight:bold">Reset</font></button>&nbsp;&nbsp;&nbsp;&nbsp;</form><br><br>';
            } else if ($_GET["t"] > $_GET["n"] && $_GET["n"] == 1) {
                echo '<br />&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" class="btn btn-default" disabled="true" id="sbutton" style="height:30px"><span class="glyphicon glyphicon-lock" style="font-size:12px" aria-hidden="true"></span><font style="font-size:12px;font-weight:bold"> Lock<font></button>&nbsp;&nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-default" onclick="frmreset()" style="height:30px"></span><font style="font-size:12px;font-weight:bold">Reset</font></button>&nbsp;&nbsp;&nbsp;&nbsp;<a href="account.php?q=quiz&step=2&eid=' . $eid . '&n=' . ($sn + 1) . '&t=' . $total . '" class="btn btn-primary" style="height:30px"><span class="glyphicon glyphicon-arrow-right" aria-hidden="true"  style="font-size:12px"></span></a></form><br><br>';
            } else {
            }
            echo '</div>';
            echo '<div class="panel" style="text-align:center">';
            $q = mysqli_query($con, "SELECT * FROM questions WHERE eid='$_GET[eid]'") or die("Error222");
            $i = 1;
            while ($row = mysqli_fetch_array($q)) {
                $ques[$row['qid']] = $i;
                $i++;
            }
            $q = mysqli_query($con, "SELECT * FROM user_answer WHERE eid='$_GET[eid]' AND username='$_SESSION[username]'") or die("Error222a");
            $i = 1;
            while ($row = mysqli_fetch_array($q)) {
                if (isset($ques[$row['qid']])) {
                    $quesans[$ques[$row['qid']]] = true;
                }
            }
            for ($i = 1; $i <= $total; $i++) {
                echo '<a href="account.php?q=quiz&step=2&eid=' . $eid . '&n=' . $i . '&t=' . $total . '"  style="margin:5px;padding:5px;background-color:';
                if ($quesans[$i]) {
                    echo "darkgreen";
                } else {
                    echo "darkred";
                }
                echo ';color:white;font-size:16px;font-family:calibri;border-radius:4px">&nbsp;' . $i . '&nbsp;</a>';
            }
        } else {
            unset($_SESSION['6e447159425d2d']);
            $q = mysqli_query($con, "UPDATE history SET status='finished' WHERE username='$_SESSION[username]' AND eid='$_GET[eid]' ") or die('Error197');
        $q = mysqli_query($con, "SELECT * FROM history WHERE eid='$_GET[eid]' AND username='$_SESSION[username]'") or die('Error156');
                while ($row = mysqli_fetch_array($q)) {
                    $s = $row['score'];
                    $scorestatus = $row['score_updated'];
                }
                 if($scorestatus=="false"){
                    $q = mysqli_query($con, "UPDATE history SET score_updated='true' WHERE username='$_SESSION[username]' AND eid='$_GET[eid]' ") or die('Error197');
                    $q = mysqli_query($con, "SELECT * FROM rank WHERE username='$username'") or die('Error161');
                    $rowcount = mysqli_num_rows($q);
                    if ($rowcount == 0) {
                        $q2 = mysqli_query($con, "INSERT INTO rank VALUES(NULL,'$username','$s',NOW())") or die('Error165');
                    } else {
                        while ($row = mysqli_fetch_array($q)) {
                            $sun = $row['score'];
                        }
                        
                        $sun = $s + $sun;
                        $q = mysqli_query($con, "UPDATE `rank` SET `score`=$sun ,time=NOW() WHERE username= '$username'") or die('Error174');
                    }
                }
            header('location:account.php?q=result&eid=' . $_GET[eid]);
        }
		  } else {
        unset($_SESSION['6e447159425d2d']);
        $q = mysqli_query($con, "UPDATE history SET status='finished' WHERE username='$_SESSION[username]' AND eid='$_GET[eid]' ") or die('Error197');
        $q = mysqli_query($con, "SELECT * FROM history WHERE eid='$_GET[eid]' AND username='$_SESSION[username]'") or die('Error156');
                while ($row = mysqli_fetch_array($q)) {
                    $s = $row['score'];
                    $scorestatus = $row['score_updated'];
                }
                if($scorestatus=="false"){
                    $q = mysqli_query($con, "UPDATE history SET score_updated='true' WHERE username='$_SESSION[username]' AND eid='$_GET[eid]' ") or die('Error197');
                    $q = mysqli_query($con, "SELECT * FROM rank WHERE username='$username'") or die('Error161');
                    $rowcount = mysqli_num_rows($q);
                    if ($rowcount == 0) {
                        $q2 = mysqli_query($con, "INSERT INTO rank VALUES(NULL,'$username','$s',NOW())") or die('Error165');
                    } else {
                        while ($row = mysqli_fetch_array($q)) {
                            $sun = $row['score'];
                        }
                        
                        $sun = $s + $sun;
                        $q = mysqli_query($con, "UPDATE `rank` SET `score`=$sun ,time=NOW() WHERE username= '$username'") or die('Error174');
                    }
                }
            header('location:account.php?q=result&eid=' . $_GET[eid]);
    }
}
if (@$_GET['q'] == 'result' && @$_GET['eid']) {
    $eid = @$_GET['eid'];
    $q = mysqli_query($con, "SELECT * FROM quiz WHERE eid='$eid' ") or die('Error157');
    while ($row = mysqli_fetch_array($q)) {
        $total = $row['total'];
		$wr = $row['wrong'];
		$cr = $row['correct'];
    }
    $q = mysqli_query($con, "SELECT * FROM history WHERE eid='$eid' AND username='$username' ") or die('Error157');
    
    while ($row = mysqli_fetch_array($q)) {
        $s      = $row['score'];
        $w      = $row['wrong'];
        $r      = $row['correct'];
        $status = $row['status'];
    }


	if ($status == "finished") {
		$q1     = mysqli_query($con, "SELECT anstype FROM quiz WHERE eid='$eid'");
		while ($row = mysqli_fetch_array($q1)) {
		$type = $row['anstype'];
		if($type == 'M'){

        echo '<div name="result" class="panel"><b><a href="javascript:void(0);" title="Print Result" onclick="printPage();"><span class="glyphicon glyphicon-print" aria-hidden="true"></span></a></b><br /><br />
	<table class="table table-striped title1" style="font-size:20px;font-weight:1000;"><tr><td colspan="2"><center><h1 class="title" style="color:#660033">Result</h1><center></td></tr>';
        echo '<tr style="color:darkblue"><td style="vertical-align:middle">Total Questions</td><td style="vertical-align:middle">' . $total . '</td></tr>
      <tr style="color:darkgreen"><td style="vertical-align:middle">Correct Answer&nbsp;<span class="glyphicon glyphicon-ok-arrow" aria-hidden="true"></span></td><td style="vertical-align:middle">' . $r . '</td></tr> 
    <tr style="color:red"><td style="vertical-align:middle">Wrong Answer&nbsp;<span class="glyphicon glyphicon-remove-arrow" aria-hidden="true"></span></td><td style="vertical-align:middle">' . $w . '</td></tr>
    <tr style="color:orange"><td style="vertical-align:middle">Unattempted&nbsp;<span class="glyphicon glyphicon-ban-arrow" aria-hidden="true"></span></td><td style="vertical-align:middle">' . ($total - $r - $w) . '</td></tr>
    <tr style="color:darkblue"><td style="vertical-align:middle">Score&nbsp;<span class="glyphicon glyphicon-star" aria-hidden="true"></span></td><td style="vertical-align:middle">' . (($r*$cr)-($w*$wr)) . '</td></tr>';
        echo '<tr></tr><tr><td colspan="2"></td></tr><tr><td colspan="2"><div class="panel"><br /><h3 align="center" style="font-family:calibri">:: Detailed Analysis ::</h3><br /></td></tr><tr><td colspan="2"><ol style="font-size:20px;font-weight:bold;font-family:calibri;margin-top:20px">';
        $q = mysqli_query($con, "SELECT * FROM questions WHERE eid='$_GET[eid]'") or die('Error197');
        while ($row = mysqli_fetch_array($q)) {
            $question = $row['qns'];
            $qid      = $row['qid'];
            $qnsi      = $row['qnsi'];
            $q2 = mysqli_query($con, "SELECT * FROM user_answer WHERE eid='$_GET[eid]' AND qid='$qid' AND username='$_SESSION[username]'") or die('Error197');
            if (mysqli_num_rows($q2) > 0) {
                $row1         = mysqli_fetch_array($q2);
                $ansid        = $row1['ans'];
                $correctansid = $row1['correctans'];
                $q3 = mysqli_query($con, "SELECT * FROM options WHERE optionid='$ansid'") or die('Error197');
                $q4 = mysqli_query($con, "SELECT * FROM options WHERE optionid='$correctansid'") or die('Error197');
                $row2       = mysqli_fetch_array($q3);
                $row3       = mysqli_fetch_array($q4);
                $ans        = $row2['option'];
                $correctans = $row3['option'];
            } else {
                $q3 = mysqli_query($con, "SELECT * FROM answer WHERE qid='$qid'") or die('Error197');
                $row1         = mysqli_fetch_array($q3);
                $correctansid = $row1['ansid'];
                $q4 = mysqli_query($con, "SELECT * FROM options WHERE optionid='$correctansid'") or die('Error197');
                $row2       = mysqli_fetch_array($q4);
                $correctans = $row2['option'];
                $ans        = "Unanswered";
            }
            if ($correctans == $ans && $ans != "Unanswered") {
                echo '<li><div style="font-size:16px;font-weight:bold;font-family:calibri;margin-top:20px;background-color:lightgreen;padding:10px;word-wrap:break-word;border:2px solid darkgreen;border-radius:10px;">' . htmlentities($question) . '';	if(!empty($qnsi)){
				echo '<img src="data:image/jpeg;base64,'.base64_encode($qnsi).'" style="width:70px;height:80px;border:1px solid #eeeeee;border-radius:8px;" />';}
				echo '<span class="glyphicon glyphicon-ok" style="color:darkgreen"></span></div><br />';
                echo '<font style="font-size:14px;color:darkgreen"><b>Your Answer: </b></font><font style="font-size:14px;">' . htmlentities($ans) . '</font><br />';
                echo '<font style="font-size:14px;color:darkgreen"><b>Correct Answer: </b></font><font style="font-size:14px;">' . htmlentities($correctans) . '</font><br />';
            } 
            else if ($ans == "Unanswered") {
                echo '<li><div style="font-size:16px;font-weight:bold;font-family:calibri;margin-top:20px;background-color:#f7f576;padding:10px;word-wrap:break-word;border:2px solid #b75a0e;border-radius:10px;">' . htmlentities($question) . '';if(!empty($qnsi)){
				echo '<img src="data:image/jpeg;base64,'.base64_encode($qnsi).'" style="width:70px;height:80px;border:1px solid #eeeeee;border-radius:8px;" />';} echo' </div><br />';
                echo '<font style="font-size:14px;color:darkgreen"><b>Correct Answer: </b></font><font style="font-size:14px;">' . htmlentities($correctans) . '</font><br />';
            } 
            else {
                echo '<li><div style="font-size:16px;font-weight:bold;font-family:calibri;margin-top:20px;background-color:#f99595;padding:10px;word-wrap:break-word;border:2px solid darkred;border-radius:10px;">' . htmlentities($question) . '';if(!empty($qnsi)){
				echo '<img src="data:image/jpeg;base64,'.base64_encode($qnsi).'" style="width:70px;height:80px;border:1px solid #eeeeee;border-radius:8px;" />';} echo' <span class="glyphicon glyphicon-remove" style="color:red"></span></div><br />';
                echo '<font style="font-size:14px;color:darkgreen"><b>Your Answer: </b></font><font style="font-size:14px;">' . htmlentities($ans) . '</font><br />';
                echo '<font style="font-size:14px;color:red"><b>Correct Answer: </b></font><font style="font-size:14px;">' . htmlentities($correctans) . '</font><br />';
            }
            echo "<br /></li>";

        }
        echo '</ol></td></tr>';
		echo 	'<tr><td colspan="2"><center><h4 class="title" style="color:Red"><span class="blinking">Note : Please remember your result for future reference.</span></h4><center></td></tr></table>
		<br />
		<style>.blinking{animation:blinkingText 1.2s infinite;}@keyframes blinkingText{0%{color:blue;}49%{  color:red;}60%{color:transparent;}99%{color:transparent;}100%{color:green;}}</style>';
        echo "</div>";
		} else {
		        /*echo '<div class="panel">
							<center><h1 class="title" style="color:purple">Congratulations!</h1><center><br />
							<center><h2 class="title" style="color:darkgreen">You successfully completed your test!!</h1><center><br />
							<center><h2 class="title" style="color:blue">Good Luck!!!</h1><center><br />';
		        echo "</div>";*/
				
		        echo '<div name="result" class="panel"><b><a href="javascript:void(0);" title="Print Result" onclick="printPage();"><span class="glyphicon glyphicon-print" aria-hidden="true"></span></a></b><br /><br />
	<table class="table table-striped title1" style="font-size:20px;font-weight:1000;"><tr><td colspan="2"><center><h1 class="title" style="color:#660033">Your Answers</h1><center></td></tr>
      <tr><td colspan="2"><ol style="font-size:20px;font-weight:bold;font-family:calibri;margin-top:20px">';
        $q = mysqli_query($con, "SELECT * FROM questions WHERE eid='$_GET[eid]'") or die('Error197');
        while ($row = mysqli_fetch_array($q)) {
            $question = $row['qns'];
            $qid      = $row['qid'];
			$qnsi = $row['qnsi'];
            $q2 = mysqli_query($con, "SELECT * FROM user_answer WHERE eid='$_GET[eid]' AND qid='$qid' AND username='$_SESSION[username]'") or die('Error197');
                $row1         = mysqli_fetch_array($q2);
                $ans        = $row1['ans'];
                echo '<li><div style="font-size:16px;font-weight:bold;font-family:calibri;margin-top:20px;background-color:lightgreen;padding:10px;word-wrap:break-word;border:2px solid darkgreen;border-radius:10px;">' . htmlentities($question) . ''; if(!empty($qnsi)){
				echo '<img src="data:image/jpeg;base64,'.base64_encode($qnsi).'" style="width:70px;height:80px;border:1px solid #eeeeee;border-radius:8px;" />';} echo' <span class="glyphicon glyphicon-ok" style="color:darkgreen"></span></div><br />';
                echo '<font style="font-size:14px;color:darkgreen"><b>Your Answer: </b></font><font style="font-size:14px;">' . htmlentities($ans) . '</font><br />';
        }
        echo '</ol></td></tr>';
		echo 	'<tr><td colspan="2"><center><h4 class="title" style="color:Red"><span class="blinking">Note : Please remember your answers for future reference.</span></h4><center></td></tr></table>
		<br />
		<style>.blinking{animation:blinkingText 1.2s infinite;}@keyframes blinkingText{0%{color:blue;}49%{  color:red;}60%{color:transparent;}99%{color:transparent;}100%{color:green;}}</style>';
        echo "</div>";

		}
	}
  } 
	

 /*   if ($status == "finished") {
        echo '<div class="panel">
<center><h1 class="title" style="color:purple">Congratulations!</h1><center><br />
<center><h2 class="title" style="color:darkgreen">You successfully completed your test!!</h1><center><br />
<center><h2 class="title" style="color:blue">Good Luck!!!</h1><center><br />';
        echo "</div>";
    } */
	else {
        die("Thats a 404 Error bro. You are trying to access a wrong page");
    }
}
if (@$_GET['q'] == 2) {
    $q = mysqli_query($con, "SELECT * FROM history WHERE username='$username' AND status='finished' ORDER BY date DESC ") or die('Error197');
    echo '<div class="panel table-responsive title">
<table class="table table-striped title1" >
<tr><td style="vertical-align:middle"><b>S.N.</b></td><td style="vertical-align:middle"><b>Exam</b></td><td style="vertical-align:middle"><b>Total Questions</b></td><td style="vertical-align:middle"><b>Date & Time</b></td><td style="vertical-align:middle"><b>Action<b></td></tr>';
    $c = 0;
    while ($row = mysqli_fetch_array($q)) {
        $eid = $row['eid'];
        $date      = $row['date'];
        $date      = date("d-m-Y h:i:s", strtotime($date));
        $s   = $row['score'];
        $w   = $row['wrong'];
        $r   = $row['correct'];
        $q23 = mysqli_query($con, "SELECT * FROM quiz WHERE  eid='$eid' ") or die('Error208');
        while ($row = mysqli_fetch_array($q23)) {
            $title = $row['title'];
            $total = $row['total'];
        }
        $c++;
        echo '<tr><td style="vertical-align:middle">' . $c . '</td><td style="vertical-align:middle">' . $title . '</td><td style="vertical-align:middle">' . $total . '</td><td style="vertical-align:middle">' . $date . '</td><td style="vertical-align:middle"><a href="account.php?q=result&eid=' . $eid . '" class="btn" style="margin:0px;background:darkred;color:white">&nbsp;<span class="title1"><b>View Result</b></a></td></tr>';
    }
    echo '</table></div>';
}
if (@$_GET['q'] == 3) {
    if(isset($_GET['show'])){
        $show = $_GET['show'];
        $showfrom = (($show-1)*10) + 1;
        $showtill = $showfrom + 9;
    }
    else{
        $show = 1;
        $showfrom = 1;
        $showtill = 10;
    }
    $q = mysqli_query($con, "SELECT * FROM rank") or die('Error223');
    echo '<div class="panel table-responsive title">
<table class="table table-striped title1" >
<tr><td style="vertical-align:middle"><b>Rank</b></td><td style="vertical-align:middle"><b>Name</b></td><td style="vertical-align:middle"><b>Branch</b></td><td style="vertical-align:middle"><b>Username</b></td><td style="vertical-align:middle"><b>Score</b></td></tr>';
    $c = $showfrom-1;
    $total = mysqli_num_rows($q);
    if($total >= $showfrom){
        $q = mysqli_query($con, "SELECT * FROM rank ORDER BY score DESC, time ASC LIMIT ".($showfrom-1).",10") or die('Error223');
        while ($row = mysqli_fetch_array($q)) {
            $e = $row['username'];
            $s = $row['score'];
            $q12 = mysqli_query($con, "SELECT * FROM user WHERE username='$e' ") or die('Error231');
            while ($row = mysqli_fetch_array($q12)) {
                $name     = $row['name'];
                $branch   = $row['branch'];
                $username = $row['username'];
            }
            $c++;
            echo '<tr><td style="color:#99cc32"><b>' . $c . '</b></td><td style="vertical-align:middle">' . $name . '</td><td style="vertical-align:middle">' . $branch . '</td><td style="vertical-align:middle">' . $username . '</td><td style="vertical-align:middle">' . $s . '</td><td style="vertical-align:middle">';
        }
    }
    else{
    }
    echo '</table></div>';
    echo '<div class="panel table-responsive title"><table class="table table-striped title1" ><tr>';
    $total = round($total/10) + 1;
    if(isset($_GET['show'])){
        $show = $_GET['show'];
    }
    else{
        $show = 1;
    }
    if($show == 1 && $total==1){
    }
    else if($show == 1 && $total!=1){
        $i = 1;
        while($i<=$total){
            echo '<td style="vertical-align:middle;text-align:center"><a style="font-size:14px;font-family:typo;font-weight:bold" href="account.php?q=3&show='.$i.'">&nbsp;'.$i.'&nbsp;</a></td>';
            $i++;
        }
        echo '<td style="vertical-align:middle;text-align:center"><a style="font-size:14px;font-family:typo;font-weight:bold" href="account.php?q=3&show='.($show+1).'">&nbsp;>>&nbsp;</a></td>';
    }
    else if($show != 1 && $show==$total){
        echo '<td style="vertical-align:middle;text-align:center"><a style="font-size:14px;font-family:typo;font-weight:bold" href="account.php?q=3&show='.($show-1).'">&nbsp;<<&nbsp;</a></td>';

        $i = 1;
        while($i<=$total){
            echo '<td style="vertical-align:middle;text-align:center"><a style="font-size:14px;font-family:typo;font-weight:bold" href="account.php?q=3&show='.$i.'">&nbsp;'.$i.'&nbsp;</a></td>';
            $i++;
        }
    }
    else{
        echo '<td style="vertical-align:middle;text-align:center"><a style="font-size:14px;font-family:typo;font-weight:bold" href="account.php?q=3&show='.($show-1).'">&nbsp;<<&nbsp;</a></td>';
        $i = 1;
        while($i<=$total){
            echo '<td style="vertical-align:middle;text-align:center"><a style="font-size:14px;font-family:typo;font-weight:bold" href="account.php?q=3&show='.$i.'">&nbsp;'.$i.'&nbsp;</a></td>';
            $i++;
        }
        echo '<td style="vertical-align:middle;text-align:center"><a style="font-size:14px;font-family:typo;font-weight:bold" href="account.php?q=3&show='.($show+1).'">&nbsp;>>&nbsp;</a></td>';
    }
    echo '</tr></table></div>';
}
?>
</div></div></div></div>
<div class="row footer">
 <div class="col-md-3 box"></div>

</body>
</html>
