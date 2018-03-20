<?php
/**
 * Created by PhpStorm.
 * User: LiQi
 * Date: 2018/1/2
 * Time: 10:16
 */
namespace app\admin\controller;
use think\Controller;
use app\admin\model\News as NewsModel;
use think\Db;
use think\Request;

class News extends Controller{

    public function newsList(){
        return $this->fetch();
    }

    public function newsSearch(){
        try{
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
                    ->field('a.id as id, a.newsName, a.newsAuthor, a.newsTime, a.newsCid, a.isShow, a.newsStatus, a.tuijian, c.name')
                    ->order('a.id desc')
                    ->where('a.newsName|a.newsAuthor|c.name','like',"%$search%")
                    ->paginate(5,false, ['query' => $request->get()]);
                if($result){
                    $this->assign('list',$result);
                    return $this->fetch('news/newsList');
                }else{
                    return $msg;
                }
            }else{
                return $msg;
            }
        }catch(\Exception $e){
            return $this->fetch('index/noFound');
        }

    }

    public function newsAdd(){
        try{
            if(request()->isPost()){

                $msg = [
                    'status' => 0,
                    'info' => ''
                ];

                $user = new NewsModel;
                $user->data([
                                'newsName' => input('newsName'),
                                'tuijian' => input('tuijian'),
                                'newsStatus' => input('newsStatus'),
                                'isShow' => input('isShow'),
                                'newsAuthor' => input('newsAuthor'),
                                'newsTime' => input('newsTime'),
                                'newsCid' => input('newsCid'),
                                'keyword' => input('keyword'),
                                'textarea' => input('textarea'),
                                'content' => input('content')
                            ]);
                $res = $user->save();
                if($res){
                    $msg['status'] = 1;
                    $msg['info'] = '添加成功';
                    return $msg;
                }else{
                    $msg['info'] = '添加失败';
                    return $msg;
                }
            }else{
                $result = Db::table('admin_category')->select();
                $newarr = $this->GetTree($result, 0, 0);
                $this->assign('category',$newarr);
                return $this->fetch();
            }
        }catch(\Exception $e){
            return $this->fetch('index/noFound');
        }

    }

    public function newsUp(){
        try{
            if(request()->isPost()){
                $msg = [
                    'status' => 0,
                    'info' => ''
                ];
                $user = new NewsModel;
                $res =  $user->where('id', input('newsId'))
                    ->update([
                                 'newsName' => input('newsName'),
                                 'tuijian' => input('tuijian'),
                                 'newsStatus' => input('newsStatus'),
                                 'isShow' => input('isShow'),
                                 'newsAuthor' => input('newsAuthor'),
                                 'newsTime' => input('newsTime'),
                                 'newsCid' => input('newsCid'),
                                 'keyword' => input('keyword'),
                                 'textarea' => input('textarea'),
                                 'content' => input('content')
                             ]);
                if($res !== false) {
                    $msg['status'] = 1;
                    $msg['info'] = '修改成功';
                    return $msg;
                }else{
                    $msg['info'] = '修改失败';
                    return $msg;
                }
            }else{
                $id = Request::instance()->param('id');
                $result = Db::table('admin_news')->where("id = $id")->select();
                $this->assign('list',$result);

                $category = Db::table('admin_category')->select();
                $newarr = $this->GetTree($category, 0, 0);
                $this->assign('category',$newarr);

                return $this->fetch();
            }
        }catch(\Exception $e){
            //$this->error('执行错误');
            return $this->fetch('index/noFound');
        }

    }

    public function newsDel(){
        try{
            $msg = [
                'status' => 0,
                'info' => ''
            ];
            if(request()->isPost()){
                $id = input('newsId');
                $user = NewsModel::get($id);
                $res = $user->delete();
                if($res !== false) {
                    $msg['status'] = 1;
                    $msg['info'] = '删除成功';
                    return $msg;
                }else{
                    $msg['info'] = '删除失败';
                    return $msg;
                }
            }else{
                $msg['info'] = '删除失败';
                return $msg;
            }
        }catch(\Exception $e){
            return $this->fetch('index/noFound');
        }

    }

    public function newsDelAll(){
        try{
            $msg = [
                'status' => 0,
                'info' => ''
            ];
            if(request()->isPost()){
                $id = input('newsId/a');
                // 或者
                $res = NewsModel::destroy($id);
                if($res !== false) {
                    $msg['status'] = 1;
                    $msg['info'] = '删除成功';
                    return $msg;
                }else{
                    $msg['info'] = '删除失败';
                    return $msg;
                }
            }else{
                $msg['info'] = '删除失败';
                return $msg;
            }
        }catch(\Exception $e){
            return $this->fetch('index/noFound');
        }

    }

    public function newsIsShow(){
        try{
            $msg = [
                'status' => 0,
                'info' => ''
            ];
            if(request()->isPost()){
                $id = input('newsId');
                $isShow = input('isShow');
                $res = NewsModel::where('id', $id)
                    ->update(['isShow' => $isShow]);
                if($res !== false) {
                    $msg['status'] = 1;
                    $msg['info'] = '展示状态修改成功!';
                    return $msg;
                }else{
                    $msg['info'] = '展示状态修改失败!';
                    return $msg;
                }
            }else{
                $msg['info'] = '展示状态修改失败';
                return $msg;
            }
        }catch(\Exception $e){
            return $this->fetch('index/noFound');
        }

    }

    public function newsShenHe(){
        try{
            $msg = [
                'status' => 0,
                'info' => ''
            ];
            if(request()->isPost()){
                $newsId = input('newsId/a');

                $user = new NewsModel;
                $list = [];
                foreach ($newsId as $id){
                    array_push($list,['id'=>$id, 'newsStatus'=>'1']);
                }
                //return $list;
                $res = $user->saveAll($list);
                if($res !== false) {
                    $msg['status'] = 1;
                    $msg['info'] = '审核成功';
                    return $msg;
                }else{
                    $msg['info'] = '审核失败';
                    return $msg;
                }
            }else{
                $msg['info'] = '审核失败';
                return $msg;
            }
        }catch(\Exception $e){
            return $this->fetch('index/noFound');
        }

    }

    public function newsTuijian(){
        try{
            $msg = [
                'status' => 0,
                'info' => ''
            ];
            if(request()->isPost()){
                $id = input('newsId');
                $tuijian = input('tuijian');
                $res = NewsModel::where('id', $id)
                    ->update(['tuijian' => $tuijian]);
                if($res !== false) {
                    $msg['status'] = 1;
                    $msg['info'] = '推荐成功';
                    return $msg;
                }else{
                    $msg['info'] = '推荐失败';
                    return $msg;
                }
            }else{
                $msg['info'] = '推荐失败';
                return $msg;
            }
        }catch(\Exception $e){
            return $this->fetch('index/noFound');
        }

    }

    private function GetTree($arr,$pid = 0 ,$step = 0){
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

    public function uploadImage(Request $request)
    {
    //thinkphp5的框架，如果是原生的，用$_FiLES['file']获取到图片，
        $file 	= $request->file('file');
        $info 	= $file->move(ROOT_PATH . 'public' . DS . 'static'. DS . 'uploads');
        if($info){
            $name_path =str_replace('\\',"/",$info->getSaveName());
            $result['data']["src"] = "/public/static/uploads/".$name_path;
            $url 	= $info->getSaveName();
            //图片上传成功后，组好json格式，返回给前端
            $arr   = array(
                'code' => 0,
                'message'=>'',
                'data' =>array(
                    'src' => "/public/static/uploads/".$name_path
                ),
            );
        }

        echo json_encode($arr);

    }

}