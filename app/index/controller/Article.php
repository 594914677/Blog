<?php
/**
 * Created by PhpStorm.
 * User: LiQi
 * Date: 2018/2/2
 * Time: 15:43
 */

namespace app\index\controller;
use think\Db;
use think\Controller;
use app\index\controller\Common as Common;

class Article extends Common
{
    public function index() {
        try{
            if(request()->isGet()){
                /*内容*/
                Db::table('admin_news')->where('id', input('id'))->setInc('total');
                $data = [
                    'a.id'=> input('id'),
                    'a.isShow'=> 1,
                ];
                $result = Db::table('admin_news')
                    ->alias('a')
                    ->join('admin_category c','a.newsCid=c.id')
                    ->field('a.id as id, a.newsName, a.newsTime, a.content, a.keyword, c.name,  a.newsCid, a.total')
                    ->order('a.id desc')
                    ->where($data)
                    ->paginate(5);
                //访问加 1

                $this->assign('list',$result);

                /*栏目导航*/
                /*栏目ID*/

                $newid = [
                    'id'=> input('id'),
                    'isShow'=> 1,
                ];
                //访问量加一
                $arr = Db::table('admin_news')->field('newsCid')->where($newid)->find();
                $this->assign('newsCid',$arr['newsCid']);

                $category = Db::table('admin_category')->order('id asc')->select();
                $this->assign('category',$category);

                /*相关文章*/
                $hot_list = Db::table('admin_news')
                    ->where('newsCid',$arr['newsCid'])
                    ->select();
                $this->assign('hot_list',$hot_list);
            }
            $this->category();
        }catch(\Exception $e){
            return $this->fetch('index/noFound');
        }
        return $this->fetch();
    }


}
