<?php
	require_once("perpage.php");	
	require_once("dbcontroller.php");
	$db_handle = new DBController();
	
	$name = "";
	
	$queryCondition = "";
	if(!empty($_POST["search"])) {
		foreach($_POST["search"] as $k=>$v){
			if(!empty($v)) {

				$queryCases = array("name");
				if(in_array($k,$queryCases)) {
					if(!empty($queryCondition)) {
						$queryCondition .= " AND ";
					} else {
						$queryCondition .= " WHERE ";
					}
				}
				switch($k) {
					case "name":
						$name = $v;
						$queryCondition .= "title LIKE '" . $v . "%'";
						break;
				}
			}
		}
	}
	$orderby = " ORDER BY date desc"; 
	$sql = "SELECT * FROM quiz " . $queryCondition;
	$href = 'index.php';					
		
	$perPage = 5; 
	$page = 1;
	if(isset($_POST['page'])){
		$page = $_POST['page'];
	}
	$start = ($page-1)*$perPage;
	if($start < 0) $start = 0;
		
	$query =  $sql . $orderby .  " limit " . $start . "," . $perPage; 
	$result = $db_handle->runQuery($query);
	
	if(!empty($result)) {
		$result["perpage"] = showperpage($sql, $perPage, $href);
	}
?>
<html>
<head>
	<link href="style.css" type="text/css" rel="stylesheet" />
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

$(document).ready(function(){
    $("a.disable").click(function(e){
        if(!confirm('Are you sure to disable this test?')){
            e.preventDefault();
            return false;
        }
        return true;
    });
});
</script>
</head>
	<body>
    <div id="toys-grid">      
			<form name="frmSearch" method="post" action="dash.php?q=0">
			<div class="search-box">
			<table><tr><td>
			<input class="form-control input-md" style="width:200px" type="text" placeholder="Name" name="search[name]" value="<?php echo $name; ?>"	/></td><td>&nbsp;&nbsp;<input type="submit" name="go" class="btn btn-primary" value="Search" onclick="window.location='dash.php?q=0'"></td><td>&nbsp;&nbsp;<input type="reset" class="btn btn-primary" value="Reset" onclick="window.location='dash.php?q=0'"/></td></tr>
			</table></div>
			<div class="panel table-responsive">
			<table class="table table-striped title1" cellpadding="10" cellspacing="1">
        <thead>
					<tr>
          <th><strong>Name</strong></th>          
          <th><strong>Total question</strong></th>
					<th><strong>Marks</strong></th>
					<th><strong>Time limit</strong></th>
					<th><strong>Status</strong></th>
					<th><strong>Action</strong></th>
					
					</tr>
				</thead>
				<tbody>
					<?php
					if(!empty($result)) { 
						foreach($result as $k=>$v) {
						  if(is_numeric($k)) {
							  if($result[$k]["status"] == "enabled"){
					?>
          <tr>
					<td><?php echo $result[$k]["title"]; ?></td>
          <td><?php echo $result[$k]["total"]; ?></td>
					<td><?php echo $result[$k]["correct"]*$result[$k]["total"]; ?></td>
					<td><?php echo $result[$k]["time"]; ?></td>
					<td><?php echo $result[$k]["status"]; ?></td> 
					<td style="vertical-align:middle"><b>
					<!--<a href="update.php?deidquiz=<?php echo $result[$k]["eid"]; ?>" onclick="return confirm(\'Are you sure to disable this test ?\')" class="disable btn logb" style="color:#FFFFFF;background:#ff0000;font-size:12px;padding:5px;margin:5px">&nbsp;<span><b>Disable</b></span></a></b></td></tr>-->
					<a href="disable.php?deidquiz=<?php echo $result[$k]["eid"]; ?>" onclick="return confirm(\'Are you sure to disable this test ?\')" class="disable btn logb" style="color:#FFFFFF;background:#ff0000;font-size:12px;padding:5px;margin:5px">&nbsp;<span><b>Disable</b></span></a></b></td></tr>
					<?php } else {?>
					          <tr>
					<td><?php echo $result[$k]["title"]; ?></td>
          <td><?php echo $result[$k]["total"]; ?></td>
					<td><?php echo $result[$k]["correct"]*$result[$k]["total"]; ?></td>
					<td><?php echo $result[$k]["time"]; ?></td>
					<td><?php echo $result[$k]["status"]; ?></td> 
					 <td style="vertical-align:middle">
					 <a href="enable.php?eid=<?php echo $result[$k]["eid"]; ?>" class="enable btn logb" style="color:#FFFFFF;background:darkgreen;font-size:12px;padding:5px;margin:5px">&nbsp;<span><b> Enable</b></span></a>
					<a href="preview.php?eid=<?php echo $result[$k]["eid"]; ?>" class="btn logb"
					 style="color:#FFFFFF;background:darkblue;font-size:12px;padding:5px;margin:5px"><i class="fa fa-pdf"" aria-hidden="true"></i><span><b>Preview</b></span></a></td></tr>

					<?php
						  }}
					   }
                    }
					if(isset($result["perpage"])) {
					?>
					<tr>
					<td colspan="6" align=right> <?php echo $result["perpage"]; ?></td>
					</tr>
					<?php } ?>
				<tbody>
			</table></div>
			</form>	
		</div>
	</body>
</html>