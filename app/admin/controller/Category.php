<?php
/**
 * Created by PhpStorm.
 * User: LiQi
 * Date: 2018/1/16
 * Time: 11:10
 */
namespace app\admin\controller;
use think\Controller;
use app\admin\model\Category as CategoryModel;
use think\Db;
use think\Request;

class Category extends Controller{

    public function categoryAdd(){
        try{
            $msg = [
                'status' => 0,
                'info' => ''
            ];
            if(request()->isPost()){
                $name = input('name');
                $pName = input('pName');
                $links = input('links');
                $isShow = input('isShow');

                $user = new CategoryModel;
                $user->data([
                                'name' => $name,
                                'links' => $links,
                                'pid' => $pName,
                                'isShow' => $isShow,
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

    public function categoryUp(){
        try{
            if(request()->isPost()){
                $msg = [
                    'status' => 0,
                    'info' => ''
                ];
                $user = new CategoryModel;
                $res =  $user->where('id', input('cid'))
                    ->update([
                                 'name' => input('name'),
                                 'links' => input('links'),
                                 'pid' => input('pName'),
                                 'isShow' => input('isShow'),
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
                $list = Db::table('admin_category')->where("id = $id")->select();

                foreach ($list as $key=>$val){
                    $pid = $val['pid'];
                    $name = Db::table('admin_category')->where("id = $pid")->field('name')->find();
                    $list[$key]['pname'] = $name;
                }
                $this->assign('list',$list);

                $result = Db::table('admin_category')->select();
                $newarr = $this->GetTree($result);

                $this->assign('category',$newarr);

                return $this->fetch();
            }
        }catch(\Exception $e){
            return $this->fetch('index/noFound');
        }

    }

    public function categoryDel(){
        try{
            $msg = [
                'status' => 0,
                'info' => ''
            ];
            if(request()->isPost()){
                $id = input('cid');
                $list = Db::table('admin_category')->where("id = $id")->find();
                if($list['pid'] == 0){
                    $msg['info'] = '该下面还有子项，删除失败！！！';
                    return $msg;
                }
                $user = CategoryModel::get($id);
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

    public function categoryDelAll(){
        try{
            $msg = [
                'status' => 0,
                'info' => ''
            ];
            if(request()->isPost()){
                $id = input('cid/a');
                // 或者
                $res = CategoryModel::destroy($id);
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

    public function categoryIsShow(){
        try{
            $msg = [
                'status' => 0,
                'info' => ''
            ];
            if(request()->isPost()){
                $id = input('newsId');
                $isShow = input('isShow');
                $res = CategoryModel::where('id', $id)
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

}