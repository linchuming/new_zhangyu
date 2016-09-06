<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../images/favicon.png">

    <title>报名简历查看 | {{$Fname}}</title>

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>

    <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>


<div class="container-fluid">
    <div class="row">
        <div class="col-sm-5 col-sm-offset-3 col-md-5 col-md-offset-3 main">
            <h1 class="sub-header">{{$Fname}}</h1>
            <div class="panel panel-default">
                <div class="panel-heading">基本信息</div>
                <div class="panel-body">
                    学号：{{$Fstu_id}}<br>
                    姓名：{{$Fname}}<br>
                    手机号码：{{$Fphone}}<br>
                    民族：{{$Fnation}}<br>
                    专业：{{$Fmajor}}<br>
                    生源地：{{$Flocation}}
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">性格与特长</div>
                <div class="panel-body">
                    {{$Ffeature}}
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">主要学生工作经历</div>
                <div class="panel-body">
                    {{$Fexperience}}
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">你的期待与发展</div>
                <div class="panel-body">
                    {{$Fdevelopment}}
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">你对我们的看法与建议</div>
                <div class="panel-body">
                    {{$Fadvice}}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
</body>
<script>

    $(document).ready(function() {

    })
</script>

</html>
