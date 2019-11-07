<?php


header ( "Content-type:text/html;charset=utf-8" );

require_once('./php/config.php');


session_start();

function add_user() {
  // 验证非空
  if (empty($_POST['email'])) {
    $GLOBALS['error_message'] = '请输入邮箱';
    return;
  }


  if (empty($_POST['password'])) {
    $GLOBALS['error_message'] = '请输入密码';
    return;
  }

  if (empty($_POST['password2'])) {
    $GLOBALS['error_message'] = '请再次输入你的密码';
    return;
  }

  if($_POST['password']===$_POST['password2']){

  }else{
    $GLOBALS['error_message'] = '两次密码不一致';
    return;
  }

    if (empty($_POST['nickname'])) {
    $GLOBALS['error_message'] = '请输入昵称';
    return;
  }

  if (empty($_POST['title'])) {
    $GLOBALS['error_message'] = '请输入标签';
    return;
  }

  if (empty($_POST['WR'])) {
    $GLOBALS['error_message'] = '请输入签名';
    return;
  }






  // 取值
  $title = $_POST['title'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $password2 = $_POST['password2'];
  $nickname =$_POST['nickname'];
  $WR = $_POST['WR'];

  // 接收文件并验证
  if (empty($_FILES['avatar'])) {
    $GLOBALS['error_message'] = '请上传头像';
    return;
  }


  $ext = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
  // => jpg
  $target = './uploads/avatar-' . uniqid() . '.' . $ext;

  if (!move_uploaded_file($_FILES['avatar']['tmp_name'], $target)) {
    $GLOBALS['error_message'] = '上传头像失败';
    return;
  }

  $avatar = substr($target, 2);

  // var_dump($name);
  // var_dump($gender);
  // var_dump($birthday);
  // var_dump($avatar);
  // 保存

  // 1. 建立连接
  $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

  if (!$conn) {
    $GLOBALS['error_message'] = '连接数据库失败';
    return;
  }

  // 2. 开始查询
  $query = mysqli_query($conn, "insert into users (email,password,avatar,nickname,title,WR) values ('{$email}','{$password}','{$avatar}','{$nickname}','{$title}','{$WR}')"  );

  if (!$query) {
    $GLOBALS['error_message'] = '查询过程失败1';
    return;
  }


  $affected_rows = mysqli_affected_rows($conn);

  if ($affected_rows !== 1) {
    $GLOBALS['error_message'] = '添加数据失败';
    return;
  }

  // mysql_close($conn);

  // $conn2= mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

  $query2 = mysqli_query($conn, "select * from users where email = '{$email}' limit 1;");

  if (!$query2) {
    $GLOBALS['error_message'] = '查询失败2';
    return;
  }

   $user = mysqli_fetch_assoc($query2);

     if (!$user) {
    // 用户名不存在
    $GLOBALS['message'] = '邮箱与密码不匹配';
    return;
  }




  $_SESSION['current_login_user'] = $user;


  // 响应
  header('Location: ../index.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  add_user();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>注册</title>
    <!--网站描述-->
    <meta name="description" content="时间教会我爱你，但是你等不起我。" />
    <!--网站关键词--搜索引擎-->
    <meta name="keywords" content="芥芥云，旅行" />
    <!--网站logo-->
    <link rel="shortcut icon" href="images/pig.ico" >
    <!--首页样式-->
    <link rel="stylesheet" href="css/register.css">
</head>
<body>
<div class="index">

    <!--logo-->
    <div class="indexCss">
        <a href="http://www.laiove.com" title="点我哦！">
            <img src="images/newLogo.gif" alt="哎呀！网速这么慢！"  height="40px">
        </a>
    </div>

    <!--下拉菜单 -->
    <div class="indexLi">
        <ul>
            <li class="Li1" >
                <a href="" target="_blank">首页</a>
                <ul>
                    <li><a href="" target="_blank">主要内容</a></li>
                    <li><a href="" target="_blank">假日指南</a></li>
                </ul>
            </li>

            <li class="Li2" >
                <a href="" target="_blank">芥芥商城</a>
                <ul>
                    <li><a href="" target="_blank">旅行必备</a></li>
                    <li><a href="" target="_blank">酷车现行</a></li>
                </ul>
            </li>

            <li class="Li3" >
                <a href="" target="_blank">智慧旅行</a>
                <ul>
                    <li><a href="" target="_blank">旅行策略</a></li>
                    <li><a href="" target="_blank">案例讲解</a></li>
                </ul>
            </li>

            <li class="Li4" >
                <a href="" target="_blank">时尚新闻</a>
                <ul>
                    <li><a href="" target="_blank">娱乐新闻</a></li>
                    <li><a href="" target="_blank">活动咨询</a></li>
                </ul>
            </li>

            <li class="Li5" >
                <a href="" target="_blank">安全须知</a>
                <ul>
                    <li><a href="" target="_blank">安全守则</a></li>
                    <li><a href="" target="_blank">耳听八方</a></li>
                </ul>
            </li>

            <li class="Li6" >
                <a href="" target="_blank">关于芥芥</a>
                <ul>
                    <li><a href="" target="_blank">芥芥由来</a></li>
                    <li><a href="" target="_blank">创始人</a></li>
                </ul>
            </li>
        </ul>
    </div>

    <!--搜索框-->
    <div class="indexSearch">
        <input type="text" value="感谢对小L的支持..." id="Search"/>
        <button value=""><a href="" ></a></button>
    </div>

    <!--登录按钮-->
    <div class="indexLogin">
        <a href="enter.php" target="_blank">返回登录</a>
    </div>

    <!--图标链接-->
    <div class="photo">
        <ul>
            <li>
                <a href=""></a>
            </li>

            <li>
                <a href=""></a>
            </li>

            <li>
                <a href=""></a>
            </li>

            <li>
                <a href="" id="code"></a>
            </li>
        </ul>
        <div id="imgDiv">

        </div>
    </div>
    

</div>

<!--body背景-->
<div class="bodyBgc">

</div>


<!-- 注册框 -->
<div class="register">

  <div class="enterDivLogo">
        <a href="">
            <img src="./images/Laiove.gif" alt="">
        </a>
        <p>账号注册</p>
  </div>

  <div class="error">
    <?php if (isset($error_message)): ?>
    <?php echo $error_message; ?>
    <?php endif ?>
  </div>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" autocomplete="off">

      <div class="avatar">
        <span>头像</span>
        <input type="file" id="avatar" name="avatar">
      </div>

      <div class="email">
        <input type="text"  id="email" name="email" style="outline:none" placeholder="请输入您的的账号">
      </div>

      <div class="password">
        <input type="password"  id="password" name="password" value="" placeholder="请输入您的密码">
      </div>

      <div class="password2">
        <input type="password"  id="password2" name="password2" value="" placeholder="请再次输入您的密码">
      </div>

      <div class="nickname">
        <input type="text"  id="nickname" name="nickname" placeholder="请输入您的昵称">
      </div>

      <div class="title">
        <input type="text"  id="title" name="title" placeholder="请输入您需要的标签（四个字以内）">
      </div>

      <div class="WR">
        <input type="text"  id="WR" name="WR" placeholder="请输入您的签名">
      </div>



      <button class="upload">上传</button>


    </form>
  </main>
</div>
  <div class="foot">
        <div class="footInterLinkAge">
            <div class="cooperate">
                <p><a href="">合作</a></p>
                <span><a href="" class="nml">关于我们</a></span>
                <span><a href="">联系我们</a></span>
            </div>
            <div class="cooperate authority">
                <p><a href="">官方</a></p>
                <span><a href="" class="nml">微信公众号</a></span>
                <span><a href="">官方网店</a></span>
                <span><a href="" class="nml">新浪微博</a></span>
                <span><a href="">QQ空间</a></span>
            </div>
            <div class="cooperate download">
                <p><a href="">下载</a></p>
                <span><a href="" class="nml">客户端</a></span>
                <span><a href="">PC端</a></span>
            </div>
            <div class="cooperate friend">
                <p><a href="">友情链接</a></p>
                <span><a href="" class="nml">淘宝网</a></span>
                <span><a href="">京东</a></span>
            </div>
            <div class="cooperate feedback">
                <p><a href="">反馈</a></p>
                <span><a href="" class="nml">帮助中心</a></span>
                <span><a href="">用户反馈</a></span>
                <span><a href="" class="nml">用户协议</a></span>
                <span><a href="">隐私条款</a></span>
                <span><a href="" class="nml">侵权投诉</a></span>
            </div>
            <div class="ico">
                <img src="./images/newLogo.jpg" alt="" >
            </div>
        </div>

        <div class="footLinkImg">
                <p><a href=""><img src="./images/Laiove.gif" alt=""></a></p>
                <p>Copyright © 2007-2019 Laiove. 保留所有权利</p>
        </div>
</div>

<script src="./js/common.js"></script>
<script>

    // index
    // 搜索框进出事件
    my$("Search").onclick=function () {
        my$("Search").value="";
    };

    my$("Search").onblur=function () {
        my$("Search").value="加载中...";
    };


    // 二维码进出事件
    my$("code").onmouseover=function () {
        var img=document.createElement("img");
        img.id="imgId";
        img.src="./images/wechatlaiove.jpg";
        my$("imgDiv").appendChild(img);
        img.style.Repeat = 'no-repeat';
    };

    my$("code").onmouseout=function () {
        my$("imgId").remove();
    };



    // 注册框
    // email
    my$("email").onclick=function () {
        my$("email").style.border="1px solid green";
        // my$("email").style.placeholder="";
    };

    my$("email").onblur=function () {
          my$("email").style.border="1px solid #c4c4c4";
    }


    // password
    my$("password").onclick=function () {
        my$("password").style.border="1px solid green";
        // my$("email").style.placeholder="";
    };

    my$("password").onblur=function () {
        my$("password").style.border="1px solid #c4c4c4";
    }


    // password2
    my$("password2").onclick=function () {
      my$("password2").style.border="1px solid green";
    };

    my$("password2").onblur=function () {
        if(my$("password").value===my$("password2").value){

          my$("password2").style.border="1px solid #c4c4c4";

          // console.log(my$("password").value===my$("password2").value);
            // var accountP=document.createElement("p");
            // accountP.id="accountId";
            // accountP.innerHTML="请输入正确的账号...";
            // my$("accountDiv").appendChild(accountP);
        }else{
          my$("password2").style.border="1px solid red";
        }
    };


    // nickname
    my$("nickname").onclick=function () {
        my$("nickname").style.border="1px solid green";
        // my$("email").style.placeholder="";
    };

    my$("nickname").onblur=function () {
        my$("nickname").style.border="1px solid #c4c4c4";
    }

// title
    my$("title").onclick=function () {
        my$("title").style.border="1px solid green";
        // my$("email").style.placeholder="";
    };

    my$("title").onblur=function () {
        my$("title").style.border="1px solid #c4c4c4";
    }

// WR
    my$("WR").onclick=function () {
        my$("WR").style.border="1px solid green";
        // my$("email").style.placeholder="";
    };

    my$("WR").onblur=function () {
        my$("WR").style.border="1px solid #c4c4c4";
    }

    // // input password 离开事件  请输入正确的账号...
    // my$("password").onblur=function () {
    //     if(my$("account").value===""){
    //         my$("passwordDiv").style.border="1px solid red";
    //         // var passwordP=document.createElement("p");
    //         // passwordP.id="passwordId";
    //         // passwordP.innerHTML="请填写密码...";
    //         // my$("passwordDiv").appendChild(passwordP);
    //     }else{
    //         my$("passwordDiv").style.border="1px solid #c4c4c4";
    //     }
    // };
</script>
</body>
</html>
