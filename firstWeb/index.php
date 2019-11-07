﻿<?php 

header ( "Content-type:text/html;charset=utf-8" );

require_once('./php/config.php');

session_start();

// 验证登录信息
function xiu_get_current_user () {
  if (empty($_SESSION['current_login_user'])) {
    // 没有当前登录用户信息，意味着没有登录
    header('Location: ../index.html');
    exit(); // 没有必要再执行之后的代码
  }
  return $_SESSION['current_login_user'];
}


$user = $_SESSION['current_login_user'];
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if (!$conn) {
    exit('<h1>连接数据库失败</h1>');
  }


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>芥芥云 - 动物大家庭、旅行小方法、出行好向导</title>
    <!--网站描述-->
    <meta name="description" content="时间教会我爱你，但是你等不起我。" />
    <!--网站关键词--搜索引擎-->
    <meta name="keywords" content="芥芥云，旅行" />
    <!--网站logo-->
    <link rel="shortcut icon" href="images/pig.ico" >
    <!--首页样式-->
    <link rel="stylesheet" href="css/index.css">



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
        <a href="enter.php" target="_blank"><?php echo $user['nickname'] ?></a>
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

<!--body内容-->
    <!--导航页-->
    <div class="bodyIndex">
            <!-- 头像 -->
            <div class="bodyIndexImg">
                <a href=""><img src="<?php echo $user['avatar'] ?>" alt="" height="120px"></a>
            </div>

            <!-- 昵称 -->
            <div class="bodyIndexBox">
                <div class="bodyIndexName">
                    <span><?php echo isset($user['nickname']) ? $user['nickname'] : '11111'; ?></span>
                </div>

                <div class="bodyIndexNameM">
                    <div>
                        <span><?php echo isset($user['title']) ? $user['title'] : '11111'; ?></span>
                    </div>
                </div>

                <div class="bodyIndexNameTab">

                    <span>视频</span>
                    <span class="bodyIndexNameTabData">
                            <?php echo isset($user['视频']) ? $user['视频'] : '0'; ?>
                    </span>  
                        
                    <span>关注</span>
                    <span class="bodyIndexNameTabData">
                        <?php echo isset($user['关注']) ? $user['关注'] : '0'; ?>
                        </span>

                    <span>粉丝</span>
                    <span class="bodyIndexNameTabData">
                         <?php echo isset($user['粉丝']) ? $user['粉丝'] : '0'; ?>
                        </span>
                </div>

                <div class="bodyIndexNameNote">
                    <p><?php echo $user['WR'] ?></p>
                </div>
            </div>

            <div class="bodyIndexButton">
                <div class="bodyIndexButtonLick"><a href="">+关注</a></div>
                <div class="bodyIndexButtonNote"><a href="">留言</a></div>
            </div>
    </div>

    <!--内容页-->
    <div class="bodyText">
        <!--内容页标签-->
        <div class="bodyTextTab">

            <a href="" class="bb c">
                视频
                <span><?php echo isset($user['视频']) ? $user['视频'] : '0'; ?></span>
            </a>

            <a href="" class="ml">
                关注
                <?php echo isset($user['关注']) ? $user['关注'] : '0'; ?>
            </a>

            <a href="" class="ml">
                粉丝
                <?php echo isset($user['粉丝']) ? $user['粉丝'] : '0'; ?>
            </a>

        </div>
        <!--内容页总页-->
        <div class="bodyTextContent">
            <div class="bodyIndexContentDiv">
                <a href="">
                    <figure>
                        <img src="./images/hamster8.jpg" alt="哦豁！没网了吧！" >
                        <figcaption>【Nice】我爱仓鼠哦吧呀！！！</figcaption>
                        <figcaption class="bodyIndexContentDivView">
                            观看
                            <span>999</span>
                            点赞
                            <span>999</span>
                        </figcaption>
                        <figcaption class="bodyIndexContentDivView">2017-08-08</figcaption>
                    </figure>
                </a>
            </div>
            <div class="bodyIndexContentDiv">
                <a href="">
                    <figure>
                        <img src="./images/hamster8.jpg" alt="哦豁！没网了吧！" >
                        <figcaption>【Nice】我爱仓鼠哦吧呀！！！</figcaption>
                        <figcaption class="bodyIndexContentDivView">
                            观看
                            <span>999</span>
                            点赞
                            <span>999</span>
                        </figcaption>
                        <figcaption class="bodyIndexContentDivView">2017-08-08</figcaption>
                    </figure>
                </a>
            </div>
            <div class="bodyIndexContentDiv">
                <a href="">
                    <figure>
                        <img src="./images/hamster8.jpg" alt="哦豁！没网了吧！" >
                        <figcaption>【Nice】我爱仓鼠哦吧呀！！！</figcaption>
                        <figcaption class="bodyIndexContentDivView">
                            观看
                            <span>999</span>
                            点赞
                            <span>999</span>
                        </figcaption>
                        <figcaption class="bodyIndexContentDivView">2017-08-08</figcaption>
                    </figure>
                </a>
            </div>
            <div class="bodyIndexContentDiv">
                <a href="">
                    <figure>
                        <img src="./images/hamster8.jpg" alt="哦豁！没网了吧！" >
                        <figcaption>【Nice】我爱仓鼠哦吧呀！！！</figcaption>
                        <figcaption class="bodyIndexContentDivView">
                            观看
                            <span>999</span>
                            点赞
                            <span>999</span>
                        </figcaption>
                        <figcaption class="bodyIndexContentDivView">2017-08-08</figcaption>
                    </figure>
                </a>
            </div>
            <div class="bodyIndexContentDiv">
                <a href="">
                    <figure>
                        <img src="./images/hamster8.jpg" alt="哦豁！没网了吧！" >
                        <figcaption>【Nice】我爱仓鼠哦吧呀！！！</figcaption>
                        <figcaption class="bodyIndexContentDivView">
                            观看
                            <span>999</span>
                            点赞
                            <span>999</span>
                        </figcaption>
                        <figcaption class="bodyIndexContentDivView">2017-08-08</figcaption>
                    </figure>
                </a>
            </div>
            <div class="bodyIndexContentDiv">
                <a href="">
                    <figure>
                        <img src="./images/hamster8.jpg" alt="哦豁！没网了吧！" >
                        <figcaption>【Nice】我爱仓鼠哦吧呀！！！</figcaption>
                        <figcaption class="bodyIndexContentDivView">
                            观看
                            <span>999</span>
                            点赞
                            <span>999</span>
                        </figcaption>
                        <figcaption class="bodyIndexContentDivView">2017-08-08</figcaption>
                    </figure>
                </a>
            </div>
            <div class="bodyIndexContentDiv">
                <a href="">
                    <figure>
                        <img src="./images/hamster8.jpg" alt="哦豁！没网了吧！" >
                        <figcaption>【Nice】我爱仓鼠哦吧呀！！！</figcaption>
                        <figcaption class="bodyIndexContentDivView">
                            观看
                            <span>999</span>
                            点赞
                            <span>999</span>
                        </figcaption>
                        <figcaption class="bodyIndexContentDivView">2017-08-08</figcaption>
                    </figure>
                </a>
            </div>
            <div class="bodyIndexContentDiv">
                <a href="">
                    <figure>
                        <img src="./images/hamster8.jpg" alt="哦豁！没网了吧！" >
                        <figcaption>【Nice】我爱仓鼠哦吧呀！！！</figcaption>
                        <figcaption class="bodyIndexContentDivView">
                            观看
                            <span>999</span>
                            点赞
                            <span>999</span>
                        </figcaption>
                        <figcaption class="bodyIndexContentDivView">2017-08-08</figcaption>
                    </figure>
                </a>
            </div>
            <div class="bodyIndexContentDiv">
                <a href="">
                    <figure>
                        <img src="./images/hamster8.jpg" alt="哦豁！没网了吧！" >
                        <figcaption>【Nice】我爱仓鼠哦吧呀！！！</figcaption>
                        <figcaption class="bodyIndexContentDivView">
                            观看
                            <span>999</span>
                            点赞
                            <span>999</span>
                        </figcaption>
                        <figcaption class="bodyIndexContentDivView">2017-08-08</figcaption>
                    </figure>
                </a>
            </div>
            <div class="bodyIndexContentDiv">
                <a href="">
                    <figure>
                        <img src="./images/hamster8.jpg" alt="哦豁！没网了吧！" >
                        <figcaption>【Nice】我爱仓鼠哦吧呀！！！</figcaption>
                        <figcaption class="bodyIndexContentDivView">
                            观看
                            <span>999</span>
                            点赞
                            <span>999</span>
                        </figcaption>
                        <figcaption class="bodyIndexContentDivView">2017-08-08</figcaption>
                    </figure>
                </a>
            </div>
            <div class="bodyIndexContentDiv">
                <a href="">
                    <figure>
                        <img src="./images/hamster8.jpg" alt="哦豁！没网了吧！" >
                        <figcaption>【Nice】我爱仓鼠哦吧呀！！！</figcaption>
                        <figcaption class="bodyIndexContentDivView">
                            观看
                            <span>999</span>
                            点赞
                            <span>999</span>
                        </figcaption>
                        <figcaption class="bodyIndexContentDivView">2017-08-08</figcaption>
                    </figure>
                </a>
            </div>
            <div class="bodyIndexContentDiv">
                <a href="">
                    <figure>
                        <img src="./images/hamster8.jpg" alt="哦豁！没网了吧！" >
                        <figcaption>【Nice】我爱仓鼠哦吧呀！！！</figcaption>
                        <figcaption class="bodyIndexContentDivView">
                            观看
                            <span>999</span>
                            点赞
                            <span>999</span>
                        </figcaption>
                        <figcaption class="bodyIndexContentDivView">2017-08-08</figcaption>
                    </figure>
                </a>
            </div>
            <div class="bodyIndexContentDiv">
                <a href="">
                    <figure>
                        <img src="./images/hamster8.jpg" alt="哦豁！没网了吧！" >
                        <figcaption>【Nice】我爱仓鼠哦吧呀！！！</figcaption>
                        <figcaption class="bodyIndexContentDivView">
                            观看
                            <span>999</span>
                            点赞
                            <span>999</span>
                        </figcaption>
                        <figcaption class="bodyIndexContentDivView">2017-08-08</figcaption>
                    </figure>
                </a>
            </div>
            <div class="bodyIndexContentDiv">
                <a href="">
                    <figure>
                        <img src="./images/hamster8.jpg" alt="哦豁！没网了吧！" >
                        <figcaption>【Nice】我爱仓鼠哦吧呀！！！</figcaption>
                        <figcaption class="bodyIndexContentDivView">
                            观看
                            <span>999</span>
                            点赞
                            <span>999</span>
                        </figcaption>
                        <figcaption class="bodyIndexContentDivView">2017-08-08</figcaption>
                    </figure>
                </a>
            </div>
            <div class="bodyIndexContentDiv">
                <a href="">
                    <figure>
                        <img src="./images/hamster8.jpg" alt="哦豁！没网了吧！" >
                        <figcaption>【Nice】我爱仓鼠哦吧呀！！！</figcaption>
                        <figcaption class="bodyIndexContentDivView">
                            观看
                            <span>999</span>
                            点赞
                            <span>999</span>
                        </figcaption>
                        <figcaption class="bodyIndexContentDivView">2017-08-08</figcaption>
                    </figure>
                </a>
            </div>

        </div>
    </div>

    <!--下标分页 -->
    <div class="bodyTextSpan">
        <a href=""><span class="bgc">1</span></a>
        <a href=""><span>2</span></a>
        <a href=""><span>3</span></a>
        <a href=""><span>4</span></a>
        <a href=""><span>5</span></a>
        <a href=""><span>6</span></a>
        <a href=""><span>7</span></a>
        <a href=""><span class="Fb">></span></a>
        <p>共9页</p>
    </div>

