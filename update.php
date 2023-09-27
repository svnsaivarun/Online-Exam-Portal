<?php
include_once 'dbConnection.php';

session_start();
$username = $_SESSION['username'];
if (isset($_SESSION['key'])) {
    if (@$_GET['fdid'] && $_SESSION['key'] == '54585c506829293a2d4c3b68543b316e2e7a2d277858545a36362e5f39') {
        $id = @$_GET['fdid'];
        $result = mysqli_query($con, "DELETE FROM feedback WHERE id='$id' ") or die('Error');
        header("location:dash.php?q=3");
    }
}
if (isset($_SESSION['key'])) {
    if (@$_GET['deidquiz'] && $_SESSION['key'] == '54585c506829293a2d4c3b68543b316e2e7a2d277858545a36362e5f39') {
        $eid = @$_GET['deidquiz'];
        $r1 = mysqli_query($con, "UPDATE quiz SET status='disabled' WHERE eid='$eid' ") or die('Error');
        $q = mysqli_query($con, "SELECT * FROM history WHERE eid='$eid' AND status='ongoing' AND score_updated='false'");
        while($row = mysqli_fetch_array($q)){
            $user = $row['username'];
            $s = $row['score'];
            $r1 = mysqli_query($con, "UPDATE history SET status='finished',score_updated='true' WHERE eid='$eid' AND username='$user' ") or die('Error');
            $q1 = mysqli_query($con, "SELECT * FROM rank WHERE username='$user'") or die('Error161');
            $rowcount = mysqli_num_rows($q1);
            if ($rowcount == 0) {
                $q2 = mysqli_query($con, "INSERT INTO rank VALUES(NULL,'$user','$s',NOW())") or die('Error165');
            } else {
                while ($row = mysqli_fetch_array($q1)) {
                    $sun = $row['score'];
                }
                        
                $sun = $s + $sun;
                $q3 = mysqli_query($con, "UPDATE `rank` SET `score`=$sun ,time=NOW() WHERE username= '$username'") or die('Error174');
            }
        }
        header("location:dash.php?q=0");
    }
}
	if (isset($_SESSION['key'])) {
		if (@$_GET['q'] == 'result' && @$_GET['eid']) {
		    $eid = @$_GET['eid'];
		    $q1     = mysqli_query($con, "SELECT anstype FROM quiz WHERE eid='$eid'");
		    while ($row = mysqli_fetch_array($q1)) {
			$type = $row['anstype'];
			if($type == 'D'){
			$result = mysqli_query($con, "SELECT DISTINCT user.name, user.rollno, user.branch, questions.qns, user_answer.ans FROM user_answer JOIN questions ON questions.qid = user_answer.qid JOIN user ON user.username = user_answer.username WHERE user_answer.eid = '$eid'") or die('Error');
			$columnHeader = '';  
			$columnHeader =  "<div><table border='1' rules='all' cellpadding='10'cellspacing='0.5'><tr><td>S.N.</td>" . "\t" . "<td>NAME</td>" . "\t" . "<td>ROLLNO</td>" . "\t" . "<td>BRANCH</td>" . "\t" . "<td>QUESTION</td>" . "\t" . "<td>ANSWER</td></tr>"; 
			$setData = '';  
			$c = 1;
			while ($rec = mysqli_fetch_row($result)) {  
					$rowData ="<td>". $c++ . "</td>\t" . '';  
				foreach ($rec as $value) {  
					$value = '' . $value . '' . "\t";  
				    $rowData .= "<td>".htmlentities($value)."</td>";  
				}  
			    $setData .= trim($rowData) . "</tr>\n";  
			}      
		   $c = 0;		    		   
			header("Content-type: application/octet-stream");  
			$result = mysqli_query($con, "SELECT title FROM quiz WHERE eid ='$eid'") or die('Error');
		    while ($row = mysqli_fetch_array($result)) {
				$title   = $row['title'];
			header("Content-Disposition: attachment; filename=".$title."_Result.xls");  
			}
			header("Pragma: no-cache");  
			header("Expires: 0");  
		echo ucwords($columnHeader) . "\n" . $setData . "\n";  
			} else /*if($type == 'M')*/ {
			$result1 = mysqli_query($con, "SELECT user.name, user.rollno, user.branch, quiz.total, history.correct, history.wrong, quiz.total-history.correct-history.wrong, (history.correct*quiz.correct)-(history.wrong*quiz.wrong) FROM history JOIN quiz ON history.eid = quiz.eid JOIN user ON user.username = history.username WHERE history.eid ='$eid'") or die('Error');
			$columnHeader = '';  
			$columnHeader =  "<div><table border='1' rules='all' cellpadding='10'cellspacing='0.5'><tr><td>S.N.</td>" . "\t" . "<td>NAME</td>" . "\t" . "<td>ROLLNO</td>" . "\t" . "<td>BRANCH</td>" . "\t" . "<td>TOTAL QUESTIONS</td>" . "\t" . "<td>CORRECT ANSWER</td>" . "\t" . "<td>WRONG ANSWER</td>" . "\t" . "<td>UNATTEMPTED</td>" . "\t" . "<td>SCORE</td></tr>"; 
			$setData = '';  
			$c = 1;
			while ($rec = mysqli_fetch_row($result1)) {  
					$rowData ="<td>". $c++ . "</td>\t" . '';  
				foreach ($rec as $value) {  
					$value = '' . $value . '' . "\t";  
				    $rowData .= "<td>".$value."</td>";  
				}  
			    $setData .= trim($rowData) . "</tr>\n";  
			}      
		   $c = 0;		    		   
			header("Content-type: application/octet-stream");  
			$result = mysqli_query($con, "SELECT title FROM quiz WHERE eid ='$eid'") or die('Error');
		    while ($row = mysqli_fetch_array($result)) {
				$title   = $row['title'];
			header("Content-Disposition: attachment; filename=".$title."_Result.xls");  
			}
			header("Pragma: no-cache");  
			header("Expires: 0");  
		echo ucwords($columnHeader) . "\n" . $setData . "\n";  
		}
	  }
      }
}
	if (isset($_SESSION['key'])) {
		if (@$_GET['q'] == 'view' && @$_GET['eid']) {
		    $eid = @$_GET['eid'];
		    $q1     = mysqli_query($con, "SELECT anstype FROM quiz WHERE eid='$eid'");
		    while ($row = mysqli_fetch_array($q1)) {
			$type = $row['anstype'];
			if($type == 'D'){
			$q2 = mysqli_query($con, "SELECT DISTINCT user.name, user.rollno, user.branch, questions.qns, user_answer.ans FROM user_answer JOIN questions ON questions.qid = user_answer.qid JOIN user ON user.username = user_answer.username WHERE user_answer.eid = '$eid'") or die('Error');
			$columnHeader = '';  
			$columnHeader =  "<div><table border='1' rules='all' cellpadding='10'cellspacing='0.5'><tr><td>S.N.</td>" . "\t" . "<td>NAME</td>" . "\t" . "<td>ROLLNO</td>" . "\t" . "<td>BRANCH</td>" . "\t" . "<td>QUESTION</td>" . "\t" . "<td>ANSWER</td></tr>"; 
			$setData = '';  
			$c = 1;
			while ($rec = mysqli_fetch_row($q2)) {  
					$rowData ="<td>". $c++ . "</td>\t" . '';  
				foreach ($rec as $value) {  
					$value = '' . $value . '' . "\t";  
				    $rowData .= "<td>".htmlentities($value)."</td>";  
				}  
			    $setData .= trim($rowData) . "</tr>\n";  
			}      
		   $c = 0;		    		   
		echo $columnHeader . "\n" . $setData . "\n";  		   
			} else /*if($type == 'M')*/ {
			$view = mysqli_query($con, "SELECT user.name, user.rollno, user.branch, quiz.total, history.correct, history.wrong, quiz.total-history.correct-history.wrong, (history.correct*quiz.correct)-(history.wrong*quiz.wrong) FROM history JOIN quiz ON history.eid = quiz.eid JOIN user ON user.username = history.username WHERE history.eid ='$eid'") or die('Error');
			$columnHeader = '';  
			$columnHeader =  "<div><table border='1' rules='all' cellpadding='10'cellspacing='0.5'><tr><td>S.N.</td>" . "\t" . "<td>NAME</td>" . "\t" . "<td>ROLLNO</td>" . "\t" . "<td>BRANCH</td>" . "\t" . "<td>TOTAL QUESTIONS</td>" . "\t" . "<td>CORRECT ANSWER</td>" . "\t" . "<td>WRONG ANSWER</td>" . "\t" . "<td>UNATTEMPTED</td>" . "\t" . "<td>SCORE</td></tr>"; 
			$setData = '';  
			$c = 1;
			while ($rec = mysqli_fetch_row($view)) {  
					$rowData ="<td>". $c++ . "</td>\t" . '';  
				foreach ($rec as $value) {  
					$value = '' . $value . '' . "\t";  
				    $rowData .= "<td>".$value."</td>";  
				}  
			    $setData .= trim($rowData) . "</tr>\n";  
			}      
		   $c = 0;		    		   
		echo $columnHeader . "\n" . $setData . "\n";  		   
		}
	  }
      }
}
if (isset($_SESSION['key'])) {
    if (@$_GET['eeidquiz'] && $_SESSION['key'] == '54585c506829293a2d4c3b68543b316e2e7a2d277858545a36362e5f39') {
        $eid = @$_GET['eeidquiz'];
        $r1 = mysqli_query($con, "UPDATE quiz SET status='enabled' WHERE eid='$eid' ") or die(mysqli_error($con));
        header("location:dash.php?q=0");
    }
} 
if (isset($_SESSION['key'])) {
    if (@$_GET['alumni'] && $_SESSION['key'] == '54585c506829293a2d4c3b68543b316e2e7a2d277858545a36362e5f39') {
        $alumni = @$_GET['alumni'];
        $r1 = mysqli_query($con, "DELETE FROM alumni WHERE username='$alumni'") or die('Error');
        header("location:dash.php?q=1");
    }
}
if (isset($_SESSION['key'])) {
    if (@$_GET['dusername'] && $_SESSION['key'] == '54585c506829293a2d4c3b68543b316e2e7a2d277858545a36362e5f39') {
        $dusername = @$_GET['dusername'];
		$q1 = mysqli_query($con, "INSERT INTO alumni SELECT * FROM user WHERE username='$dusername'") or die('Error');
        $r1 = mysqli_query($con, "DELETE FROM rank WHERE username='$dusername' ") or die('Error');
        $r2 = mysqli_query($con, "DELETE FROM history WHERE username='$dusername' ") or die('Error');
        $result = mysqli_query($con, "DELETE FROM user WHERE username='$dusername' ") or die('Error');
        header("location:dash.php?q=1");
    }
}
if (isset($_SESSION['key'])) {
    if (@$_GET['q'] == 'rmquiz' && $_SESSION['key'] == '54585c506829293a2d4c3b68543b316e2e7a2d277858545a36362e5f39') {
        $eid = @$_GET['eid'];
        $result = mysqli_query($con, "SELECT * FROM questions WHERE eid='$eid' ") or die('Error');
        while ($row = mysqli_fetch_array($result)) {
            $qid = $row['qid'];
            $r1 = mysqli_query($con, "DELETE FROM options WHERE qid='$qid'") or die('Error');
            $r2 = mysqli_query($con, "DELETE FROM answer WHERE qid='$qid' ") or die('Error');
        }
        
        $r3 = mysqli_query($con, "DELETE FROM questions WHERE eid='$eid' ") or die('Error');
        $r4 = mysqli_query($con, "DELETE FROM quiz WHERE eid='$eid' ") or die('Error');
        $r4 = mysqli_query($con, "DELETE FROM history WHERE eid='$eid' ") or die('Error');
        header("location:dash.php?q=5");
    }
}
if (isset($_SESSION['key'])) {
    if (@$_GET['q'] == 'addquiz' && $_SESSION['key'] == '54585c506829293a2d4c3b68543b316e2e7a2d277858545a36362e5f39') {
        $name    = $_POST['name'];
        $name    = ucwords(strtolower($name));
        $total   = $_POST['total'];
        $correct = $_POST['right'];
        $wrong   = $_POST['wrong'];
        $time    = $_POST['time'];
        $status  = "disabled";
		$anstype = $_POST['anstype'];
		$anstype   = stripslashes($anstype);
		$anstype   = addslashes($anstype);
        $id      = uniqid();
        $q3      = mysqli_query($con, "INSERT INTO quiz VALUES(NULL,'$id','$name','$correct','$wrong','$total','$time', 'NOW()','$status','$anstype')");
        header("location:dash.php?q=4&step=2&eid=$id&n=$total&a=$anstype");
    }
}
if (isset($_SESSION['key'])) {
    if (@$_GET['q'] == 'updatequiz' && $_SESSION['key'] == '54585c506829293a2d4c3b68543b316e2e7a2d277858545a36362e5f39') {
		$eid = $_GET['eid'];
        $name    = $_POST['name'];
        $name    = ucwords(strtolower($name));
        $total   = $_POST['total'];
        $correct = $_POST['right'];
        $wrong   = $_POST['wrong'];
        $time    = $_POST['time'];
        $status  = "disabled";
		$anstype = $_POST['anstype'];
		$anstype   = stripslashes($anstype);
		$anstype   = addslashes($anstype);
        $q3      = mysqli_query($con,"UPDATE `quiz` SET `title`='$name',`correct`='$correct',`wrong`='$wrong',`total`='$total',`time`='$time',`date`='NOW()',`status`= '$status',`anstype`='$anstype' WHERE eid='$eid'");
       header("location:dash.php?q=7&step=2&eid=$eid&n=$total&a=$anstype");
    }
}
if (isset($_SESSION['key'])) {
    if (@$_GET['q'] == 'addqns' && $_SESSION['key'] == '54585c506829293a2d4c3b68543b316e2e7a2d277858545a36362e5f39') {
        $n   = @$_GET['n'];
        $eid = @$_GET['eid'];
        $ch  = @$_GET['ch'];
        for ($i = 1; $i <= $n; $i++) {
            $qid  = uniqid();
            $qns  = addslashes($_POST['qns' . $i]);
            //$qnsi  = addslashes($_POST['qnsi' . $i]);
			//if(!empty($_POST['qnsi' . $i])) {
				//if(isset($_POST["qnsi"])){
					$qnsi = $_POST['qnsi'.$i];
					$qnsi = addslashes(file_get_contents($_FILES['qnsi'.$i]["tmp_name"]));
				//$qnsi = NULL; 
			//} else { 
					//$qnsi = $_POST["qnsi"];
				//	$qnsi = addslashes(file_get_contents($_FILES["qnsi"]["tmp_name"]));
				//$qnsi = " "; 
			//}
			$q3   = mysqli_query($con, "INSERT INTO questions VALUES  (NULL,'$eid','$qid','$qns' , '$ch' , '$i', '$qnsi')") or die(mysqli_error($con));
            $oaid = uniqid();
            $obid = uniqid();
            $ocid = uniqid();
            $odid = uniqid();
            $a    = addslashes($_POST[$i . '1']);
            $b    = addslashes($_POST[$i . '2']);
            $c    = addslashes($_POST[$i . '3']);
            $d    = addslashes($_POST[$i . '4']);
            $qa = mysqli_query($con, "INSERT INTO options VALUES  (NULL,'$qid','$a','$oaid')") or die('Error61');
            $qb = mysqli_query($con, "INSERT INTO options VALUES  (NULL,'$qid','$b','$obid')") or die('Error62');
            $qb = mysqli_query($con, "INSERT INTO options VALUES  (NULL,'$qid','$c','$ocid')") or die('Error63'.mysqli_error($con));
            $qd = mysqli_query($con, "INSERT INTO options VALUES  (NULL,'$qid','$d','$odid')") or die('Error64');
            $e = $_POST['ans' . $i];
            switch ($e) {
                case 'a':
                    $ansid = $oaid;
                    break;
                
                case 'b':
                    $ansid = $obid;
                    break;
                
                case 'c':
                    $ansid = $ocid;
                    break;
                
                case 'd':
                    $ansid = $odid;
                    break;
                
                default:
                    $ansid = $oaid;
            }
				//}
            $qans = mysqli_query($con, "INSERT INTO answer VALUES  (NULL,'$qid','$ansid')");
        }
        
        header("location:dash.php?q=0");
    }
}
if (isset($_SESSION['key'])) {
    if (@$_GET['q'] == 'addqnss' && $_SESSION['key'] == '54585c506829293a2d4c3b68543b316e2e7a2d277858545a36362e5f39') {
        $n   = @$_GET['n'];
        $eid = @$_GET['eid'];
        $ch  = @$_GET['ch'];
               for ($i = 1; $i <= $n; $i++) {
            $qid  = uniqid();
            $qns  = addslashes($_POST['qns' . $i]);
            //$qnsi  = addslashes($_POST['qnsi' . $i]);
			//if(!empty($_POST['qnsi' . $i])) {
				//if(isset($_POST["qnsi"])){
					$qnsi = $_POST['qnsi'.$i];
					$qnsi = addslashes(file_get_contents($_FILES['qnsi'.$i]["tmp_name"]));
				//$qnsi = NULL; 
			//} else { 
					//$qnsi = $_POST["qnsi"];
				//	$qnsi = addslashes(file_get_contents($_FILES["qnsi"]["tmp_name"]));
				//$qnsi = " "; 
			//}
			$q3   = mysqli_query($con, "INSERT INTO questions VALUES  (NULL,'$eid','$qid','$qns' , '$ch' , '$i', '$qnsi')") or die(mysqli_error($con));
        }
        
        header("location:dash.php?q=0");
    }
}
if (isset($_SESSION['key'])) {
    if (@$_GET['updateqns'] && $_SESSION['key'] == '54585c506829293a2d4c3b68543b316e2e7a2d277858545a36362e5f39') {
        $qid = @$_GET['updateqns'];
        $n   = @$_GET['n'];
        $eid = @$_GET['eid'];
        $optionid = @$_GET['optionid'];
        //$ch  = @$_GET['ch'];
		$qns = $_POST['qns'];
		$qns  = addslashes($qns);
		$qns  = stripslashes($qns);
		//$ans = $_POST['ans'];
		//$ans  = addslashes($ans);
		//$ans  = stripslashes($ans);
        $q3   = mysqli_query($con, "UPDATE `questions` SET `qns`='$qns' WHERE qid='$qid'") or die(mysqli_error($con));
        for ($i = 1; $i <= $n; $i++) {
            $a    = addslashes($_POST[$i . '1']);
            $b    = addslashes($_POST[$i . '2']);
            $c    = addslashes($_POST[$i . '3']);
            $d    = addslashes($_POST[$i . '4']);
            //$qid  = uniqid();
            //$qns  = addslashes($_POST['qns' . $i]);
            $qa = mysqli_query($con, "UPDATE `options` SET `option`='$option' WHERE optionid='$optionid'") or die(mysqli_error($con));
           /* $e = $_POST['ans'];
            switch ($e) {
                case 'a':
                    $ansid = $oaid;
                    break;
                
                case 'b':
                    $ansid = $obid;
                    break;
                
                case 'c':
                    $ansid = $ocid;
                    break;
                
                case 'd':
                    $ansid = $odid;
                    break;
                
                default:
                    $ansid = $oaid;
            }
           
            $qans = mysqli_query($con, "UPDATE `answer` SET `qid`='$qid',`ansid`='$ansid' WHERE qid='$qid'")or die(mysqli_error($con));*/
        }
        
        //header("location:dash.php?q=0");
    }
}
if (isset($_SESSION['key'])) {
    if (@$_GET['updateqnss'] && $_SESSION['key'] == '54585c506829293a2d4c3b68543b316e2e7a2d277858545a36362e5f39') {
        $qid = @$_GET['updateqnss'];
		$n   = @$_GET['n'];           
        $eid = @$_GET['eid'];
        $optionid = @$_GET['optionid'];
		//$qns = (isset($_POST['qns']) ? $_POST['qns'] : '');
		$qns = $_POST['qns'];
		$qns  = addslashes($qns);
		$qns  = stripslashes($qns);
		$option = $_POST['option'];
		$option  = addslashes($option);
		$option  = stripslashes($option);
		$ans = $_POST['ans'];
		$ans  = addslashes($ans);
		$ans  = stripslashes($ans);
		$q1 = mysqli_query($con, "SELECT anstype FROM quiz WHERE eid = '$eid'");
		while ($row = mysqli_fetch_array($q1)) {	
        $a   = $row['anstype'];}
        $r1 = mysqli_query($con, "UPDATE `questions` SET `qns`='$qns' WHERE qid='$qid'") or die(mysqli_error($con));
        //$r2 = mysqli_query($con, "UPDATE `options` SET `option`='$option' WHERE qid='$qid' AND optionid='$optionid'") or die(mysqli_error($con));
        //$r3 = mysqli_query($con, "UPDATE `answer` SET `ans`='$ans' WHERE qid='$qid'") or die(mysqli_error($con));
        //$r2 = mysqli_query($con, "DELETE FROM options WHERE qid='$qid'") or die(mysqli_error($con));
        //$r3 = mysqli_query($con, "DELETE FROM answer WHERE qid='$qid'") or die(mysqli_error($con));
        //$r4 = mysqli_query($con, "UPDATE `quiz` SET `total`=quiz.total-1 WHERE eid='$eid'") or die(mysqli_error($con));
        header("location:dash.php?q=7&step=2&eid=$eid&n=$n&a=$a");
    }
}
/*if (isset($_SESSION['key'])) {
    if (@$_GET['q'] == 'updateqnss' && $_SESSION['key'] == '54585c506829293a2d4c3b68543b316e2e7a2d277858545a36362e5f39') {
		if(isset($_POSt["save"])){
        $n   = @$_GET['n'];           
        $eid = @$_GET['eid'];
        $ch  = @$_GET['ch'];
        $qid  = @$_GET['id'];
        $qns  = addslashes($_POST['qns']);
		$qns     = stripslashes($qns);
		$q   = mysqli_query($con, "SELECT anstype FROM quiz WHERE eid='$eid'") or die(mysqli_error($con));
		while ($row = mysqli_fetch_array($q)) {	
        $a   = $row['anstype'];
        //for ($i = 1; $i <= $n; $i++) {
            $q3   = mysqli_query($con, "UPDATE `questions` SET `eid`='$eid',`qid`='$qid',`qns`='$qns',`choice`='$ch' WHERE eid='$eid' && qid='$qid'") or die(mysqli_error($con));
			if($q3){		echo $eid.','.$qid.','.$qns;}else{		echo $eid.','.$qid.','.$qns;}
        //}q=7&step=2&eid=$eid&n=$total&a=$anstype
        header("location:dash.php?q=7&step=2&eid=$eid&n=$n&a=$a");
    }}
}}*/
if (isset($_SESSION['key'])) {
    if (@$_GET['deleteqnss'] && $_SESSION['key'] == '54585c506829293a2d4c3b68543b316e2e7a2d277858545a36362e5f39') {
        $qid = @$_GET['deleteqnss'];
		$n   = @$_GET['n'];           
        $eid = @$_GET['eid'];
		$q1 = mysqli_query($con, "SELECT anstype FROM quiz WHERE eid = '$eid'");
		while ($row = mysqli_fetch_array($q1)) {	
        $a   = $row['anstype'];}
        $r1 = mysqli_query($con, "DELETE FROM questions WHERE qid='$qid'") or die(mysqli_error($con));
        $r2 = mysqli_query($con, "DELETE FROM options WHERE qid='$qid'") or die(mysqli_error($con));
        $r3 = mysqli_query($con, "DELETE FROM answer WHERE qid='$qid'") or die(mysqli_error($con));
        $r4 = mysqli_query($con, "UPDATE `quiz` SET `total`=quiz.total-1 WHERE eid='$eid'") or die(mysqli_error($con));
        header("location:dash.php?q=7&step=2&eid=$eid&n=$n&a=$a");
    }
}
if (@$_GET['q'] == 'quiz' && @$_GET['step'] == 2 && isset($_SESSION['6e447159425d2d']) && $_SESSION['6e447159425d2d'] == "6e447159425d2d" && isset($_POST['ans']) && (!isset($_GET['delanswer']))) {
    $eid   = @$_GET['eid'];
    $sn    = @$_GET['n'];
    $total = @$_GET['t'];
    $ans   = $_POST['ans'];
    $qid   = @$_GET['qid'];
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
            $q = mysqli_query($con, "SELECT * FROM user_answer WHERE eid='$_GET[eid]' AND username='$_SESSION[username]' AND qid='$qid' ") or die('Error115');
            while ($row = mysqli_fetch_array($q)) {
                $prevans = $row['ans'];
            }
            $q = mysqli_query($con, "SELECT * FROM answer WHERE qid='$qid' ");
            while ($row = mysqli_fetch_array($q)) {
                $ansid = $row['ansid'];
            }
            $q = mysqli_query($con, "SELECT * FROM user_answer WHERE username='$_SESSION[username]' AND eid='$_GET[eid]' AND qid='$qid' ") or die('Error1977');
            if (mysqli_num_rows($q) != 0) {
                $q = mysqli_query($con, "UPDATE user_answer SET ans='$ans' WHERE username='$_SESSION[username]' AND eid='$_GET[eid]' AND qid='$qid' ") or die('Error197');
            } else {
                $q = mysqli_query($con, "INSERT INTO user_answer VALUES(NULL,'$qid','$ans','$ansid','$_GET[eid]','$_SESSION[username]')");
            }
            
            $q = mysqli_query($con, "SELECT * FROM options WHERE qid='$qid' AND optionid='$ans'");
            while ($row = mysqli_fetch_array($q)) {
                $option = $row['option'];
            }
            
            
            if ($ans == $ansid) {
                $q = mysqli_query($con, "SELECT * FROM quiz WHERE eid='$eid' ");
                while ($row = mysqli_fetch_array($q)) {
                    $correct = $row['correct'];
                    $wrong   = $row['wrong'];
                }
                
                $q = mysqli_query($con, "SELECT * FROM history WHERE eid='$eid' AND username='$username' ") or die('Error115');
                while ($row = mysqli_fetch_array($q)) {
                    $s = $row['score'];
                    $r = $row['correct'];
                    $w = $row['wrong'];
                }
                
                if (isset($prevans) && $prevans == $ansid) {
                } else if (isset($prevans) && $prevans != $ansid) {
                    $r++;
                    $w--;
                    $s = $s + $correct + $wrong;
                    $q = mysqli_query($con, "UPDATE `history` SET `score`=$s,`level`=$sn,`correct`=$r,`wrong`=$w, date= NOW()  WHERE  username = '$username' AND eid = '$eid'") or die('Error13');
                } else {
                    $r++;
                    $s = $s + $correct;
                    $q = mysqli_query($con, "UPDATE `history` SET `score`=$s,`level`=$sn,`correct`=$r, date= NOW()  WHERE  username = '$username' AND eid = '$eid'") or die('Error14');
                }
            } else {
                $q = mysqli_query($con, "SELECT * FROM quiz WHERE eid='$eid' ") or die('Error129');
                while ($row = mysqli_fetch_array($q)) {
                    $wrong   = $row['wrong'];
                    $correct = $row['correct'];
                }
                
                $q = mysqli_query($con, "SELECT * FROM history WHERE eid='$eid' AND username='$username' ") or die('Error139');
                while ($row = mysqli_fetch_array($q)) {
                    $s = $row['score'];
                    $w = $row['wrong'];
                    $r = $row['correct'];
                }
                if (isset($prevans) && $prevans != $ansid) {
                } else if (isset($prevans) && $prevans == $ansid) {
                    $r--;
                    $w++;
                    $s = $s - $correct - $wrong;
                    $q = mysqli_query($con, "UPDATE `history` SET `score`=$s,`level`=$sn,`wrong`=$w,`correct`=$r, date= NOW()  WHERE  username = '$username' AND eid = '$eid'") or die('Error11');
                } else {
                    $w++;
                    $s = $s - $wrong;
                    $q = mysqli_query($con, "UPDATE `history` SET `score`=$s,`level`=$sn,`wrong`=$w,date= NOW()  WHERE  username = '$username' AND eid = '$eid'") or die('Error12');
                }
            }
            header("location:account.php?q=quiz&step=2&eid=$eid&n=$sn&t=$total") or die('Error152');
            
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

if (@$_GET['q'] == 'quiz' && @$_GET['step'] == 2 && isset($_SESSION['6e447159425d2d']) && $_SESSION['6e447159425d2d'] == "6e447159425d2d" && (!isset($_POST['ans'])) && (isset($_GET['delanswer'])) && $_GET['delanswer'] == "delanswer") {
    $eid   = @$_GET['eid'];
    $sn    = @$_GET['n'];
    $total = @$_GET['t'];
    $qid   = @$_GET['qid'];
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
            $q = mysqli_query($con, "SELECT * FROM answer WHERE qid='$qid' ");
            while ($row = mysqli_fetch_array($q)) {
                $ansid = $row['ansid'];
            }
            $q = mysqli_query($con, "SELECT * FROM user_answer WHERE eid='$_GET[eid]' AND username='$_SESSION[username]' AND qid='$qid' ") or die('Error115');
            $row = mysqli_fetch_array($q);
            $ans = $row['ans'];
            $q = mysqli_query($con, "DELETE FROM user_answer WHERE qid='$qid' AND username='$_SESSION[username]' AND eid='$_GET[eid]' ") or die("Error2222");
            if ($ans == $ansid) {
                $q = mysqli_query($con, "SELECT * FROM quiz WHERE eid='$eid' ") or die('Error129');
                while ($row = mysqli_fetch_array($q)) {
                    $wrong   = $row['wrong'];
                    $correct = $row['correct'];
                }
                
                $q = mysqli_query($con, "SELECT * FROM history WHERE eid='$eid' AND username='$username' ") or die('Error139');
                while ($row = mysqli_fetch_array($q)) {
                    $s = $row['score'];
                    $w = $row['wrong'];
                    $r = $row['correct'];
                }
                $r--;
                $s = $s - $correct;
                $q = mysqli_query($con, "UPDATE `history` SET `score`=$s,`level`=$sn,`correct`=$r, date= NOW()  WHERE  username = '$username' AND eid = '$eid'") or die('Error11');
            } else {
                $q = mysqli_query($con, "SELECT * FROM quiz WHERE eid='$eid' ") or die('Error129');
                while ($row = mysqli_fetch_array($q)) {
                    $wrong   = $row['wrong'];
                    $correct = $row['correct'];
                }
                
                $q = mysqli_query($con, "SELECT * FROM history WHERE eid='$eid' AND username='$username' ") or die('Error139');
                while ($row = mysqli_fetch_array($q)) {
                    $s = $row['score'];
                    $w = $row['wrong'];
                    $r = $row['correct'];
                }
                $w--;
                $s = $s + $wrong;
                $q = mysqli_query($con, "UPDATE `history` SET `score`=$s,`level`=$sn,`wrong`=$w, date= NOW()  WHERE  username = '$username' AND eid = '$eid'") or die('Error11');
            }
            header('location:account.php?q=quiz&step=2&eid=' . $_GET[eid] . '&n=' . $_GET[n] . '&t=' . $total);
            
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
?>
