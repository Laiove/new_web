# JavaScript-Seniors--Violet_Jie


----------


##第一块
###1.创建对象的三种方式
1）字面量的方式
2）调用系统函数
3）自定义构造函数

```
//实例对象 字面量的形式
var per1={
    name:"卡卡西";
    age:20;
    sex:"男";
    eat：function(){
        console.log("吃臭豆腐");
    };
}
=========================
//调用系统的构造函数
var per2=new Object();
per2.name="大蛇丸";
per2.age=20;
per2.eat=function(){
    console.log("吃鸡蛋");
}
-------------------------
//以上创建的对象都是是Object类型
-------------------------
//自定义构造函数
function Person(name,age,sex){
    this.name=name;
    this.age=age;
    this.sex=sex;
    this.play=function(){
        console.log("天天打游戏。");
    };
}
var per3=new Person("雏田",18,"女");
```

*创建对象--->实例化一个对象的同时对属性进行初始化*
*期间做了四件事*

 1. 开辟空间存储对象
 2. 把this设置为当前对象
 3. 设置属性和方法的值
 4. 把this对象返回
 
###2.工厂模式创建对象和自定义创建对象的区别
```
//工厂模式创建对象
function createObject(name,age){
    var obj=new Object();
    obj.name=name;
    obj.age=age;
    obj.sayHi=function(){
        console.log("你好！");
    };
    return obj;
}
var per4=createObject("小黑",20);

//自定义构造函数
function Person(name,age,sex){
    this.name=name;
    this.age=age;
    this.sex=sex;
    this.play=function(){
        console.log("天天打游戏。");
    };
}
var per3=new Person("雏田",18,"女");
```
区别：
1）工厂模式创建对象

     1. 有new
     2. 有返回值
     3. new之后的对象是当前对象
     4. 直接调用函数创建对象


2）自定义构造函数

     1. 函数名大写（开头）
     2. 没有new
     3. 没有返回值。this就是当前对象
     4. 通过new的方式来创建对象
     
###3.构造函数和实例对象之间的关系
通过以下方式判断实例对象使用的构造函数的数据类型
```
console.dir(per);//dir可以把对象的结构显示出来
```
```
console.log(per.constructor==Person);//constructor 是构造器
console.log(per.__proto__.constructor==Person);
console.log(per.__proto__.constructor==Person.prototype.constructor);
//以上三种等同于
console.log(per.constructor==Person);
//另一种
console.log(per instanceof Person);
```
总结：
实例对象和构造函数的关系：

 1. 实例对象是通过构造函数来创建的---创建的过程较实例化
 2. 如何判断对象是不是这个数据类型
    1）通过构造器的方式 实例对象.构造器==构造函数的名字
    2）对象 instanceof 构造函数的名字

###4.原型添加方法解决数据共享问题
```
function Person(name,age) {
      this.name=name;
      this.age=age;
    }
    //通过原型来添加方法,解决数据共享,节省内存空间
    Person.prototype.eat=function () {
      console.log("吃凉菜");
    };

    var p1=new Person("小明",20);
    var p2=new Person("小红",30);
    console.log(p1.eat==p2.eat);//true

    console.dir(p1);
    console.dir(p2);
```
注意问题：
```
<script>

    //构造函数

    function Person(sex,age) {
      this.sex=sex;
      this.age=age;
    }
    //通过原型添加方法
    Person.prototype.sayHi=function () {
      console.log("打招呼,您好");
    };
    var per=new Person("男",20);
    console.log(per.__proto__.constructor==Person.prototype.constructor);//实例对象
    console.dir(Person);//构造函数的名字

    var per2=new Person("女",30);
    console.log(per.sayHi==per2.sayHi);

    //实例对象中有两个属性(这两个属性是通过构造函数来获取的),__proto__这个属性
    //构造函数中并没有sex和age的两个属性

    /*
    *
    * 实例对象中有个属性,__proto__,也是对象,叫原型,不是标准的属性,浏览器使用的
    * 构造函数中有一个属性,prototype,也是对象,叫原型,是标准属性,程序员使用
    *
    * 原型---->__proto__或者是prototype,都是原型对象,
    * 原型的作用:共享数据,节省内存空间
    *
    *
    *
    *
    * */

  </script>
```
###5.体会面对过程和面对对象的编程思想
```
<style>
    div {
      width: 300px;
      height: 200px;
      background-color: red;
    }
</style>

</head>
<body>
    <input type="button" value="显示效果" id="btn"/>
    <div id="dv"></div>
<script src="common.js"></script>
<script>

  function ChangeStyle(btnObj, dvObj, json) {
    this.btnObj = btnObj;
    this.dvObj = dvObj;
    this.json = json;
  }
  ChangeStyle.prototype.init = function () {
    //点击按钮,改变div多个样式属性值
    var that = this;
    this.btnObj.onclick = function () {//按钮
      for (var key in that.json) {
        that.dvObj.style[key] = that.json[key];
      }
    };
  };

  //实例化对象


  var json = {"width": "500px", "height": "800px", "backgroundColor": "blue", "opacity": "0.2"};
  var cs = new ChangeStyle(my$("btn"), my$("dv"), json);
  cs.init();//调用方法

  //点击p标签,设置div的样式


</script>
```
###6.总结构造函数、实例对象、原型对象的关系
    * 构造函数可以实例化对象
    * 构造函数中有一个属性叫prototype,是构造函数的原型对象
    * 构造函数的原型对象(prototype)中有一个constructor构造器,这个构造器指向的就是自己所在的原型对象所在的构造函数
    * 实例对象的原型对象(__proto__)指向的是该构造函数的原型对象
    * 构造函数的原型对象(prototype)中的方法是可以被实例对象直接访问的
    
    
