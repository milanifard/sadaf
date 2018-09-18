<?php
	// برنامه نویس: امید میلانی فرد
	class PASUtils
	{
		function GetCurrentDateShamsiName()
		{
			$now = date("Ymd"); 
			$yy = substr($now,0,4); 
			$mm = substr($now,4,2); 
			$dd = substr($now,6,2);
			$CurrentDay = $yy."/".$mm."/".$dd;
			list($dd,$mm,$yy) = ConvertX2SDate($dd,$mm,$yy);
			$yy = substr($yy, 2, 2);
			$CurYear = 1300+$yy;	
			return PASUtils::FarsiDayName(date("l"))." ".$CurYear."/".$mm."/".$dd;
		}
		
	
		// با گرفتن مقدار معادل یک فیلد تاریخ-ساعت مقدار آن را به دقیقه بر می گرداند
		function GetMinutes($DateTime)
		{
			return substr($DateTime, 11, 2)*60+substr($DateTime, 14, 2);
		}
		
		// مشخص می کند یک بازه تاریخی چند روز است
		function GetDaysCount($FromDate, $ToDate)
		{
			$FromDate2  = substr($FromDate, 4, 2)."/".substr($FromDate, 6, 2)."/".substr($FromDate, 0, 4);
			$ToDate2  = substr($ToDate, 4, 2)."/".substr($ToDate, 6, 2)."/".substr($ToDate, 0, 4);
			$DaysCount = (strtotime($ToDate2)-strtotime($FromDate2))/86400+1;
			return $DaysCount;
		}

		function FarsiDayNumberInWeek($EnglishDayName)
		{
			if($EnglishDayName=="Friday")
				return 7;
			if($EnglishDayName=="Thursday")
				return 6;
			if($EnglishDayName=="Wednesday")
				return 5;
			if($EnglishDayName=="Tuesday")
				return 4;
			if($EnglishDayName=="Monday")
				return 3;
			if($EnglishDayName=="Sunday")
				return 2;
			if($EnglishDayName=="Saturday")
				return 1;
		}
		
		function FarsiDayName($EnglishDayName)
		{
			if($EnglishDayName=="Friday")
				return "جمعه";
			if($EnglishDayName=="Thursday")
				return "پنجشنبه";
			if($EnglishDayName=="Wednesday")
				return "چهارشنبه";
			if($EnglishDayName=="Tuesday")
				return "سه شنبه";
			if($EnglishDayName=="Monday")
				return "دو شنبه";
			if($EnglishDayName=="Sunday")
				return "یکشنبه";
			if($EnglishDayName=="Saturday")
				return "شنبه";
		}
		
		function GetMonthName($month)
		{
			if($month==1)
				return "فروردین";
			if($month==2)
				return "اردیبهشت";
			if($month==3)
				return "خرداد";
			if($month==4)
				return "تیر";
			if($month==5)
				return "مرداد";
			if($month==6)
				return "شهریور";
			if($month==7)
				return "مهر";
			if($month==8)
				return "آبان";
			if($month==9)
				return "آذر";
			if($month==10)
				return "دی";
			if($month==11)
				return "بهمن";
			if($month==12)
				return "اسفند";
			return "";
		}
		
		//  - فرمت به صورت 2008-01-12 - روز قبل را بر می گرداند
		function GetPreviousDate($CurDate)
		{
			$CurDate=shdate($CurDate);
			//echo $CurDate."<br>";
			$CurDay = substr($CurDate,0,2);
			$CurMonth = substr($CurDate,3,2);
			$CurYear = substr($CurDate,6,2);
			
			$CurDay--;
			if($CurDay==0)
			{
				$CurMonth--;
				if($CurMonth==0)
				{
					$CurYear--;
					$CurMonth = 12;
					$CurDay = 29;
				}
				else if($CurMonth<7)
					$CurDay = 31;
				else 
					$CurDay = 30;
			}
			if(strlen($CurDay)<2)
				$CurDay = "0".$CurDay;
			if(strlen($CurMonth)<2)
				$CurMonth = "0".$CurMonth;
			$CurDate = xdate($CurYear."/".$CurMonth."/".$CurDay);
			return substr($CurDate,0,4)."-".substr($CurDate,4,2)."-".substr($CurDate,6,2);
		}
		
		//  - فرمت به صورت 2008-01-12 - روز بعد را بر می گرداند
		function GetNextDate($CurDate)
		{
			$CurDate=shdate($CurDate);
			$CurDay = substr($CurDate,0,2);
			$CurMonth = substr($CurDate,3,2);
			$CurYear = substr($CurDate,6,2);
		
			if($CurMonth<7)
			{
				$CurDay++;
				if($CurDay>31)
				{
					$CurDay = 1;
					$CurMonth++;
				}
			}
			else
			{
				$CurDay++;
				if($CurDay>30)
				{
					$CurDay = 1;
					$CurMonth++;
					if($CurMonth>12)
					{
						$CurMonth=1;
						$CurYear++;
					}
				}
			}
			if(strlen($CurDay)<2)
				$CurDay = "0".$CurDay;
			if(strlen($CurMonth)<2)
				$CurMonth = "0".$CurMonth;
			$CurDate = xdate($CurYear."/".$CurMonth."/".$CurDay);
			return substr($CurDate,0,4)."-".substr($CurDate,4,2)."-".substr($CurDate,6,2);
		}
		
		function ShowTimeInHourAndMinute($TotalMinutes)
		{
			$h = (int)($TotalMinutes/60);
			$m = $TotalMinutes%60;
			if($h<10)
				$h = "0".$h;
			if($m<10)
				$m = "0".$m;
			return $h.":".$m;
		}
		
		function ShowTimeInHourAndMinuteOrEmpty($TotalMinutes)
		{
			$h = (int)($TotalMinutes/60);
			$m = $TotalMinutes%60;
			if($h<10)
				$h = "0".$h;
			if($m<10)
				$m = "0".$m;
			if($h.":".$m!="00:00")
				return $h.":".$m;
			else
				return "-";
		}
		
	}
?>