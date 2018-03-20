<?php
/**
 * Created by PhpStorm.
 * User: LiQi
 * Date: 2018/1/12
 * Time: 14:31
 */
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\Request;

class Adminuser extends Controller{

    public function changePwd(){
        try{
            if(request()->isPost()){
                $msg = [
                    'status' => 0,
                    'info' => '',
                ];
                $id = input('id');
                $name = input('name');
                $oldPwd = input('oldPwd');
                $newPwd = input('newPwd');
                $confirmPwd = input('confirmPwd');
                if($newPwd !== $confirmPwd){
                    $msg['info'] = "修改失败";
                    return $msg;
                }
                $data = [
                    'id'=>$id,
                    'name'=>$name,
                    'password'=>md5($oldPwd),
                ];
                //查询旧密码是否正确
                $request = Db::table('admin_adminuser')->where($data)->select();

                if (empty($request)){
                    $msg['info'] = "修改失败";
                    return $msg;
                }
                //更新密码
                $uppwd = Db::table('admin_adminuser')->where('id', $id)->update(['password' => md5($newPwd)]);
                if(!$uppwd){
                    $msg['info'] = "修改失败";
                    return $msg;
                }else{
                    $msg = [
                        'status' => 1,
                        'info' => '修改成功',
                    ];
                    return $msg;
                }
            }else{
                return $this->fetch('login');
            }
        }catch(\Exception $e){
            return $this->fetch('index/noFound');
        }
    }
}