###7.函数的自调用及全局部变量（对象）变成全局变量（对象）
```
<script>

    //通过自调用函数产生一个随机数对象,在自调用函数外面,调用该随机数对象方法产生随机数
    (function (window) {
      //产生随机数的构造函数
      function Random() {
      }
      //在原型对象中添加方法
      Random.prototype.getRandom = function (min,max) {
        return Math.floor(Math.random()*(max-min)+min);
      };
      //把Random对象暴露给顶级对象window--->外部可以直接使用这个对象
      window.Random=Random;
    })(window);//可视为  (函数名（变量）{})(window);
    //实例化随机数对象
    var rm=new Random();
    //调用方法产生随机数
    console.log(rm.getRandom(0,5));


    //全局变量
  </script>
```
##第二块
###1.贪吃蛇案例
```
 <style>
    .map {
      width: 800px;
      height: 600px;
      background-color: #CCC;
      position: relative;
    }
  </style>
</head>
<body>
<!--画出地图,设置样式-->
<div class="map"></div>
<script>


  //自调用函数----食物的
  (function () {
    var elements = [];//用来保存每个小方块食物的
    //食物就是一个对象,有宽,有高,有颜色,有横纵坐标,先定义构造函数,然后创建对象
    function Food(x, y, width, height, color) {
      //横纵坐标
      this.x = x || 0;
      this.y = y || 0;
      //宽和高
      this.width = width || 20;
      this.height = height || 20;
      //背景颜色
      this.color = color || "green";
    }

    //为原型添加初始化的方法(作用：在页面上显示这个食物)
    //因为食物要在地图上显示,所以,需要地图的这个参数(map---就是页面上的.class=map的这个div)
    Food.prototype.init = function (map) {
      //先删除这个小食物
      //外部无法访问的函数
      remove();

      //创建div
      var div = document.createElement("div");
      //把div加到map中
      map.appendChild(div);
      //设置div的样式
      div.style.width = this.width + "px";
      div.style.height = this.height + "px";
      div.style.backgroundColor = this.color;
      //先脱离文档流
      div.style.position = "absolute";
      //随机横纵坐标
      this.x = parseInt(Math.random() * (map.offsetWidth / this.width)) * this.width;
      this.y = parseInt(Math.random() * (map.offsetHeight / this.height)) * this.height;
      div.style.left = this.x + "px";
      div.style.top = this.y + "px";

      //把div加入到数组elements中
      elements.push(div);
    };

    //私有的函数---删除食物的
    function remove() {
      //elements数组中有这个食物
      for (var i = 0; i < elements.length; i++) {
        var ele = elements[i];
        //找到这个子元素的父级元素,然后删除这个子元素
        ele.parentNode.removeChild(ele);
        //再次把elements中的这个子元素也要删除
        elements.splice(i, 1);
      }
    }

    //把Food暴露给Window,外部可以使用
    window.Food = Food;
  }());

  //自调用函数---小蛇
  (function () {
    var elements = [];//存放小蛇的每个身体部分
    //小蛇的构造函数
    function Snake(width, height, direction) {
      //小蛇的每个部分的宽
      this.width = width || 20;
      this.height = height || 20;
      //小蛇的身体
      this.body = [
        {x: 3, y: 2, color: "red"},//头
        {x: 2, y: 2, color: "orange"},//身体
        {x: 1, y: 2, color: "orange"}//身体
      ];
      //方向
      this.direction = direction || "right";
    }

    //为原型添加方法--小蛇初始化的方法
    Snake.prototype.init = function (map) {
      //先删除之前的小蛇
      remove();//===========================================

      //循环遍历创建div
      for (var i = 0; i < this.body.length; i++) {
        //数组中的每个数组元素都是一个对象
        var obj = this.body[i];
        //创建div
        var div = document.createElement("div");
        //把div加入到map地图中
        map.appendChild(div);
        //设置div的样式
        div.style.position = "absolute";
        div.style.width = this.width + "px";
        div.style.height = this.height + "px";
        //横纵坐标
        div.style.left = obj.x * this.width + "px";
        div.style.top = obj.y * this.height + "px";
        //背景颜色
        div.style.backgroundColor = obj.color;
        //方向暂时不定
        //把div加入到elements数组中----目的是为了删除
        elements.push(div);
      }
    };

    //为原型添加方法---小蛇动起来
    Snake.prototype.move = function (food, map) {
      //改变小蛇的身体的坐标位置
      var i = this.body.length - 1;//2
      for (; i > 0; i--) {
        this.body[i].x = this.body[i - 1].x;
        this.body[i].y = this.body[i - 1].y;
      }
      //判断方向---改变小蛇的头的坐标位置
      switch (this.direction) {
        case "right":
          this.body[0].x += 1;
          break;
        case "left":
          this.body[0].x -= 1;
          break;
        case "top":
          this.body[0].y -= 1;
          break;
        case "bottom":
          this.body[0].y += 1;
          break;
      }

      //判断有没有吃到食物
      //小蛇的头的坐标和食物的坐标一致
      var headX=this.body[0].x*this.width;
      var headY=this.body[0].y*this.height;
      //判断小蛇的头的坐标和食物的坐标是否相同
      if(headX==food.x&&headY==food.y){
        //获取小蛇的最后的尾巴
        var last=this.body[this.body.length-1];
        //把最后的蛇尾复制一个,重新的加入到小蛇的body中
        this.body.push({
          x:last.x,
          y:last.y,
          color:last.color
        });
        //把食物删除,重新初始化食物
        food.init(map);
      }
    }
    ;//删除小蛇的私有的函数=============================================================================
    function remove() {
      //删除map中的小蛇的每个div,同时删除elements数组中的每个元素,从蛇尾向蛇头方向删除div
      var i = elements.length - 1;
      for (; i >= 0; i--) {
        //先从当前的子元素中找到该子元素的父级元素,然后再弄死这个子元素
        var ele = elements[i];
        //从map地图上删除这个子元素div
        ele.parentNode.removeChild(ele);
        elements.splice(i, 1);
      }
    }

    //把Snake暴露给window,外部可以访问
    window.Snake = Snake;
  }());

  //自调用函数---游戏对象================================================
  (function () {

    var that = null;//该变量的目的就是为了保存游戏Game的实例对象-------

    //游戏的构造函数
    function Game(map) {
      this.food = new Food();//食物对象
      this.snake = new Snake();//小蛇对象
      this.map = map;//地图
      that = this;//保存当前的实例对象到that变量中-----------------此时that就是this
    }

    //初始化游戏-----可以设置小蛇和食物显示出来
    Game.prototype.init = function () {
      //初始化游戏
      //食物初始化
      this.food.init(this.map);
      //小蛇初始化
      this.snake.init(this.map);
      //调用自动移动小蛇的方法========================||调用了小蛇自动移动的方法
      this.runSnake(this.food, this.map);
      //调用按键的方法
      this.bindKey();//========================================
    };

    //添加原型方法---设置小蛇可以自动的跑起来
    Game.prototype.runSnake = function (food, map) {

      //自动的去移动
      var timeId = setInterval(function () {
        //此时的this是window
        //移动小蛇
        this.snake.move(food, map);
        //初始化小蛇
        this.snake.init(map);
        //横坐标的最大值
        var maxX = map.offsetWidth / this.snake.width;
        //纵坐标的最大值
        var maxY = map.offsetHeight / this.snake.height;
        //小蛇的头的坐标
        var headX = this.snake.body[0].x;
        var headY = this.snake.body[0].y;
        //横坐标
        if (headX < 0 || headX >= maxX) {
          //撞墙了,停止定时器
          clearInterval(timeId);
          alert("游戏结束");
        }
        //纵坐标
        if (headY < 0 || headY >= maxY) {
          //撞墙了,停止定时器
          clearInterval(timeId);
          alert("游戏结束");
        }
      }.bind(that), 150);
    };

    //添加原型方法---设置用户按键,改变小蛇移动的方向
    Game.prototype.bindKey=function () {

      //获取用户的按键,改变小蛇的方向
      document.addEventListener("keydown",function (e) {
        //这里的this应该是触发keydown的事件的对象---document,
        //所以,这里的this就是document
        //获取按键的值
        switch (e.keyCode){
          case 37:this.snake.direction="left";break;
          case 38:this.snake.direction="top";break;
          case 39:this.snake.direction="right";break;
          case 40:this.snake.direction="bottom";break;
        }
      }.bind(that),false);
    };

    //把Game暴露给window,外部就可以访问Game对象了
    window.Game = Game;
  }());



  //初始化游戏对象
  var gm = new Game(document.querySelector(".map"));

  //初始化游戏---开始游戏
  gm.init();
</script>
```
##第三块
###1.原型总结
原型作用之一:数据共享,节省内存空间
原型作用之二:为了实现继承

