<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="icon" href="image/logo.png" type="image/icon" sizes="16x16">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="viewport" content="width=device-width, initial-scale=1">

<title> Admin || Online Exam</title>
<link  rel="stylesheet" href="css/bootstrap.min.css"/>
 <link  rel="stylesheet" href="css/bootstrap-theme.min.css"/>    
 <link rel="stylesheet" href="css/main.css">
 <link  rel="stylesheet" href="css/font.css">
 <script src="js/jquery.js" type="text/javascript"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"  type="text/javascript"></script>
  <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

<script src="http://code.jquery.com/jquery-1.11.1.min.js">

</script>
</head>

<body  style="background:#eee;">
<div class="header">
<div class="row">
<div class="col-lg-6">
<span class="logo">ONLINE EXAM </span></div>
<?php
include_once 'dbConnection.php';
session_start();
if (!(isset($_SESSION['username']))  || ($_SESSION['key']) != '54585c506829293a2d4c3b68543b316e2e7a2d277858545a36362e5f39') {
    session_destroy();
    header("location:index.php");
} else {
    $name     = $_SESSION['name'];
    $username = $_SESSION['username'];
    
    include_once 'dbConnection.php';
    echo '<span class="pull-right top title1" ><span style="color:white"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;&nbsp;&nbsp;&nbsp;Hello,</span> <span class="log log1" style="color:lightyellow">' . $name . '&nbsp;&nbsp;|&nbsp;&nbsp;<a href="logout.php?q=account.php" style="color:lightyellow"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>&nbsp;Logout</button></a></span>';
}
?>
</div></div>
<nav class="navbar navbar-default title1">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="dash.php?q=0"><b>Dashboard</b></a>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li <?php
if (@$_GET['q'] == 0)
    echo 'class="active"';
?>><a href="dash.php?q=0">Home<span class="sr-only">(current)</span></a></li>
        <li <?php
if (@$_GET['q'] == 1)
    echo 'class="active"';
?>><a href="dash.php?q=1">Students</a></li>
    <li <?php
if (@$_GET['q'] == 2)
    echo 'class="active"';
?>><a href="dash.php?q=2">Add Student</a></li>
    <li <?php
if (@$_GET['q'] == 3)
    echo 'class="active"';
?>><a href="dash.php?q=3">Feedback</a></li>
        <li <?php
if (@$_GET['q'] == 4)
    echo 'class="active"';
?>><a href="dash.php?q=4">Add Exam</a></li>
        <li <?php
if (@$_GET['q'] == 5)
    echo 'class="active"';
?>><a href="dash.php?q=5">Remove Exam</a></li>
    <li <?php
if (@$_GET['q'] == 6)
    echo 'class="active"';
?>><a href="dash.php?q=6">Scoreboard</a></li>
      </ul>
          </div>
  </div>
