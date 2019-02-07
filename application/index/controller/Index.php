<?php

namespace app\index\controller;
use think\Controller;
use think\Request;
use think\Db;
class Index extends Controller
{
    public function _initialize()
    {
        $user = isset($_SESSION['name']) ? $_SESSION['name'] :null;
        if(!$user){
           // $this->success('未登录，请登录',url('Index/index'),3);
        }
    }

    public function index()//http://mdj.com/index/Index/index  http://mdj.com/index/Index/index
   {
       // 判断用户是否登陆
       return $this->fetch("index");
    }

    public function login(){//http://mdj.com/index/Index/login
        $param['code'] = 200;
        $param['msg'] = "成功";

        if(Request::instance()->isPost())
        {
            $account = input('account');
            $password = input('password');
            //$account = $_POST['account'];
            //$password = $_POST['password'];
            if(empty($account) || empty($password))
            {
                $param['code'] = -1;
                $param['msg'] = "参数错误，请输入正确的账号与密码";
                return json_encode($param,true);
            }

            $user_info = Db::table('mdj_user')->where('user_name','=',$account)->find();
            if(empty($user_info)){
                $param['code'] = -2;
                $param['msg'] = "账号不存在";
                return json_encode($param,true);
            }
            if($user_info['password'] != md5($password)){
                $param['code'] = -2;
                $param['msg'] = "密码错误";
                return json_encode($param,true);
            }
            return json_encode($param,true);
        }

        return $this->fetch("login");
    }

    public function registry(){

        $param['code'] = 200;
        $param['msg'] = "成功";

        if(Request::instance()->isPost())
        {
            $account = input('account');
            $password = input('password');

            if(empty($account) || empty($password))
            {
                $param['code'] = -1;
                $param['msg'] = "参数错误，请输入正确的账号与密码";
                return json_encode($param,true);
            }

            $user_info = Db::table('mdj_user')->where('user_name','=',$account)->find();
            if(!empty($user_info)){
                $param['code'] = -2;
                $param['msg'] = "账号已经存在";
                return json_encode($param,true);
            }

            $info['user_name'] = $account;
            $info['password'] = md5($password);
            $info['login_times'] = time();
            $info['last_login_ip'] = $_SERVER['REMOTE_ADDR'];
            $info['last_login_time'] = time();
            $info['real_name'] =$account;
            $info['status'] =1;
            $info['role_id'] =1;
            $user_info = Db::table('mdj_user')->insert($info);

            if(empty($user_info)){
                $param['code'] = -2;
                $param['msg'] = "账号创建失败，请联系管理员";
                return json_encode($param,true);
            }

            return json_encode($param,true);
        }

        return $this->fetch("rege");
    }

    public function upload(){
        $file = $_FILES['file'];//得到传输的数据

        //得到文件名称
        $name = $file['name'];
        $type = strtolower(substr($name,strrpos($name,'.')+1)); //得到文件类型，并且都转化成小写
        $allow_type = array('jpg','jpeg','gif','png');  //定义允许上传的类型
        //判断文件类型是否被允许上传
        if(!in_array($type, $allow_type)){
            //如果不被允许，则直接停止程序运行
            return ;
        }
       //判断是否是通过HTTP POST上传的
        if(!is_uploaded_file($file['tmp_name'])){
            //如果不是通过HTTP POST上传的
            return ;
        }
        $upload_path = $_SERVER['DOCUMENT_ROOT']."/static/images/";  //上传文件的存放路径

        //开始移动文件到相应的文件夹
        if(move_uploaded_file($file['tmp_name'],$upload_path.$file['name'])){
            $param['code'] = 200;
            $param['url'] = $upload_path.$file['name'];
            $param['msg'] = "成功";
            return json_encode($param,true);
        }else{
            $param['code'] = -1;
            $param['url'] = $upload_path.$file['name'];
            $param['msg'] = "失败";
            return json_encode($param,true);
        }
    }

    public function autoRegister(){//http://mdj.com/index/Index/autoRegister
     
    }
}
