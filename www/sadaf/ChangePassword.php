<?php
	// Programmer: Omid Milanifard 
	// در این نسخه از چارچوب نرم افزاری کلمه عبور به صورت متن خام ذخیره شده است
	// برای نسخه های عملیاتی حتما از رمزنگاری مناسب استفاده شود - مثال: md5
	
	include("header.inc.php");
	HTMLBegin();
	$UnitCode = 0;
	$mysql = dbclass::getInstance();
	if(isset($_REQUEST["NewPass"]))
	{
		$query = "select * from sadaf.AccountSpecs where UserID='".$_SESSION["UserID"]."' and UserPassword='".$_REQUEST["OldPass"]."'";
		$res = $mysql->Execute($query);
		if($rec = $res->FetchRow())
		{
			$query = "update sadaf.AccountSpecs set UserPassword='".$_REQUEST["NewPass"]."' where UserID='".$_SESSION["UserID"]."'";
			$mysql->Execute($query);
			echo "<p align=center><font color=green>اطلاعات ذخیره شد</font></p>";
		}
		else
			echo "<p align=center><font color=red>کلمه عبور فعلی نادرست وارد شده است</font></p>";
	}
?>
<br>
<form method=post name=f1 id=f1 enctype='multipart/form-data'>
<?php if(isset($_REQUEST["PersonID"])) { ?>
<inut type=hidden name=PersonID id=PersonID value='<?php echo $_REQUEST["PersonID"] ?>'>
<?php } ?>
<div class="container-fluid">
<div class="row">
<div class="col-1" ></div>
<div class="col-10" >

<table class="table table-bordered" align="center">
<tr>
<td>
	<table class="table table-sm table-borderless">
	<tr>
		<td colspan=2 class=HeaderOfTable>
		تغییر کلمه عبور
		</td>
	</tr>
	<tr>
		<td>
		کلمه عبور فعلی: 
		</td>
		<td>
		<input class="form-control" name=OldPass type=password size=40 maxlength=200 value=''>
		</td>
	</tr>
	<tr>
		<td nowrap>
		کلمه عبور جدید: 
		</td>
		<td>
		<input class="form-control" name=NewPass type=password size=40 maxlength=200 value=''>
		</td>
	</tr>
	<tr>
		<td nowrap>
		تکرار کلمه عبور جدید:  
		</td>
		<td>
		<input class="form-control" name=ConfirmPass type=password size=40 maxlength=200 value=''>
		</td>
	</tr>
	<tr>
		<td colspan=2 align=center class=FooterOfTable>
			<input type=button class="btn btn-info" value='اعمال' onclick='javascript: CheckValidity();'>
		</td>
	</tr>
	</table>
</td>
</tr>
</table>
<br>
<?php if(isset($_REQUEST["PersonID"]) && !isset($_REQUEST["pfname"])) { ?>
<input type=hidden name=PersonID id=PersonID value='<?php echo $_REQUEST["PersonID"] ?>'>
<?php } ?>
</form>
<script>
	function CheckValidity()
	{
		if(f1.NewPass.value=="")
		{
			alert("کلمه عبور را ثبت نکرده اید");
			return;
		}
		if(f1.NewPass.value!=f1.ConfirmPass.value)
		{
			alert("کلمه عبور جدید با تکرار آن یکی نیست");
			return;
		}
		f1.submit();
	}
</script>

<?
	HTMLEnd();
?>
