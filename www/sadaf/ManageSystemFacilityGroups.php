<?php 
/*
برنامه نویس: امید میلانی فرد
*/
include("header.inc.php");
include("classes/SystemFacilityGroups.class.php");

if(isset($_REQUEST["GetID"])) 
{	
	$obj = new be_SystemFacilityGroups();
	$obj->LoadDataFromDatabase($_REQUEST["GetID"]); 
	echo json_encode($obj);
	die();
}	

HTMLBegin();
if(isset($_REQUEST["Save"])) 
{
	if(isset($_REQUEST["Item_GroupName"]))
	{
		$Item_GroupName=$_REQUEST["Item_GroupName"];
		$Item_OrderNo=$_REQUEST["Item_OrderNo"];
	}
	if(!isset($_REQUEST["UpdateID"]) || $_REQUEST["UpdateID"]=="0") 
	{	
		manage_SystemFacilityGroups::Add($Item_GroupName
				, $Item_OrderNo
				);
	}	
	else 
	{	
		manage_SystemFacilityGroups::Update($_REQUEST["UpdateID"] 
				, $Item_GroupName
				, $Item_OrderNo
				);
		die();
	}	
	echo SharedClass::CreateMessageBox("اطلاعات ذخیره شد");
}
?>
<form method="post" id="f1" name="f1" >
<input type="hidden" name="UpdateID" id="UpdateID" value='0'>

<div class="container-fluid">

<div class="modal fade" id="DataEntryForm" tabindex="-1" role="dialog" aria-labelledby="..." aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
        <h5 class="modal-title">ایجاد/ویرایش گروه امکانات</h4>
      </div>
      <div class="modal-body">
			<div class="row">
			<div class="col">
			<table id="NewFacilityGroupForm" class="table table-sm">
				<tr>
					<td width="1%" nowrap>
				 نام 
					</td>
					<td nowrap>
					<input type="text" class="sadaf-m-input form-control" name="Item_GroupName" id="Item_GroupName" maxlength="145">
					</td>
				</tr>
				<tr>
					<td width="1%" nowrap>
				 شماره ترتیب
					</td>
					<td nowrap>
					<input type="text" class="sadaf-s-input form-control" name="Item_OrderNo" id="Item_OrderNo" maxlength="2">
					</td>
				</tr>
			</table>
			</div>
		</div>
      </div>
      <div class="modal-footer DivRtl">
		<input type="button" class="btn" onclick="javascript: ResetForm();" value="جدید">
		<button type="button" class="btn btn-primary" onclick='javascript: ValidateForm();'>ذخیره</button>
      </div>
    </div>
  </div>
</div>

<input type="hidden" name="Save" id="Save" value="1">
</form>
<script>
	function ValidateForm()
	{
		document.f1.submit();
	}
</script>
<?php 
$res = manage_SystemFacilityGroups::GetList(); 
$SomeItemsRemoved = false;
for($k=0; $k<count($res); $k++)
{
	if(isset($_REQUEST["ch_".$res[$k]->GroupID])) 
	{
		manage_SystemFacilityGroups::Remove($res[$k]->GroupID); 
		$SomeItemsRemoved = true;
	}
}
if($SomeItemsRemoved)
	$res = manage_SystemFacilityGroups::GetList(); 
?>
<br>
<div class="row">
<div class="col-1" ></div>
<div class="col-10">
	<div class="portlet box green">
		<div class="portlet-title">
			<div class="actions">
				<input type="button" class="btn btn-success btn-sm" onclick="javascript: ResetForm(); $('#DataEntryForm').modal();" value="ایجاد">
				<input type="button" class="btn btn-danger btn-sm" data-toggle="confirmation" 
					data-btn-ok-label="بلی" 
					data-btn-ok-class="btn-success"
				data-btn-ok-icon-class="material-icons" data-btn-ok-icon-content="check"
				data-btn-cancel-label="خیر" data-btn-cancel-class="btn-danger"
				data-btn-cancel-icon-class="material-icons" data-btn-cancel-icon-content="close"
				data-title="آیا مطمئن هستید؟" data-content=""
				value="حذف">
			</div>			
			<div class="caption">
			<i class="material-icons">settings</i>
				گروه های منو 
			</div>
		</div>
		<div class="portlet-body">
			<form id="ListForm" name="ListForm" method="post"> 
			<table class="table table-striped table-bordered table-hover table-checkable order-column" id="FacilityGroupList">
			<thead>
				<th >&nbsp;</th>
				<th > نام </th>
				<th > ترتیب </th>
				<th > عملیات </th>				
			</thead>
			<tbody>
			<?
			for($k=0; $k<count($res); $k++)
			{
				echo "<tr>";
				echo "<td>";
				echo "<input type=\"checkbox\" name=\"ch_".$res[$k]->GroupID."\">";
				echo "</td>";
				echo "	<td>".htmlentities($res[$k]->GroupName, ENT_QUOTES, 'UTF-8')."</td>";
				echo "	<td>".htmlentities($res[$k]->OrderNo, ENT_QUOTES, 'UTF-8')."</td>";
				echo "	<td>";
				echo "<a href='javascript: SetRecordForUpdate(".$res[$k]->GroupID.")'>";
				echo "<i class='material-icons'>edit</i>";
				echo "</a>";
				echo "</td>";
				echo "</tr>";
			}
			?>
			</tbody>
			</table>
		</div>
	</div>

</div>
<div class="col-1" ></div>
</div>

</form>
<form target="_blank" method="post" action="NewSystemFacilityGroups.php" id="NewRecordForm" name="NewRecordForm">
</form>
<script>
$('[data-toggle=confirmation]').confirmation({
  rootSelector: '[data-toggle=confirmation]',
  // other options
  onConfirm: function(value) {
    document.ListForm.submit();
  }  
});

function ResetForm()
{
	document.getElementById('UpdateID').value='0'; 
	document.getElementById('Item_GroupName').value = ''; 
	document.getElementById("Item_OrderNo").value = '';
}

function SetRecordForUpdate(uid)
{
	document.getElementById("UpdateID").value = uid;
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			var myObj = JSON.parse(this.responseText);
			document.getElementById("Item_GroupName").value = myObj.GroupName;
			document.getElementById("Item_OrderNo").value = myObj.OrderNo;
			$('#DataEntryForm').modal();
		}
	};
	xmlhttp.open("GET", "ManageSystemfacilityGroups.php?GetID="+uid, true);
	xmlhttp.send(); 
}

$(document).ready(function() {
    $('#FacilityGroupList').DataTable( {
	stateSave: true, 
	"pagingType": "numbers",
	"decimal":        "",
	"language": {
    "emptyTable":     "رکوردی وجود ندارد",
    "info":           "نمایش ردیف _START_ تا _END_ از _TOTAL_ رکورد",
    "infoEmpty":      "",
    "infoFiltered":   "(فیلتر شده از بین _MAX_ ورودی)",
    "infoPostFix":    "",
    "thousands":      ",",
    "lengthMenu":     "نمایش _MENU_ رکورد در هر صفحه",
    "loadingRecords": "در حال بارگذاری...",
    "processing":     "در حال پردازش...",
    "search":         "جستجو: ",
    "zeroRecords":    "رکوردی یافت نشد"
	},
	"dom": '<t>',
	"columns": [
    { "orderable": false, "width": "1%" },
    { "orderable": true, "width": "97%" },
    { "orderable": true, "width": "1%" },
    {"orderable": false, "width": "1%" }]	,
	"order": [
		[1, "asc"]
	] // set first column as a default sort by asc	
	
    } );
} );

</script>
</html>
