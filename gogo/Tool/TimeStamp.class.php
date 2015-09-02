<?php
namespace Tool;
class TimeStamp {
    function makeTimeStamp($year='', $month='', $day='')
    {
       if(empty($year)) {
           $year = strftime('%Y');
       }
       if(empty($month)) {
           $month = strftime('%m');
       }
       if(empty($day)) {
           $day = strftime('%d');
       }
       return mktime(0, 0, 0, $month, $day, $year);
    }
}