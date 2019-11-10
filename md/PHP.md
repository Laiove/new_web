# PHP

---

##第一天

###**一：如何安装Apache**

1.下载
地址：https://www.apachelounge.com/download/
说明：https://httpd.apache.org/docs/current/platform/windows.html

2.通过命令提示符安装Apache服务
    1）找到你的解压目录 在命令提示符中输入 cd 接上你的路径 然后盘符：
    2）输入httpd -k -install -n "Apache"
    3）出现 Syntax OK 即可
   
###**二：修改主要参数路径**
F:\Apache\conf\httpd.conf

###**三：修改域名指向（只适合本地）**
C:\WINDOWS\System32\drivers\etc\hosts
格式：127.0.0.1 VioletJie.com

###**四：修改站点路径**
1.找到主要参数路径打开搜索：DocumentRoot

###**五：虚拟主机的配置**
参考链接：http://skypegnu1.blog.51cto.com/8991766/1532454
1.找到主要参数路径（F:\Apache\conf\httpd.conf）打开搜索：Virtual hosts 取消注释。
2.找到路径（F:\Apache\conf\extra\httpd-Vhosts.conf） 打开编辑
```
//所有的80端口
<VirtualHost *:80> 
    //站长的电子邮箱
    ServerAdmin 1679852974@qq.com-host.example.com
    //虚拟主机1
    DocumentRoot "F:/www"
    //站点的域名
    ServerName VioletJie.co
    //站点的错误日志
    ErrorLog "logs/VioletJie.co-error.log"
    //站点的访问日志
    CustomLog "logs/VioletJie.co-access.log" common
</VirtualHost>

<VirtualHost *:80>
    ServerAdmin 1679852974@qq.com-host2.example.com
    //虚拟主机2
    DocumentRoot "F:/sss"
    <Directory "F:/sss">
    //当没有默认的页面时隐藏路径 不会出现 for\路径
    Options (Indexes) FollowSymLinks

    AllowOverride None
    //准许被访问 不会出现 Forbidden 的提示
    Require all granted

    </Directory>
    ServerName VioletJie1.co
    ErrorLog "VioletJie1.co1-error.log"
    CustomLog "VioletJie1.co1-access.log" common
</VirtualHost>
```
##第二天

###**一：PHP（PHP:Hypertext Preproccrssor）**
php只运行后缀名为php的文件

Apache：处理静态文本

php：处理动态文本

1.php下载
https://windows.php.net/download#php-7.1-nts-VC14-x64

2.php安装（增加后缀名判断是否让php工作）
打开：F:\Apache\conf\httpd.conf
找到：#LoadModule xml2enc_module modules/mod_xml2enc.so
新建：LoadModule php7_module F:/php/php7apache2_4.dll

找到：AddType application/x-compress .Z
新建：AddType application/x-httpd-php .php

3.语法结构
```
#输出 Hello World
<?php echo"Hello World";  ?>

#输出当前的年月日
<?php echo date("Y-m-d"); ?>
```

4.输出的方式
    1）echo 可以同时输出多个
```
<?php

echo '1','2';
```

    2）print 只能同时输出一个
```
<?php
print '1';
```

    3）var_dump 可以输出字符的长度
```
<?php
var_dump('hello');
--------
输出：string(5) "hello"


var_dump(array(
    '1','12','123'
))
--------
array(3){
    [0]=>
    string(1) "1"
    [1]=>
    string(2) "12"
    [3]=>
    string(3) "123"
}
```

5.和html的混编
最常见的用法
```
<?php if($age > 18 ); ?>
    <p>成年人</p>
<?php else; ?>
    <p>小屁孩</p>
<?php endif ?>
```


###**二：表单案例（字符串相关）**
思路：

用到的api

字符串处理

1.字符串截取
echo substr(‘截取的字符串(英文)’，截取的开始)；
echo mb_substr("中文"，截取的开始)；

2.大小写转换
strtolower（字符）；
strtoupper(字符)；

3.清除空格
trim（）；清除所有空格
ltrim（）；清除左边的空格
rtrim（）；清除右边的空格

4.替换字符
吧1替换成2，
str_replace("1"，“2”，“字符串”)

5.重复字符串
str_repeat("4",5);


数组处理


