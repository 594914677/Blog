<?php
/**
 * Created by PhpStorm.
 * User: LiQi
 * Date: 2018/2/9
 * Time: 14:33
 */
namespace app\admin\controller;
use think\Controller;
use app\admin\model\Carousel as CarouselModel;
use think\Db;
use think\Request;

class Carousel extends Controller{

    public function carouselAdd(){
        try{
            if(request()->isPost()){
                $msg = [
                    'status' => 0,
                    'info' => ''
                ];
                $user = new CarouselModel;
                $user->data([
                                'name' => input('name'),
                                'img' => input('upload_img'),
                                'url' => input('url'),
                                'isShow' => input('isShow'),
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
        }catch(\Exception $e){
            return $this->fetch('index/noFound');
        }
        return $this->fetch();
    }

    public function carouselUp(){
        try{
            if(request()->isPost()){
                $msg = [
                    'status' => 0,
                    'info' => ''
                ];
                $user = new CarouselModel;
                $res =  $user->where('id', input('carouselId'))
                    ->update([
                                 'name' => input('name'),
                                 'img' => input('img'),
                                 'url' => input('url'),
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
                $result = Db::table('admin_carousel')->where("id = $id")->select();
                $this->assign('list',$result);
                return $this->fetch();
            }
        }catch(\Exception $e){
            return $this->fetch('index/noFound');
        }
    }

    public function carouselDel(){
        try{
            $msg = [
                'status' => 0,
                'info' => ''
            ];
            if(request()->isPost()){
                $id = input('carouselId');

                $carousel = Db::table('admin_carousel')->where('id',$id)->find();

                $user = CarouselModel::get($id);
                $res = $user->delete();
                if($res !== false) {
                    unlink(ROOT_PATH.$carousel['img']);
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

    public function carouselDelAll(){
        try{
            $msg = [
                'status' => 0,
                'info' => ''
            ];
            if(request()->isPost()){
                $id = input('carouselId/a');
                // 或者
                $res = CarouselModel::destroy($id);
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

    public function carouselIsShow(){
        try{
            $msg = [
                'status' => 0,
                'info' => ''
            ];
            if(request()->isPost()){
                $id = input('carouselId');
                $isShow = input('isShow');
                $res = CarouselModel::where('id', $id)
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

    public function uploadImage(Request $request)
    {
        //thinkphp5的框架，如果是原生的，用$_FiLES['file']获取到图片，
        $file 	= $request->file('file');
        $info 	= $file->move(ROOT_PATH . 'public' . DS . 'static'. DS . 'image'. DS . 'index'. DS . 'banner');
        if($info){
            $name_path =str_replace('\\',"/",$info->getSaveName());
            $result['data']["src"] = "/public/static/image/index/banner/".$name_path;
            $url 	= $info->getSaveName();
            //图片上传成功后，组好json格式，返回给前端
            $arr   = array(
                'code' => 0,
                'message'=>'',
                'data' =>array(
                    'src' => "/public/static/image/index/banner/".$name_path
                ),
            );
        }

        echo json_encode($arr);

    }

}