<?php
// Programmer: Omid Milanifard
class SharedClass
{
	static function ReplaceFarsiNumbersWithEnglishNumbers($st)
	{
		$st = str_replace("۰", "0", $st);
		$st = str_replace("۱", "1", $st);
		$st = str_replace("۲", "2", $st);
		$st = str_replace("۳", "3", $st);
		$st = str_replace("۴", "4", $st);
		$st = str_replace("۵", "5", $st);
		$st = str_replace("۶", "6", $st);
		$st = str_replace("۷", "7", $st);
		$st = str_replace("۸", "8", $st);
		$st = str_replace("۹", "9", $st);
		return $st;
	}

	static function ReplaceEnglishNumbersWithFarsiNumbers($st)
	{
		$st = str_replace("0", "۰", $st);
		$st = str_replace( "1", "۱",$st);
		$st = str_replace( "2", "۲",$st);
		$st = str_replace( "3", "۳",$st);
		$st = str_replace( "4", "۴",$st);
		$st = str_replace( "5", "۵",$st);
		$st = str_replace( "6", "۶",$st);
		$st = str_replace( "7", "۷",$st);
		$st = str_replace( "8", "۸",$st);
		$st = str_replace( "9", "۹",$st);
		return $st;
	}
	
	/*
	 * @param $ShamsiYear: سال شمسی
	 * @param $ShamsiMonth: ماه شمسی
	 * @param $ShamsiDay: روز شمسی
	 * @return تاریخ میلادی
	 */
	static function xdate2($date)
	  {
	   if($date==NULL)
	     return '0000-00-00';
	   else{
	   $yy=substr($date,0,4);
	   $mm=substr($date,5,2);
	   $dd=substr($date,8,2);
	   $xdate2 = ConvertS2XDate($dd,$mm,$yy);
	   return $xdate2;}
	  }
	static function ConvertToMiladi2($ShamsiYear, $ShamsiMonth, $ShamsiDay)
	{
		//!ereg("^[0-9]{2}", $ShamsiMonth) || !ereg("^[0-9]{2}", $ShamsiDay))
		if(!is_numeric($ShamsiYear) || !is_numeric($ShamsiMonth) || !is_numeric($ShamsiDay))
			return "0000-00-00";
		if($ShamsiMonth>12 || $ShamsiDay>31 || $ShamsiYear==0)
			return "0000-00-00";
		if(strlen($ShamsiDay)==1)
			$ShamsiDay = "0".$ShamsiDay;
		if(strlen($ShamsiMonth)==1)
			$ShamsiMonth = "0".$ShamsiMonth;
		$ShamsiDate = SharedClass::xdate2($ShamsiYear."/".$ShamsiMonth."/".$ShamsiDay);
		return substr($ShamsiDate,0,4)."-".substr($ShamsiDate,4,2)."-".substr($ShamsiDate,6,2);
	}
	
	/*
	 * @param $ShamsiYear: سال شمسی
	 * @param $ShamsiMonth: ماه شمسی
	 * @param $ShamsiDay: روز شمسی
	 * @return تاریخ میلادی
	 */
	static function ConvertToMiladi($ShamsiYear, $ShamsiMonth, $ShamsiDay)
	{
		//!ereg("^[0-9]{2}", $ShamsiMonth) || !ereg("^[0-9]{2}", $ShamsiDay))
		if(!is_numeric($ShamsiYear) || !is_numeric($ShamsiMonth) || !is_numeric($ShamsiDay))
			return "0000-00-00";
		if($ShamsiMonth>12 || $ShamsiDay>31 || $ShamsiYear==0)
			return "0000-00-00";
		if(strlen($ShamsiDay)==1)
			$ShamsiDay = "0".$ShamsiDay;
		if(strlen($ShamsiMonth)==1)
			$ShamsiMonth = "0".$ShamsiMonth;
		$ShamsiDate = xdate($ShamsiYear."/".$ShamsiMonth."/".$ShamsiDay);
		return substr($ShamsiDate,0,4)."-".substr($ShamsiDate,4,2)."-".substr($ShamsiDate,6,2);
	}
	