```
<?php

//读取文本内容

$contents = file_get_contents('names.txt');

//调试（每次出现新的变量均要调试一下最好）
//var_dump($contents);

//2.按照一定的规则解析文本内容
//分割字符串函数 第一个参数 以什么分割 要分割的字符串

$lines =explode("\n",$contents);

//测试
//var_dump($lines);

//2.2 遍历每一行分别解析每一行中的数据 第一个参数：需要遍历的文件，第二个参数：遍历文件的索引可以用变量替代。

foreach($lines as $item){
    //item为空 继续
    if (!$item) contents;
    
    //var_dump($item);
    
    //分割函数
    $cols=explode("|",$item);
    
    
    //var_dump($cols);
    
    
    $data[] = $cols;
    
    
    //var_dump($data);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>成员信息表</title>
</head>
<body>
<h1>成员信息表</h1>
    <table>
        <thead>
            <tr>
                <th>编号</th>
                <th>姓名</th>
                <th>年龄</th>
                <th>邮箱</th>
                <th>网址</th>
            </tr>
        </thead>
        
        <tbody>
        
            //定义一个新的变量吧 $data 的索引放到$line的索引之中
            <?php foreach ($data as $line): ?>
            
            <tr>
            
            //定义一个新的变量吧 $line 的索引放到$col 的索引之中
                <?php foreach ($line as $col): ?>
                
                    //清除空格
                     <?php $col = trim($col); ?>
                     
                     //判断http://是不是在一开始
                     <?php if (strpos($col, 'http://') === 0): ?>
                     
                         <td>
                        //a标签输出完整的链接 一小写字母的形式 strtolower 
                             <a href="<?php echo strtolower($col); ?>">
                             //截取从$col变量中第7个开始的字符串
                                <?php echo substr($col, 7); ?>
                             </a>
                         </td>
                         
                         <?php else: ?>
                         
                         <td><?php echo $col; ?></td>
                     
                     <?php endif ?>
                
                <?php endforeach ?>
            
            </tr>
            
            <?php endforeach ?>
            
        </tbody>
    </table>
</body>
</html>
```

###**三.API(Application Programing Interface)**
1.应用程序编程接口（类插头）

2.API不需要强制记忆，更重要的是语言的语法。

3.PHP中有1000+的API，也提供额外的扩展模块（插件），需要设置。
    1）复制一份 php.ini-development 到 ext
    2）重命名 php.ini
    3）打开 php.ini 查找extension
        修改 
```
        ; extension_dir = "ext"
        ; 到这个目录找扩展
        extension_dir = "F:/php/ext"
```

4）解开

```
        ;extension=php_mbstring.dll
```

5）查看php的信息
        新建一个 phpinfo.php
    
输入
```

<?php

    phpinfo();
```
发现php加载扩展是在c:/windown

6）修改默认扩展路径（Apache）
   找到php加载模块
   
   添加
```
PHPIniDir F:/php/ext
```
###**四：数组**
一：数组的类型
1.索引数组
```
$dict=array(
"hello"=>'你好'，
'hello1'=>'你好'，
'hello2'=>'你好'，
)

//获取所有的键
array_keys($dict);
//=> ['hello','hello1','hello2']

//获取所有的值
array_values($dict)；；
//=>['hello','hello','hello']

//判断键
var_dump(array_key_exists('hello',$dict));


```
2.关联数组

二.方式
1.array（）

2.[]php5.4


三.数组相关的API
1.isset 判断数组中是否存在键或值
```
if(isset($dict['foo'])){
    echo $dict['foo']；
}else{
    echo '没有';
}
```

2.empty 比isset更高级 还能判断是否为空
```
empty（$dict'foo']）相当于 ！isset($dict['foo'])|| $dict['foo']=flase

if(empty($dict['foo'])){
    echo '没有';
}else{
    echo $dict['foo'];
};

源代码 
function empty($input){
    return !isset($input)||$input==false
}
注意：判断true/false
是先把要true换成1 false换成2
```

3.去除重复的元素
array_unique()

4.数组长度
count（）

5.获取数组元素的下标
array_search()

6.判断存在
[].includes

###**五.时间函数和日期函数**
1.time
```
<?php

//输出的是以秒为单位的时间数 js中的Date函数输出的毫秒为单位的时间数

echo time();

```

2.Date
```
//格式化一个时间戳
//第一个参数是一个时间格式
//第二个参数是一个时间戳
//默认时间戳获取的就是格林威治时间需要改
date_default_timezone_set('PRC');
//可以修改配置文件 建议还是自己敲代码
//进入php.ini 搜索 timezone=PRC；

echo date（'Y-m-d H:i:s',time()）;
```

