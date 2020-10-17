<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/10/17 0017
 * Time: 15:53
 */

namespace App\Models\Yaojiuyao;

class HomeModel
{

    public function index(){
        $db = \Config\Database::connect();
        $prefix = $db->getPrefix();
        $res = $db->query('select * from '.$prefix.'users where uid=1');
        
        return $res;
    }
}