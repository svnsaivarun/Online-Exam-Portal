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
<style>
    
    .blinking{
    animation:blinkingText 1.2s infinite;
}
@keyframes blinkingText{
    0%{     color: blue;    }
    49%{    color: red; }
    60%{    color: transparent; }
    99%{    color:transparent;  }
    100%{   color: green;    }
}
</style>
</head>

<body onload="createTable()" style="background:#eee;">
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

<script>
$(document).ready(function(){
    $("a.enable").click(function(e){
        if(!confirm('Are you sure to enable this test?')){
            e.preventDefault();
            return false;
        }
        return true;
    });
});
</script>

<div class="container">
<div class="row">
<div class="col-md-12">
<h3>You have to click "Save" button before going to "Enable" exam</h3>
<script type="text/javascript" src="jquery-latest.js"></script>

<script type="text/javascript">

jQuery(document).ready(function($){

$('.my-form .add-box').click(function(){

var n = $('.text-box').length + 1;

if( 20 < n ) {

alert('Stop it!');

return false;

}

var box_html = $('<p class="text-box"><label for="box' + n + '"><span class="box-number">' + n + '</span></label>&nbsp;<select name="branch[]" id="box' + n + '" class="logb" style="color:#FFFFFF;background:#f0ad4e;font-size:12px;padding:5px;margin:0px;" required><option value="">Select Branch</option><option value="MPCS">M.P.Cs</option><option value="MSTCS">M.St.Cs</option><option value="MSCCOMP">M.Sc(Computers)</option><option value="MSCPHY">M.Sc(Physics)</option><option value="MSCCHEM">M.Sc(Chemistry)</option><option value="MCOM">M.Com</option><option value="MPC">M.P.C</option><option value="BZC">B.Z.C</option><option value="MBC">M.B.C</option><option value="BCOMG">B.Com(Gen)</option> <option value="BCOMR">B.Com(Res)</option></select>&nbsp;<select name="year[]" id="box' + n + '" class="logb" style="color:#FFFFFF;background:#f0ad4e;font-size:12px;padding:5px;margin:0px;" required><option value="">Select Year</option><option value="1">I Year</option><option value="2">II Year</option><option value="3">III Year</option></select> <select name="section[]" id="box' + n + '" class="logb" style="color:#FFFFFF;background:#f0ad4e;font-size:12px;padding:5px;margin:0px;" required><option value="">Select Section</option><option value="A">A Section</option><option value="B">B Section</option></select>&nbsp;<a href="#" class="remove-box"><img src="image/delete.png" title="delete row" style="height:25px; width:20px;"></a></p>');

box_html.hide();

$('.my-form p.text-box:last').after(box_html);

box_html.fadeIn('slow');

return false;

});

$('.my-form').on('click', '.remove-box', function(){

// $(this).parent().css( 'background-color', '#FFFFFF' );

$(this).parent().fadeOut("slow", function() {

$(this).remove();

$('.box-number').each(function(index){

$(this).text( index + 1 );

});

});

return false;

});

});

</script>
	<?php
			$eid = $_GET['eid'];
			$qr = mysqli_query($con, "SELECT title FROM quiz WHERE eid = '$eid'") or die('Error');
			while ($row = mysqli_fetch_array($qr)) {
			$title   = $row['title'];
			
echo '<form method="post" name="frm" action="enable_save.php?eid='.$eid.'">
<br />
<div class="row" id="div1">
<div class="my-form">
<p class="text-box">
<b>1 </b>
		<select name="branch[]" class="logb" style="color:#FFFFFF;background:#f0ad4e;font-size:12px;padding:5px;margin:0px;" required>
		<option value="">Select Branch</option>
		<option value="MPCS">M.P.Cs</option>
		<option value="MSTCS">M.St.Cs</option>
		<option value="MSCCOMP">M.Sc(Computers)</option>
		<option value="MSCPHY">M.Sc(Physics)</option>
		<option value="MSCCHEM">M.Sc(Chemistry)</option>
		<option value="MCOM">M.Com</option>
		<option value="MPC">M.P.C</option>
		<option value="BZC">B.Z.C</option>
		<option value="MBC">M.B.C</option>
		<option value="BCOMG">B.Com(Gen)</option> 
		<option value="BCOMR">B.Com(Res)</option>
		</select>
		<select name="year[]" class="logb" style="color:#FFFFFF;background:#f0ad4e;font-size:12px;padding:5px;margin:0px;" required>
		<option value="">Select Year</option>
		<option value="1">I Year</option>
		<option value="2">II Year</option>
		<option value="3">III Year</option>
		</select>
		<select name="section[]" class="logb" style="color:#FFFFFF;background:#f0ad4e;font-size:12px;padding:5px;margin:0px;" required>
		<option value="">Select Section</option>
		<option value="A">A Section</option>
		<option value="B">B Section</option>
		</select>
<a class="add-box" href="#"><img src="image/sq_plus.png" title="Add row" style="height:25px; width:20px;"></a><br />
</form>
<br/>
<input type="submit" name="save" value="Save" class="btn logb" style="color:#FFFFFF;font-size:12px;padding:5px;margin:0px;"/>&nbsp;&nbsp;';
}?>
</p>
</div>
</div>
<div>
	<?php
echo '
<br/><br/><div class="row">
<span><b>Selected : </b></span><br/>
<table class="table" border="1" style="width:500px;">
<tr><td><b>Branch</b></td><td><b>Year</b></td><td><b>Section</b></td><td><b>Action</b></td></tr>';
			$eid = $_GET['eid'];
			$qr = mysqli_query($con, "SELECT * FROM enable_options WHERE eid = '$eid'") or die('Error');
			while ($row = mysqli_fetch_array($qr)) {
			$cid   = $row['cid'];
			$branch   = $row['branch'];
			$year   = $row['year'];
			$section   = $row['section'];
echo '<tr><td>'.$branch.'</td><td>'.$year.'</td><td>'.$section.'</td><td><a class="add-box" href="#"><a href="enable_delete.php?eid='.$eid.'&cid='.$cid.'" class="remove-box"><img src="image/delete.png" title="delete row" style="height:25px; width:20px;"></a></td></tr>';
}
echo '</table><div><h3 class="blinking">You have to click "Save" button before going to "Enable" exam</h3>';

$result = mysqli_query($con, "SELECT * FROM enable_options WHERE eid = '$eid'")or die('Error');
if(mysqli_num_rows($result) >= 1){
      //return true;
	  echo '<a name="submit" href="update.php?eeidquiz=' . $eid . '" class="btn logb" style="color:#FFFFFF;background:darkgreen;font-size:12px;padding:5px;margin-left:400px;margin:0px;" onclick="return confirm(\'Are you sure to enable this test ?\')"> Enable Exam</a>';
   }else{
      return false;
	    $message = "Select atleast one branch to enable";
        echo "<script type='text/javascript'>
        alert('$message');
        </script>";
   }
echo '</div>';
?>
</div>
</body>
</html>
