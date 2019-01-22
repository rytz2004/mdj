<?php
namespace app\index\controller;
use think\Controller;

class Index extends Controller
{
    public function index()
    {
      return $this->fetch("rege");
     }

    public function login(){//http://mdj.cn/index/Index/login
        return $this->fetch("login");
    }
}
