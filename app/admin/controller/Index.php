<?php
/**
 * Created by PhpStorm.
 * User: LiQi
 * Date: 2017/12/28
 * Time: 12:59
 */
namespace app\admin\controller;
use think\Controller;
use think\Route;
use think\Db;
use think\Session;
use think\Cache;
use think\cache\driver\Redis;

class Index extends Controller{

    /*首页*/
    public function index(){
        try{
            $id = '';
            $name = '';
            if (Cache::store('redis')->has('admin_id') && Cache::store('redis')->has('admin_name')){
                $id = Cache::store('redis')->get('admin_id');
                $name = Cache::store('redis')->get('admin_name');
            }
            $data = [
                'id'=> $id,
                'name'=>$name
            ];
            $result = Db::table('admin_adminuser')->where($data)->find();
            if(!empty($result)){
                return $this->fetch();
            }else{
                return $this->fetch('index/login');
            }
        }catch(\Exception $e){
            //$this->error('页面错误！请稍后再试～～～');
            return $this->fetch('index/noFound');
        }

    }

    /*登录*/
    public function login(){
        //Redis操作缓存正确方式
       /* 切换到redis操作
        Cache::store('redis')->set('name','value');
        Cache::store('redis')->get('name');
        Cache::store('redis')->has('name');
       */
        try{
            if(request()->isPost()){
                $msg = [
                    'status' => 0,
                    'info' => '',
                    'url'=>''
                ];

                $data = [
                    'name'=>input('post.username'),
                    'password'=>MD5(input('post.password'))
                ];
                $result = $this->validate(
                    [
                        'name'  => $data['name'],
                        'password' => input('post.password'),
                    ],
                    [
                        'name'  => 'require',
                        'password'   => 'require',
                    ]);
                if(true !== $result){
                    $msg['info'] = "账号或者密码错误1";
                    goto dome;
                }
                if(!captcha_check(input('post.captcha'))) {
                    $msg['info'] = "验证码不正确";
                    goto dome;
                }

                $request = Db::table('admin_adminuser')->where($data)->find();

                if(empty($request)){
                    $msg['info'] = "账号或者密码错误";
                    goto dome;

                }else{

                    Cache::store('redis')->set('admin_id',$request['id'],3600);
                    Cache::store('redis')->set('admin_name',$request['name'], 3600);

                    //Session::set('admin_id',$request['id']);
                    //Session::set('admin_name',$request['name']);

                    $msg['status'] = 1;
                    $msg['info'] = "登录成功";
                    $msg['url'] = "index";
                }
                dome:
                return  $msg;
            }else{
                Session::clear();
                return $this->fetch('login');
            }
        }catch(\Exception $e){
            $this->error('页面错误！请稍后再试～～～');
        }
    }

    /*main主体*/
    public function main(){
        return $this->fetch();
    }

    /*文章列表*/
    public function news(){
        try{
            $result = Db::table('admin_news')
                ->alias('a')
                ->join('admin_category c','a.newsCid=c.id')
                ->field('a.id as id, a.newsName, a.newsAuthor, a.newsTime, a.newsCid, a.isShow, a.newsStatus, a.tuijian, c.name')
                ->order('a.id desc')
                ->paginate(10);

            $this->assign('list',$result);
            return $this->fetch('news/newsList');
        }catch(\Exception $e){
            return $this->fetch('index/noFound');
        }
    }

    /*标题分类*/
    public function category(){
        try{
            $result = Db::table('admin_category')->order('id asc')->select();
            $newarr = $this->GetTree($result, 0, 0);
            $this->assign('list',$newarr);
            return $this->fetch('category/categoryList');
        }catch(\Exception $e){
            return $this->fetch('index/noFound');
        }
    }

    /*友情链接*/
    public function links(){
        try{
            $result = Db::table('admin_links')->order('id desc')->paginate(10);
            $this->assign('list',$result);
            return $this->fetch('links/linksList');
        }catch(\Exception $e){
            return $this->fetch('index/noFound');
        }
    }

    /*轮播图*/
    public function carousel(){
        try{
            $result = Db::table('admin_carousel')->order('id desc')->select();
            $this->assign('list',$result);
            return $this->fetch('carousel/carouselList');
        }catch(\Exception $e){
            return $this->fetch('index/noFound');
        }
    }

    /*修改密码*/
    public function adminUser(){
        try{
            $id = '';
            $name = '';
            if (Session::has('admin_id') && Session::has('admin_name')){
                $id = Session::get('admin_id');
                $name = Session::get('admin_name');
            }
            $data = [
                'id'=> $id,
                'name'=>$name
            ];
            $result = Db::table('admin_adminuser')->where($data)->find();
            $this->assign('name',$result['name']);
            $this->assign('id',$result['id']);
            return $this->fetch('adminuser/changePwd');
        }catch(\Exception $e){
            return $this->fetch('index/noFound');
        }

    }

    /* icons 图标 */
    public function systemSetting(){
        return $this->fetch('systemSetting/icons');
    }

    /* 404页面*/
    public function noFound(){
        return $this->fetch();
    }

    /*标题分类 分类等级优化*/
    private function GetTree($arr,$pid,$step){
        global $tree;
        foreach($arr as $key=>$val) {
            if($val['pid'] == $pid) {
                $flg = str_repeat('└―',$step);
                $val['name'] = $flg.$val['name'];
                $tree[] = $val;
                $this->GetTree($arr , $val['id'] ,$step+1);
            }
        }
        return $tree;
    }

    /*
     * 空方法
     *如果调用不存在的方法跳转到404页面
     */
    public function _empty()
    {
        //把所有城市的操作解析到city方法
        return $this->noFound();
    }
}