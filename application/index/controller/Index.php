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
            if(empty($account) || empty($password))
            {
                $param['code'] = -1;
                $param['msg'] = "参数错误，请输入正确的账号与密码";
                return json_encode($param,true);
            }

            $user_info = Db::table('mdj_user')->where('account','=',$account)->find();
            if(empty($user_info)){
                $param['code'] = -2;
                $param['msg'] = "账号不存在";
                return json_encode($param,true);
            }

            return json_encode($param,true);
        }

        return $this->fetch("login");
    }

    public function registry(){
        return $this->fetch("rege");
    }

    public function autoRegister(){//http://mdj.com/index/Index/autoRegister
     
    }
}
