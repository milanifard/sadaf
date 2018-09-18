<?php 
/*
 صفحه  نمایش لیست و مدیریت داده ها مربوط به : 
	برنامه نویس: امید میلانی فرد
	تاریخ ایجاد: 92-8-4
*/
include("header.inc.php");
include("classes/UserFacilities.class.php");
include ("classes/SystemFacilities.class.php");
HTMLBegin();

// functions that call in modal form and after them the new UI code show be produce
// { begin
if(isset($_REQUEST["RemoveItemID"]))
{
	manage_UserFacilities::Remove($_REQUEST["RemoveItemID"]);
}

if(isset($_REQUEST["Item_UserID"]))
{
	$Item_UserID=$_REQUEST["Item_UserID"];
	$Item_FacilityID=$_REQUEST["FacilityID"];	
	manage_UserFacilities::Add($Item_UserID, $Item_FacilityID);
}
// } end of functional ajax function

?>
<form method="post" id="f1" name="f1" >
<?
echo manage_SystemFacilities::ShowSummary($_REQUEST["FacilityID"]);
$res = manage_UserFacilities::GetList($_REQUEST["FacilityID"]); 
?>
<br><table width="90%" border="1" cellspacing="0" align="center">
<tr>
<td>
<table width="100%" border="0">
<tr>
	<td>
 کاربر
	</td>
	<td>
	<select class="form-control sadaf-m-input" dir="ltr" name="Item_UserID" id="Item_UserID">
	<option value=0>-
	<? echo SharedClass::CreateARelatedTableSelectOptions("sadaf.AccountSpecs", "UserID", "UserID", "UserID"); ?>	</select>
	</td>
	<td width=30%>
		<input type="button" class="btn btn-primary" onclick="javascript: AddUser('<? echo $_REQUEST["FacilityID"] ?>');" value="ذخیره">	
	</td>
</tr>
<input type="hidden" name="FacilityID" id="FacilityID" value='<? if(isset($_REQUEST["FacilityID"])) echo htmlentities($_REQUEST["FacilityID"], ENT_QUOTES, 'UTF-8'); ?>'>
</table>
</td>
</tr>
</table>
<input type="hidden" name="Save" id="Save" value="1">
</form>

<form id="ListForm" name="ListForm" method="post"> 
	<input type="hidden" id="Item_FacilityID" name="Item_FacilityID" value="<? echo htmlentities($_REQUEST["FacilityID"], ENT_QUOTES, 'UTF-8'); ?>">
<br>
<table class='table table-sm table-stripped table-bordered'>
<tr class="HeaderOfTable">
	<td width="1%">ردیف</td>
	<td>کاربر</td>
	<td>عملیات</td>
</tr>
<?
for($k=0; $k<count($res); $k++)
{
	echo "<tr>";
	echo "<td>".($k+1)."</td>";
	echo "	<td>".$res[$k]->UserID_Desc."</td>";
	echo "<td>";
	echo "<a href=\"javascript: RemoveUser(".$_REQUEST["FacilityID"].",".$res[$k]->FacilityPageID.");\">";
	echo "<i class='material-icons'  data-toggle='tooltip' title='حذف' data-placement='top'>delete</i>";
	echo "</a>";
	echo "</td>";
	echo "</tr>";
}
?>
</table>
</form>
</html>
