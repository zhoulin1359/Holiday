<?php

/**
 * Created by PhpStorm.
 * User: JeemuZhou
 * Date: 2017/4/25
 * Time: 14:21
 */
namespace Jeemu;

class Holiday
{
    private $holidays =[];//节假日配置信息
    private $dates = [];  //日期

    public function __construct($dates)
    {
        if (is_array($dates)){
            foreach ($dates as $val){
                $year = substr($val,0,4);
                $this->loadConfig($year);
            }
            $this->dates = $dates;
        }else{
            $year = substr($dates,0,4);
            $this->loadConfig($year);
            $this ->dates = [$dates];
        }
      /*  $week = date('w',strtotime($date));
        $year = substr($date,0,4);
        $this->loadConfig($year);
        if ($week >=1 && $week <=5){
            //正常工作日
            if (in_array($date,$this->holidays[$year]['holidays'])){
                return true;
            }else{
                return false;
            }
        }else{
            //周末
            if (in_array($date,$this->holidays[$year]['workdays'])){
                return false;
            }else{
                return true;
            }
        }*/
    }


    /**
     * 检查日期是否是节假日
     */
    public function checkHoliday(){
        foreach ($this->dates as $val){
            $week = date('w',strtotime($val));
            $year = substr($val,0,4);
            if ($week >=1 && $week <=5){
                //正常工作日
                if (in_array($val,$this->holidays[$year]['holidays'])){
                    $result[$val] =  true;
                }else{
                    $result[$val] =  false;
                }
            }else{
                //周末
                if (in_array($val,$this->holidays[$year]['workdays'])){
                    $result[$val] =  false;
                }else{
                    $result[$val] =  true;
                }
            }
        }
        return $result;
    }

    /**
     * 加载节假日配置信息
     * @param $year
     */
    private function loadConfig($year){
        if (isset($this->holidays[$year])){
            return;
        }
        //$path = str_replace('\\', DIRECTORY_SEPARATOR, $class);
        $path =__DIR__.'/conf/'.$year.'.php';
        if (is_file($path)){
            $yearConf = require_once __DIR__.'/conf/'.$year.'.php';
            if (isset($yearConf) && is_array($yearConf)){
                $this->holidays[$year] = $yearConf;
            }
        }
    }

    public function printfConfing(){
        var_dump($this->holidays);
    }
}