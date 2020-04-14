<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class TanggalHelper{
	public function __construct(){
		$this->month = array(
				"01" => 'Jan',
				"02" => 'Feb',
				"03" => 'Mar',
				"04" => 'Apr',
				"05" => 'May',
				"06" => 'Jun',
				"07" => 'Jul',
				"08" => 'Aug',
				"09" => 'Sep',
				"10" => 'Oct',
				"11" => 'Nov',
				"12" => 'Des'
			);
	
    }

    function monthName($str){
		if(preg_match('((?:Jan(?:uary)?|Feb(?:ruary)?|Mar(?:ch)?|Apr(?:il)?|May|Jun(?:e)?|Jul(?:y)?|Aug(?:ust)?|Sep(?:tember)?|Sept|Oct(?:ober)?|Nov(?:ember)?|Dec(?:ember)?))', $str)){
			$month = strtoupper($str);
				if(preg_match('((JAN(?:UARY)?))',$month)){
					$month = 'Jan.';
				}elseif(preg_match('((FEB(?:RUARY)))',$month) or $month == 'FEB'){
					$month = 'Feb.';
				}elseif(preg_match('((MAR(?:CH)?))',$month)){
					$month = 'Mar.';
				}elseif(preg_match('((APR(?:IL)?))',$month)){
					$month = 'Apr.';
				}elseif(preg_match('((MAY?))',$month)){
					$month = 'Mei.';
				}elseif(preg_match('((JUN(?:E)?))',$month)){
					$month = 'Jun.';
				}elseif(preg_match('((JUL(?:Y)?))',$month)){
					$month = 'Jul.';
				}elseif(preg_match('((AUG(?:UST)?))',$month)){
					$month = 'Agu.';
				}elseif(preg_match('((SEP(?:TEMBER)?))',$month)){
					$month = 'Sep.';
				}elseif(preg_match('((OCT(?:OBER)?))',$month)){
					$month = 'Okt.';
				}elseif(preg_match('((NOV(?:EMBER)?))',$month)){
					$month = 'Nov.';
				}elseif(preg_match('((DEC(?:EMBER)?))',$month)){
					$month = 'Des.';
				}
			return $month;
		}
	}

	function monthFullName($str){
		if(preg_match('((?:Jan(?:uary)?|Feb(?:ruary)?|Mar(?:ch)?|Apr(?:il)?|May|Jun(?:e)?|Jul(?:y)?|Aug(?:ust)?|Sep(?:tember)?|Sept|Oct(?:ober)?|Nov(?:ember)?|Dec(?:ember)?))', $str)){
			$month = strtoupper($str);
				if(preg_match('((JAN(?:UARY)?))',$month)){
					$month = 'Januari';
				}elseif(preg_match('((FEB(?:RUARY)))',$month) or $month == 'FEB'){
					$month = 'Februari';
				}elseif(preg_match('((MAR(?:CH)?))',$month)){
					$month = 'Maret';
				}elseif(preg_match('((APR(?:IL)?))',$month)){
					$month = 'April';
				}elseif(preg_match('((MAY?))',$month)){
					$month = 'Mei';
				}elseif(preg_match('((JUN(?:E)?))',$month)){
					$month = 'Juni';
				}elseif(preg_match('((JUL(?:Y)?))',$month)){
					$month = 'Juli';
				}elseif(preg_match('((AUG(?:UST)?))',$month)){
					$month = 'Agustus';
				}elseif(preg_match('((SEP(?:TEMBER)?))',$month)){
					$month = 'September';
				}elseif(preg_match('((OCT(?:OBER)?))',$month)){
					$month = 'Oktober';
				}elseif(preg_match('((NOV(?:EMBER)?))',$month)){
					$month = 'November';
				}elseif(preg_match('((DEC(?:EMBER)?))',$month)){
					$month = 'Desember';
				}
			return $month;
		}
	}

	function dayName($str){
		if(preg_match('((?:Monday|Tuesday|Wednesday|Thursday|Friday|Saturday|Sunday|Tues|Thur|Thurs|Sun|Mon|Tue|Wed|Thu|Fri|Sat))', $str)){
			
			$day = strtoupper($str);
			if(preg_match('|MONDAY|',$day)){
				$day = 'Senin';
			}elseif(preg_match('|TUESDAY|',$day)){
				$day = 'Selasa';
			}elseif(preg_match('|WEDNESDAY|',$day)){
				$day = 'Rabu';
			}elseif(preg_match('|THURSDAY|',$day)){
				$day = 'Kamis';
			}elseif(preg_match('|FRIDAY|',$day)){
				$day = 'Jumat';
			}elseif(preg_match('|SATURDAY|',$day)){
				$day = 'Sabtu';
			}elseif(preg_match('|SUNDAY|',$day)){
				$day = 'Minggu';
			}
			return $day;
		}
	}

	public function convertDayDate($str){
		if(preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $str)){
			$date = (date_format(date_create($str),'Y/M/d'));
			$dates = explode("/", $date);
			$hari = $this->dayName(date('l', strtotime($str)));
			return $hari.", ".$dates[2]." ".$this->monthName($dates[1])." ".$dates[0];
		}else{
			return " - ";
		}	

	}
	public function convertDate($str){
		if(preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $str)){
			$date = (date_format(date_create($str),'Y/M/d'));
			$dates = explode("/", $date);
			return $dates[2]." ".$this->monthName($dates[1])." ".$dates[0];
		}else{
			return " - ";
		}
	}

	public function convertDateFullMonth($str){
		if(preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $str)){
			$date = (date_format(date_create($str),'Y/M/d'));
			$dates = explode("/", $date);
			return $dates[2]." ".$this->monthFullName($dates[1])." ".$dates[0];
		}else{
			return " - ";
		}
	}

	public function convertToInputDate($str){
		if(preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $str)){
			$date = (date_format(date_create($str),'d/m/Y'));
			$dates = explode("/", $date);
			return $date;
		}else{
			return "";
		}
	}

	public function getSelisihHari($date1,$date2){
	 	$date1 = strtotime($date1);
	 	$date2 = strtotime($date2);
	 	$datediff = $date2 - $date1;
	 	return floor($datediff/(60*60*24));
	}

	public function getSelisihTahun($date1,$date2){
		$diff = abs(strtotime($date2) - strtotime($date1));
		return floor($diff / (365*60*60*24));
	}

	public function convertToMysqlDate($date){
		if(strpos($date, '-') !== false) {
		    $arr = explode("-", $date);
		}elseif (strpos($date, ' ') !== false){
			$arr = explode(" ", $date);	
		}elseif (strpos($date, '/') !== false){
			$arr = explode("/", $date);	
		}else{
			return null;
		}
		
		if (count($arr)==3){
			foreach ($this->month as $key => $value) {
				if( $arr[1] == $value){
					$arr[1] = $key;
				}
			}
			$date = implode("/", $arr);
			$re1='((?:(?:[0-2]?\\d{1})|(?:[3][01]{1}))[-:\\/.](?:[0]?[1-9]|[1][012])[-:\\/.](?:(?:[1]{1}\\d{1}\\d{1}\\d{1})|(?:[2]{1}\\d{3})))(?![\\d])';	# DDMMYYYY 1
			if ($c=preg_match_all ("/".$re1."/is", $date, $matches)){
				$myDateTime = DateTime::createFromFormat('d/m/Y', $date);
				return $myDateTime->format('Y-m-d');
			}else{
				return false;
			}
		}
		
	}
	public function getDayName($date){
		$status = True;
		$re1='((?:(?:[0-2]?\\d{1})|(?:[3][01]{1}))[-:\\/.](?:[0]?[1-9]|[1][012])[-:\\/.](?:(?:[1]{1}\\d{1}\\d{1}\\d{1})|(?:[2]{1}\\d{3})))(?![\\d])';	# DDMMYYYY 1
		if ($c=preg_match_all ("/".$re1."/is", $date, $matches)){
			$myDateTime = DateTime::createFromFormat('d/m/Y', $date);
			$date = $myDateTime->format('Y-m-d');
			$status = True;
			return date('l', strtotime($date));
		}else{
			$status = False;
		}
		$re2='((?:(?:[1]{1}\\d{1}\\d{1}\\d{1})|(?:[2]{1}\\d{3}))[-:\\/.](?:[0]?[1-9]|[1][012])[-:\\/.](?:(?:[0-2]?\\d{1})|(?:[3][01]{1})))(?![\\d])';	# YYYYMMDD 1
		if ($c=preg_match_all ("/".$re2."/is", $date, $matches)){
			$myDateTime = DateTime::createFromFormat('Y-m-d', $date);
			$date = $myDateTime->format('Y-m-d');
			return date('l', strtotime($date));
		}else{
			$status = false;
		}
		if($status == false){
			return 'Error, Date Invalid Format';
		}
		return date('l', strtotime($date));
	}

	function isInputDateValid($date){
		$tmp = explode('/', $date);

		if(count($tmp)!=3){
			return FALSE;
		}
		if(intval($tmp[0])<1 OR intval($tmp[0])>31){
			return FALSE;
		}
		if(intval($tmp[1])<1 OR intval($tmp[1])>12){
			echo intval($tmp[1]);
			return FALSE;
		}

		if(intval($tmp[2])<1){
			return FALSE;
		}

		return TRUE;
	}

	public function parse_day_to_year($vonis){
		$result = array();
		$month = (int)($vonis/30);
		$year = (int) ($month/12);
		$month = (int) ($month%12);
		$total = (int)($year*12*30+$month*30);
		$day = intval($vonis-$total);
		$result['year'] = $year;
		$result['month'] = $month;
		$result['day'] = $day;
		return $result;
	}

	public function getSelisihJam($time1,$time2){
	 	$time1 = strtotime($time1);
	 	$time2 = strtotime($time2);
	 	$timediff = $time2 - $time1;
	 	return floor($timediff);
	}

	public function converToAngkaRomawi($integer, $upcase = true){ 
	    $table = array('M'=>1000, 'CM'=>900, 'D'=>500, 'CD'=>400, 'C'=>100, 'XC'=>90, 'L'=>50, 'XL'=>40, 'X'=>10, 'IX'=>9, 'V'=>5, 'IV'=>4, 'I'=>1); 
	    $return = ''; 
	    while($integer > 0) 
	    { 
	        foreach($table as $rom=>$arb) 
	        { 
	            if($integer >= $arb) 
	            { 
	                $integer -= $arb; 
	                $return .= $rom; 
	                break; 
	            } 
	        } 
	    } 

	    return $return; 
	}

	function Terbilang($x){ 
		$abil = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
		if ($x < 12)
			return " " . $abil[$x];
		elseif ($x < 20)
			return $this->Terbilang($x - 10) . "belas";
		elseif ($x < 100)
			return $this->Terbilang($x / 10) . " puluh" . $this->Terbilang($x % 10);
		elseif ($x < 200)
			return " seratus" . $this->Terbilang($x - 100);
		elseif ($x < 1000)
			return $this->Terbilang($x / 100) . " ratus" . $this->Terbilang($x % 100);
		elseif ($x < 2000)
			return " seribu" . $this->Terbilang($x - 1000);
		elseif ($x < 1000000)
			return $this->Terbilang($x / 1000) . " ribu" . $this->Terbilang($x % 1000);
		elseif ($x < 1000000000)
			return $this->Terbilang($x / 1000000) . " juta" . $this->Terbilang($x % 1000000);
		elseif ($x < 1000000000000)
			return $this->Terbilang($x / 1000000000) . " milyar" . $this->Terbilang($x % 1000000000);
	}

}