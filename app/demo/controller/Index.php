<?php
declare (strict_types = 1);

namespace app\demo\controller;
use think\facade\View;

class Index
{
    public function index()
    {
//        $view = new View();

//        $view->assign('title', '视图测试');
//        $view->assign('content', '这是一个视图类的示例');
//
//        $view->display('template.php');
        return View::fetch('index');
    }
}


