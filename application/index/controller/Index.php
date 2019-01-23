<?php
namespace app\index\controller;
use think\Controller;
use think\db;
class Index extends Controller
{
    public function _initialize()
    {
        // 判断用户是否登陆
        $user = isset($_SESSION['name']) ? $_SESSION['name'] :null;
        if(!$user){
           // $this->success('未登录，请登录',url('index/index'),3);
        }
    }

    public function index()//http://mdj.cn/index/Index/index
   {
      return $this->fetch("index");
    }

    public function login(){//http://mdj.cn/index/Index/login
        return $this->fetch("login");
    }

    public function autoRegister(){//http://mdj.cn/index/Index/autoRegister
     
    }
}
