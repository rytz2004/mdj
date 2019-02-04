<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
class Index extends Controller
{
    public function _initialize()
    {
        $user = isset($_SESSION['name']) ? $_SESSION['name'] :null;
        if(!$user){
           // $this->success('未登录，请登录',url('index/index'),3);
        }
    }

    public function index()//http://mdj.cn/index/Index/index  http://mdj.com/index/Index/index
   {
       // 判断用户是否登陆
       return $this->fetch("index");
    }

    public function login(){//http://mdj.cn/index/Index/login
        return $this->fetch("login");
    }

    public function autoRegister(){//http://mdj.cn/index/Index/autoRegister
     
    }
}
