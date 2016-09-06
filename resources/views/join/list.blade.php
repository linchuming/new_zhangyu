<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../images/favicon.png">

    <title>报名简历查看</title>

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
        <div class="col-sm-12 col-md-12 main">
            <h1 class="sub-header">报名简历查看</h1>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>学号</th>
                        <th>姓名</th>
                        <th>专业</th>
                        <th>手机</th>
                        <th>学邮</th>
                        <th>报名时间</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody id="data">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/comm.js"></script>
</body>
<script>

    $(document).ready(function() {
        $.ajax({
            type: 'post',
            url: 'queryjoinlist',
            data: {},
            success: function(res) {
                $.each(res.data, function(key, val) {
                    var email = val.Fstu_id + "@fudan.edu.cn"
                    var url = "joinlook?stuId=" + val.Fstu_id + "&check=" + val.Fcheck
                    var url2 = "enter?stuId=" + val.Fstu_id + "&check=" + val.Fcheck
                    var look = "<a href='" + url2 + "' target='_blank'>查看</a>"
                    var stuId = "<a href='" + url + "' target='_blank'>"+ val.Fstu_id +"</a>"
                    var tableRow = "<tr><td>" +
                            stuId +
                            "</td><td>" +
                            val.Fname +
                            "</td><td>" +
                            val.Fmajor +
                            "</td><td>" +
                            val.Fphone +
                            "</td><td>" +
                            email +
                            "</td><td>" +
                            val.Fadd_time +
                            "</td><td>" +
                            look +
                            "</td></tr>"
                    //console.log(tableRow)
                    $('#data').append(tableRow)
                })
            }
        })
    })
</script>

</html>
