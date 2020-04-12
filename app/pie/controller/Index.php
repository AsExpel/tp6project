<?php
declare (strict_types = 1);

namespace app\pie\controller;
use think\facade\Request;
use think\facade\View;
use app\admin\model\buglist;

class Index
{
    public function index()
    {

        return View::fetch();
    }
    public function get_all_bug(){
//        $this->dateRandom();
//        print_r('in');

        $ans=buglist::get_all();
//        var_dump($ans);
        return $ans;
    }


}
