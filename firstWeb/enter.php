<?php

header ( "Content-type:text/html;charset=utf-8" );

require_once('./php/config.php');


session_start();

function login () {
  // 1. 接收并校验
  // 2. 持久化
  // 3. 响应
  if (empty($_POST['email'])) {
    $GLOBALS['message'] = '请填写邮箱';
    return;
  }
  if (empty($_POST['password'])) {
    $GLOBALS['message'] = '请填写密码';
    return;
  }



  $email = $_POST['email'];
  $password = $_POST['password'];

  // 当客户端提交过来的完整的表单信息就应该开始对其进行数据校验
  $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
  if (!$conn) {
    exit('<h1>连接数据库失败</h1>');
  }

  $query = mysqli_query($conn, "select * from users where email = '{$email}' limit 1;");

  if (!$query) {
    $GLOBALS['message'] = '登录失败，请重试！';
    return;
  }

  // 获取登录用户
  $user = mysqli_fetch_assoc($query);

  if (!$user) {
    // 用户名不存在
    $GLOBALS['message'] = '邮箱与密码不匹配';
    return;
  }

  // 一般密码是加密存储的
  if ($user['password'] !== $password ) {
    // 密码不正确
    $GLOBALS['message'] = '邮箱与密码不匹配';
    return;
  }

  // 存一个登录标识
  // $_SESSION['is_logged_in'] = true;
  $_SESSION['current_login_user'] = $user;

  // 一切OK 可以跳转
  header('Location: ../index.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  login();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>登录</title>
    <!--网站描述-->
    <meta name="description" content="时间教会我爱你，但是你等不起我。" />
    <!--网站关键词--搜索引擎-->
    <meta name="keywords" content="芥芥旅行" />
    <!--网站logo-->
    <link rel="shortcut icon" href="images/pig.ico" >
    <!--首页样式-->
    <link rel="stylesheet" href="css/enter.css">
    <!-- 加载样式 -->

</head>
<body>
<!--导航页-->
<div class="index">

    <!--logo-->
    <div class="indexCss">

        <a href="http://www.laiove.com" title="点我哦！">
            <img src="images/newLogo.gif" alt="哎呀！网速这么慢！"  height="40px">
        </a>

        <!--<div class="indexAlone">-->
        <!--&#45;&#45;独立旅行计划&#45;&#45;-->
        <!--</div>-->
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
        <a href="index.html" target="_self">返回首页</a>
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

<!--登入框-->
<div class="enterDiv">
    <!--登入第一行logo-->
    <div class="enterDivLogo">
        <a href="">
            <img src="./images/Laiove.gif" alt="">
        </a>
        <p>账号登录</p>
    </div>


    <!--登入的两个输入框-->
    <div class="enterDivInput">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" autocomplete="off" novalidate>
        <!-- 错误信息反馈 -->
        <?php if (isset($message)): ?>
        <div class="wrong">
            <strong>错误！</strong> 
            <?php echo $message; ?>
        </div>
      <?php endif ?>
        <!--账号框-->
        <div class="enterDivAccount" id="accountDiv">
            <span></span>
            <input type="text" id="account" name="email" autofocus value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>">
        </div>
        <!--密码框-->
        <div class="enterDivKey" id="passwordDiv">
            <span></span>
            <input type="password" id="password" name="password" value="<?php echo empty($_POST['password']) ? '' : $_POST['password'] ?>">
        </div>
        <!--登录“按钮”-->
        <button id="button">  
              <div class="enterDivLogin">
           登录
        </div>
    </button>

        </form>
    </div>
    <!--登录帮助-->
    <div class="enterDivHelp">
        <a href="" class="help">帮助中心</a>
        <a href="" class="forget">忘记密码</a>
        <a href="../register.php" class="login">立即注册</a>
    </div>
    </form>
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

    // 登入框
    // input account 进入事件
    my$("account").onclick=function () {
        my$("accountDiv").style.border="1px solid green";
        // my$("accountId").remove();
    };

    // input account 离开事件
    my$("account").onblur=function () {
        if(my$("account").value===""){
            my$("accountDiv").style.border="1px solid red";
            // var accountP=document.createElement("p");
            // accountP.id="accountId";
            // accountP.innerHTML="请输入正确的账号...";
            // my$("accountDiv").appendChild(accountP);
        }else{
            my$("accountDiv").style.border="1px solid #c4c4c4";
        }
    };

    // input password 进入事件
    my$("password").onclick=function () {
        my$("passwordDiv").style.border="1px solid green";
        // my$("passwordId").remove();
    };

    // input password 离开事件  请输入正确的账号...
    my$("password").onblur=function () {
        if(my$("account").value===""){
            my$("passwordDiv").style.border="1px solid red";
            // var passwordP=document.createElement("p");
            // passwordP.id="passwordId";
            // passwordP.innerHTML="请填写密码...";
            // my$("passwordDiv").appendChild(passwordP);
        }else{
            my$("passwordDiv").style.border="1px solid #c4c4c4";
        }
    };

</script>
</body>
</html>