构造函数中的this就是实例对象,
原型对象中方法中的this就是实例对象,
原型的指向是可以改变的,
实例对象和原型对象之间的关系是通过__proto__原型来联系起来的,这个关系就是原型链。

```
//人的构造函数
    function Person(age) {
      this.age=10;
    }
    //人的原型对象方法
    Person.prototype.eat=function () {
      console.log("人的吃");
    };
    //学生的构造函数
    function Student() {

    }
    Student.prototype.sayHi=function () {
      console.log("嗨,小苏你好帅哦");
    };
    //学生的原型,指向了一个人的实例对象
    Student.prototype=new Person(10);
    var stu=new Student();
    stu.eat();
    stu.sayHi();
```
###2.组合继承
```
<script>


    //原型实现继承
    //借用构造函数实现继承
    //组合继承:原型继承+借用构造函数继承

    function Person(name,age,sex) {
      this.name=name;
      this.age=age;
      this.sex=sex;
    }
    Person.prototype.sayHi=function () {
      console.log("阿涅哈斯诶呦");
    };
    function Student(name,age,sex,score) {
      //借用构造函数:属性值重复的问题
      Person.call(this,name,age,sex);
      this.score=score;
    }
    //改变原型指向----继承
    Student.prototype=new Person();//不传值
    Student.prototype.eat=function () {
      console.log("吃东西");
    };
    var stu=new Student("小黑",20,"男","100分");
    console.log(stu.name,stu.age,stu.sex,stu.score);
    stu.sayHi();
    stu.eat();
    var stu2=new Student("小黑黑",200,"男人","1010分");
    console.log(stu2.name,stu2.age,stu2.sex,stu2.score);
    stu2.sayHi();
    stu2.eat();

    //属性和方法都被继承了
</script>
```
###3.小知识点
1.以后尽量使用函数的声明
```
var ff;//函数声明
    if(true){
      ff=function () {
        console.log("哈哈,我又变帅了");
      };
    }else{
      ff=function () {
        console.log("小苏好猥琐");
      };
    }
    ff();
```
原因：
1）函数声明如果放在if-else的语句中,在IE8的浏览器中会出现问题
2）以后宁愿用函数表达式,都不用函数声明

