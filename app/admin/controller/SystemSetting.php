<?php
/**
 * Created by PhpStorm.
 * User: LiQi
 * Date: 2018/2/7
 * Time: 10:36
 */
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\Request;

class SystemSetting extends Controller{

    public function icons(){

        return $this->fetch('systemSetting/icons');
    }
}