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

$(function () {
    $(document).on( /*'scroll',*/ function(){
        console.log('scroll top : ' + $(window).scrollTop());
        if($(window).scrollTop()>=$(".logo").height())
        {
             $(".navbar").addClass("navbar-fixed-top");
        }

        if($(window).scrollTop()<$(".logo").height())
        {
             $(".navbar").removeClass("navbar-fixed-top");
        }
    });
});

$(document).ready(function(){
    $("a.delete").click(function(e){
        if(!confirm('Are you sure to remove this test?')){
            e.preventDefault();
            return false;
        }
        return true;
    });
});

$(document).ready(function(){
    $("input.add").click(function(e){
        if(!confirm('Are you sure to add this test?')){
            e.preventDefault();
            return false;
        }
        return true;
    });
});

$(document).ready(function(){
    $("a.enable").click(function(e){
        if(!confirm('Are you sure to enable this test?')){
            e.preventDefault();
            return false;
        }
        return true;
    });
});

$(document).ready(function(){
    $("a.disable").click(function(e){
        if(!confirm('Are you sure to disable this test?')){
            e.preventDefault();
            return false;
        }
        return true;
    });
});

/*$('#preview').on('show.bs.modal', function (event) {
  var myVal = $(event.relatedTarget).data('val');
  $(this).find(".modal-body").text(myVal);
});*/

$('#classModal').modal('show')

	
	$(document).ready(function(){
		$('#submit').click(function(){
			var image_name = $('#profile').val();
			if(image_name == '')
			{
				alert("Please Select Image");
				return flase;
			}
			else
			{
				var extension = $('#profile').val().split('.').pop().tolowercase();
				if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)
				{
					alert('Invalid Image File');
					$('#profile').val('');
					return false;
				}
			}
		});
})

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
?>><a href="dash.php?q=3">Add Teacher</a></li>
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
    <li <?php
if (@$_GET['q'] == 7)
    echo 'class="active"';
?> hidden><a href="dash.php?q=7" hidden></a></li>
      </ul>
          </div>
  </div>
</nav>
<script>
function validateForm(e) {
  var y = document.forms["form"]["name"].value; 
  if (y == null || y == "") {
    document.getElementById("errormsg").innerHTML="Name must be filled out.";
    return false;
  }
  var r = document.forms["form"]["rollno"].value; 
  if (r == null || r == "") {
    document.getElementById("errormsg").innerHTML="Roll number must be filled out.";
    return false;
  }
  var br = document.forms["form"]["branch"].value;
  if (br == "") {
    document.getElementById("errormsg").innerHTML="Please select your branch";
    return false;
  }
  if (m.length < 10) {
    document.getElementById("errormsg").innerHTML="Passwords must be 12 digits long";
    return false;
  }
  var g = document.forms["form"]["gender"].value;
  if (g=="") {
    document.getElementById("errormsg").innerHTML="Please select your gender";
    return false;
  }
  var x = document.forms["form"]["username"].value;
  if (x.length == 0) {
    document.getElementById("errormsg").innerHTML="Please enter a valid username";
    return false;
  }
  if (x.length < 4) {
    document.getElementById("errormsg").innerHTML="Username must be at least 4 characters long";
    return false;
  }
  var m = document.forms["form"]["phno"].value;
  if (m.length != 10) {
    document.getElementById("errormsg").innerHTML="Phone number must be 10 digits long";
    return false;
  }
  var a = document.forms["form"]["password"].value;
  if(a == null || a == ""){
    document.getElementById("errormsg").innerHTML="Password must be filled out";
    return false;
  }
  if(a.length<4 || a.length>15){
    document.getElementById("errormsg").innerHTML="Passwords must be 4 to 15 characters long.";
    return false;
  }
  var b = document.forms["form"]["cpassword"].value;
  if (a!=b){
    e.preventDefault();
    document.getElementById("errormsg").innerHTML="Passwords must match.";
    return false;
  }
}
	$(document).ready(function(){
		$('#insert').click(function(){
			var image_name = $('#qnsi').val();
			if(image_name == '')
			{
				alert("Please Select Image");
				return flase;
			}
			else
			{
				var extension = $('#qnsi').val().split('.').pop().tolowercase();
				if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)
				{
					alert('Invalid Image File');
					$('#qnsi').val('');
					return false;
				}
			}
		});
})
</script>

