<?php
declare (strict_types = 1);

namespace app\admin\controller;

use app\admin\model\user;
use think\Console;
use think\facade\Db;
use think\facade\Log;
use think\facade\Request;
use think\facade\View;

class Index
{
    public function index()
    {

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
    public function get_all_user(){
        $ans=user::get_all();
        return $ans;
    }
    public function get_id_to_name(Request $request) {
        $ans=user::search_id_user((int) $_REQUEST["id"])
            ->map(
                function (user $user){
                    unset($user["password"]);
                    return $user;
                }
            );

        return json_encode($ans, JSON_UNESCAPED_UNICODE);
    }
    public function get_name_to_id(Request $request){
        $ans=user::search_name_user($_POST["name"])
            ->map(
                function (user $user){
                    unset($user["password"]);
                    return $user;
                }
            );
        return $ans;
    }
    public function get_test(){//http://www.guangxiangtest.top/index.php/admin/index/get_test
        $data = array(
            'name' => 'red_panda',
            'address' => 'China',
        );
        $code = 200;
        $msg = 'ok';
        return json_encode($code,JSON_UNESCAPED_UNICODE);
    }
    public function dateRandom($type){
        if($type=='user'){
            $first=array('张','王','李','赵','金','艾','单','龚','钱','周','吴','郑','孔','曺','严','华','吕','徐','何');
            $middle=array('芳','军','建','明','辉','芬','红','丽','功');
            $last=array('明','芳','华','民','敏','丽','辰','楷','龙','雪','凡','锋','芝','');
            $email1=array('1231wqad','87g8yg3','67899kjo','57812312');
            $email2=array('asd','ijbi','jhihjb','jkl','zxc','bnm');
            $email3=array('@163.com','@137.com','@gmail.com','@173.com','@qq.com');
            $passwd1=array('1234','5678','147','258');
            for($i=15;$i<100;$i++){
                $name=$first[random_int(1,18)] . $middle[random_int(0,8)] . $last[random_int(1,13)];
                $email=$email1[random_int(0,3)] . $email2[random_int(0,5)] . $email3[random_int(0,4)];
                $data = ['user_id' => $i, 'name' =>$name,'age'=>random_int(18,75),'email'=>$email,'password'=>$passwd1[random_int(0,3)]];
                $result = Db::name('user')->insert($data);
//            console.log($result);
            }
            return '成功添加了'.$i.'条记录';
        } elseif ($type=='inventory'){
            $first=array('张','王','李','赵','金','艾','单','龚','钱','周','吴','郑','孔','曺','严','华','吕','徐','何');
            $middle=array('芳','军','建','明','辉','芬','红','丽','功');
            $last=array('明','芳','华','民','敏','丽','辰','楷','龙','雪','凡','锋','芝','');
            $norm_array=array('箱','个','盒','桶','件','提','打');
            $output_array=array('克','个','毫升');
            for($i=100;$i<110;$i++){
                $name=$first[random_int(0,count($first)-1)] . $middle[random_int(0,count($middle)-1)] . $last[random_int(0,count($last)-1)];
                $norm=$norm_array[random_int(0,count($norm_array)-1)];
                $data = ['item_id' => $i, 'item_name' =>'测试玩意儿'.$i,'item_input_price'=>random_int(1,1000),
                    'item_input_norm'=>$norm,'item_convert_norm'=>random_int(1,90)*random_int(1,20)*5,'item_output_norm'=>$output_array[random_int(0,count($output_array)-1)]];
                $result = Db::name('inventory')->insert($data);
//            console.log($result);
            }
            return '成功添加了'.$i.'条记录';
        }

    }
}
