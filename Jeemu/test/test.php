<?php
/**
 * Created by PhpStorm.
 * User: JeemuZhou
 * Date: 2017/4/25
 * Time: 15:57
 */
require_once __DIR__.'/..//src/Holiday.php';

$endTime = strtotime('2017-12-31');
$startTime = strtotime('2017-1-1');
for ($time = $startTime; $time <= $endTime; $time += 3600 * 24) {

    $timeArr[] = date('Ymd', $time);
}

($holiday = new Jeemu\Holiday($timeArr));
echo(json_encode($holiday->checkHoliday()));