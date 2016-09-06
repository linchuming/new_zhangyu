<?php
/**
 * Created by PhpStorm.
 * User: cmlin
 * Date: 2016/9/2
 * Time: 17:15
 */
namespace App\Service;

use App\Models\Join;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Mail;
use DB;
use App\Jobs\SendJoinEmail;
class JoinService
{
    use DispatchesJobs;
    public function addJoin($input)
    {
        //DB::beginTransaction();
        $join = new Join();
        $check = Tools::getRandChar(16);
        $ins = [
            'Fstu_id' => $input['stu_id'],
            'Fname' => $input['name'],
            'Fphone' => $input['phone'],
            'Fcheck' => $check,
        ];
        try {
            $join->insert($ins);
            $this->sendJoinEmail($input['stu_id'], $input['name'], $check);

        }catch (\Exception $e) {
            //DB::rollBack();
        }
        //DB::commit();
        return $check;
    }

    public function addJoin2($input)
    {
        //DB::beginTransaction();
        $join = new Join();
        $check = Tools::getRandChar(16);
        $ins = [
            'Fstu_id' => $input['stu_id'],
            'Fname' => $input['name'],
            'Fphone' => $input['phone'],
            'Fcheck' => $check,
        ];
        //$join->insert($ins);
        //$this->sendJoinMail($input['stu_id'], $input['name'], $check);
        try {
//            $join->insert($ins);
//            $this->sendJoinMail($input['stu_id'], $input['name'], $check);

        }catch (\Exception $e) {
            //DB::rollBack();
        }
        //DB::commit();
        return $check;
    }

    public function sendJoinMail($stuId, $stuName, $check)
    {
        $toMail = $stuId. '@fudan.edu.cn';
        $data = [
            'email' => $toMail,
            'name' => $stuName,
            'stuId' => $stuId,
            'stuName' => $stuName,
            'check' => $check,
        ];
//        var_dump($data);
        Mail::send('email.join', $data, function($message) use($data) {
            $message->to(
                $data['email'],
                $data['name']
            )->subject('欢迎报名张江学生活动中心，请尽快完善您的个人资料！');
        });
    }

    public function sendJoinEmail($stuId, $stuName, $check)
    {
        //分配异步任务
        $this->dispatch(new SendJoinEmail($stuId, $stuName, $check));
    }

    public function getJoinInfo($stuId, $check)
    {
        $join = new Join();
        $res = $join->select()
            ->where('Fstu_id', $stuId)
            ->where('Fcheck', $check)
            ->first();
        if(empty($res)) {
            return false;
        } else {
            return $res->toArray();
        }
    }

    public function updateJoinInfo($input)
    {
        $join = new Join;

        $data = [
            'Fphone' => $input['phone'],
            'Fnation' => $input['nation'],
            'Flocation' => $input['location'],
            'Fmajor' => $input['major'],
            'Ffeature' => $input['feature'],
            'Fexperience' => $input['experience'],
            'Fdevelopment' => $input['development'],
            'Fadvice' => $input['advice'],
            'Fmodify_time' => date('Y-m-d H:i:s'),
        ];

        $join->where('Fstu_id', $input['stuId'])
            ->where('Fcheck', $input['check'])
            ->update($data);

        return true;
    }

    public function queryJoinInfo($input)
    {
        if(isset($input['stuId']) && isset($input['check'])) {
            //$res = $this->getJoinInfo($input['stuId'], $input['check']);
        }
        $join = new Join();
        $keys = [
            'Fstu_id',
            'Fname',
            'Fphone',
            'Fcheck',
            'Fmajor',
            'Fadd_time',
        ];
        $sql = $join->select($keys);
        $res = $sql->get()->toArray();
        if(isset($input['unique']) && $input['unique'] == 1) {
            //智能去重
            $count = 0;
            $data = [];
            foreach ($res as $row) {
                if(isset($data[$row['Fstu_id']]) && !empty($row['Fmajor'])) {
                    $data[$row['Fstu_id']] = $row;
                } else if(!isset($data[$row['Fstu_id']])) {
                    $data[$row['Fstu_id']] = $row;
                    $count++;
                }
            }
            $res = $data;
        } else {
            $count = $sql->count();
        }
        $result['data'] = $res;
        $result['total'] = $count;
        return $result;
    }


}