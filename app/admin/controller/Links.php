<?php
/**
 * Created by PhpStorm.
 * User: LiQi
 * Date: 2018/1/2
 * Time: 10:16
 */
namespace app\admin\controller;
use think\Controller;
use app\admin\model\Links as LinksModel;
use think\Db;
use think\Request;

class Links extends Controller{

    public function newsList(){
        return $this->fetch();
    }


    public function linksAdd(){
        try{
            if(request()->isPost()){
                $msg = [
                    'status' => 0,
                    'info' => ''
                ];
                $user = new LinksModel;
                $user->data([
                                'linksName' => input('linksName'),
                                'linksUrl' => input('linksUrl'),
                                'masterEmail' => input('masterEmail'),
                                'linksDesc' => input('linksDesc'),
                                'linksTime' => input('linksTime'),
                                'isShow' => input('isShow')
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
            }
            return $this->fetch();
        }catch(\Exception $e){
            return $this->fetch('index/noFound');
        }

    }

    public function linksUp(){
        try{
            if(request()->isPost()){
                $msg = [
                    'status' => 0,
                    'info' => ''
                ];
                $user = new LinksModel;
                $res =  $user->where('id', input('newsId'))
                    ->update([
                                 'linksName' => input('linksName'),
                                 'linksUrl' => input('linksUrl'),
                                 'masterEmail' => input('masterEmail'),
                                 'linksDesc' => input('linksDesc'),
                                 'linksTime' => input('linksTime'),
                                 'isShow' => input('isShow')
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
                $result = Db::table('admin_links')->where("id = $id")->select();
                $this->assign('list',$result);
                return $this->fetch();
            }
        }catch(\Exception $e){
            return $this->fetch('index/noFound');
        }

    }

    public function linksDel(){
        try{
            $msg = [
                'status' => 0,
                'info' => ''
            ];
            if(request()->isPost()){
                $id = input('newsId');
                $user = LinksModel::get($id);
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

    public function linksDelAll(){
        try{
            $msg = [
                'status' => 0,
                'info' => ''
            ];
            if(request()->isPost()){
                $id = input('newsId/a');
                // 或者
                $res = LinksModel::destroy($id);
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

    public function linksIsShow(){
        try{
            $msg = [
                'status' => 0,
                'info' => ''
            ];
            if(request()->isPost()){
                $id = input('newsId');
                $isShow = input('isShow');
                $res = LinksModel::where('id', $id)
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

}