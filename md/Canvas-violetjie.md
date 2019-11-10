# Canvas

---
##一：基本使用
```
    <style>
        canvas {
            border: 1px solid #ccc;
        }
    </style>
    
    //设置画布大小
    <canvas width="600" height="400"></canvas>
    
    //基本结构
    <script>
    var myCanvas = document.querySelector('canvas');
    var ctx = myCanvas.getContext('2d');
    </script>
```

##二：不同的绘制方法
###1.绘制镂空四边形（原理出发）
```
//思想：
//一个四边形里套一个四边形
ctx.moveTo(100,100);
    ctx.lineTo(300,100);
    ctx.lineTo(300,300);
    ctx.lineTo(100,300);
    ctx.closePath();

    ctx.moveTo(150,150);
    ctx.lineTo(150,250);
    ctx.lineTo(250,250);
    ctx.lineTo(250,150);
    ctx.closePath();
    
    /*在填充的时候回遵循非零环绕规则*/
    ctx.fillStyle = 'red';
    ctx.fill();
```

###1.1绘制四边形（api出发）
```
//思想：
//绘制矩形路径 不是独立路径
    ctx.rect(100,100,200,100);
    ctx.fillStyle = 'green';
    ctx.stroke();
    ctx.fill();

//绘制矩形  有自己的独立路径
ctx.strokeRect(100,100,200,100);//描边形状
ctx.fillRect(100,100,200,100);//填充形状


//清除矩形的内容（清除画布所有的东西）
ctx.clearRect(0,0,ctx.canvas.width,ctx.canvas.height);
```


###2.绘制渐变（原理出发）
```
//思想：
/*绘制一个矩形*/
/*线是由点构成的*/

    ctx.lineWidth = 30;
    for (var i = 0; i < 255; i++) {
        ctx.beginPath();
        ctx.moveTo(100+i-1,100);
        ctx.lineTo(100+i,100);
        ctx.strokeStyle = 'rgb('+i+',0,0)';
        ctx.stroke();
    }

```

###2.1绘制渐变（api出发）
```
//思想：
//回顾：div的渐变方法

.linearGradient{
            width: 400px;
            height: 100px;
            background-image: linear-gradient(to right,pink,blue);
        }
        
<div class="linearGradient"></div>

//借鉴：
//canvas中是否有类似的api呢？

//设置填充样式前面两个开始位置，后面两个结束位置。
var linearGradient = ctx.createLinearGradient(100,100,500,400);

//开始的颜色为’pink‘ 为0%
linearGradient.addColorStop(0,'pink');

//结束的颜色为’blue‘ 为100%
linearGradient.addColorStop(1,'blue');
 
//调用颜色的填充样式
ctx.fillStyle = linearGradient;

//使用fillStyle中的颜色填充形状
//x，y，宽度，高度。
ctx.fillRect(100,100,400,100);
 
```