	static function ConvertFarsiDateToMiladi($FarsiDate)
	{
		$ShamsiDate = SharedClass::xdate2(SharedClass::ReplaceFarsiNumbersWithEnglishNumbers($_REQUEST["LetterDate"]));
		return substr($ShamsiDate,0,4)."-".substr($ShamsiDate,4,2)."-".substr($ShamsiDate,6,2);
	}
	
	// بر اساس یک کلید از جدول دومین آپشنهای یک لیست را بر می گرداند
	static function CreateADomainNameSelectOptions($DomainName, $OrderByColumn = "description")
	{
		$ret = "";
		$mysql = pdodb::getInstance();
		$mysql->Execute("select * from sadaf.domains where DomainName='".$DomainName."' order by ".$OrderByColumn);
                $res = $mysql->ExecuteStatement(array());
		while($rec = $res->fetch())
		{
			$ret .= "<option value='".$rec["DomainValue"]."'>";
			$ret .= $rec["description"];
			$ret .= "</option>";
		}
		return $ret;
	}

	// آپشنهای یک لیست را بر اساس یک جدول و فیلد مقدار و متن مربوطه می سازد
	static function CreateARelatedTableSelectOptions($RelatedTable, $RelatedValueField, $RelatedDescriptionField, $OrderBy = "")
	{
		if($OrderBy=="")
			$OrderBy = $RelatedValueField;
		$ret = "";
		$mysql = pdodb::getInstance();
		$mysql->Prepare("select * from ".$RelatedTable." order by ".$OrderBy);
                $res = $mysql->ExecuteStatement(array());
		while($rec = $res->fetch())
		{
			$ret .= "<option value='".$rec[$RelatedValueField]."'>";
			$ret .= $rec[$RelatedDescriptionField];
			$ret .= "</option>";
		}
		return $ret;
	}

	static function CreateAdvanceRelatedTableSelectOptions($RelatedTable, $RelatedValueField, $RelatedDescriptionField, $SelectOptions, $OrderBy = "")
	{
		if($OrderBy=="")
			$OrderBy = $RelatedValueField;
		$ret = "";
		$mysql = pdodb::getInstance();
		$mysql->Prepare("select ".$SelectOptions." from ".$RelatedTable." order by ".$OrderBy);
                $res = $mysql->ExecuteStatement(array());
		while($rec = $res->fetch())
		{
			$ret .= "<option value='".$rec[$RelatedValueField]."'>";
			$ret .= $rec[$RelatedDescriptionField];
			$ret .= "</option>";
		}
		return $ret;
	}
	
	static function CreateMessageBox($MessageBody, $MessageColor='green')
	{
		$ret = "";
		$ret .= "<table align=center><tr id=\"MessageBox\" style=\"display: \"><td><font color='".$MessageColor."'>".$MessageBody."</font></td></tr></table>\r\n";
		$ret .= "<script>setTimeout('document.getElementById(\"MessageBox\").style.display=\"none\";', 3000);</script>";
		return $ret;			
	}
	
	static function GetPersonFullName($PersonID)
	{
		$mysql = pdodb::getInstance();
		$mysql->Prepare("select concat(pfname, ' ', plname) as FullName from sadaf.persons where PersonID=?");
		$res = $mysql->ExecuteStatement(array($PersonID));
		if($rec = $res->fetch())
		{
			return $rec["FullName"]; 		
		}
		return "-";
	}
	
	static function getRealIpAddr()
	{
	    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
	    {
	      $ip=$_SERVER['HTTP_CLIENT_IP'];
	    }
	    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
	    {
	      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
	    }
	    else
	    {
	      $ip=$_SERVER['REMOTE_ADDR'];
	    }
	    return $ip;
	}	
	
}

?>