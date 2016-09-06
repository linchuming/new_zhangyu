<?php
/**
 * Created by PhpStorm.
 * User: lcm
 * Date: 16-8-23
 * Time: 下午5:59
 */
namespace App\Http\Controllers\Join;

use App\Http\Controllers\Controller;
use App\Models\Join;
use App\Service\JoinService;
use Request;
use Mail;
class JoinController extends Controller {
    public function index()
    {
        return view('join.index');
    }

    public function enter()
    {
        $input = Request::all();
        $this->validatorCheck($input,[
            'stuId' => 'required',
            'check' => 'required',
        ]);
        $join = new JoinService();
        $info = $join->getJoinInfo($input['stuId'], $input['check']);
        if($info == false) {
            throw new \Exception('查无此报名信息');
        }
        return view('join.enter',[
            'stuId' => $input['stuId'],
            'check' => $input['check'],
        ]);
    }

    public function join()
    {
        $input = Request::all();
        $this->validatorCheck($input, [
            'stu_id' => 'required',
            'name' => 'required',
            'phone' => 'required',
        ]);
        $join = new JoinService();
        $check = $join->addJoin($input);
        return [
            'stuId' => $input['stu_id'],
            'check' => $check,
        ];
    }

    public function join2()
    {
        $input = Request::all();
        $this->validatorCheck($input, [
            'stu_id' => 'required',
            'name' => 'required',
            'phone' => 'required',
        ]);
        $join = new JoinService();
        $check = $join->addJoin2($input);
        return [
            'stuId' => $input['stu_id'],
            'check' => $check,
        ];
    }

    public function joinSuccess()
    {
        $input = Request::all();
        $this->validatorCheck($input,[
            'stuId' => 'required',
            'check' => 'required',
        ]);
        return view('join.success',[
            'mail' => $input['stuId'] .'@fudan.edu.cn',
            'stuId' => $input['stuId'],
            'check' => $input['check']
        ]);
    }

    public function getStuInfo()
    {
        $input = Request::all();
        $this->validatorCheck($input,[
            'stuId' => 'required',
            'check' => 'required',
        ]);
        $join = new JoinService();
        $info = $join->getJoinInfo($input['stuId'], $input['check']);
        if($info == false) {
            throw new \Exception('查无此报名信息');
        }
        return $info;
    }

    public function updateStuInfo()
    {
        $input = Request::all();
        $this->validatorCheck($input,[
            'stuId' => 'required',
            'check' => 'required',
//            'phone' => 'required',
//            'nation' => 'required',
//            'location' => 'required',
//            'major' => 'required',
//            'feature' => 'required',
//            'experience' => 'required',
//            'development' => 'required',
//            'advice' => 'required',
        ]);
        $this->_checkInfo($input);
        $join = new JoinService();
        if($join->updateJoinInfo($input)) {
            return ['time' => date('Y-m-d H:i:s')];
        }
    }

    private function _checkInfo(&$input)
    {
        $input['phone'] = $this->getParam($input['phone']);
        $input['nation'] = $this->getParam($input['nation']);
        $input['location'] = $this->getParam($input['location']);
        $input['major'] = $this->getParam($input['major']);
        $input['feature'] = $this->getParam($input['feature']);
        $input['experience'] = $this->getParam($input['experience']);
        $input['development'] = $this->getParam($input['development']);
        $input['advice'] = $this->getParam($input['advice']);
    }

    public function joinList()
    {
        return view('join.list');
    }

    public function queryJoinList()
    {
        $input = Request::all();
        $join = new JoinService();
        $result = $join->queryJoinInfo($input);
        return $result;
    }

    public function joinlook()
    {
        $input = Request::all();
        $this->validatorCheck($input,[
            'stuId' => 'required',
            'check' => 'required',
        ]);
        $join = new JoinService();
        $info = $join->getJoinInfo($input['stuId'], $input['check']);
        if($info == false) {
            throw new \Exception('查无此报名信息');
        }
        return view('join.look',
            $info
        );
    }
}