<div class="container">
<div class="row">
<div class="col-md-12">
<?php
if (@$_GET['q'] == 0) {
    include 'dash/index.php';
	
}
if (@$_GET['q'] == 2) {
    echo ' 
<div class="row">
<span class="title1" style="margin-left:35%;font-size:30px;"><b>Enter Student Details</b></span><br /><br />
 <div class="col-md-3"></div><div class="col-md-6">   
<form class="form-horizontal title1" name="form" action="sign.php?q=account.php" method="POST" onSubmit="return validateForm()" enctype="multipart/form-data">
<fieldset>
<div class="form-group">
  <label class="col-md-12 control-label" for="name"></label>  
  <div class="col-md-12">
  <div id="errormsg" style="font-size:14px;font-family:calibri;font-weight:normal;color:red">';
if (@$_GET['q7']) {
    echo '<p style="color:red;font-size:15px;">' . @$_GET['q7'];
}
echo '</div>
    
  </div>
</div>
<div class="form-group">
  <label class="col-md-12 control-label" for="name"></label>  
  <div class="col-md-12">
  <input id="name" name="name" placeholder="Enter your name" class="form-control input-md" type="text" value="';
if (isset($_GET['name']))
{
echo $_GET['name'];
} echo '" required pattern="[A-Za-z]+" title="allows only alphabets">
    
  </div>
</div>
<div class="form-group">
  <label class="col-md-12 control-label" for="rollno"></label>  
  <div class="col-md-12">
  <input id="rollno" name="rollno" placeholder="Enter your Roll Number" class="form-control input-md" type="text" maxlength="10" value="';
if (isset($_GET['rollno']))
{
echo $_GET['rollno'];
}echo'" required pattern="[A-Za-z0-9]{10}" title="allows only alphabets and digits">    
  </div>
</div>
<div class="form-group">
  <label class="col-md-12 control-label" for="gender"></label>
  <div class="col-md-12">
    <select id="gender" name="gender" placeholder="Select your gender" class="form-control input-md" required>
   <option value="" ';
if (!isset($_GET['gender']))
    echo "selected";
   echo'>Select Gender</option>
  <option value="M" ';
  if (isset($_GET['gender']))
  {
if ($_GET['gender'] == "M")
    echo "selected";
  }
echo'>Male</option>
  <option value="F" <';
  if (isset($_GET['gender']))
  {
if ($_GET['gender'] == "F")
    echo "selected";
  }
echo'>Female</option> </select>
  </div>
</div>
<div class="form-group">
  <label class="col-md-12 control-label" for="branch"></label>
  <div class="col-md-12">
    <select id="branch" name="branch" placeholder="Select your branch" class="form-control input-md" required>
   <option value="" <';
if (!isset($_GET['branch']))
    echo "selected";
echo'>Select Branch</option>
  <option value="MPCS" <';
  if (isset($_GET['branch']))
  {
if ($_GET['branch'] == "MPCS")
    echo "selected";
  }
  echo'>M.P.Cs</option>
  <option value="MSTCS" <';
  if (isset($_GET['branch']))
  {
if ($_GET['branch'] == "MSTCS")
    echo "selected";
  }
echo'>M.St.Cs</option>
<option value="MSCCOMP" <';
  if (isset($_GET['branch']))
  {
if ($_GET['branch'] == "MSCCOMP")
    echo "selected";
  }
  echo'>M.Sc(Computers)</option>
  <option value="MSCPHY" ';
  if (isset($_GET['branch']))
  {
if ($_GET['branch'] == "MSCPHY")
    echo "selected";
  }
  echo'>M.Sc(Physics)</option>
  <option value="MSCCHEM" ';
  if (isset($_GET['branch']))
  {
if ($_GET['branch'] == "MSCCHEM")
    echo "selected";
  }
  echo'>M.Sc(Chemistry)</option>
  <option value="MCOM" ';
  if (isset($_GET['branch']))
  {
if ($_GET['branch'] == "MCOM")
    echo "selected";
  }
  echo'>M.Com</option>
  <option value="MPC" ';
  if (isset($_GET['branch']))
  {
if ($_GET['branch'] == "MPC")
    echo "selected";
  }
echo'>M.P.C</option>
  <option value="BZC" ';
  if (isset($_GET['branch']))
  {
  if ($_GET['branch'] == "BZC")
    echo "selected";
  }
echo'>B.Z.C</option>
  <option value="MBC" ';
  if (isset($_GET['branch']))
  {
if ($_GET['branch'] == "MBC")
    echo "selected";
  }
echo'>M.B.C</option>
  <option value="BCOMG" ';
  if (isset($_GET['branch']))
  {
if ($_GET['branch'] == "BCOMG")
    echo "selected";
  }
echo'>B.Com(Gen)</option> 
  <option value="BCOMR" ';
  if (isset($_GET['branch']))
  {
if ($_GET['branch'] == "BCOMR")
    echo "selected";
  }
echo'>B.Com(Res)</option> 
</select>
  </input>
  </div>
</div>
<div class="form-group">
  <label class="col-md-12 control-label" for="year"></label>
  <div class="col-md-12">
    <select id="year" name="year" placeholder="Select year" class="form-control input-md" required>
   <option value="" ';
if (!isset($_GET['year']))
    echo "selected";
   echo'>Select Year</option>
  <option value="1" ';
  if (isset($_GET['year']))
  {
if ($_GET['year'] == "1")
    echo "selected";
  }
echo'>I year</option>
  <option value="2" <';
  if (isset($_GET['year']))
  {
if ($_GET['year'] == "2")
    echo "selected";
  }
echo'>II year</option> 
  <option value="3" <';
  if (isset($_GET['year']))
  {
if ($_GET['year'] == "3")
    echo "selected";
  }
echo'>III year</option> </select>
  </div>
</div>
<div class="form-group">
  <label class="col-md-12 control-label" for="section"></label>
  <div class="col-md-12">
    <select id="section" name="section" placeholder="Select section" class="form-control input-md" required>
   <option value="" ';
if (!isset($_GET['section']))
    echo "selected";
   echo'>Select Section</option>
  <option value="A" ';
  if (isset($_GET['section']))
  {
if ($_GET['section'] == "A")
    echo "selected";
  }
echo'>A Section</option>
  <option value="B" <';
  if (isset($_GET['section']))
  {
if ($_GET['section'] == "B")
    echo "selected";
  }
echo'>B Section</option> </select>
  </div>
</div>
<div class="form-group">
  <label class="col-md-12 control-label title1" for="username"></label>
  <div class="col-md-12">
    <input id="username" name="username" placeholder="Choose a username" class="form-control input-md" type="username" value="';
if (isset($_GET['username']))
{
echo $_GET['username'];
};
echo'" style="';
if (isset($_GET['q7']))
    echo "border-color:red";
echo'" required pattern="[A-Za-z0-9]+" title="allows only alphabets and digits">

  </div>
</div>
<div class="form-group">
  <label class="col-md-12 control-label" for="email"></label>  
  <div class="col-md-12">
  <input id="email" name="email" placeholder="Enter your email" class="form-control input-md" type="email" value="';
if (isset($_GET['email']))
{
echo $_GET['email'];
};
echo'" style="';
if (isset($_GET['q8']))
    echo "border-color:red";
echo'" required pattern="[A-Za-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title="must contain `@` and `.` symbols">    
  </div>
</div>
<div class="form-group">
  <label class="col-md-12 control-label" for="phno"></label>  
  <div class="col-md-12">
  <input id="phno" name="phno" placeholder="Enter your mobile number" class="form-control input-md" type="tel" maxlength="10" value="';
if (isset($_GET['phno']))
{
echo $_GET['phno'];
}
echo'" required pattern="\d{10}" title="allows only digits">
    
  </div>
</div>
<div class="form-group">
  <label class="col-md-12 control-label" for="password"></label>
  <div class="col-md-12">
    <input id="password" name="password" placeholder="Enter your password" maxlength="10" class="form-control input-md" type="password" ';
	// pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{10,}" 
	echo'onchange="form.cpassword.pattern = this.value;" required title="maximum length 10">
    
  </div>
</div>

<div class="form-group">
  <label class="col-md-12control-label" for="cpassword"></label>
  <div class="col-md-12">
    <input id="cpassword" name="cpassword" placeholder="Confirm Password" class="form-control input-md" type="password" pattern="" required title="must match with the password">
    
  </div>
</div>
<div class="form-group">
  <label class="col-md-12control-label" for="profile"></label>
  <div class="col-md-12">
    <input id="profile" name="profile" placeholder="Upload Your Profile" class="form-control input-md" type="file" title="must be .jpg/ .jpeg/ .png" />
	<span style="text-align:right">Note : For better result, use default size images (3.5cm*4.5cm)</span>
    
  </div>
</div>
<div class="form-group">
  <label class="col-md-12 control-label" for=""></label>
  <div class="col-md-12" style="text-align: center"> 
    <input  type="submit" name="submit" id="submit" value=" Register Now " class="btn btn-primary" style="text-align:center" />
  </div>
</div>

</fieldset>
</form></div>';
}
if (@$_GET['q'] == 1) {
    echo '<div style="text-align:right"><a title="Open Alumni" href="#" data-toggle="modal" data-target="#alumni"><b><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span></b></a></div>';
    $result = mysqli_query($con, "SELECT * FROM user ORDER BY name ASC") or die('Error');
    echo '<div class="panel table-responsive"><table class="table table-striped title1">
<tr><td style="vertical-align:middle"><b>S.N.</b></td><td style="vertical-align:middle"><b>Name</b></td><td style="vertical-align:middle"><b>Gender</b></td><td style="vertical-align:middle"><b>Rollno</b></td><td style="vertical-align:middle"><b>Branch</b></td><td style="vertical-align:middle"><b>Year</b></td><td style="vertical-align:middle"><b>Section</b></td><td style="vertical-align:middle"><b>Username</b></td><td style="vertical-align:middle"><b>Password</b></td><td style="vertical-align:middle"><b>Phno</b></td><td style="vertical-align:middle"><b>Profile</b></td><td style="vertical-align:middle"></td></tr>';
    $c = 1;
    while ($row = mysqli_fetch_array($result)) {
        $name      = $row['name'];
        $phno      = $row['phno'];
        $gender    = $row['gender'];
        $rollno    = $row['rollno'];
        $branch    = $row['branch'];
        $year    = $row['year'];
        $section    = $row['section'];
        $username1 = $row['username'];
        $password = $row['password'];
        $profile = $row['profile'];
        
        echo '<tr><td style="vertical-align:middle">' . $c++ . '</td><td style="vertical-align:middle">' . $name . '</td><td style="vertical-align:middle">' . $gender . '</td><td style="vertical-align:middle">' . $rollno . '</td><td style="vertical-align:middle">' . $branch . '</td><td style="vertical-align:middle">' . $year . '</td><td style="vertical-align:middle">' . $section . '</td><td style="vertical-align:middle">' . $username1 . '</td><td style="vertical-align:middle">' . $password . '</td><td style="vertical-align:middle">' . $phno . '</td><td style="vertical-align:middle">'; 
		if($profile!= NULL){ echo'<img src="data:image/jpeg;base64,'.base64_encode($profile).'" style="width:70px;height:80px;border:1px solid #000000;border-radius:8px;" />'; }else{echo'<img src="image/NO-IMAGE-AVAILABLE.jpg" style="width:70px;height:80px;border:1px solid #000000;border-radius:8px;" />';} echo'</td>
  <td style="vertical-align:middle"><a title="Delete User" href="update.php?dusername=' . $username1 . '" onclick="return confirm(\'Are you sure to remove this user ?\')"><b><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></b></a></td></tr>';
    }
    $c = 0;
    echo '</table></div>

<!-- Modal For Alumni-->
<div class="modal fade title1" id="alumni">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" style="font-family:"typo" "><span style="color:orange">Alumni</span></h4>
      </div>
      <div class="modal-body">
	  <style>.paneli{border-color:#eee;margin: 4px; padding: 2px;font: 15px "Century Gothic", "Times Roman", sans-serif;}</style>';
	    $result = mysqli_query($con, "SELECT * FROM alumni") or die('Error');
	    echo '<div class="paneli table-responsive"><table class="table table-striped title1">
				<tr><td style="vertical-align:middle"><b>S.N.</b></td><td style="vertical-align:middle"><b>Name</b></td><td style="vertical-align:middle"><b>Gender</b></td><td style="vertical-align:middle"><b>Rollno</b></td><td style="vertical-align:middle"><b>Branch</b></td><td style="vertical-align:middle"><b>Year</b></td><td style="vertical-align:middle"><b>Section</b></td><td style="vertical-align:middle"><b>Username</b></td><td style="vertical-align:middle"><b>Password</b></td><td style="vertical-align:middle"><b>Phno</b></td><td style="vertical-align:middle"><b>Profile</b></td><td style="vertical-align:middle"></td></tr>';
	    $c = 1;
		while ($row = mysqli_fetch_array($result)) {
			$name      = $row['name'];
	        $phno      = $row['phno'];
		    $gender    = $row['gender'];
			$rollno    = $row['rollno'];
	        $branch    = $row['branch'];
	        $year    = $row['year'];
	        $section    = $row['section'];
		    $username1 = $row['username'];
			$password = $row['password'];
	        $profile = $row['profile'];
        
        echo '<tr><td style="vertical-align:middle">' . $c++ . '</td><td style="vertical-align:middle">' . $name . '</td><td style="vertical-align:middle">' . $gender . '</td><td style="vertical-align:middle">' . $rollno . '</td><td style="vertical-align:middle">' . $branch . '</td><td style="vertical-align:middle">' . $year . '</td><td style="vertical-align:middle">' . $section . '</td><td style="vertical-align:middle">' . $username1 . '</td><td style="vertical-align:middle">' . $password . '</td><td style="vertical-align:middle">' . $phno . '</td><td>';
		if($profile!= NULL){ echo'<img src="data:image/jpeg;base64,'.base64_encode($profile).'" style="width:70px;height:80px;border:1px solid #000000;border-radius:8px;" />'; }else{echo'<img src="image/NO-IMAGE-AVAILABLE.jpg" style="width:70px;height:80px;border:1px solid #000000;border-radius:8px;" />';} echo'</td>
		<td style="vertical-align:middle"><a title="Delete Permanently" href="update.php?alumni=' . $username1 . '" onclick="return confirm(\'Are you sure to remove this user permanently ?\')"><b><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></b></a></td></tr>';
		}
		$c = 0;
		echo '</table></div>
      </div>

    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
	';   
}
if (@$_GET['q'] == 3) {
  echo ' 
  <div class="row">
  <span class="title1" style="margin-left:35%;font-size:30px;"><b>Enter Teacher Details</b></span><br /><br />
   <div class="col-md-3"></div><div class="col-md-6">   
  <form class="form-horizontal title1" name="form" action="teacher.php?q=account.php" method="POST" onSubmit="return validateForm()" enctype="multipart/form-data">
  <fieldset>
  <div class="form-group">
    <label class="col-md-12 control-label" for="name"></label>  
    <div class="col-md-12">
    <div id="errormsg" style="font-size:14px;font-family:calibri;font-weight:normal;color:red">';
  if (@$_GET['q7']) {
      echo '<p style="color:red;font-size:15px;">' . @$_GET['q7'];
  }
  echo '</div>
      
    </div>
  </div>
  <div class="form-group">
    <label class="col-md-12 control-label" for="name"></label>  
    <div class="col-md-12">
    <input id="name" name="name" placeholder="Enter your name" class="form-control input-md" type="text" value="';
  if (isset($_GET['name']))
  {
  echo $_GET['name'];
  } echo '" required pattern="[A-Za-z]+" title="allows only alphabets">
      
    </div>
  </div>
  <div class="form-group">
    <label class="col-md-12 control-label" for="empid"></label>  
    <div class="col-md-12">
    <input id="empid" name="empid" placeholder="Enter your Employee ID" class="form-control input-md" type="text" maxlength="10" value="';
  if (isset($_GET['empid']))
  {
  echo $_GET['empid'];
  }echo'" required pattern="[A-Za-z0-9]{10}" title="allows only alphabets and digits">    
    </div>
  </div>
  <div class="form-group">
    <label class="col-md-12 control-label" for="gender"></label>
    <div class="col-md-12">
      <select id="gender" name="gender" placeholder="Select your gender" class="form-control input-md" required>
     <option value="" ';
  if (!isset($_GET['gender']))
      echo "selected";
     echo'>Select Gender</option>
    <option value="M" ';
    if (isset($_GET['gender']))
    {
  if ($_GET['gender'] == "M")
      echo "selected";
    }
  echo'>Male</option>
    <option value="F" <';
    if (isset($_GET['gender']))
    {
  if ($_GET['gender'] == "F")
      echo "selected";
    }
  echo'>Female</option> </select>
    </div>
  </div>
  <div class="form-group">
    <label class="col-md-12 control-label title1" for="username"></label>
    <div class="col-md-12">
      <input id="username" name="username" placeholder="Choose a username" class="form-control input-md" type="username" value="';
  if (isset($_GET['username']))
  {
  echo $_GET['username'];
  };
  echo'" style="';
  if (isset($_GET['q7']))
      echo "border-color:red";
  echo'" required pattern="[A-Za-z0-9]+" title="allows only alphabets and digits">
  
    </div>
  </div>
  <div class="form-group">
    <label class="col-md-12 control-label" for="email"></label>  
    <div class="col-md-12">
    <input id="email" name="email" placeholder="Enter your email" class="form-control input-md" type="email" value="';
  if (isset($_GET['email']))
  {
  echo $_GET['email'];
  };
  echo'" style="';
  if (isset($_GET['q8']))
      echo "border-color:red";
  echo'" required pattern="[A-Za-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title="must contain `@` and `.` symbols">    
    </div>
  </div>
  <div class="form-group">
    <label class="col-md-12 control-label" for="phno"></label>  
    <div class="col-md-12">
    <input id="phno" name="phno" placeholder="Enter your mobile number" class="form-control input-md" type="tel" maxlength="10" value="';
  if (isset($_GET['phno']))
  {
  echo $_GET['phno'];
  }
  echo'" required pattern="\d{10}" title="allows only digits">
      
    </div>
  </div>
  <div class="form-group">
    <label class="col-md-12 control-label" for="password"></label>
    <div class="col-md-12">
      <input id="password" name="password" placeholder="Enter your password" maxlength="10" class="form-control input-md" type="password" ';
    // pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{10,}" 
    echo'onchange="form.cpassword.pattern = this.value;" required title="maximum length 10">
      
    </div>
  </div>
  
  <div class="form-group">
    <label class="col-md-12control-label" for="cpassword"></label>
    <div class="col-md-12">
      <input id="cpassword" name="cpassword" placeholder="Confirm Password" class="form-control input-md" type="password" pattern="" required title="must match with the password">
      
    </div>
  </div>
  <div class="form-group">
    <label class="col-md-12control-label" for="profile"></label>
    <div class="col-md-12">
      <input id="profile" name="profile" placeholder="Upload Your Profile" class="form-control input-md" type="file" title="must be .jpg/ .jpeg/ .png" />
    <span style="text-align:right">Note : For better result, use default size images (3.5cm*4.5cm)</span>
      
    </div>
  </div>
  <div class="form-group">
    <label class="col-md-12 control-label" for=""></label>
    <div class="col-md-12" style="text-align: center"> 
      <input  type="submit" name="submit" id="submit" value=" Register Now " class="btn btn-primary" style="text-align:center" />
    </div>
  </div>
  
  </fieldset>
  </form></div>';
}
if (@$_GET['q'] == 4 && !(@$_GET['step'])) {
echo '<div class="row">
<span class="title1" style="margin-left:35%;font-size:30px;"><b>Enter Exam Details</b></span><br /><br />
 <div class="col-md-3"></div><div class="col-md-6">   <form class="form-horizontal title1" name="form" action="update.php?q=addquiz"  method="POST">
<fieldset>
<div class="form-group">
  <label class="col-md-12 control-label" for="name"></label>  
  <div class="col-md-12">
  <input id="name" name="name" placeholder="Enter Exam title" class="form-control input-md" type="text" required />
    
  </div>
</div>
<div class="form-group">
  <label class="col-md-12 control-label" for="total"></label>  
  <div class="col-md-12">
  <input id="total" name="total" placeholder="Enter total number of questions" class="form-control input-md" type="number" required />
    
  </div>
</div>
<div class="form-group">
  <label class="col-md-12 control-label" for="right"></label>  
  <div class="col-md-12">
  <input id="right" name="right" placeholder="Enter marks on right answer" class="form-control input-md" min="0" type="number" required />
    
  </div>
</div>
<div class="form-group">
  <label class="col-md-12 control-label" for="wrong"></label>  
  <div class="col-md-12">
  <input id="wrong" name="wrong" placeholder="Enter minus marks on wrong answer without sign" class="form-control input-md" min="0" type="number" required />
    
  </div>
</div>
<div class="form-group">
  <label class="col-md-12 control-label" for="time"></label>  
  <div class="col-md-12">
  <input id="time" name="time" placeholder="Enter time limit for test in minute" class="form-control input-md" min="1" type="number" required />
    
  </div>
</div>
<div class="form-group">
  <label class="col-md-12 control-label" for="anstype"></label>
  <div class="col-md-12">
   <select id="anstype" name="anstype" class="form-control input-md" required>
   <option value="">Select Answer Type</option>
   <option value="M">Multiple choice</option>
  <option value="D">Descriptive</option> </select>
  </div>    
  </div>

</div>

<div class="form-group">
  <label class="col-md-12 control-label" for=""></label>
  <div class="col-md-12"> 
    <input  type="submit" style="margin-left:45%" class="btn btn-primary" value="Submit" class="btn btn-primary add" onclick="return confirm(\'Are you sure to add this test ?\')"/>
  </div>
</div>

</fieldset>
</form></div>';
}
if (@$_GET['q'] == 4 && (@$_GET['step']) == 2) {
	if(@$_GET['a'] == 'D'){
		    echo ' 
<div class="row">
<span class="title1" style="margin-left:40%;font-size:30px;"><b>Enter Question Details</b></span><br /><br />
 <div class="col-md-3"></div><div class="col-md-6"><form class="form-horizontal title1" name="form" action="update.php?q=addqnss&n=' . @$_GET['n'] . '&eid=' . @$_GET['eid'] . '&ch=0 "  method="POST" enctype="multipart/form-data">
<fieldset>
';
    for ($i = 1; $i <= @$_GET['n']; $i++) {
        echo '<b>Question number&nbsp;' . $i . '&nbsp;:</><br /><!-- Text input-->
<div class="form-group">
  <label class="col-md-12 control-label" for="qns' . $i . ' "></label>  
  <div class="col-md-12">
  <textarea rows="3" cols="5" name="qns' . $i . '" class="form-control" placeholder="Write question number ' . $i . ' here..." required></textarea>
  </div>
</div>
<div class="form-group">
  <label class="col-md-12control-label" for="qnsi'.$i.'"></label>
  <div class="col-md-12">
    <input id="qnsi'.$i.'" name="qnsi'.$i.'" placeholder="Upload Your Picture" class="form-control input-md" type="file" title="must be .jpg/ .jpeg/ .png" />
	<span style="text-align:right">Note : use .jpg/ .jpeg/ .png/ .gif extensions only</span>
    
  </div>
</div>
';
    }
    
    echo '<div class="form-group">
  <label class="col-md-12 control-label" for=""></label>
  <div class="col-md-12"> 
    <input name="insert" id="insert" type="submit" style="margin-left:45%" class="btn btn-primary" value="Submit" class="btn btn-primary add" onclick="return confirm(\'Confirm to add this test ?\')"/>
  </div>
</div>

</fieldset>
</form></div>';    
}else 	if(@$_GET['a'] == 'M'){
    echo ' 
<div class="row">
<span class="title1" style="margin-left:40%;font-size:30px;"><b>Enter Question Details</b></span><br /><br />
 <div class="col-md-3"></div><div class="col-md-6"><form class="form-horizontal title1" name="form" action="update.php?q=addqns&n=' . @$_GET['n'] . '&eid=' . @$_GET['eid'] . '&ch=4 "  method="POST" enctype="multipart/form-data">
<fieldset>
';
    
    for ($i = 1; $i <= @$_GET['n']; $i++) {
        echo '<b>Question number&nbsp;' . $i . '&nbsp;:</><br /><!-- Text input-->
<div class="form-group">
  <label class="col-md-12 control-label" for="qns' . $i . ' "></label>  
  <div class="col-md-12">
  <textarea rows="3" cols="5" name="qns' . $i . '" class="form-control" placeholder="Write question number ' . $i . ' here..." required></textarea>  
 
    </div>
</div>

<div class="form-group">
  <label class="col-md-12control-label" for="qnsi'.$i.'"></label>
  <div class="col-md-12">
    <input id="qnsi'.$i.'" name="qnsi'.$i.'" placeholder="Upload Your Picture" class="form-control input-md" type="file" title="must be .jpg/ .jpeg/ .png" />
	<span style="text-align:right">Note : use .jpg/ .jpeg/ .png/ .gif extensions only</span>
    
  </div>
</div>
<div class="form-group">
  <label class="col-md-12 control-label" for="' . $i . '1"></label>  
  <div class="col-md-12">
  <input id="' . $i . '1" name="' . $i . '1" placeholder="Enter option a" class="form-control input-md" type="text" required />
    
  </div>
</div>
<div class="form-group">
  <label class="col-md-12 control-label" for="' . $i . '2"></label>  
  <div class="col-md-12">
  <input id="' . $i . '2" name="' . $i . '2" placeholder="Enter option b" class="form-control input-md" type="text" required />
    
  </div>
</div>
<div class="form-group">
  <label class="col-md-12 control-label" for="' . $i . '3"></label>  
  <div class="col-md-12">
  <input id="' . $i . '3" name="' . $i . '3" placeholder="Enter option c" class="form-control input-md" type="text" required />
    
  </div>
</div>
<div class="form-group">
  <label class="col-md-12 control-label" for="' . $i . '4"></label>  
  <div class="col-md-12">
  <input id="' . $i . '4" name="' . $i . '4" placeholder="Enter option d" class="form-control input-md" type="text" required />
    
  </div>
</div>
<br />
<b>Correct answer</b>:<br />
<select id="ans' . $i . '" name="ans' . $i . '" placeholder="Choose correct answer " class="form-control input-md" required>
  <option value="">Select answer for question ' . $i . '</option>
  <option value="a">option a</option>
  <option value="b">option b</option>
  <option value="c">option c</option>
  <option value="d">option d</option> </select><br /><br />';
    }
    
    echo '<div class="form-group">
  <label class="col-md-12 control-label" for=""></label>
  <div class="col-md-12"> 
    <input name="insert" id="insert" type="submit" style="margin-left:45%" class="btn btn-primary" value="Submit" class="btn btn-primary add" onclick="return confirm(\'Confirm to add this test ?\')"/>
  </div>
</div>

</fieldset>
</form></div>';    
}
}

if (@$_GET['q'] == 5) {
    
    $result = mysqli_query($con, "SELECT * FROM quiz ORDER BY date DESC") or die('Error');
    echo '<div class="panel table-responsive"><table class="table table-striped title1">
<tr><td style="vertical-align:middle"><b>S.N.</b></td><td style="vertical-align:middle"><b>Topic</b></td><td style="vertical-align:middle"><b>Total question</b></td><td style="vertical-align:middle"><b>Marks</b></td><td style="vertical-align:middle"><b>Time limit</b></td><td style="vertical-align:middle"><b>Action</b></td></tr>';
    $c = 1;
    while ($row = mysqli_fetch_array($result)) {
        $title   = $row['title'];
        $total   = $row['total'];
        $correct = $row['correct'];
        $time    = $row['time'];
        $eid     = $row['eid'];
        echo '<tr><td style="vertical-align:middle">' . $c++ . '</td><td style="vertical-align:middle">' . $title . '</td><td style="vertical-align:middle">' . $total . '</td><td style="vertical-align:middle">' . $correct * $total . '</td><td style="vertical-align:middle">' . $time . '&nbsp;min</td>
  <td style="vertical-align:middle"><b><a onclick="return confirm(\'Are you sure to remove this test ?\')" class="delete btn" href="update.php?q=rmquiz&eid=' . $eid . '" style="margin:0px;background:red;color:white">&nbsp;<span class="title1"><b>Remove</b></span></a></b></td></tr>';
    }
    $c = 0;
    echo '</table></div>';    
}
if (@$_GET['q'] == 6) {
    $result = mysqli_query($con, "SELECT * FROM quiz ORDER BY date DESC") or die('Error');
    echo '<div class="panel table-responsive"><table class="table table-striped title1">
<tr><td style="vertical-align:middle"><b>S.N.</b></td><td style="vertical-align:middle"><b>Topic</b></td><td style="vertical-align:middle"><b>Total question</b></td><td style="vertical-align:middle"><b>Marks</b></td><td style="vertical-align:middle"><b>Time limit</b></td><td style="vertical-align:middle"><b>Result</b></td></tr>';
    $c = 1;
    while ($row = mysqli_fetch_array($result)) {
        $title   = $row['title'];
        $total   = $row['total'];
        $correct = $row['correct'];
        $time    = $row['time'];
        $eid     = $row['eid'];
        echo '<tr><td style="vertical-align:middle">' . $c++ . '</td><td style="vertical-align:middle">' . $title . '</td><td style="vertical-align:middle">' . $total . '</td><td style="vertical-align:middle">' . $correct * $total . '</td><td style="vertical-align:middle">' . $time . '&nbsp;min</td>
 
   <td style="vertical-align:middle"><a title="View Result" target="iframe_view" href="update.php?q=view&eid=' . $eid . '" class="btn" type="button" style="color:#FFFFFF;background:#43baea;font-size:12px;padding:7px;padding-left:10px;padding-right:10px"><b><span  aria-hidden="true">View</span></b></a>';

  /*<td><a title="Print Result" href="#" onClick="print()"><b><span class="glyphicon glyphicon-print" aria-hidden="true"></span></b></a></td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*/
  
   echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a title="Download Result" href="update.php?q=result&eid=' . $eid . '"><b><span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span></b></a></td>
   </tr>';
    }
    $c = 0;
	echo '</table></div>';    
    echo '<div class="panel table-responsive title"><table class="table table-striped title1"><tr>';
	echo '<iframe name="iframe_view" width="1024px" height="200px"><p>...</p></iframe>';
    echo '</tr></table></div>';
}
if (@$_GET['q'] == 7) {
    
    $result = mysqli_query($con, "SELECT * FROM quiz ORDER BY date DESC") or die('Error');
	$option = '';
	 while($row = mysqli_fetch_array($result))
	{
		$eid = $row['eid'];
		$option .= '<option value = "'.$row['title'].'">'.$row['title'].'</option>';
	}
}
if (@$_GET['q'] == 7 && !(@$_GET['step']) && @$_GET['eid']) {
	$eid = @$_GET['eid'];
    $q = mysqli_query($con, "SELECT * FROM quiz WHERE eid='$eid' ") or die('Error');
    while ($row = mysqli_fetch_array($q)) {
    $title     = $row['title'];
    $correct     = $row['correct'];
    $wrong     = $row['wrong'];
    $total     = $row['total'];
    $time     = $row['time'];
    $anstype     = $row['anstype'];

echo '<div class="row">
<span class="title1" style="margin-left:35%;font-size:30px;"><b>Edit Exam Details</b></span><br /><br />
 <div class="col-md-3"></div><div class="col-md-6">   <form class="form-horizontal title1" name="form" action="update.php?q=updatequiz&eid='.$eid.'"  method="POST">
<fieldset>
<div class="form-group">
  <label class="col-md-12 control-label" for="name"></label>  
  <div class="col-md-12">
  <input id="name" name="name" value="'.$title.'" placeholder="Enter Exam title" class="form-control input-md" type="text" required />
    
  </div>
</div>
<div class="form-group">
  <label class="col-md-12 control-label" for="total"></label>  
  <div class="col-md-12">
  <input id="total" name="total" value="'.$total.'" placeholder="Enter total number of questions" class="form-control input-md" type="number" required />
    
  </div>
</div>
<div class="form-group">
  <label class="col-md-12 control-label" for="right"></label>  
  <div class="col-md-12">
  <input id="right" name="right" value="'.$correct.'" placeholder="Enter marks on right answer" class="form-control input-md" min="0" type="number" required />
    
  </div>
</div>
<div class="form-group">
  <label class="col-md-12 control-label" for="wrong"></label>  
  <div class="col-md-12">
  <input id="wrong" name="wrong" value="'.$wrong.'" placeholder="Enter minus marks on wrong answer without sign" class="form-control input-md" min="0" type="number" required />
    
  </div>
</div>
<div class="form-group">
  <label class="col-md-12 control-label" for="time"></label>  
  <div class="col-md-12">
  <input id="time" name="time" value="'.$time.'" placeholder="Enter time limit for test in minute" class="form-control input-md" min="1" type="number" required />
    
  </div>
</div>
<div class="form-group">
  <label class="col-md-12 control-label" for="anstype"></label>
  <div class="col-md-12">
   <select id="anstype" name="anstype" class="form-control input-md">
   <option value="">Select Answer Type</option>
   <option value="M"'; if($anstype == "M") echo "SELECTED"; echo'>Multiple choice</option>
  <option value="D"'; if($anstype == "D") echo "SELECTED"; echo'>Descriptive</option> </select>
  </div>    
  </div>

</div>

<div class="form-group">
  <label class="col-md-12 control-label" for=""></label>
  <div class="col-md-12"> 
    <input  type="submit" style="margin-left:45%" class="btn btn-primary" value="Submit" class="btn btn-primary add" onclick="return confirm(\'Are you sure to update this test ?\')"/>
  </div>
</div>

</fieldset>
</form></div>';
	}
}
if (@$_GET['q'] == 7 && (@$_GET['step']) == 2) {
	if(@$_GET['a'] == 'D'){
		    echo ' 
<div class="row">
<span class="title1" style="margin-left:35%;font-size:30px;"><b>Update Question Details</b></span><br /><br />
 <div class="col-md-3"></div><div class="col-md-6">
';
	$eid = $_GET['eid'];
	$n = @$_GET['n'];
	$q = mysqli_query($con,"SELECT * from questions WHERE eid='$eid'") or die(mysqli_error($con));
    for ($i = 1; $i <= $n; $i++) {
	while ($row = mysqli_fetch_array($q)) {	
	$qid[$i] = $row['qid'];
	$qns[$i] = $row['qns'];
	$id = $qid[$i];
	$qn = $qns[$i];
  echo '<form class="form-horizontal title1" name="form" action="update.php?updateqnss=' . $id . '&eid='.$eid.'&n='.$n.'"  method="POST">
<fieldset><b>Question number&nbsp;' . $i . '&nbsp;:</><br /><!-- Text input-->
  <div class="form-group">
  <label class="col-md-12 control-label" for="qns' . $i . ' "></label>  
  <div class="col-md-12">
  <textarea rows="3" cols="5" name="qns" class="form-control" placeholder="Write question number ' . $i . ' here...">'.htmlentities($qn).'</textarea>';
 echo ' </div>
</div>
<div class="form-group">
  <label class="col-md-12 control-label" for="' . $i . '4"></label>  
  <div class="col-md-12" style="text-align:right">
	<input  type="submit" name="submit" id="submit" style="margin-left:45%" value="Update" class="btn btn-primary add" font-size:12px;padding:7px;padding-left:10px;padding-right:10px" onclick="return confirm(\'Confirm to Update this Question ?\')" title="Update Question"/>
	&nbsp;&nbsp;';
	echo '<a href="update.php?deleteqnss=' . $id . '&eid='.$eid.'&n='.$n.'" name="delete" id="delete" class="btn btn-danger" font-size:12px;padding:7px;padding-left:10px;padding-right:10px" onclick="return confirm(\'Confirm to Remove this Question ?\')" title="Remove Question"> Remove </a>
	<br /><br />
  </div>
</div>
</fieldset>
</form>';
break; } } 
    echo '<div class="form-group">
  <label class="col-md-12 control-label" for=""></label>
  <div class="col-md-12"> 
    <a href="dash.php?q=0" style="margin-left:45%" value="Close" class="btn btn-primary">Close</a>
  </div>
</div>

</fieldset>
</form></div>';    
}else 	if(@$_GET['a'] == 'M'){
    echo ' 
<div class="row">
<span class="title1" style="margin-left:40%;font-size:30px;"><b>Enter Question Details</b></span><br /><br />
 <div class="col-md-3"></div><div class="col-md-6">
';
	$eid = $_GET['eid'];
	$n = @$_GET['n'];
	$q = mysqli_query($con,"SELECT * from questions WHERE eid='$eid'") or die(mysqli_error($con));
    for ($i = 1; $i <= $n; $i++) {
	while ($row = mysqli_fetch_array($q)) {	
	$qid[$i] = $row['qid'];
	$qns[$i] = $row['qns'];
	$id = $qid[$i];
	$qn = $qns[$i];
  echo '<form class="form-horizontal title1" name="form" action="update.php?updateqns=' . $id . '&eid='.$eid.'&n='.$n.'"  method="POST">
<fieldset><b>Question number&nbsp;' . $i . '&nbsp;:</><br /><!-- Text input-->
<div class="form-group">
  <label class="col-md-12 control-label" for="qns' . $i . ' "></label>  
  <div class="col-md-12">
  <textarea rows="3" cols="5" name="qns" class="form-control" placeholder="Write question number ' . $i . ' here..." required>'.htmlentities($qn).'</textarea>  
  </div>
</div>';
		$qr2 = mysqli_query($con, "SELECT * FROM options WHERE qid = '$id'") or die('Error');
		while ($row = mysqli_fetch_array($qr2)) {
		$option = $row['option'];
		$optionid = $row['optionid'];
		//for($i=1;$i<=sizeof((array)$option);$i++){
		//$opt = $option[$i];
echo'<div class="form-group">
  <label class="col-md-12 control-label" for="' . $i . '1"></label>  
  <div class="col-md-12">
  <input id="' . $i . '1" name="option" value="'.htmlentities($option).'" class="form-control input-md" type="text" required />
    
  </div>
</div>';
echo '';}
 $get = mysqli_query($con,"SELECT * FROM options WHERE qid = '$id'") or die('Error');
 $option = '';
 while ($row = mysqli_fetch_array($get))
{
  $option .= '<option value = "'.$row['optionid'].'">'.$row['option'].'</option>';
}
 /*echo '
 <b>Correct answer</b>:<br />
<select id="ans' . $i . '" name="ans" placeholder="Choose correct answer " class="form-control input-md" required>
<option value="">Select answer for question ' . $i . '</option>';
echo $option; 
echo '</select><br/>';*/
echo'
<div class="form-group">
  <label class="col-md-12 control-label" for="' . $i . '4"></label>  
  <div class="col-md-12" style="text-align:right">
	<input  type="submit" name="submit" id="submit" style="margin-left:45%" value="Update" class="btn btn-primary add" font-size:12px;padding:7px;padding-left:10px;padding-right:10px" onclick="return confirm(\'Confirm to Update this Question ?\')" title="Update Question"/>
	&nbsp;&nbsp;
	<a href="update.php?deleteqnss=' . $id . '&eid='.$eid.'&n='.$n.'&optionid='.$optionid.'" name="delete" id="delete" class="btn btn-danger" font-size:12px;padding:7px;padding-left:10px;padding-right:10px" onclick="return confirm(\'Confirm to Remove this Question ?\')" title="Remove Question"> Remove </a>
	<br /><br />
	<br /><br />
  </div>
</div>';
   break; }}
    
    echo '<div class="form-group">
  <label class="col-md-12 control-label" for=""></label>
  <div class="col-md-12"> 
    <a href="dash.php?q=0" style="margin-left:45%" value="Close" class="btn btn-primary">Close</a>
  </div>
</div>

</fieldset>
</form></div>';    
	}
}
/*if (@$_GET['q'] == 7 && !(@$_GET['step']) && @$_GET['eid']) {
	$eid = @$_GET['eid'];
    $q = mysqli_query($con, "SELECT * FROM quiz WHERE eid='$eid' ") or die('Error');
    while ($row = mysqli_fetch_array($q)) {
    $title     = $row['title'];
    $correct     = $row['correct'];
    $wrong     = $row['wrong'];
    $total     = $row['total'];
    $time     = $row['time'];
    $anstype     = $row['anstype'];

echo '<div class="row">
<span class="title1" style="margin-left:35%;font-size:30px;"><b>Edit Exam Details</b></span><br /><br />
 <div class="col-md-3"></div><div class="col-md-6">   <form class="form-horizontal title1" name="form" action="update.php?q=updatequiz&eid='.$eid.'"  method="POST">
<fieldset>
<div class="form-group">
  <label class="col-md-12 control-label" for="name"></label>  
  <div class="col-md-12">
  <input id="name" name="name" value="'.$title.'" placeholder="Enter Exam title" class="form-control input-md" type="text" required />
    
  </div>
</div>
<div class="form-group">
  <label class="col-md-12 control-label" for="total"></label>  
  <div class="col-md-12">
  <input id="total" name="total" value="'.$total.'" placeholder="Enter total number of questions" class="form-control input-md" type="number" required />
    
  </div>
</div>
<div class="form-group">
  <label class="col-md-12 control-label" for="right"></label>  
  <div class="col-md-12">
  <input id="right" name="right" value="'.$correct.'" placeholder="Enter marks on right answer" class="form-control input-md" min="0" type="number" required />
    
  </div>
</div>
<div class="form-group">
  <label class="col-md-12 control-label" for="wrong"></label>  
  <div class="col-md-12">
  <input id="wrong" name="wrong" value="'.$wrong.'" placeholder="Enter minus marks on wrong answer without sign" class="form-control input-md" min="0" type="number" required />
    
  </div>
</div>
<div class="form-group">
  <label class="col-md-12 control-label" for="time"></label>  
  <div class="col-md-12">
  <input id="time" name="time" value="'.$time.'" placeholder="Enter time limit for test in minute" class="form-control input-md" min="1" type="number" required />
    
  </div>
</div>
<div class="form-group">
  <label class="col-md-12 control-label" for="anstype"></label>
  <div class="col-md-12">
   <select id="anstype" name="anstype" class="form-control input-md" required>
   <option value="">Select Answer Type</option>
   <option value="M"'; if($anstype == "M") echo "SELECTED"; echo'>Multiple choice</option>
  <option value="D"'; if($anstype == "D") echo "SELECTED"; echo'>Descriptive</option> </select>
  </div>    
  </div>

</div>

<div class="form-group">
  <label class="col-md-12 control-label" for=""></label>
  <div class="col-md-12"> 
    <input  type="submit" style="margin-left:45%" class="btn btn-primary" value="Submit" class="btn btn-primary add" onclick="return confirm(\'Are you sure to update this test ?\')"/>
  </div>
</div>

</fieldset>
</form></div>';
	}
}
if (@$_GET['q'] == 7 && (@$_GET['step']) == 2) {
	if(@$_GET['a'] == 'D'){
		    echo ' 
<div class="row">
<span class="title1" style="margin-left:40%;font-size:30px;"><b>Update Question Details</b></span><br /><br />
 <div class="col-md-3"></div><div class="col-md-6"><form class="form-horizontal title1" name="form" action="update.php?q=updateqnss&n=' . @$_GET['n'] . '&eid=' . @$_GET['eid'] . '&ch=0 "  method="POST">
<fieldset>
';
	$eid = $_GET['eid'];
	$q = mysqli_query($con,"SELECT * from questions WHERE eid='$eid'") or die(mysqli_error($con));
    while ($row = mysqli_fetch_array($q)) {
	$qns = $row['qns'];
	}
	for ($i = 1; $i <= @$_GET['n']; $i++) {

        echo '<b>Question number&nbsp;' . $i . '&nbsp;:</><br /><!-- Text input-->
<div class="form-group">
  <label class="col-md-12 control-label" for="qns' . $i . ' "></label>  
  <div class="col-md-12">
  <textarea rows="3" cols="5" name="qns' . $i . '" class="form-control" placeholder="Write question number ' . $i . ' here..."></textarea>
  </div>
</div>
';
	}   
    echo '<div class="form-group">
  <label class="col-md-12 control-label" for=""></label>
  <div class="col-md-12"> 
    <input  type="submit" style="margin-left:45%" class="btn btn-primary" value="Submit" class="btn btn-primary add" onclick="return confirm(\'Confirm to update this test ?\')"/>
  </div>
</div>

</fieldset>
</form></div>';    
}else 	if(@$_GET['a'] == 'M'){
    echo ' 
<div class="row">
<span class="title1" style="margin-left:40%;font-size:30px;"><b>Enter Question Details</b></span><br /><br />
 <div class="col-md-3"></div><div class="col-md-6"><form class="form-horizontal title1" name="form" action="update.php?q=updateqns&n=' . @$_GET['n'] . '&eid=' . @$_GET['eid'] . '&ch=4 "  method="POST">
<fieldset>
';
    
    for ($i = 1; $i <= @$_GET['n']; $i++) {
        echo '<b>Question number&nbsp;' . $i . '&nbsp;:</><br /><!-- Text input-->
<div class="form-group">
  <label class="col-md-12 control-label" for="qns' . $i . ' "></label>  
  <div class="col-md-12">
  <textarea rows="3" cols="5" name="qns' . $i . '" class="form-control" placeholder="Write question number ' . $i . ' here..." required></textarea>  
  </div>
</div>
<div class="form-group">
  <label class="col-md-12 control-label" for="' . $i . '1"></label>  
  <div class="col-md-12">
  <input id="' . $i . '1" name="' . $i . '1" placeholder="Enter option a" class="form-control input-md" type="text" required />
    
  </div>
</div>
<div class="form-group">
  <label class="col-md-12 control-label" for="' . $i . '2"></label>  
  <div class="col-md-12">
  <input id="' . $i . '2" name="' . $i . '2" placeholder="Enter option b" class="form-control input-md" type="text" required />
    
  </div>
</div>
<div class="form-group">
  <label class="col-md-12 control-label" for="' . $i . '3"></label>  
  <div class="col-md-12">
  <input id="' . $i . '3" name="' . $i . '3" placeholder="Enter option c" class="form-control input-md" type="text" required />
    
  </div>
</div>
<div class="form-group">
  <label class="col-md-12 control-label" for="' . $i . '4"></label>  
  <div class="col-md-12">
  <input id="' . $i . '4" name="' . $i . '4" placeholder="Enter option d" class="form-control input-md" type="text" required />
    
  </div>
</div>
<br />
<b>Correct answer</b>:<br />
<select id="ans' . $i . '" name="ans' . $i . '" placeholder="Choose correct answer " class="form-control input-md" required>
  <option value="">Select answer for question ' . $i . '</option>
  <option value="a">option a</option>
  <option value="b">option b</option>
  <option value="c">option c</option>
  <option value="d">option d</option> </select><br /><br />';
    }
    
    echo '<div class="form-group">
  <label class="col-md-12 control-label" for=""></label>
  <div class="col-md-12"> 
    <input  type="submit" style="margin-left:45%" class="btn btn-primary" value="Submit" class="btn btn-primary add" onclick="return confirm(\'Confirm to update this test ?\')"/>
  </div>
</div>

</fieldset>
</form></div>';    
	}
}*/
?>
</div>
</div></div>
</body>
</html>