<!--脚部内容-->
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
        <div class="footLink">
            <span class="nml"><a href="">中国互联网举报中心</a></span>
            <span><a href="">京ICP备5201314号</a></span>
            <span><a href="">京ICP证2157号</a></span>
            <span><a href="">节目制作经营许可证（京）字第2157号</a></span>
            <span><a href="">网络文化经营单位</a></span>
            <span class="nml"><a href="">北京互联网举报中心</a></span>
            <span class="nml"><a href="">京网文[2019]520-999号</a></span>
            <span><a href="">公安部网络违法犯罪举报网站</a></span>
            <span><a href="">京公网安备 52013142157号</a></span>
            <span><a href="">北京12318文化市场举报热线</a></span>
            <span class="nml"><a href="">违法和不良信息举报电话：010-53952610</a></span>
            <span><a href="">举报邮箱：ac-report@kuaishou.com</a></span>
            <span><a href="">公司名称: 江西芥芥动物有限公司</a></span>
            <span><a href="">电话: 999-52013142157</a></span>
            <div class="footLinkImg">
                <p><a href=""><img src="./images/Laiove.gif" alt=""></a></p>
                <p>Copyright © 2007-2019 Laiove. 保留所有权利</p>
            </div>
        </div>
    </div>
<!-- 音乐 -->
<!-- <div class="music">
    <video src="../music/Bg莫妮卡.mp3" autoplay="true" width="0px" controls="false"></video>
</div> -->
<!--小仓鼠动画-->
<!-- <div id="hamster">
    <embed src="./images/hamster.swf" width="200px" />
</div> -->

 <script src="./js/common.js"></script>
<script>
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



</script>
</body>
</html>