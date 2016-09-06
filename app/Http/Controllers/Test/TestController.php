<?php

namespace App\Http\Controllers\Test;

use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mockery\CountValidator\Exception;

class TestController extends Controller
{
    public function login(Request $request) {
        $user = $request->input('user',''); //获取表单user的数据,第二个参数为默认值(如果未指定就返回默认值)
        $url = $request->path(); //请求的uri
        $method = $request->method(); //请求的方法
        $input = $request->all(); //所有的输入数据
        $input = $request->only('user','password'); //获取指定的参数

        if($request->isMethod('post')) {

            $db = DB::connection('mysql'); //连接配置文件的mysql配置

            $users = $db->select('select * from t_user where userid = ? and password = ?',[$input['user'],$input['password']]);

            $users = $db->table('t_user')
                ->where('userid', '=' ,$input['user'])
                ->where('password', '=', $input['password'])->get();

            return var_dump($users[0]->name);
        }

    }

    public function check() {
        if($this->tableExist('snswin_log','order_log')) {
            echo "123";
        }
    }

    public function tableExist($database,$table) {
        $db = DB::connection('mysql');
        $res = $db->table('information_schema.tables')->select(['table_name'])
            ->where('table_schema',$database)
            ->where('table_name',$table)->get();
        return !(empty($res));
    }
}



