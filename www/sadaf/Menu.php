<!doctype html>
<!--- programmer: Omid MilaniFard --->
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet"  href="css/lab.css" type="text/css">	
	<script src="js/jquery-3.3.1.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
    <title></title>
  </head>
<?php
	include "header.inc.php";
	include "PAS_shared_utils.php";
	$mysql = pdodb::getInstance();
?>
<style>
</style>
<body style="background: #34495e">
<div class="container-fluid">

<div class="row text-white sfont">
	<div class="col-md-12">
	<?php echo PASUtils::GetCurrentDateShamsiName(); ?>
	<i class="fa fa-calendar"></i>
	</div>
</div>
<div class="row text-white sfont">
	<div class="col-md-12">
	<b><?php  echo $_SESSION["UserName"] ?></b> <i class="fa fa-user"></i> 
	</div>
</div>
<div class="row text-white sfont">
	<div class="col-md-12">
			<a href='#' data-toggle="tooltip" title="تغییر رمز عبور" onclick='javascript: parent.document.getElementById("MainContent").src="ChangePassword.php"'>
			<i class="fa fa-key text-white p-2" ></i>
			</a>
			<a href='#' data-toggle="tooltip" title="کارهایی که انجام دادم" onclick='javascript: parent.document.getElementById("MainContent").src="MyActions.php"'>
			<i class="fa fa-list text-white p-2" ></i>
			<a href='javascript: parent.document.location="SignOut.php?logout=1"' data-toggle="tooltip" title="خروج" >
			<i class="fa fa-sign-out text-white p-2" ></i>
			</a>
	</div>
</div>

<div class="row mb-1">
	<div class="col align-center">
		<div class="panel-group" id="accordion" align="center">
		<?php 
			$gres = $mysql->Execute("select * from sadaf.SystemFacilityGroups order by OrderNo");
			while($grec = $gres->fetch())
			{ 
		 ?>
			<div class="panel-heading  mb-1">
				<button type="button" class="MenuColor" data-toggle="collapse" data-parent="#accordion" href="#collapse<? echo $grec["GroupID"]  ?>">
				<?php echo $grec["GroupName"]; ?>
				<span class="caret"></span>
				</button>
			</div>
			<div id="collapse<? echo $grec["GroupID"]  ?>" class="panel-collapse collapse in mb-1">
				<div class="panel-body">
					<div class="list-group">
					<?php 
						$res = $mysql->Execute("select * from sadaf.SystemFacilities JOIN sadaf.UserFacilities using (FacilityID) where UserID='".$_SESSION["UserID"]."' and GroupID=".$grec["GroupID"]." order by OrderNo");
						
						while($rec = $res->fetch())
						{
							echo "<button type=\"button\" ";
							echo " class=\"list-group-item list-group-item-action\" onclick='javascript: parent.document.getElementById(\"MainContent\").src=\"".$rec["PageAddress"]."\"'>";
							echo $rec["FacilityName"]."</button>";
						}
					?>
					</div>
				</div>
			</div>
			
		<?php } ?>
		</div>

		</div>
	</div>
</div>
<script>


	function ColapseAll()
	{
	  <?
	    $gres = $mysql->Execute("select * from sadaf.SystemFacilityGroups order by OrderNo");
	    while($grec = $gres->fetch())
	    { 
	      echo "document.getElementById('tr_".$grec["GroupID"]."').style.display = 'none';\r\n";
	    }
	  ?>
	}
	
	function ExpandOrColapse(tr_id)
	{
	  ColapseAll();
		if(document.getElementById(tr_id).style.display=='')
			document.getElementById(tr_id).style.display = 'none';
		else
			document.getElementById(tr_id).style.display = '';
	}
	
	$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});
</script>
</body>
