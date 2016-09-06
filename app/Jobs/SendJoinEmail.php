<?php
/**
 * Created by PhpStorm.
 * User: cmlin
 * Date: 2016/9/3
 * Time: 12:19
 */
namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mail;


class SendJoinEmail extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $stuId;
    protected $stuName;
    protected $check;
    public function __construct($stuId, $stuName, $check)
    {
        $this->stuId = $stuId;
        $this->stuName = $stuName;
        $this->check = $check;
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

        Mail::send('email.join', $data, function($message) use($data) {
            $message->to(
                $data['email'],
                $data['name']
            )->subject('欢迎报名张江学生活动中心，请尽快完善您的个人资料！');
        });
    }

    public function handle()
    {
        if($this->attempts() > 3) {
            //尝试3次后，发送失败，记录LOG
            Log::error("发送报名邮件失败，报名信息为:$this->stuId;$this->stuName;$this->check");
        } else {
            $this->sendJoinMail(
                $this->stuId,
                $this->stuName,
                $this->check
            );
        }
    }
}