2.方法的本质是函数
```
var obj={
    sayHi:function(){
    }
};
```
###4.函数的this指向问题
```
<script>
      //普通函数
       function f1() {
         console.log(this);
       }
      f1();
      // 定时器中的this
       setInterval(function () {
         console.log(this);
       },1000);

    //构造函数
       function Person() {
         console.log(this);
    //对象的方法
         this.sayHi=function () {
           console.log(this);
         };
       }
    //原型中的方法
       Person.prototype.eat=function () {
         console.log(this);
       };
       var per=new Person();
       console.log(per);
       per.sayHi();
       per.eat();

    //BOM:中顶级对象是window,浏览器中所有的东西都是window的
    </script>
```
函数中的this的指向
     普通函数中的this是谁?-----window
     对象.方法中的this是谁?----当前的实例对象
     定时器方法中的this是谁?----window
     构造函数中的this是谁?-----实例对象
     原型对象方法中的this是谁?---实例对象

###5.函数调用的不同方式
```
  <script>

    //普通函数  函数名小写
    function f1() {
      console.log("文能提笔控萝莉");
    }
    f1();

    //构造函数---通过new 来调用,创建对象  函数名大写
    function F1() {
      console.log("我是构造函数,我骄傲");
    }
    var f=new F1();

    //对象的方法
    function Person() {
      this.play=function () {
        console.log("玩代码");
      };
    }
    var per=new Person();
    per.play();
    
    //数组的函数调用
    var arr=[
        function () {
          console.log("十一假期快乐");
        },
        function () {
          console.log("十一假期开心");
        }
        ,
        function () {
          console.log("十一假期健康");
        }
    ];
    //回调函数:函数作为参数使用
    arr.forEach(function (ele) {
      ele();
    });
  </script>
```
###6.函数也是对象
判断原理：
函数是对象,对象不一定是函数

    对象中有__proto__原型,是对象---对象有{}
    函数中有prototype原型,是对象
    
