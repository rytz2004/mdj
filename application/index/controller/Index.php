<?php
namespace app\index\controller;
use think\Controller;

class Index extends Controller
{
    public function index()
    {
      return $this->fetch("rege");
     }

    public function register(){//http://mdj.cn/index/Index/register
        echo "register";
    }
}
