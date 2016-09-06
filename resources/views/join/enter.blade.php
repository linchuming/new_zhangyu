<!DOCTYPE html>
<!--[if lte IE 8]>              <html class="ie8 no-js" lang="en">     <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <html class="not-ie no-js" lang="en">  <!--<![endif]-->
<head>

    <!-- Basic Page Needs
  ================================================== -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <title>张江学生活动中心 | 报名</title>

    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Favicons
    ================================================== -->
    <link rel="shortcut icon" href="../images/favicon.png">

    <!-- Mobile Specific Metas
  ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- CSS
  ================================================== -->
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="../css/grid.css" />
    <link rel="stylesheet" href="../css/layout.css" />
    <link rel="stylesheet" href="../css/fontello.css" />
    <link rel="stylesheet" href="../css/animation.css" />

    <link rel="stylesheet" href="../css/tooltipster.css" />
    <link rel="stylesheet" href="../js/fancybox/jquery.fancybox.css" />

    <!-- HTML5 Shiv
    ================================================== -->
    <script src="../js/jquery.modernizr.js"></script>

</head>
<body>
<div class="container">

    <div class="row">
        <div class="col-xs-12">
            <hgroup class="section-title align-center">
                <h1>报名信息填写</h1>
                <p>感谢您报名加入张江学生活动中心，请尽快完善您的报名资料，点击保存即可保存信息。
                    <br>在面试前几天我们会有工作人员向您的学生邮箱或者手机发送面试时间与地点，请注意查收~
                    <br>如果有其他问题，欢迎您咨询我们的工作人员，或者发送邮件至fduzhangyu@126.com或者联系技术cmlin<13307130255@fudan.edu.cn>
                    <br>PS:记得随时保存哦 ^0^~
                </p>
            </hgroup>
        </div>
    </div><!--/ .row-->

    <div class="col-md-offset-3 col-md-6">

        <form class="contact-form" method="post" action="/" id="join_from">
            <p class="input-block">
                学号：
                <input type="text" name="stu_id" id="stu_id" placeholder="学号 *" readonly="true"/>
            </p>
            <p class="input-block">
                姓名：
                <input type="text" name="name" id="name" placeholder="姓名 *" readonly="true" />
            </p>
            <p class="input-block">
                手机号码：
                <input type="text" name="phone" id="phone" placeholder="手机号码 *" />
            </p>
            <p class="input-block">
                民族：
                <input type="text" name="nation" id="nation" placeholder="民族（如汉族、回族）*" />
            </p>
            <p class="input-block">
                生源地：
                <input type="text" name="location" id="location" placeholder="生源地（如上海、福建）*" />
            </p>
            <p class="input-block">
                专业：
                <input type="text" name="major" id="major" placeholder="专业 *" />
            </p>
            <p class="input-block">
                性格与特长：
                <textarea name="feature" id="feature" placeholder="手脚特长也是可以的哦^0^"></textarea>
            </p>
            <p class="input-block">
                主要学生工作经历：
                <textarea name="experience" id="experience" placeholder="具体负责哪些工作"></textarea>
            </p>
            <p class="input-block">
                你的期待与发展：
                <textarea name="development" id="development" placeholder="你希望在张娱收获什么，是否希望在张娱有进一步的发展（例如中高层）"></textarea>
            </p>
            <p class="input-block">
                你对我们的看法与建议：
                <textarea name="advice" id="advice" placeholder="你觉得张娱是一个什么样的学生组织？你认为张娱有什么可以改进的地方（例如推广手段、品牌活动，新增业务）"></textarea>
            </p>
            <p class="input-block">
                <p id="result"></p>
                <button class="button turquoise middle" type="button" id="submit">保存</button>
            </p>

        </form><!--/ .contact-form-->

    </div>
</div>
<input type="hidden" id="stuId" value="{{$stuId}}">
<input type="hidden" id="check" value="{{$check}}">
<script src="../js/jquery.min.js"></script>
<script>
    var stuId = '';
    var check = '';
    var changeFlag=false;
    $(document).ready(function() {
        stuId = $('#stuId').val();
        check = $('#check').val();

        updateInfo(stuId, check);

        $("p").on("input",function() {
            changeFlag = true
        })
        $(window).bind('beforeunload',function(){
            if(changeFlag) {
                return '您输入的内容尚未保存，确定离开此页面吗？';
            }
        });

        $('#submit').click(function() {
            submitInfo(stuId, check)
        })
    })

    function updateInfo(stuId, check)
    {
        $.ajax({
            type: 'post',
            url: '/join/getStuInfo',
            data:{
                stuId: stuId,
                check: check
            },
            success: function(data){
                $('#stu_id').val(data.Fstu_id)
                $('#name').val(data.Fname)
                $('#phone').val(data.Fphone)
                $('#nation').val(data.Fnation)
                $('#location').val(data.Flocation)
                $('#major').val(data.Fmajor)
                $('#feature').val(data.Ffeature)
                $('#experience').val(data.Fexperience)
                $('#development').val(data.Fdevelopment)
                $('#advice').val(data.Fadvice)
            }
        })
    }

    function submitInfo(stuId, check)
    {
        $.ajax({
            type: 'post',
            url: '/join/updateStuInfo',
            data:{
                stuId: stuId,
                check: check,
                phone: $('#phone').val(),
                nation: $('#nation').val(),
                major: $('#major').val(),
                location: $('#location').val(),
                feature: $('#feature').val(),
                experience: $('#experience').val(),
                development: $('#development').val(),
                advice: $('#advice').val()
            },
            success: function(data) {
                changeFlag = false;
                $('#result').html('保存成功，保存时间：' + data.time);
            },
            error: function() {
                $('#result').html('保存失败，请联系工作人员');
            }
        })
    }


</script>
</body>
