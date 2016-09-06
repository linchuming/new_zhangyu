<!doctype html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
</head>
<body>
<p>
    亲爱的 {{ $stuName }} 同学, <br>
    感谢您报名参加新学期复旦大学张江学生活动中心的招新，请尽快完善您的个人资料，<br>
    面试通知我们会在面试前通过邮件以及短信通知~<br>
     <a href="http://zhangyu.cmlin.me/join/enter?stuId={{$stuId}}&check={{$check }}" target="_blank">点击这填写您的个人资料</a> <br>
    如果无法进入，请复制下面的链接地址到浏览器上进行填写：<br>
    http://fduzhangyu.com/join/enter?stuId={{$stuId}}&check={{$check }}
</p>
</body>
</html>