###**六：时间格式的字符串转时间戳**
```
//给定一个变量记录接受的时间
$str='2017-10-22 15:16:18';

//给定一个变量接收转换的时间戳
$timestamp =strtotime($str);

//输出想要的时间格式
echo date('Y年m月d日 H:i:s',$timestamp);
```


###**七：常量命名法**
1.变量用snake_case (小写字母加下划线)

2.常量用SNAKE_CASE(大写字母加下划线)

3.常量直接命名
```
第一个参数常量名，第二参数常量值，第三个参数（不建议使用）是否忽略常量名称的大小写，

define('MY_NAME','周峻')；
echo MY_NAME;
```

###**八：载入文件的方式**
1.require 强烈需求 （如果找不到文件会报严重错误，不会在执行后面的代码）
require（文件路径）；
require_once 只载入一次

2.include 一般需求
include （文件路径）
include_once 只载入一次


###**九：表单制作**
1.news.ycombinator.com

2.简单的表单
```
<body>
    <form action="请求的文件index.php" method="请求方式get">
        <table>
        
            <tr>
                <td>用户名</td>
                <td><input type="text" name="username"/></td>
            </tr>
             
            <tr>
            <td>密码</td>
            <td><input type="password" name="password"/></td>
            </tr>
            
            <tr>
            <td></td>
            <td><butto type="submit" >登录</button></td>
            </tr>
        </table>
    </form>
</body>

请求文件的读取
<?php

var_dump($_GET);获取地址栏的内容

var_dump($_POST);获取请求体中提交的数据

var_dump($_REQUEST);兼容上面两种。
```

###**十：客户端和服务端注意事项**
1.超全局变量$_SERVER[...];
```
<?php
// // 将表单的处理逻辑放在HTML之前，为了更灵活的控制 HTML 的输出
// var_dump($_POST);
// 因为对于表单的处理逻辑不是每一次都需要执行，
// 所以一般我们会判断请求的方式，从而决定是否执行对数据的处理

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // 请求的方式是 POST，当前是点击按钮产生的请求
  var_dump($_POST);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>登录</title>
</head>
<body>
  <!-- 一般为了便于维护，我们将表单提交给当前页面本身 -->
  <!-- <form action="02-form-action.php" method="post"> -->
  <!-- 由于文件重命名会导致代码修改，鲁棒性不强 -->
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <div>
      <label for="username">用户名</label>
      <input type="text" id="username" name="username">
    </div>
    <div>
      <label for="password">密码</label>
      <input type="password" id="password" name="password">
    </div>
    <button type="submit">登录</button>
  </form>
</body>
</html>
```
提交方式一般是get

###**十一：常见的表单提交**
1.单选框
当表单中使用了 radio ，一定要为相同 name 的 radio 设置不同的 value，让服务端可以辨别
```
<label><input type="radio" name="gender" value="male"> 男</label>

<label><input type="radio" name="gender" value="female"> 女</label>
```

2.确定框
checkbox 如果没有选中则不会提交，如果选中提交 on
```
<label><input type="checkbox" name="agree" value="true"> 同意协议</label>
```

3.复选框
[]重点
```
<label><input type="checkbox" name="funs[]" value="football"> 足球</label>
<label><input type="checkbox" name="funs[]" value="basketball"> 篮球</label>
<label><input type="checkbox" name="funs[]" value="earth"> 地球</label>
```

4.下拉菜单
默认接收value 没有的话就选择文本
```
<select name="status">
      <option>激活</option>
      <option>未激活</option>
      <option value="1">待激活</option>
    </select>
```

5.选择文件
文本域问题
如果一个表单中有文本域（文件上传）。必修将表单的 method 设置为post ，enctype 设置为 multipart/form-data 
```
<body>
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
  
        <input type="file" name="img" >
        
        <button>提交</button>
        
  </form>
</body>
```

