<?php
namespace app\index\controller;
use think\Controller;
use think\db;
class Index extends Controller
{
    public function index()
    {
      //db::find()
      return $this->fetch("rege");
     }

    public function login(){//http://mdj.cn/index/Index/login
        return $this->fetch("login");
    }

    public function autoRegister(){//http://mdj.cn/index/Index/autoRegister
     
    }
}