所有的函数实际上都是Function的构造函数创建出来的实例对象
```
<script>
var f1=new Function("num1","num2","return num1+num2");
   console.log(f1(10,20));
   console.log(f1.__proto__==Function.prototype);

    //所以,函数实际上也是对象

   console.dir(f1);
</script>
```
函数也是个数据类型
##第四块
###1.apply和call方法
作用:可以改变this的指向

apply使用方法：
函数.apply（对象,[参数,参数]);

call使用方法：
函数.call（对象,参数,参数);
```
    function Person(age,sex) {
      this.age=age;
      this.sex=sex;
    }
    //通过原型添加方法
    Person.prototype.sayHi=function (x,y) {
      console.log("您好啊:"+this.sex);
      return 1000;
    };
    var per=new Person(10,"男");
    per.sayHi();

    console.log("==============");
    function Student(name,sex) {
      this.name=name;
      this.sex=sex;
    }
    var stu=new Student("小明","人妖");
    var r1=per.sayHi.apply(stu,[10,20]);
    var r2=per.sayHi.call(stu,10,20);

    console.log(r1);
    console.log(r2);
```
apply和call方法实际上并不在函数这个实例对象中,而是在Function的prototype中
###2.bind的方法
函数.bind(对象,参数,参数）
通俗理解：改变了this的值（有这个动作的时候）并复制一份到被调用函数中。
* 函数名字.bind(对象,参数1,参数2,...);---->返回值是复制之后的这个函数
* 方法名字.bind(对象,参数1,参数2,...);---->返回值是复制之后的这个方法
```
   function Person(age) {
      this.age=age;
    }
    Person.prototype.play=function () {
      console.log(this+"====>"+this.age);
    };

    function Student(age) {
      this.age=age;
    }
    var per=new Person(10);
    var stu=new Student(20);
    //复制了一份
    var ff=per.play.bind(stu);
    ff();
```
###3.函数作为返回值使用的小例子
1.判断数据类型
作用：判断这个对象和传入的类型是不是同一个类型
```
    function getFunc(type) {
      return function (obj) {
        return Object.prototype.toString.call(obj) === type;
      }
    }

    var ff = getFunc("[object Array]");
    var result = ff([10, 20, 30]);
    console.log(result);

    var ff1 = getFunc("[object Object]");
    var dt = new Date();
    var result1 = ff1(dt);
    console.log(result1);
```
2.数组里排序
作用：排序，比冒泡排序更高级
```
    var arr = [1, 100, 20, 200, 40, 50, 120, 10];
    arr.sort(function (obj1,obj2) {
      if(obj1>obj2){
        return -1;
      }else if(obj1==obj2){
        return 0;
      }else{
        return 1;
      }
    });
    console.log(arr);

    var arr1=["acdef","abcd","bcedf","bced"];
    arr1.sort(function (a,b) {
      if(a>b){
        return 1;
      }else if(a==b){
        return 0;
      }else{
        return -1;
      }
    });
    console.log(arr1);
```
3.预解析
预解析:就是在浏览器解析代码之前,把变量的声明和函数的声明提前(提升)到该作用域的最上面
###4.闭包
* 闭包的概念:函数A中,有一个函数B,函数B中可以访问函数A中定义的变量或者是数据,此时形成了闭包(这句话暂时不严谨)
* 闭包的模式:函数模式的闭包,对象模式的闭包
* 闭包的作用:缓存数据,延长作用域链
* 闭包的优点和缺点:缓存数据
```
    //普通的函数
    function f1() {
      var num = 10;
      num++;
      return num;
    }
    console.log(f1());
    console.log(f1());
    console.log(f1());

    //函数模式的闭包
    function f2() {
      var num = 10;
      return function () {
        num++;
        return num;
      }
    }
    var ff = f2();//RETUAN 后可以在外面访问num的值 所以他是有缓存的
    console.log(ff());//11
    console.log(ff());//12
    console.log(ff());//13
```
闭包小案例
实现点赞
```
  //获取所有的按钮
  //根据标签名字获取元素
  function my$(tagName) {
    return document.getElementsByTagName(tagName);
  }
  //闭包缓存数据
  function getValue() {
    var value=2;
    return function () {
      //每一次点击的时候,都应该改变当前点击按钮的value值
      this.value="赞("+(value++)+")";
    }
  }
  //获取所有的按钮
  var btnObjs=my$("input");
  //循环遍历每个按钮,注册点击事件
  for(var i=0;i<btnObjs.length;i++){
    //注册事件
    btnObjs[i].onclick=getValue();
  }
```
###5.递归
递归:函数中调用函数自己,此时就是递归,递归一定要有结束的条件
1.理解递归
```
    //递归实现:求n个数字的和   n=5--->  5+4+3+2+1
    //函数的声明
  function getSum(x) 
  if(x==1){
       return 1
       }
      return x+getSum(x-1);
    }
    //函数的调用
    console.log(getSum(5)
```
* 执行过程:
* 代码执行getSum(5)--->进入函数,此时的x是5,执行的是5+getSum(4),此时代码等待
* 此时5+getSum(4),代码先不进行计算,先执行getSum(4),进入函数,执行的是4+getSum(3),等待, 先执行的是getSum(3),进入函数,执行3+getSum(2),等待,先执行getSum(2),进入函数,执行 2+getSum(1);等待, 先执行getSum(1),执行的是x==1的判断,return 1,所以,
* 此时getSum(1)的结果是1,开始向外走出去
* 2+getSum(1) 此时的结果是:2+1
* 执行:
* getSum(2)---->2+1
* 3+getSum(2) 此时的结果是3+2+1
* 4+getSum(3) 此时的结果是4+3+2+1
* 5+getSum(4) 此时的结果是5+4+3+2+1
* 结果:15

2.深化递归===>斐波那契数列
```
    function getFib(x) {
      if(x==1||x==2){
        return 1
      }
      return getFib(x-1)+getFib(x-2);
    }
    console.log(getFib(12));
```
##第五块
###1.浅拷贝
浅拷贝:拷贝就是复制,就相当于把一个对象中的所有的内容,复制一份给另一个对象,直接复制,或者说,就是把一个对象的***地址***给了另一个对象,他们指向相同,两个对象之间有共同的属性或者方法,都可以使用
```
<script>
    var obj1={
      age:10,
      sex:"男",
      car:["奔驰","宝马","特斯拉","奥拓"]
    };
    //另一个对象
    var obj2={};
    
    //写一个函数,作用:把一个对象的属性复制到另一个对象中,浅拷贝
    //把a对象中的所有的属性复制到对象b中
    function extend(a,b) {
      for(var key in a){
        b[key]=a[key];
      }
    }
    extend(obj1,obj2);
    console.dir(obj2);//开始的时候这个对象是空对象
    console.dir(obj1);//有属性
</script>
```
###2.深拷贝
深拷贝:拷贝还是复制,深:把一个对象中所有的属性或者方法,一个一个的找到.并且在另一个对象中开辟相应的空间,一个一个的存储到另一个对象中
```
<script>
    var obj1={
      age:10,
      sex:"男",
      car:["奔驰","宝马","特斯拉","奥拓"],
      dog:{
        name:"大黄",
        age:5,
        color:"黑白色"
      }
    };

    var obj2={};//空对象
    //通过函数实现,把对象a中的所有的数据深拷贝到对象b中
    function extend(a,b) {
      for(var key in a){
        //先获取a对象中每个属性的值
        var item=a[key];
        //判断这个属性的值是不是数组
        if(item instanceof Array){
          //如果是数组,那么在b对象中添加一个新的属性,并且这个属性值也是数组
          b[key]=[];
          //调用这个方法，把a对象中这个数组的属性值一个一个的复制到b对象的这个数组属性中
          extend(item,b[key]);
        }else if(item instanceof Object){//判断这个值是不是对象类型的
     //如果是对象类型的,那么在b对象中添加一个属性,是一个空对象
          b[key]={};
          //再次调用这个函数,把a对象中的属性对象的值一个一个的复制到b对象的这个属性对象中
          extend(item,b[key]);
        }else{
          //如果值是普通的数据,直接复制到b对象的这个属性中
          b[key]=item;
        }
      }
    }

    extend(obj1,obj2);
    console.dir(obj1);
    console.dir(obj2);
</script>
```
###3.遍历DOM树
 第一个函数:给我根节点,我会找到所有的子节点:forDOM(根节点)
 获取这个根节点的子节点
 var children=根节点的.children
 调用第二个函数

 第二个函数:给我所有的子节点,我把每个子节点的名字显示出来(children)
 for(var i=0;i<children.length;i++){
   每个子节点
   var child=children[i];
   f1(child);给我节点,我显示该节点的名字
   child是子节点,但是如果child里面还有子节点,此时child就是爹了
   child.children&&第一个函数(child)

```
<script>
  //获取页面中的根节点--根标签
  var root=document.documentElement;//html
  //函数遍历DOM树
  //根据根节点,调用fn的函数,显示的是根节点的名字
  function forDOM(root1) {
    //调用f1,显示的是节点的名字
   // f1(root1);
    //获取根节点中所有的子节点
    var children=root1.children;
    //调用遍历所有子节点的函数
    forChildren(children);
  }
  //给我所有的子节点,我把这个子节点中的所有的子节点显示出来
  function forChildren(children) {
    //遍历所有的子节点
    for(var i=0;i<children.length;i++){
      //每个子节点
      var child=children[i];
      //显示每个子节点的名字
      f1(child);
      //判断child下面有没有子节点,如果还有子节点,那么就继续的遍历
      child.children&&forDOM(child);
    }
  }
  //函数调用,传入根节点
  forDOM(root);
  function f1(node) {
    console.log("节点的名字:"+node.nodeName);
  }

  //节点:nodeName,nodeType,nodeValue
  </script>
```
###4.正则表达式
正则表达式:也叫规则表达式,按照一定的规则组成的一个表达式,这个表达式的作用主要是匹配字符串的,
正则表达式的作用:匹配字符串的，在大多数编程语言中都可以使用
正则表达式的组成:是由元字符或者是限定符组成的一个式子

1. .表示的是:除了\n以外的任意的一个字符
2. [] 表示的是:范围,
3. [0-9] 表示的是0到9之间的任意的一个数字,  "789" [0-9]
4. [1-7] 表示的是1到7之间的任意的一个数字
5. [a-z] 表示的是:所有的小写的字母中的任意的一个
6. [A-Z] 表示的是:所有的大写的字母中的任意的一个
7. [a-zA-Z] 表示的是:所有的字母的任意的一个
8. [0-9a-zA-Z] 表示的是: 所有的数字或者是字母中的一个
9. [] 另一个函数: 把正则表达式中元字符的意义干掉    [.] 就是一个.
10. | 或者     [0-9]|[a-z] 表示的是要么是一个数字,要么是一个小写的字母
11. () 分组 提升优先级   [0-9]|([a-z])|[A-Z]
12. ([0-9])([1-5])([a-z]) 三组, 从最左边开始计算
13. (()(()))
```
//写正则表达式,根据字符串来写正则表达式进行匹配

//经验: 1.找规律 2.不要追求完美

//身份证的正则表达式:15位或者18位
([1-9][0-9]{14})|([1-9][0-9]{16}[0-9xX])

//座机号码的正则表达式
010-19876754
0431-87123490
[0-9]{3,4}[-][0-9]{8}
\d{3,4}[-]\d{8}
\d{3,4}[-][0-9]{8}

2.qq号码的正则表达式
[1-9][0-9]{4,10}
\d{5,11}

3.手机号码的正则表达式
130 131 132 133 134 135 136 137 138 139
143 147
150 151 152 153 154 155 156 157 158 159
170 171 173 176 177
180 181 182 183 184 185 186 187 188 189
([1][358][0-9][0-9]{8})|([1][4][37][0-9]{8})|([1][7][01367][0-9]{8})
\d{11}

4.邮箱的正则表达式,必须要记住的
sd2113_3.-fd@itcast.com.cn
[0-9a-zA-Z_.-]+[@][0-9a-zA-Z_.-]+([.][a-zA-Z]+){1,2}
```

1. *表示的是:前面的表达式出现了0次到多次
2. [a-z][0-9]* 小写字母中的任意一个 后面是要么是没有数字的,要么是多个数字的
3. "fdsfs3223323"  [a-z][0-9]*
4.  +表示的是:前面的表达式出现了1次到多次
5. [a-z][9]+  小写字母一个后面最少一个9,或者多个9
6. "fesfewww9fefds"
7. ?  表示的是:前面的表达式出现了0次到1次,最少是0次,最多1次 ,另一个含义:阻止贪婪模式
8. [4][a-z]? "1231234ij"
9. 限定符:限定前面的表达式出现的次数
10. {} 更加的明确前面的表达式出现的次数
11. {0,} 表示的是前面的表达式出现了0次到多次,和 *一样的
12. {1,} 表示的是前面的表达式出现了1次到多次,和 +一样的
13. {0,1} 表示的是前面的表达式出现了0次到1次,和 ?一样的
14. {5,10} 表示的是前面的表达式出现了5次到10次
15. {4} 前面的表达式出现了4次
16. {,10} 错误的========不能这么写
17. ^ 表示的是以什么开始,或者是取非(取反) ^[0-9] 以数字开头
18. ^[a-z] 以小写字母开始
19. [^0-9] 取反,非数字
20. [^a-z] 非小写字母
21. [^0-9a-zA-Z_]
22. $ 表示的是以什么结束   [0-9][a-z]$  必须以小写字母结束
23. ^[0-9][a-z] 相当于是严格模式   "3f2432e"  "4f"
24. \d 数字中的任意一个,
25. \D 非数字中的一个
26. \s 空白符中的一个
27. \S 非空白符
28. \w 非特殊符号
29. \W 特殊符号
30. \b 单词的边界

2.正则表达式在JavaScript中
```
<script>
//最简模式
console.log(/[a-zA-Z]+/.test("hello"));

//其他
   console.log(/./.test("除了回车换行以为的任意字符"));//true
   console.log(/.*/.test("0个到多个"));//true
   console.log(/.+/.test("1个到多个"));//true
   console.log(/.?/.test("哈哈"));//true
   console.log(/[0-9]/.test("9527"));//true
   console.log(/[a-z]/.test("what"));//true
   console.log(/[A-Z]/.test("Are"));//true
   console.log(/[a-zA-Z]/.test("干啥子"));//false
   console.log(/[0-9a-zA-Z]/.test("9ebg"));//true
   console.log(/b|(ara)/.test("abra"));//true
   console.log(/[a-z]{2,3}/.test("arfsf"));//
</script>
```
判断邮箱
```
<script>
  //如果输入的是邮箱,那么背景颜色为绿色,否则为红色

  //获取文本框,注册失去焦点的事件
  document.getElementById("email").onblur = function () {
    //判断这个文本框中输入的是不是邮箱
    var reg = /^[0-9a-zA-Z_.-]+[@][0-9a-zA-Z_.-]+([.][a-zA-Z]+){1,2}$/;
    if (reg.test(this.value)) {
      this.style.backgroundColor = "green";
    } else {
      this.style.backgroundColor = "red";
    }
  };
</script>
```
大型案例js代码
```
<script>

  //qq的
  checkInput(my$("qq"),/^\d{5,11}$/);
  //手机
  checkInput(my$("phone"),/^\d{11}$/);
  //邮箱
  checkInput(my$("e-mail"),/^[0-9a-zA-Z_.-]+[@][0-9a-zA-Z_.-]+([.][a-zA-Z]+){1,2}$/);
  //座机号码
  checkInput(my$("telephone"),/^\d{3,4}[-]\d{7,8}$/);
  //中文名字
  checkInput(my$("fullName"),/^[\u4e00-\u9fa5]{2,6}$/);
  //给我文本框,给我这个文本框相应的正则表达式,我把结果显示出来
  //通过正则表达式验证当前的文本框是否匹配并显示结果
  function checkInput(input,reg) {
    //文本框注册失去焦点的事件
    input.onblur=function () {
      if(reg.test(this.value)){
        this.nextElementSibling.innerText="正确了";
        this.nextElementSibling.style.color="green";
      }else{
        this.nextElementSibling.innerText="让你得瑟,错了吧";
        this.nextElementSibling.style.color="red";
      }
    };
  }

</script>
```
其他方法的使用
正则表达式中:g 表示的是全局模式
匹配正则表达式中:i 表示的是忽略大小写
```
<script>
    var str = "中国移动:10086,中国联通:10010,中国电信:10000";
    var reg=/\d{5}/g;
    //通过正则表达式匹配这个字符串
    var array=reg.exec(str);
    while (array!=null){
      //输出匹配的内容
      console.log(array[0]);
      array=reg.exec(str);
    }
</script>
```
###5.伪数组
伪数组和数组的区别
真数组的长度是可变的
伪数组的长度不可变
真数组可以使用数组中的方法
伪数组不可以使用数组中的方法

数组实例对象的____proto____----->Array的prototype
