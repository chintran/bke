<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Util{
	public static function loadImg($path){
		return base_url('public/').$path;
	}

	public static function secondsToTime($inputSeconds) {

        $secondsInAMinute = 60;
        $secondsInAnHour  = 60 * $secondsInAMinute;
        $secondsInADay    = 24 * $secondsInAnHour;

        // extract days
        $days = floor($inputSeconds / $secondsInADay);

        // extract hours
        $hourSeconds = $inputSeconds % $secondsInADay;
        $hours = floor($hourSeconds / $secondsInAnHour);

        // extract minutes
        $minuteSeconds = $hourSeconds % $secondsInAnHour;
        $minutes = floor($minuteSeconds / $secondsInAMinute);

        // extract the remaining seconds
        $remainingSeconds = $minuteSeconds % $secondsInAMinute;
        $seconds = ceil($remainingSeconds);

        // return the final array
        $obj = array(
            'd' => Util::numWithZero($days),
            'h' => Util::numWithZero($hours),
            'm' => Util::numWithZero($minutes),
            's' => Util::numWithZero($seconds),
        );
        return $obj;
    }
    public static function numWithZero($num){
    	return ($num < 10) ? '0'.$num : $num;
    }

    public static function formatTime($datetime){
        return date('h:i A',strtotime($datetime));
    }
    public static function formatDate($datetime){
        return date('d M Y',strtotime($datetime));
    }

    public static function formatDateTime($datetime){
        return date('d M Y, h:i A',strtotime($datetime));
    }

    public static function typeOfCompetition($competition){
        $curTime = time();
        if($curTime < strtotime($competition->begin_datetime))
            return CompStatus::$UP;
        else if($curTime > strtotime($competition->end_datetime))
            return CompStatus::$END;
        else
            return CompStatus::$LIVE;
    }

    public static function shortName($fullName){
        $arr = mb_split('\s+', trim($fullName));
        $length = count($arr);
        if($length < 3)
            return $fullName;
        else
            return $arr[$length-2].' '.$arr[$length-1];
    }

    public static function removeNewline($str){
        return str_replace ("\r\n", '', $str);
    }

    public static function response($error_code, $message, $data = null){
        $resp = array('error_code'=>$error_code, 'message'=>$message, 'data'=>$data);
        echo json_encode($resp);
        exit;
    }

    public static function formatDateYMD($strDate, $determine='/'){
        $arrDate = explode($determine, $strDate);
        if(count($arrDate)==3)
            return $arrDate[2].'-'.$arrDate[1].'-'.$arrDate[0];
        else 
            return null;
    }
    public static function formatDateDMY($strDate, $determine='-'){
        $arrDate = explode($determine, $strDate);
        if(count($arrDate)==3)
            return $arrDate[2].'/'.$arrDate[1].'/'.$arrDate[0];
        else 
            return null;
    }

    public static function array2Hash($arr){
        $length = count($arr);
        $tmp = array();
        for($i = 0; $i < $length; $i++){
            $tmp[$arr[$i]] = $arr[$i];
        }
        return $tmp;
    }
    public static function timeRemain($limitTime, $starttime){
        return $limitTime - (time() - $starttime);
    }

    public static function timeDuration($start, $end){
        return strtotime($end) - strtotime($start);
    }

     public static function timeDurationHours($start, $end){
        return round((strtotime($end) - strtotime($start))/3600,1);
    }

    public static function curDate(){
        return date('Y-m-d H:i:s');
    }

     public static function curDateAndTime(){
        $cur = date('Y-m-d H:i:s');
        return explode(' ', $cur);
    }

    public static function getYear($datetime){
        return date('Y', strtotime($datetime));
    }
}