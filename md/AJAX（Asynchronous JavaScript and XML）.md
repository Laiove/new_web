#AJAX（Asynchronous JavaScript and XML）



###一：AJAX的含义
1.是浏览器提供的一套API，可以通过JavaScript调用。这样JavaScript可以进行网络编程。

2.一般代码操作
```
<script>
    //1.安装浏览器（用户代理）
    //xhr 就类似于浏览器的作用（发送请求接收响应）
    var xhr = new XMLHttpRequest()
    //2.打开浏览器 输入网址
    
    xhr.open("GET","./time.php")
    //3.敲下回车 开始请求
    
    xhr.send() 
    //因为客户端永远不知道服务端什么时候才能返回我们需要的响应
    //所以ajxa api 采用事件的机制（通知的感觉）
    xhr.onreadystatechange = function (){
    //xhr 状态改变就触发
    if(this.readState !== 4) return
    //获取响应的内容（响应体）
    console.log(this.responseText)
     }
    
    
</script>
```

3.readystate状态变化
```
<script>
    ....
    xhr.send()
    
    xhr.addEventListener('readstatechange',function(){
        switch(this.readyState){
            
            case 2:
            console.log(this.readystate)
            break
            
            case 3:
            console.log(this.readystate)
            break
            
            case 4:
            console.log(this.readystate)
            break
            
            
        }
    })
</script>
```

4.ajxa遵寻 http协议
```
<script>
    var xhr = new XMLHttpRequest()
    
    xhr.open('POST','/add.php')//设置请求体
    
    xhr.setRequestHeader('foo','bar')//设置一个请求头
    
    xhr.serRequestHeader('Content-Type','application/x-www-form-urlencoded')
    //鱼 urlencoded 格式设置请求体
    xhr.send('key1=value1&key2=value2')
</script>
```





5.ajax 通过get传递数据
```
//数据文件 
<?php

header('Content-Type: application/json');
/**
 * 返回的响应就是一个 JSON 内容（返回的就是数据）
 * 对于返回数据的地址一般我们称之为接口（形式上是 Web 形式）
 */

// `/users.php?id=1` => id 为 1 的用户信息

$data = array(
  array(
    'id' => 1,
    'name' => '张三',
    'age' => 18
  ),
  array(
    'id' => 2,
    'name' => '李四',
    'age' => 20
  ),
  array(
    'id' => 3,
    'name' => '二傻子',
    'age' => 18
  ),
  array(
    'id' => 4,
    'name' => '三愣子',
    'age' => 19
  )
);


if (empty($_GET['id'])) {
  // 没有 ID 获取全部
  // 因为 HTTP 中约定报文的内容就是字符串，而我们需要传递给客户端的信息是一个有结构的数据
  // 这种情况下我们一般采用 JSON 作为数据格式
  $json = json_encode($data); // => [{"id":1,"name":"张三"},{...}]
  echo $json;
} else {
  // 传递了 ID 只获取一条
  foreach ($data as $item) {
    if ($item['id'] != $_GET['id']) continue;
    $json = json_encode($item); // => [{"id":1,"name":"张三"},{...}]
    echo $json;
  }
}


//网页内容
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>AJAX发送GET请求并传递参数</title>
</head>
<body>
  <ul id="list"></ul>

  <script>

    var listElement = document.getElementById('list')

    // 发送请求获取列表数据呈现在页面
    // =======================================

    var xhr = new XMLHttpRequest()

    xhr.open('GET', 'users.php')

    xhr.send()

    xhr.onreadystatechange = function () {
      if (this.readyState !== 4) return
      var data = JSON.parse(this.responseText)
      // data => 数据

      for (var i = 0; i < data.length; i++) {
        var liElement = document.createElement('li')
        liElement.innerHTML = data[i].name
        liElement.id = data[i].id

        listElement.appendChild(liElement)

        liElement.addEventListener('click', function () {
          // TODO: 通过AJAX操作获取服务端对应数据的信息
          // 如何获取当前被点击元素对应的数据的ID
          // console.log(this.id)
          var xhr1 = new XMLHttpRequest()
          xhr1.open('GET', 'users.php?id=' + this.id)
          xhr1.send()
          xhr1.onreadystatechange = function () {
            if (this.readyState !== 4) return
            var obj = JSON.parse(this.responseText)
            alert(obj.age)
          }
        })
      }
    }

    // 给每一个 li 注册点击事件
    // 因为 li 后来动态创建，所以不能这样注册事件
    // for (var i = 0; i < listElement.children.length; i++) {
    //   listElement.children[i].addEventListener('click', function () {
    //     console.log(111)
    //   })
    // }


    // var xhr = new XMLHttpRequest()
    // // 这里任然是使用URL中的问号参数传递数据
    // xhr.open('GET', 'users.php?id=2')
    // xhr.send(null)

    // xhr.onreadystatechange = function () {
    //   if (this.readyState !== 4) return
    //   console.log(this.responseText)
    // }

  </script>
</body>
</html>

```


6.ajax兼容代码 ie5、6
```
var xhr=window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
```

7.同步和异步
xhr.open('GET','time.php',true) 最后一个参数是true时，为异步。

当为flase时，
需要先注册事件然后在调用send，否则 readystatechange 无法触发。
```
xhr.onreadystatechange =function(){
    if(this.readystate===4){
        console.log('request done')
    }
}
xhr.send(null)

可以直接使用
console.log(xhr.responseText)
```

8.response和responseText
    1.this.response 获取到的结果会根据 this.responseType 的变化而变化
    2.this.responseText 获取到的结果永远是字符串形式的响应体。