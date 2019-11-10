# Jquery--Violet_Jie


---
##第一天
###一.JavaScript的缺点
**1. 不爽的地方：**
    1）代码比较麻烦，需要遍历，可能还需要嵌套。
    2）找对象麻烦，方法少，还长
    3）会有兼容性问题。
    4）如果想要实现简单的动画效果 animate
    5）js注册事件，会被覆盖，addEventListener

**2. 等待页面加载完成后才会执行。**
```
    window.onload = function () {};
```
**3. 版本存在兼容性问题**
   低版本火狐浏览器不支持innerText，支持textContent
###二.Jquery初体验
**1.Jquery的引入**
```
<script src="jquery-1.12.4.js"></script>
```
**2.入口函数**

  1）js的入口函数执行要比jQuery的入口函数执行得晚一些。
  2）jq的入口函数会等待页面的加载完成才执行，但是不会等待图片的加载。
  3）js的入口函数会等待页面加载完成，并且等待图片加载完成才开始执行。
```
  <script>
    //2. 入口函数的标准
    $(document).ready(function(){
      //注册事件，把on去掉，是一个方法
      $("#btn1").click(function () {
        //隐式迭代：偷偷的遍历，jQuery会自动的遍历，不需要我们遍历。
        $("div").show(1000);
      });
      
      $("#btn2").click(function () {
        $("div").text("我是内容");
      });
    });
  </script>
  
```
**3.Dom对象和Jq对象**

1）什么是DOM对象(js对象):
    使用js的方式获取到的元素就是js对象（DOM对象）
```
    var cloth = document.getElementById("cloth");
    cloth.style.backgroundColor = "pink";
```
2）什么是jq对象：使用jq的方式获取到的元素就是jq对象
```
    var $li = $("li");
    console.log($li);
    $li.text("我改了内容");
```
3) jq对象与js对象的区别
   js对象不能调用jq对象的方法
```
    var cloth = document.getElementById("cloth");
    cloth.text("呵呵");
```
4) jq对象与js对象的联系
    （jq对象其实就是js对象的一个集合，伪数组，里面存放了一大堆的js对象）（宏观上）


5) DOM无法调用jQuery对象的方法：为什么：因为是两个不同对象
    DOM对象调用jQuery对象的方法。需要把DOM对象转换成jQuery对象。
```
    var cloth = document.getElementById("cloth");
    //DOM对象就变成jQuery对象
    $(cloth).text("呵呵");
```
6) jQuery对象怎么转换成DOM对象（取出来）
```
    var $li = $("li");
        $li[1].style.backgroundColor = "red";
        $li.get(2).style.backgroundColor = "yellow";
```
7) 总结
    1. 什么是DOM对象：用js的方式获取到的对象时DOM对象
    2. jQuery对象：用jq的方式获取到的对象时jq对象
    3. 区别与联系
    4. 区别:js对象与jq对象的方法不能混着用
    5. 联系：
```
      DOM-->  jQuery  $(DOM对象)
      jQuery--》 DOM  $li[0]  $li.get(0)
```