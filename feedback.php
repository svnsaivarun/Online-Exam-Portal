<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="icon" href="image/logo.png" type="image/icon" sizes="16x16">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Online Exam </title>
  
 <link rel="stylesheet" href="css/main.css">
 <link  rel="stylesheet" href="css/font.css">
 <script src="js/jquery.js" type="text/javascript"></script>
<link  rel="stylesheet" href="css/bootstrap.min.css"/>
 <link  rel="stylesheet" href="css/bootstrap-theme.min.css"/>  
  <script src="js/bootstrap.min.js"  type="text/javascript"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
 
  <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
<?php
if (@$_GET['w']) {
    echo '<script>alert("' . @$_GET['w'] . '");</script>';
}
?>
</head>

<body>
<div class="row header">
<div class="col-lg-6">
<span class="logo">ONLINE EXAM </span></div>
<div class="col-md-2">
</div>
<div class="col-md-4">
<?php
include_once 'dbConnection.php';
session_start();
if ((!isset($_SESSION['username']))) {
    echo '<a href="#" class="pull-right logb btn btn-primary" data-toggle="modal" data-target="#myModal" style="color:white"><span class="glyphicon glyphicon-log-in" aria-hidden="true"></span>&nbsp;<font style="font-size:12px;font-weight:bold">Login</font></a>&nbsp;';
} else {
    echo '<a href="logout.php?q=feedback.php" class="pull-right logb btn btn-primary" style="color:white"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>&nbsp;<font style="font-size:12px;font-weight:bold">Logout</font></a>&nbsp;';
}
?>

<a href="index.php" class="pull-right btn logb btn-primary" style="color:white"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>&nbsp;<font style="font-size:12px;font-weight:bold">Home</font></a>&nbsp;
</div></div>
<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content title1">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title title1"><span style="color:darkblue;font-size:12px;font-weight:bold">Login to your Account</span></h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" action="login.php?q=index.php" method="POST">
<fieldset>
<div class="form-group">
  <label class="col-md-3 control-label" for="username"></label>  
  <div class="col-md-6">
  <input id="username" name="username" placeholder="Enter your username-id" class="form-control input-md" type="username">
    
  </div>
</div>
<div class="form-group">
  <label class="col-md-3 control-label" for="password"></label>
  <div class="col-md-6">
    <input id="password" name="password" placeholder="Enter your Password" class="form-control input-md" type="password">
    
  </div>
</div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Login</button>
    </fieldset>
</form>
      </div>
    </div>
  </div>
</div>
<div style="background:url(image/index.jpg);min-height:535px;background-repeat: repeat-x;background-color: #202020;-webkit-background-size:cover;-moz-background-size:cover;-o-background-size:cover;background-size:cover;">
<div class="row">
<div class="col-md-3"></div>
<div class="col-md-6 panel" style="background-color:lightblue; min-height:430px;">
<h2 align="center" style="font-family:'typo'; color:white">FEEDBACK</h2>
<div style="font-size:14px;margin-top:20px"><br />
<?php
if (@$_GET['q'])
    echo '<span style="font-size:18px;"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span>&nbsp;' . @$_GET['q'] . '</span>';
else {
    echo ' 

<form role="form"  method="post" action="feed.php?q=feedback.php">
<div class="row">
<div class="col-md-3"><b>Rollno:</div>
<div class="col-md-9">

<div class="form-group">
    <input id="name" name="name" placeholder="Enter your roll number" class="form-control input-md" type="text" maxlength="10" required>      
 </div>
</div>
</div>
<div class="row">
<div class="col-md-3"><b>Subject:</b></div>
<div class="col-md-9">

<div class="form-group">
  <input id="name" name="subject" placeholder="Enter short description of your feedback" class="form-control input-md" type="text" required>    
 </div>
</div>
</div>

<div class="row">
<div class="col-md-3"><b>E-Mail ID:</b></div>
<div class="col-md-9">

<div class="form-group">
  <input id="email" name="email" placeholder="Enter your e-mail" class="form-control input-md" type="email" required pattern="[A-Za-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$">    
 </div>
</div>
</div>

<div class="form-group"> 
<textarea rows="5" cols="8" name="feedback" class="form-control" placeholder="Write feedback here. Keep it clean and simple." required></textarea>
</div>
<div class="form-group" align="center">
<font style="font-size:12px;font-weight:bold"><input type="submit" name="submit" value="Send My Feedback" class="btn btn-primary" /></font>
</div>
</form>';
}
?>
</div>
<div class="col-md-3"></div></div>
</div></div>
</div>
<div class="row footer">
  <div class="col-md-2 box"></div>
<div class="col-md-6 box">
<a href="#" data-toggle="modal" data-target="#developers" style="color:lightyellow">Organized by &COPY; V&S Solutions</a></div>

<!-- Modal For Developers-->
<div class="modal fade title1" id="developers">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" style="font-family:'typo' "><span style="color:orange">Developers</span></h4>
      </div>
	  
      <div class="modal-body">
        <p>
		<div class="row">
		<div class="col-md-4">
		 <img src="image/Developer.jpg" width=100 height=100 alt="Developer" title="Developer" class="img-rounded">
		 </div>
		 <div class="col-md-5">
		<a href="http://vnssolutions.blogspot.com" style="color:blue; font-family:'typo' ; font-size:18px" title="Find on Blogger">VinmayiSwamy</a>
		<h4 style="color:#202020; font-family:'typo' ;font-size:16px" class="title1">+91 7207566702</h4>
		<h4 style="font-family:'typo' ">vnssolutions2020@gmail.com</h4>
		<h4 style="font-family:'typo' ">V&S Solutions, Guntur</h4></div></div>
		</p>
      </div>

	   <div class="modal-body">
        <p>
		<div class="row">
		<div class="col-md-4">
		 <img src="image/CoDeveloper.jpg" width=100 height=100 alt="CoDeveloper" title="Co-Developer" class="img-rounded">
		 </div>
		 <div class="col-md-5">
		<a href="http://vnssolutions.blogspot.com" style="color:blue; font-family:'typo' ; font-size:18px" title="Find on Blogger">Sai Kumar Kakarla</a>
		<h4 style="color:#202020; font-family:'typo' ;font-size:16px" class="title1">+91 7207566702</h4>
		<h4 style="font-family:'typo' ">vnssolutions2020@gmail.com</h4>
		<h4 style="font-family:'typo' ">V&S Solutions, Guntur</h4></div></div>
		</p>
      </div>

    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="col-md-2 box">
<span href="feedback.php" style="color:lightyellow;text-decoration:underline" onmouseover="this.style('color:yellow')">Feedback</span></div>

</body>
</html>
