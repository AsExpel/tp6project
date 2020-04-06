<?php
declare (strict_types = 1);

namespace app\admin\controller;

use app\admin\model\buglist;
use think\Console;
use think\facade\Db;
use think\facade\Log;
use think\facade\Request;
use think\facade\View;

class Index
{
    public function index()
    {
//        $this->dateRandom();
        View::assign('test1','id搜索');

        View::assign('test2','name搜索');

        View::assign('index');

        return View::fetch('index');
        // 使用内置PHP模板引擎渲染模板输出
//        return View::engine('php')->fetch('Index');
//        return '您好！这是一个[admin]示例应用';
    }
    /**
     * @var \think\Request Request实例
     */
    protected $request;

    /**
     * 构造方法
     * @param Request $request Request对象
     * @access public
     */
    public function get_all_bug(){
        $this->dateRandom();
        $ans=buglist::get_all();
//        var_dump($ans);
        return $ans;
    }
    public function get_id_to_name(Request $request) {
        $ans=buglist::search_id_bug((int) $_REQUEST["id"])
            ->map(
                function (buglist $buglistselector){
                    unset($buglistselector["password"]);
                    return $buglistselector;
                }
            );

        return json_encode($ans, JSON_UNESCAPED_UNICODE);
    }
    public function get_name_to_id(Request $request){
        $ans=buglist::search_name_bug($_POST["name"])
            ->map(
                function (buglist $buglistselector){
                    unset($buglistselector["remarks"]);
                    return $buglistselector;
                }
            );
        return $ans;
    }
    public function get_test(){//http://http://localhost/tp6project/public/index.php/admin/index/get_test
        $data = array(
            'name' => 'red_panda',
            'address' => 'China',
        );
        $code = 200;
        $msg = 'ok';
        return json_encode($code,JSON_UNESCAPED_UNICODE);
    }
    public function dateRandom(){
//        echo ('in');
        $first=array('张','王','李','赵','金','艾','单','龚','钱','周','吴','郑','孔','曺','严','华','吕','徐','何');
        $middle=array('芳','军','集','建','明','辉','芬','红','丽','憨','功','');
        $last=array('明','芳','华','民','敏','憨','成','丽','辰','楷','龙','雪','凡','锋','芝','笑',);
        $tag1=array('1231wqad','87g8yg3','67899kjo','57812312');
        $tag2=array('asd','ijbi','jhihjb','jkl','zxc','bnm');
        //$email3=array('@163.com','@137.com','@gmail.com','@173.com','@qq.com');
        //$passwd1=array('1234','5678','147','258');
        $i=0;
        for($i=1;$i<10;$i++){
            $name=$first[random_int(1,18)] . $middle[random_int(0,8)] . $last[random_int(1,13)];
            $tag=$tag1[random_int(0,3)];// . $tag2[random_int(0,5)];
            $data = ['bug_id' => $i, 'bug_name' =>$name,'bug_submit_time'=>date("Ymdhi",time()),'bug_tag'=>$tag,'remarks'=>''];
            $result = Db::name('buglist')->insert($data);
            var_dump("in");
        }
//        echo '成功添加了'.$i.'条记录';

    }
}
