<?php

use App\User;
use Hekmatinasser\Verta\Facades\Verta;


function saveFile($file,$fileName,$dir){
    $Name = $fileName.'.'.$file->extension();
    $file->move(public_path($dir),$Name);
    return $Name;
}
function convertToPersianNumber($str){
    $english = array('0','1','2','3','4','5','6','7','8','9');
    $persian = array('۰','۱','۲','۳','۴','۵','۶','۷','۸','۹');
    $convertedStr = str_replace($english, $persian, $str);
    return $convertedStr;
}
function convertToEnglishNumber($str){
    $english = array('0','1','2','3','4','5','6','7','8','9');
    $persian = array('۰','۱','۲','۳','۴','۵','۶','۷','۸','۹');
    $convertedStr = str_replace($persian, $english, $str);
    return $convertedStr;
}
function createGDate($date){
    $date = convertToEnglishNumber($date);
    if (strlen($date) > 10){
        $dateTime = explode(' ',$date);
        $dateArray =  explode('/',$dateTime[0]);
        $timeArray = explode(':',$dateTime[1]);
        $GDateArray = Verta::getGregorian($dateArray[0],$dateArray[1],$dateArray[2]);
        $result = \Carbon\Carbon::create($GDateArray[0],$GDateArray[1],$GDateArray[2],$timeArray[0],$timeArray[1],$timeArray[2]);
    }else{
        $dateArray = explode('/',$date);
        $GDateArray = Verta::getGregorian($dateArray[0],$dateArray[1],$dateArray[2]);
        $result = \Carbon\Carbon::create($GDateArray[0],$GDateArray[1],$GDateArray[2]);
    }
    return $result;
}