##三.折线图
```
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <style>
        canvas {
            border: 1px solid #ccc;
        }
    </style>
</head>
<body>
<canvas width="600" height="400"></canvas>
<script>
    /*1.构造函数*/
    var LineChart = function (ctx) {
        /*获取绘图工具*/
        this.ctx = ctx || document.querySelector('canvas').getContext('2d');
        /*画布的大小*/
        this.canvasWidth = this.ctx.canvas.width;
        this.canvasHeight = this.ctx.canvas.height;
        /*网格的大小*/
        this.gridSize = 10;
        /*坐标系的间距*/
        this.space = 20;
        /*坐标原点*/
        this.x0 = this.space;
        this.y0 = this.canvasHeight - this.space;
        /*箭头的大小*/
        this.arrowSize = 10;
        /*绘制点*/
        this.dottedSize = 6;
        /*点的坐标 和数据有关系  数据可视化*/
    }
    /*2.行为方法*/
    LineChart.prototype.init = function (data) {
        this.drawGrid();
        this.drawAxis();
        this.drawDotted(data);
    };
    /*绘制网格*/
    LineChart.prototype.drawGrid = function () {
        /*x方向的线*/
        var xLineTotal = Math.floor(this.canvasHeight / this.gridSize);
        this.ctx.strokeStyle = '#eee';
        for (var i = 0; i <= xLineTotal; i++) {
            this.ctx.beginPath();
            this.ctx.moveTo(0, i * this.gridSize - 0.5);
            this.ctx.lineTo(this.canvasWidth, i * this.gridSize - 0.5);
            this.ctx.stroke();
        }
        /*y方向的线*/
        var yLineTotal = Math.floor(this.canvasWidth / this.gridSize);
        for (var i = 0; i <= yLineTotal; i++) {
            this.ctx.beginPath();
            this.ctx.moveTo(i * this.gridSize - 0.5, 0);
            this.ctx.lineTo(i * this.gridSize - 0.5, this.canvasHeight);
            this.ctx.stroke();
        }
    };
    /*绘制坐标系*/
    LineChart.prototype.drawAxis = function () {
        /*X轴*/
        this.ctx.beginPath();
        this.ctx.strokeStyle = '#000';
        this.ctx.moveTo(this.x0, this.y0);
        this.ctx.lineTo(this.canvasWidth - this.space, this.y0);
        this.ctx.lineTo(this.canvasWidth - this.space - this.arrowSize, this.y0 + this.arrowSize / 2);
        this.ctx.lineTo(this.canvasWidth - this.space - this.arrowSize, this.y0 - this.arrowSize / 2);
        this.ctx.lineTo(this.canvasWidth - this.space, this.y0);
        this.ctx.stroke();
        this.ctx.fill();
        /*Y轴*/
        this.ctx.beginPath();
        this.ctx.strokeStyle = '#000';
        this.ctx.moveTo(this.x0, this.y0);
        this.ctx.lineTo(this.space, this.space);
        this.ctx.lineTo(this.space + this.arrowSize / 2, this.space + this.arrowSize);
        this.ctx.lineTo(this.space - this.arrowSize / 2, this.space + this.arrowSize);
        this.ctx.lineTo(this.space, this.space);
        this.ctx.stroke();
        this.ctx.fill();
    };
    /*绘制所有点*/
    LineChart.prototype.drawDotted = function (data) {
        /*1.数据的坐标 需要转换 canvas坐标*/
        /*2.再进行点的绘制*/
        /*3.把线连起来*/
        var that = this;
        /*记录当前坐标*/
        var prevCanvasX = 0;
        var prevCanvasY = 0;
        data.forEach(function (item, i) {
            /* x = 原点的坐标 + 数据的坐标 */
            /* y = 原点的坐标 - 数据的坐标 */
            var canvasX = that.x0 + item.x;
            var canvasY = that.y0 - item.y;
            /*绘制点*/
            that.ctx.beginPath();
            that.ctx.moveTo(canvasX - that.dottedSize / 2, canvasY - that.dottedSize / 2);
            that.ctx.lineTo(canvasX + that.dottedSize / 2, canvasY - that.dottedSize / 2);
            that.ctx.lineTo(canvasX + that.dottedSize / 2, canvasY + that.dottedSize / 2);
            that.ctx.lineTo(canvasX - that.dottedSize / 2, canvasY + that.dottedSize / 2);
            that.ctx.closePath();
            that.ctx.fill();
            /*点的连线*/
            /*当时第一个点的时候 起点是 x0 y0*/
            /*当时不是第一个点的时候 起点是 上一个点*/
            if(i == 0){
                that.ctx.beginPath();
                that.ctx.moveTo(that.x0,that.y0);
                that.ctx.lineTo(canvasX,canvasY);
                that.ctx.stroke();
            }else{
                /*上一个点*/
                that.ctx.beginPath();
                that.ctx.moveTo(prevCanvasX,prevCanvasY);
                that.ctx.lineTo(canvasX,canvasY);
                that.ctx.stroke();
            }
            /*记录当前的坐标，下一次要用*/
            prevCanvasX = canvasX;
            prevCanvasY = canvasY;
        });
    };
    /*3.初始化*/
    var data = [
        {
            x: 100,
            y: 120
        },
        {
            x: 200,
            y: 160
        },
        {
            x: 300,
            y: 240
        },
        {
            x: 400,
            y: 120
        },
        {
            x: 500,
            y: 80
        }
    ];
    var lineChart = new LineChart();
    lineChart.init(data);
</script>
</body>
</html>
```
##四.饼状图
```
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <style>
        canvas {
            border: 1px solid #ccc;
            display: block;
            margin: 100px auto;
        }
    </style>
</head>
<body>
<canvas width="600" height="400"></canvas>
<script>
    /*var myCanvas = document.querySelector('canvas');
    var ctx = myCanvas.getContext('2d');*/

    /*1.绘制饼状态图*/
    /*1.1 根据数据绘制一个饼图*/
    /*1.2 绘制标题 从扇形的弧中心伸出一条线在画一条横线在横线的上面写上文字标题*/
    /*1.3 在画布的左上角 绘制说明 一个和扇形一样颜色的矩形 旁边就是文字说明*/

    var PieChart = function (ctx) {
        /*绘制工具*/
        this.ctx = ctx || document.querySelector('canvas').getContext('2d');
        /*绘制饼图的中心*/
        this.w = this.ctx.canvas.width;
        this.h = this.ctx.canvas.height;
        /*圆心*/
        this.x0 = this.w / 2 + 60;
        this.y0 = this.h / 2;
        /*半径*/
        this.radius = 150;
        /*伸出去的线的长度*/
        this.outLine = 20;
        /*说明的矩形大小*/
        this.rectW = 30;
        this.rectH = 16;
        this.space = 20;
    }
    PieChart.prototype.init = function (data) {
        /*1.准备数据*/
        this.drawPie(data);
    };
    PieChart.prototype.drawPie = function (data) {
        var that = this;
        /*1.转化弧度*/
        var angleList = this.transformAngle(data);
        /*2.绘制饼图*/
        var startAngle = 0;
        angleList.forEach(function (item, i) {
            /*当前的结束弧度要等于下一次的起始弧度*/
            var endAngle = startAngle + item.angle;
            that.ctx.beginPath();
            that.ctx.moveTo(that.x0, that.y0);
            that.ctx.arc(that.x0, that.y0, that.radius, startAngle, endAngle);
            var color = that.ctx.fillStyle = that.getRandomColor();
            that.ctx.fill();
            /*下一次要使用当前的这一次的结束角度*/
            /*绘制标题*/
            that.drawTitle(startAngle, item.angle, color , item.title);
            /*绘制说明*/
            that.drawDesc(i,item.title);
            startAngle = endAngle;
        });
    };
    PieChart.prototype.drawTitle = function (startAngle, angle ,color , title) {
        /*1.确定伸出去的线 通过圆心点 通过伸出去的点  确定这个线*/
        /*2.确定伸出去的点 需要确定伸出去的线的长度*/
        /*3.固定伸出去的线的长度*/
        /*4.计算这个点的坐标*/
        /*5.需要根据角度和斜边的长度*/
        /*5.1 使用弧度  当前扇形的起始弧度 + 对应的弧度的一半 */
        /*5.2 半径+伸出去的长度 */
        /*5.3 outX = x0 + cos(angle) * ( r + outLine)*/
        /*5.3 outY = y0 + sin(angle) * ( r + outLine)*/
        /*斜边*/
        var edge = this.radius + this.outLine;
        /*x轴方向的直角边*/
        var edgeX = Math.cos(startAngle + angle / 2) * edge;
        /*y轴方向的直角边*/
        var edgeY = Math.sin(startAngle + angle / 2) * edge;
        /*计算出去的点坐标*/
        var outX = this.x0 + edgeX;
        var outY = this.y0 + edgeY;
        this.ctx.beginPath();
        this.ctx.moveTo(this.x0, this.y0);
        this.ctx.lineTo(outX, outY);
        this.ctx.strokeStyle = color;
        /*画文字和下划线*/
        /*线的方向怎么判断 伸出去的点在X0的左边 线的方向就是左边*/
        /*线的方向怎么判断 伸出去的点在X0的右边 线的方向就是右边*/
        /*结束的点坐标  和文字大小*/
        this.ctx.font = '14px Microsoft YaHei';
        var textWidth = this.ctx.measureText(title).width ;
        if(outX > this.x0){
            /*右*/
            this.ctx.lineTo(outX + textWidth,outY);
            this.ctx.textAlign = 'left';
        }else{
            /*左*/
            this.ctx.lineTo(outX - textWidth,outY);
            this.ctx.textAlign = 'right';
        }
        this.ctx.stroke();
        this.ctx.textBaseline = 'bottom';
        this.ctx.fillText(title,outX,outY);

    };
    PieChart.prototype.drawDesc = function (index,title) {
        /*绘制说明*/
        /*矩形的大小*/
        /*距离上和左边的间距*/
        /*矩形之间的间距*/
        this.ctx.fillRect(this.space,this.space + index * (this.rectH + 10),this.rectW,this.rectH);
        /*绘制文字*/
        this.ctx.beginPath();
        this.ctx.textAlign = 'left';
        this.ctx.textBaseline = 'top';
        this.ctx.font = '12px Microsoft YaHei';
        this.ctx.fillText(title,this.space + this.rectW + 10 , this.space + index * (this.rectH + 10));
    };
    PieChart.prototype.transformAngle = function (data) {
        /*返回的数据内容包含弧度的*/
        var total = 0;
        data.forEach(function (item, i) {
            total += item.num;
        });
        /*计算弧度 并且追加到当前的对象内容*/
        data.forEach(function (item, i) {
            var angle = item.num / total * Math.PI * 2;
            item.angle = angle;
        });
        return data;
    };
    PieChart.prototype.getRandomColor = function () {
        var r = Math.floor(Math.random() * 256);
        var g = Math.floor(Math.random() * 256);
        var b = Math.floor(Math.random() * 256);
        return 'rgb(' + r + ',' + g + ',' + b + ')';
    };

    var data = [
        {
            title: '15-20岁',
            num: 6
        },
        {
            title: '20-25岁',
            num: 30
        },
        {
            title: '25-30岁',
            num: 10
        },
        {
            title: '30以上',
            num: 8
        }
    ];

    var pieChart = new PieChart();
    pieChart.init(data);

</script>
</body>
</html>
```

