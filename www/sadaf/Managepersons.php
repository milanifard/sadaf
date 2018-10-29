<?php 
/*
 	برنامه نویس: امید میلانی فرد
*/
include("header.inc.php");
include("classes/persons.class.php");
HTMLBegin();
if(isset($_REQUEST["Save"])) 
{
	if(isset($_REQUEST["Item_pfname"]))
		$Item_pfname=$_REQUEST["Item_pfname"];
	if(isset($_REQUEST["Item_plname"]))
		$Item_plname=$_REQUEST["Item_plname"];
	if(isset($_REQUEST["Item_CardNumber"]))
		$Item_CardNumber=$_REQUEST["Item_CardNumber"];
	if(isset($_REQUEST["Item_EnterExitTypeID"]))
		$Item_EnterExitTypeID=$_REQUEST["Item_EnterExitTypeID"];
	if(!isset($_REQUEST["UpdateID"])) 
	{	
		manage_persons::Add($Item_pfname
				, $Item_plname
				, $Item_CardNumber
				);
	}	
	else 
	{	
		manage_persons::Update($_REQUEST["UpdateID"] 
				, $Item_pfname
				, $Item_plname
				, $Item_CardNumber
				);
	}	
	echo SharedClass::CreateMessageBox("اطلاعات ذخیره شد");
}
$LoadDataJavascriptCode = '';
if(isset($_REQUEST["UpdateID"])) 
{	
	$obj = new be_persons();
	$obj->LoadDataFromDatabase($_REQUEST["UpdateID"]); 
	$LoadDataJavascriptCode .= "document.f1.Item_pfname.value='".htmlentities($obj->pfname, ENT_QUOTES, 'UTF-8')."'; \r\n "; 
	$LoadDataJavascriptCode .= "document.f1.Item_plname.value='".htmlentities($obj->plname, ENT_QUOTES, 'UTF-8')."'; \r\n "; 
	$LoadDataJavascriptCode .= "document.f1.Item_CardNumber.value='".htmlentities($obj->CardNumber, ENT_QUOTES, 'UTF-8')."'; \r\n "; 
}	
?>
<form method="post" id="f1" name="f1" >
<?
	if(isset($_REQUEST["UpdateID"])) 
	{
		echo "<input type=\"hidden\" name=\"UpdateID\" id=\"UpdateID\" value='".$_REQUEST["UpdateID"]."'>";
	}
?>
<div class="container-fluid">
<div class="row">
<div class="col-2" ></div>
<div class="col-8" >
<br><table class="table table-sm table-stripped table-bordered">
<tr class="HeaderOfTable">
<td align="center">ایجاد/ویرایش افراد</td>
</tr>
<tr>
<td>
<table width="100%" border="0">
<tr>
	<td width="1%" nowrap>
 نام
	</td>
	<td nowrap>
	<input class="form-control sadaf-m-input" type="text" name="Item_pfname" id="Item_pfname" maxlength="45" >
	</td>
</tr>
<tr>
	<td width="1%" nowrap>
 نام خانوادگی
	</td>
	<td nowrap>
	<input class="form-control sadaf-m-input" type="text" name="Item_plname" id="Item_plname" maxlength="45" >
	</td>
</tr>
<tr>
	<td width="1%" nowrap>
 شماره کارت
	</td>
	<td nowrap>
	<input class="form-control sadaf-m-input" type="text" name="Item_CardNumber" id="Item_CardNumber" maxlength="45">
	</td>
</tr>
</table>
</td>
</tr>
<tr class="FooterOfTable">
<td align="center">
<input type="button" class="btn btn-info" onclick="javascript: ValidateForm();" value="ذخیره">
 <input type="button" class="btn " onclick="javascript: document.location='Managepersons.php';" value="جدید">
</td>
</tr>
</table>
</div>
<div class="col-2" ></div>
</div>

<input type="hidden" name="Save" id="Save" value="1">
</form><script>
	<? echo $LoadDataJavascriptCode; ?>
	function ValidateForm()
	{
		document.f1.submit();
	}
</script>
<?php 
$res = manage_persons::GetList(0, 1000, "PersonID", ""); 
$SomeItemsRemoved = false;
for($k=0; $k<count($res); $k++)
{
	if(isset($_REQUEST["ch_".$res[$k]->PersonID])) 
	{
		manage_persons::Remove($res[$k]->PersonID); 
		$SomeItemsRemoved = true;
	}
}
if($SomeItemsRemoved)
	$res = manage_persons::GetList(0, 1000, "PersonID", ""); 
?>
<form id="ListForm" name="ListForm" method="post"> 
<div class="row">
<div class="col-2" ></div>
<div class="col-8" >
<br><table id="PersonList" class="table table-sm table-stripped table-bordered">
<thead>
	<th>&nbsp;</th>
	<th>ویرایش</th>
	<th>نام خانوادگی</th>
	<th>نام</th>
</thead>
<tbody>
<?
for($k=0; $k<count($res); $k++)
{
	echo "<tr>";
	echo "<td>";
	echo "<input type=\"checkbox\" name=\"ch_".$res[$k]->PersonID."\">";
	echo "</td>";
	echo "	<td><a href=\"Managepersons.php?UpdateID=".$res[$k]->PersonID."\"><i class=\"material-icons\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"ویرایش\">edit</i></a></td>";	
	echo "	<td>".htmlentities($res[$k]->plname, ENT_QUOTES, 'UTF-8')."</td>";
	echo "	<td>".htmlentities($res[$k]->pfname, ENT_QUOTES, 'UTF-8')."</td>";
	echo "</tr>";
}
?>
</tbody>
</table>
<table class="table table-sm table-bordered">
<tr class="FooterOfTable">
<td colspan="5" align="center">
	<input type="button" class="btn btn-danger" data-toggle="confirmation" 
			data-btn-ok-label="بلی" 
			data-btn-ok-class="btn-success"
        data-btn-ok-icon-class="material-icons" data-btn-ok-icon-content="check"
        data-btn-cancel-label="خیر" data-btn-cancel-class="btn-danger"
        data-btn-cancel-icon-class="material-icons" data-btn-cancel-icon-content="close"
        data-title="آیا مطمئن هستید؟" data-content=""
		value="حذف">
</td>
</tr>
</table>
</div>
<div class="col-2" ></div>
</div>

</form>
<form target="_blank" method="post" action="Newpersons.php" id="NewRecordForm" name="NewRecordForm">
</form>
<form method="post" name="f2" id="f2">
</form>
<script>

$(document).ready(function() {
    $('#PersonList').DataTable( {
	stateSave: true, 
	"columns": [
    { "orderable": false, "width": "1%" },
	{ "orderable": false, "width": "1%" },
    null,
    null
	],
	"order": [[ 2, "asc" ]],
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
	"dom": '<"DivRtl" l><"DivRtl" f>t<"DivRtl" ip>'
    } );
} );

$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

$('[data-toggle=confirmation]').confirmation({
  rootSelector: '[data-toggle=confirmation]',
  // other options
  onConfirm: function(value) {
    document.ListForm.submit();
  }  
});

</script>
</html>
