<?php
/**
 * Created by PhpStorm.
 * User: LiQi
 * Date: 2017/12/21
 * Time: 17:04
 */

namespace app\index\controller;
use think\Db;
use think\Controller;
use think\Request;

class Common extends Controller{
    /**
     * 跳转到404页面
     */
    public function _empty()
    {
        //return $this->noFound();
        header("HTTP/1.0 404 Not Found");
        return \view(APP_PATH.'404.html');
    }

    /*顶部分类导航*/
    public function category(){
        try{
            $result = Db::table('admin_category')->order('id asc')->select();
            $newarr = $this->generateTree($result);
            $this->assign('category',$newarr);
        }catch(\Exception $e){
            $this->error('执行错误');
        }
    }

    /*无限极分类*/
    public function generateTree($list, $pk = 'id', $pid = 'pid', $child = 'child', $root = 0)
    {
        $tree     = array();
        $packData = array();
        foreach ($list as $data) {
            $packData[$data[$pk]] = $data;
        }
        foreach ($packData as $key => $val) {
            if ($val[$pid] == $root) {
                //代表跟节点, 重点一
                $tree[] = &$packData[$key];
            } else {
                //找到其父类,重点二
                $packData[$val[$pid]][$child][] = &$packData[$key];
            }
        }
        return $tree;
    }
}