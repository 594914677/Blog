<?php
/**
 * Created by PhpStorm.
 * User: LiQi
 * Date: 2018/1/12
 * Time: 13:15
 */
namespace app\admin\model;

use think\Model;

class Links extends Model
{
    //默认主键为自动识别，如果需要指定，可以设置属性：
    protected $pk = 'id';
    // 设置当前模型对应的完整数据表名称
    protected $table = 'admin_links';

    //自定义初始化
    protected function initialize()
    {
        //需要调用`Model`的`initialize`方法
        parent::initialize();
        //TODO:自定义的初始化
    }
}