<?php 
/*
	برنامه نویس: امید میلانی فرد
*/
include("header.inc.php");
include("classes/SystemFacilities.class.php");

if(isset($_REQUEST["GetID"])) 
{	
	$obj = new be_SystemFacilities();
	$obj->LoadDataFromDatabase($_REQUEST["GetID"]); 
	echo json_encode($obj);
	die();
}	

HTMLBegin();
if(isset($_REQUEST["Save"])) 
{
	if(isset($_REQUEST["Item_FacilityName"]))
		$Item_FacilityName=$_REQUEST["Item_FacilityName"];
	if(isset($_REQUEST["Item_GroupID"]))
		$Item_GroupID=$_REQUEST["Item_GroupID"];
	if(isset($_REQUEST["Item_OrderNo"]))
		$Item_OrderNo=$_REQUEST["Item_OrderNo"];
	if(isset($_REQUEST["Item_PageAddress"]))
		$Item_PageAddress=$_REQUEST["Item_PageAddress"];
	if($_REQUEST["UpdateID"]=="0") 
	{	
		manage_SystemFacilities::Add($Item_FacilityName
				, $Item_GroupID
				, $Item_OrderNo
				, $Item_PageAddress
				);
	}	
	else 
	{	
		manage_SystemFacilities::Update($_REQUEST["UpdateID"] 
				, $Item_FacilityName
				, $Item_GroupID
				, $Item_OrderNo
				, $Item_PageAddress
				);
	}	
	echo SharedClass::CreateMessageBox("اطلاعات ذخیره شد");
}
?>
<form method="post" id="f1" name="f1" >
<input type="hidden" name="UpdateID" id="UpdateID" value='0'>
<div class="container-fluid">

<? BootStrapModal("UserListDiv", "UserListDivHeader", "UserListDivContent", "کاربران"); ?>

<div class="modal fade" id="DataEntryForm" tabindex="-1" role="dialog" aria-labelledby="..." aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header align-right DivRtl">
        <h5 class="modal-title" id="exampleModalLongTitle">ایجاد/ویرایش گروه امکانات</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
			<div class="row">
			<div class="col">
				<table class="table table-sm table-stripped table-bordered">
				<tr>
					<td width="1%" nowrap>
				 عنوان
					</td>
					<td nowrap>
					<input type="text" class="form-control sadaf-m-input" name="Item_FacilityName" id="Item_FacilityName" maxlength="245" >
					</td>
				</tr>
				<tr>
					<td width="1%" nowrap>
				 گروه
					</td>
					<td nowrap>
					<select class="form-control sadaf-m-input" name="Item_GroupID" id="Item_GroupID">
					<option value=0>-
					<? echo SharedClass::CreateARelatedTableSelectOptions("SystemFacilityGroups", "GroupID", "GroupName", "GroupName"); ?>	</select>
					</td>
				</tr>
				<tr>
					<td width="1%" nowrap>
				 ترتیب
					</td>
					<td nowrap>
					<input type="text" class="form-control sadaf-s-input" name="Item_OrderNo" id="Item_OrderNo" maxlength="20" >
					</td>
				</tr>
				<tr>
					<td width="1%" nowrap>
				 آدرس صفحه
					</td>
					<td nowrap>
					<input type="text" dir="ltr" class="form-control sadaf-m-input" name="Item_PageAddress" id="Item_PageAddress" maxlength="345" size="40">
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
</form><script>
	function ValidateForm()
	{
		document.f1.submit();
	}
</script>
<?php 

$res = manage_SystemFacilities::GetList(); 
$SomeItemsRemoved = false;
for($k=0; $k<count($res); $k++)
{
	if(isset($_REQUEST["ch_".$res[$k]->FacilityID])) 
	{
		manage_SystemFacilities::Remove($res[$k]->FacilityID); 
		$SomeItemsRemoved = true;
	}
}
if($SomeItemsRemoved)
	$res = manage_SystemFacilities::GetList(); 
