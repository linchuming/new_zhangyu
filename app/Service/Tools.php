<?php
/**
 * Created by PhpStorm.
 * User: cmlin
 * Date: 2016/9/2
 * Time: 16:47
 */
namespace App\Service;

class Tools
{
    static public function getRandChar($length){
        $str = null;
        $strPol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
        $max = strlen($strPol)-1;

        for($i=0;$i<$length;$i++){
            $str.=$strPol[rand(0,$max)];//rand($min,$max)生成介于min和max两个数之间的一个随机整数
        }

        return $str;
    }
}