</nav>
<div class="container">
<div class="row">
<div class="col-md-12">
<div style="margin-bottom:10px;">
<script type="text/javascript">
 function printPage(){
        var tableData = '<table border="1" class="table">'+document.getElementsByTagName('table')[0].innerHTML+'</table>';
        var data = '<button onclick="window.print()">Print this page</button>'+tableData;       
        myWindow=window.open('','','width=800,height=600');
        myWindow.innerWidth = screen.width;
        myWindow.innerHeight = screen.height;
        myWindow.screenX = 0;
        myWindow.screenY = 0;
        myWindow.document.write(data);
        myWindow.focus();
    };
 </script>
	 <?php
	    $eid = $_GET['eid'];
		echo '<a href="dash.php?q=0" class="btn logb" title="Close Preview" style="color:#FFFFFF;background:darkblue;font-size:12px;padding:5px;margin:0px;">&nbsp;&nbsp; Close &nbsp;&nbsp;</a>
		&nbsp;';
		$query = mysqli_query($con, "SELECT * FROM quiz WHERE eid = '$eid'") or die('Error');
        while ($row = mysqli_fetch_array($query)) {
		$title = $row['title'];
        $n   = $row['total'];
		$a = $row['anstype'];
		echo '
		<a href="questions/index.php?eid='.$eid.'&n='.$n.'&a='.$a.'" class="btn logb" title="Edit Question Paper" style="color:#FFFFFF;background:darkgreen;font-size:12px;padding:5px;margin:0px;">&nbsp;&nbsp; Edit Question Paper &nbsp;&nbsp;</a>';

		echo '&nbsp;&nbsp;<a href="javascript:void(0);" title="Print Paper" onclick="printPage();" class="btn logb"style="color:#FFFFFF;background:orange;font-size:12px;padding:5px;margin:0px;">&nbsp;&nbsp;Print&nbsp;&nbsp;</a></div>
	   <form action="" method="post" class="form-horizontal " enctype="multipart/form-data">
	  <table border="1" class="table" cellpadding="5" cellspacing="5" style="vertical-align:middle;background-color:white;"><tr>
	  <td style="vertical-align:middle;text-align:center;"><img src="image/logo.png" title="Logo" alt="logo" style="width: 150px;" /></td>
	 <td colspan="6" style="vertical-align:middle;"> <span><h1><font color="green">Vellore Institute of Technology, Andhra Pradesh</font></h1></span></td></tr>
       <tr><td colspan="7" style="vertical-align:middle;text-align:center"><span style="color:red"><h4 class="modal-title" style="font-family:"typo" "><u>Paper title : '.$title.'</u></h4></span></td>
		</tr>
		<tr><td style="vertical-align:middle; text-align:center;"><b>S.N.</b></td> <td style="vertical-align:middle;"><b>Question</b></td><td  style="vertical-align:middle;"><b>Option A</b></td><td  style="vertical-align:middle;"><b>Option B</b></td><td  style="vertical-align:middle;"><b>Option C</b></td><td  style="vertical-align:middle;"><b>Option D</b></td><td style="vertical-align:middle;"><b>Correct Answer</b></td></tr>';
        $anstype   = $row['anstype'];
		if($anstype == 'M'){
		$qr1 = mysqli_query($con, "SELECT * FROM questions WHERE eid = '$eid'") or die('Error5');
	    $c = 1;
        while ($row = mysqli_fetch_array($qr1)) {
        $qid   = $row['qid'];
        $qns   = $row['qns'];
        $qnsi   = $row['qnsi'];
		echo '<tr><td style="vertical-align:middle; text-align:center;word-break:break-all;">'.$c++.'</td> <td style="vertical-align:middle;word-break:break-all;">'.htmlentities($qns).'';
		if(!empty($qnsi)){
		echo '<img src="data:image/jpeg;base64,'.base64_encode($row['qnsi']).'" style="width:300px;height:250px;border:1px solid #eeeeee;border-radius:8px;" />';}
		echo '</td>';
		$qr2 = mysqli_query($con, "SELECT * FROM options WHERE qid = '$qid'") or die('Error6');
		while ($row = mysqli_fetch_array($qr2)) {
		$option = $row['option'];
		for($i=1;$i<=sizeof((array)$option);$i++){
		echo'<td style="vertical-align:middle;word-break:break-all;">'.htmlentities($option).'</td>';
				}
			}
		$qr3 = mysqli_query($con, "SELECT * FROM options JOIN answer ON options.optionid = answer.ansid WHERE options.qid = '$qid'") or die('Error7');
		while ($row = mysqli_fetch_array($qr3)) {
		$ans = $row['option'];
		echo '<td style="vertical-align:middle;word-break:break-all;">'.htmlentities($ans).'</td>';
			}
		}
		//echo '<tr><td colspan="7">&nbsp;</td></tr><tr><td colspan="7">&nbsp;</td></tr>';
		} else {
		$qr1 = mysqli_query($con, "SELECT * FROM questions WHERE questions.eid = '$eid'") or die('Error8');
	    $c = 1;
        while ($row = mysqli_fetch_array($qr1)) {
        $qid   = $row['qid'];
        $qns   = $row['qns'];
        $qnsi   = $row['qnsi'];
		echo '<tr><td style="vertical-align:middle; text-align:center;">'.$c++.'</td> <td style="vertical-align:middle">'.htmlentities($qns).'	';	if(!empty($qnsi)){
		echo '<img src="data:image/jpeg;base64,'.base64_encode($qnsi).'" style="width:300px;height:250px;border:1px solid #eeeeee;border-radius:8px;" />';}
		echo '</td><td style="vertical-align:middle;text-align:center;">-</td><td style="vertical-align:middle;text-align:center;">-</td><td style="vertical-align:middle;text-align:center;">-</td><td style="vertical-align:middle;text-align:center;">-</td><td style="vertical-align:middle;text-align:center;">-</td></tr>';
		}
		}
		//echo '<tr><td colspan="7" rowspan="4">&nbsp;</td></tr>';
		}
		'</table>
	  </form>  ';
?>
</div>
</div></div>
</body>
</html>
