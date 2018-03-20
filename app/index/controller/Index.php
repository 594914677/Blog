<?php
namespace app\index\controller;
use think\Db;
use think\Controller;
use think\Request;

class Index extends Common
{

    public function index() {
        try{
            if(input('?cid')){
                $cid = input('cid');
                $category = Db::table('admin_category')
                    ->field('id')
                    ->where('isShow',1)
                    ->where('id',$cid)
                    ->whereOr('pid',$cid)
                    ->select();
                $id = [];
                foreach ($category as $val){
                    $id[] = $val['id'];
                }
                $id = implode(",", $id);
                $data = [
                    'a.isShow'=> 1,
                    'a.newsCid'=> array('in', $id),
                ];
                $result = Db::table('admin_news')
                    ->alias('a')
                    ->join('admin_category c','a.newsCid=c.id')
                    ->field('a.id as id, a.newsName, a.newsTime, a.newsCid, a.isShow, a.newsStatus, a.tuijian, c.name, a.textarea, a.total')
                    ->order('a.id desc')
                    ->where($data)
                    ->paginate(5);
                $this->assign('list',$result);
            }else{
                $data = [
                    'a.isShow'=> 1,
                ];
                //$result = Db::table('admin_news')->where($data)->order('id desc')->paginate(10);
                $result = Db::table('admin_news')
                    ->alias('a')
                    ->join('admin_category c','a.newsCid=c.id')
                    ->field('a.id as id, a.newsName, a.newsTime, a.newsCid, a.isShow, a.newsStatus, a.tuijian, c.name, a.textarea, a.total')
                    ->order(['a.tuijian'=>'desc','a.id'=>'desc'])
                    ->where($data)
                    ->paginate(5);
                $this->assign('list',$result);

            }
            $this->links();
            $this->carousel();
            $this->category();
        }catch(\Exception $e){
            //$this->error('执行错误');
            return $this->fetch('index/noFound');
        }
        return $this->fetch();
    }
    /* carousel 轮播图*/
    public function carousel(){
        try{
            $data = [
                'isShow'=> 1,
            ];
            $carousel = Db::table('admin_carousel')->where($data)->order('id desc')->select();
            $this->assign('carousel',$carousel);
        }catch(\Exception $e){
            $this->error('执行错误');
            //return $this->fetch('index/noFound');
        }
    }

    /*友情链接*/
    public function links(){
        try{
            $links_data = [
                'isShow'=> 1,
            ];
            $links = Db::table('admin_links')->where($links_data)->order('id desc')->select();
            $this->assign('links',$links);
        }catch(\Exception $e){
            $this->error('执行错误');
            //return $this->fetch('index/noFound');
        }
    }

    /*搜索*/
    public function Search(){
        $this->links();
        $this->category();
        $msg = [
            'status' => 0,
            'info' => '暂无数据'
        ];
        if(request()->isGet()){
            $request = Request::instance();
            $search = input('search');
            $result = Db::table('admin_news')
                ->alias('a')
                ->join('admin_category c','a.newsCid=c.id')
                ->field('a.id as id, a.newsName, a.newsTime, a.newsCid, a.isShow, a.newsStatus, a.tuijian, c.name, a.textarea, a.total')
                ->order('a.id desc')
                ->where('a.newsName|a.keyword|c.name','like',"%$search%")
                ->paginate(5,false, ['query' => $request->get()]);
            if($result){
                $this->assign('list',$result);
                return $this->fetch('index/index');
            }else{
                return $msg;
            }
        }else{
            return $msg;
        }
    }

    public function noFound(){
        return $this->fetch();
    }

}