?>
<br>
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
			<div class="caption font-dark">
			<i class="material-icons">settings</i>
				منوها 
			</div>
		</div>
		<div class="portlet-body">
			<form id="ListForm" name="ListForm" method="post"> 
			<table id="FacilityListTable" class="table ">
			<thead>
				<th>&nbsp;</th>
				<th>عنوان</th>
				<th>گروه</th>
				<th>آدرس صفحه</th>
				<th>ترتیب</th>		
				<th>عملیات</th>				
			</thead>
			<tbody>
			<?
			for($k=0; $k<count($res); $k++)
			{
				echo "<tr>";
				echo "<td>";
				echo "<input type=\"checkbox\" name=\"ch_".$res[$k]->FacilityID."\">";
				echo "</td>";
				echo "	<td>".htmlentities($res[$k]->FacilityName, ENT_QUOTES, 'UTF-8')."</td>";
				echo "	<td>".$res[$k]->GroupID_Desc."</td>";
				echo "	<td>".htmlentities($res[$k]->PageAddress, ENT_QUOTES, 'UTF-8')."</td>";
				echo "	<td>".htmlentities($res[$k]->OrderNo, ENT_QUOTES, 'UTF-8')."</td>";		
				echo "<td>";
				echo "<a href=\"javascript: SetRecordForUpdate(".$res[$k]->FacilityID.");\" >";
				echo "<i class='material-icons' data-toggle=\"tooltip\" data-placement=\"top\" title=\"ویرایش\" >edit</i>";
				echo "</a>";
				echo "&nbsp; ";
				echo "<a  href='javascript: void(0)' onclick='ShowUsersList(".$res[$k]->FacilityID .")'>";
				echo "<i class='material-icons' data-toggle=\"tooltip\" data-placement=\"top\" title=\"کاربران\" >person_add</i>";
				echo "</a>";
				echo "&nbsp; ";
				echo "<a  target=\"_blank\" href='ManageFacilityPages.php?FacilityID=".$res[$k]->FacilityID ."'>";
				echo "<i class='material-icons' data-toggle=\"tooltip\" data-placement=\"top\" title=\"صفحات\" >folder_open</i>";
				echo "</a>";
				echo "</td>";
				echo "</tr>";
			}
			?>
			</tbody>
			</table>
		</div>
	</div>
</form>
<form target="_blank" method="post" action="NewSystemFacilities.php" id="NewRecordForm" name="NewRecordForm">
</form>
<? HTMLEnd(); ?>
<script>

function ShowUsersList(uid)
{
	ShowDetailsInModal("ManageUserFacilities.php", "#UserListDiv", "کاربران", "UserListDivContent", "UserListDivHeader", "FacilityID", uid);
}

function RemoveUser(uid, item_id)
{
	DoActionAndRefreshModal("ManageUserFacilities.php", "#UserListDiv", "", "UserListDivContent", "UserListDivHeader", "FacilityID", uid, "RemoveItemID", item_id);
}

function AddUser(uid)
{
	DoActionAndRefreshModal("ManageUserFacilities.php", "#UserListDiv", "", "UserListDivContent", "UserListDivHeader", "FacilityID", uid, "Item_UserID", document.getElementById('Item_UserID').value);
}

$(document).ready(function() {
	
    var MyDataTable = $('#FacilityListTable').DataTable( {
	stateSave: true, 
	"order": [[ 1, "desc" ]],
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
	"dom": '<"DivRtl" l><"DivRtl" f>t<"DivRtl" ip>',
	"columns": [
    { "orderable": false },
	null,
    null,
    { className: "align-left" },
    { className: "align-left" },
    null
	]
	
    } );

	MyDataTable.draw();
} );

$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

$('[data-toggle=confirmation]').confirmation({
  rootSelector: '[data-toggle=confirmation]',
  onConfirm: function(value) {
    document.ListForm.submit();
  }  
});

function ResetForm()
{
	document.getElementById('UpdateID').value='0'; 
	document.getElementById('Item_FacilityName').value = ''; 
	document.getElementById("Item_GroupID").value = '0';
	document.getElementById("Item_OrderNo").value = '';
	document.getElementById("Item_PageAddress").value = '';
}

function SetRecordForUpdate(uid)
{
	document.getElementById("UpdateID").value = uid;
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			var myObj = JSON.parse(this.responseText);
			document.getElementById("Item_FacilityName").value = myObj.FacilityName;
			document.getElementById("Item_GroupID").value = myObj.GroupID;
			document.getElementById("Item_OrderNo").value = myObj.OrderNo;
			document.getElementById("Item_PageAddress").value = myObj.PageAddress;
			$('#DataEntryForm').modal();
		}
	};
	xmlhttp.open("GET", "ManageSystemFacilities.php?GetID="+uid, true);
	xmlhttp.send(); 
}

</script>
</html>
