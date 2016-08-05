<!DOCTYPE html>
<?php
session_start();
?>
<html lang="en">
<head>
    <script>
        function validateform()
        {
            if(document.signup.Name.value == "")
            {
                window.alert ("please input your name!")
                return false;
            }



            if(document.signup.email.value == "")
            {
                window.alert ("请输入您的邮箱!")
                return false;
            }

            if(document.signup.password.value == "")
            {
                window.alert ("密码不能为空!")
                return false;
            }

        }
    </script>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sign up</title>

    <!-- Bootstrap Core CSS -->
<!--    <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">-->
<!---->
<!--    <!-- MetisMenu CSS -->-->
<!--    <link href="bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">-->
<!---->
<!--    <!-- Custom CSS -->-->
<!--    <link href="dist/css/sb-admin-2.css" rel="stylesheet">-->
<!---->
<!--    <!-- Custom Fonts -->-->
<!--    <link href="bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">-->
<!---->
<!--    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->-->
<!--    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->-->
<!--    <!--[if lt IE 9]>-->
<!--    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>-->
<!--    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>-->
<!--    <![endif]-->-->

</head>

<body>

<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">请注册</h3>
                </div>
                <div class="panel-body">
                    <form role="form" action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" name="signup" onSubmit="return validateform( this.form )">
                        <fieldset>
                            <div class="form-group" >
                                <input class="form-control" placeholder="用户名" name="Name" id="Name" autofocus>
                            </div>
                            <div class="form-group" >
                                <input class="form-control" placeholder="E-mail" name="email" id="email" autofocus>
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="密码" name="password" type="password" value="">
                            </div>
                            <!--                            <div class="form-group" style="font-size: 17px;">-->
                            <!--                                请选择用户类型<br>-->
                            <!--                                <input type="checkbox" value="1" name="type">管理员-->
                            <!--                                &nbsp &nbsp &nbsp &nbsp<input type="checkbox" value="2" name="type">成绩管理员-->
                            <!--                                &nbsp &nbsp &nbsp &nbsp<input type="checkbox" value="3" name="type">普通用户-->
                            <!--                            </div>-->



                            <!-- Change this to a button or input when using this as a form -->
                            <button class="btn btn-lg btn-success btn-block" type="submit" >Sign up</button>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php

if(isset($_POST['email'])){
    require_once "dbaccess.php";
    mysql_query("insert into user values ('' ,'".$_POST['Name']."','".$_POST['email']."',md5('".$_POST['password']."'));");
    $username = $_POST['Name'];

    $id_result = mysql_query("select * from user where email = '".$_POST['email']."'");
    $id_row = mysql_fetch_array($id_result);
    $user_id = $id_row[id];

    $_SESSION['username'] = $username;
    $_SESSION['user_id'] =$user_id;

    $index = "decisions.php";
    echo '<script language="javascript">';
    echo "window.location.href='$index';";
    echo '</script>';

}

?>
<!-- jQuery -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="bower_components/metisMenu/dist/metisMenu.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="dist/js/sb-admin-2.js"></script>

</body>

</html>