6.回发处理逻辑(解决else嵌套过多，html代码可以忽略)
```
<?php
function postback () {
  // // 申明 $message 是全局
  // global $message;

  // 1. 校验参数的完整性
  if (empty($_POST['username'])) {
    // 没有提交用户名 或 用户名为空字符串
    $GLOBALS['message'] = '会不会玩';
    return;
  }

  if (empty($_POST['password'])) {
    $GLOBALS['message'] = '请输入密码';
    return;
  }

  if (empty($_POST['confirm'])) {
    $GLOBALS['message'] = '请输入确认密码';
    return;
  }

  if ($_POST['password'] !== $_POST['confirm']) {
    $GLOBALS['message'] = '两次输入的密码不一致';
    return;
  }

  if (!(isset($_POST['agree']) && $_POST['agree'] === 'on')) {
    $GLOBALS['message'] = '必须同意注册协议';
    return;
  }

  // 所有的校验都OK
  $username = $_POST['username'];
  $password = $_POST['password'];

  // 将数据保存到文本文件中
  file_put_contents('users.txt', $username . '|' . $password . "\n", FILE_APPEND);
  $GLOBALS['message'] = '注册成功';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  postback();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>注册</title>
</head>
<body>
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <table border="1">
      <tr>
        <td><label for="username">用户名</label></td>
        <td><input type="text" name="username" id="username" value="<?php echo isset($_POST['username']) ? $_POST['username'] : ''; ?>"></td>
      </tr>
      <tr>
        <td><label for="password">密码</label></td>
        <td><input type="password" name="password" id="password"></td>
      </tr>
      <tr>
        <td><label for="confirm">确认密码</label></td>
        <td><input type="password" name="confirm" id="confirm"></td>
      </tr>
      <tr>
        <td></td>
        <td><label><input type="checkbox" name="agree" value="on"> 同意注册协议</label></td>
      </tr>
      <?php if (isset($message)): ?>
      <tr>
        <td></td>
        <td><?php echo $message; ?></td>
      </tr>
      <?php endif ?>
      <tr>
        <td></td>
        <td><button>注册</button></td>
      </tr>
    </table>
  </form>
</body>
</html>
```
###**十二：文本域案例**
1.修改php.ini
    1.搜索upload_max_filesize 修改单次上传文件大小 建议20M
    2.搜索post_max_size 修改单次请求体大小 建议80M
```
    <?php
	
	function upload(){
		if(!isset($_FILES['avatar'])){
			$GLOBALS['message']='请选择文件'; 
			return;
		}

		$avatar=$_FILES['avatar'];

		if(!$avatar['error']===UPLOAD_ERR_OK){
			$GLOBALS['message']='上传失败';
			return;
		}

		$loadFile=$avatar['tmp_name'];
		$newFile='./upload/'.$avatar['name'];

		$okLoad=move_uploaded_file($loadFile, $newFile);

		if(!$okLoad){
			$GLOBALS['message']='上传失败';
			return;
		}
			echo " SUCCESS";
	}



	if($_SERVER['REQUEST_METHOD']==='POST'){
		upload();
	}

?>
<!DOCTYPE html> 
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
		<input type="file" name="avatar" >
		<button>上传</button>
			<?php if(isset($message)): ?>
				<p><?php echo $message; ?></p>
			<?php endif ?>
	</form>

</body>
</html>
```

###**十三：文本域总结(ADD.PHP)**
1.先判断文件上传格式
```
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  add();//设置回调函数
}
```

2.接收id=title文件内容
```
    $_POST['title']
```

3.检查接受文件内容
```
if (empty($_POST['title'])) {
    $GLOBALS['error_message'] = '请输入音乐标题';//设置错误信息
    return;
  }
  
```

4.保存文件内容
```
$data['title'] = $_POST['title'];
```

5.上传多个文件设置
1）判断文本域是否正常
```
    if (empty($_FILES['images'])) {
    $GLOBALS['error_message'] = '请正常使用表单';
    return;
  }
```
2）保存文本域接收的文件
```
    $images = $_FILES['images'];
```
    
3）设置一个容器装所有的海报路径
```
    $data['images'] = array();
```
    
4）遍历文件判断是否成功
```
    for ($i = 0; $i < count($images['name']); $i++) {
    // $images['error'] => [0, 0, 0]
    if ($images['error'][$i] !== UPLOAD_ERR_OK) {
      $GLOBALS['error_message'] = '上传海报文件失败1';
      return;
    }
```
    
5）判断是否是图片类型
    
strpos函数：【第一个参数文件，第二个参数要判断的文件类型】
```
    if (strpos($images['type'][$i], 'image/') !== 0) {
      $GLOBALS['error_message'] = '上传海报文件格式错误';
      return;
    }
```
    
6）判断文件大小
```
    if ($images['size'][$i] > 1 * 1024 * 1024) {
      $GLOBALS['error_message'] = '上传海报文件过大';
      return;
    }
```
    
7）移动文件到网站
```
    //先设置加到本网站的路径
    $dest = '../uploads/' . uniqid() . $images['name'][$i];
```

move_uploaded_file函数：【第一个参数：原来文件的路径，第二个参数：要加到本网站的路径】
```
    if (!move_uploaded_file($images['tmp_name'][$i], $dest)) {
      $GLOBALS['error_message'] = '上传海报文件失败2';
      return;
    }
```
    
8）保存文件
substr字符串截取函数：(第一个参数：需要截取的字符串，第二个参数：从那个索引开始截取)
```
        $data['images'][] = substr($dest, 2);
```

9）数据的解码 编码 成新的数据
```
    //1. 拿到原来的数据
    $getOldData=file_get_contents('data.json')；
    
    //2.解码
    $old = json_decode($json, true);
    
    //3.新的数据加入解码后旧的数据
    array_push($old, $data);
    
    //4.编码
    $new_json = json_encode($old);
    
    //5.全部编码后加入原来的文件
    file_put_contents('data.json', $new_json);
```

10）跳转
```
    header('Location: list.php');
    
    回调函数结束
```

11）html格式
1.错误框
```
    <?php if (isset($error_message)): ?>
    <div class="alert alert-danger">
      <?php echo $error_message; ?>
    </div>
    <?php endif ?>
```

2.表单标签属性
    1.action="<?php echo $_SERVER['PHP_SELF'];
    
    2.method="post"
    
    3.enctype="multipart/form-data">

3.一般的文本框提升用户体验避免输入数据丢失
```
<input type="text" class="form-control" id="title" name="title" value="<?php echo isset($_POST['title']) ? $_POST['title'] : ''; ?>">
```
###**十四：主页面总结（list.php）**

1.接受文件
$json = file_get_contents('data.json');

2.解码文件
$data = json_decode($json, true);

3.判断数据是否异常
```
if (!$data) {
  // JSON 格式不正确
  exit('数据文件异常');
}
```

4.数据的输出（因为是数组，所以用foreach）
```
<?php foreach ($data as $item): ?>
<tr>
          <td class="align-middle"> <?php echo **$item['title'];** ?> </td>
          <td class="align-middle">
          <a class="btn btn-danger btn-sm" 
          href=" delete.php?id=       <?php echo $item['id'];?>     ">删除</a></td>
        </tr>
        <?php endforeach ?>
```

十五：删除页面（delete.PHP）
1.判断url地址中不同的ID 有没有这个id
```
if (empty($_GET['id'])) {
  // 没有传递必要的参数
  exit('<h1>必须指定参数</h1>');
}
```

2.拿到这个要删除的id
```
$id = $_GET['id'];
```

3.找到要删除的数据
```
$data = json_decode(file_get_contents('data.json'), true);
```

4.查找是不是我们要的数据、
```
foreach ($data as $item) {
    if ($item['id'] !== $id) continue;
```

5.要删除的数据的索引已经找到
```
$index = array_search($item, $data);

array_splice($data, $index, 1);
```

6.删除后文件需要重新编码
```
$json = json_encode($data);
```

7.编码完成 加入原数据文件
```
file_put_contents('data.json', $json);
```

8.跳转
```
header('Location: list.php');
```
##第三天：http
1.http协议
    1）请求/响应报文格式
    2）请求方法--GET/POST
    3)响应状态--200/404/302/304
    4)预设的请求/响应头
    
2.约定形式 
1. 客户端通过随机端口与服务端某个固定端口（一般为80）建立连接 三次握手
2. 客户端通过这个连接发送请求（一个包）到服务端（这里的请求是名词）
3. 服务端监听端口得到的客户端发送过来的请求 
4. 服务端通过连接响应给客户端状态和内容 

    
3.可以修改请求头
    1）Location：xxx.php 可以跳转网页 自动跳转
    2）Content-Type: text/html 修改文件读取格式
    
4.
    
    
JSON（JavaScript Object Notation） 的使用
1.文件读取格式
file_get_contents('');
解析文件格式 json_decode();注意第二个参数要为true，不然返回的是一个对象，而不是一个关联数组。

