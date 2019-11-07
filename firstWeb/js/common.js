/**
 * 根据id的属性值，返回对应的标签元素
 * @param id id的属性值，string类型的
 * @returns {HTMLElement} 元素对象
 */
function my$(id) {
    return document.getElementById(id)
}

function setInnerText(element, text) {
    if (typeof element.textContent == "undefined") {
        element.innerText = text;
    } else {
        element.textContent = text;
    }

    function getInnerText(element) {
        if (typeof element.textContent == "undefined") {
            return element.innerText;
        } else {
            return element.textContent;
        }

    }

}

//获取任意一个父级元素的第一个子级元素
function getFirstElementChild(element) {
    if (element.firstElementChild) {
        return element.firstElementChild
    } else {
        var node = element.firstChild;
        while (node && node.nodeType != 1) {
            node = node.nextSibling;
        }
        return node;
    }
}

//获取任意一个父级元素的最后一个子级元素
function getLastElementChild(element) {
    if (element.lastElementChild) {
        return element.lastElementChild
    } else {
        var node = element.lastChild;
        while (node && node.lastChild) {
            node = node.previousSibling;
        }
        return node;
    }
}

//为元素绑定任意事件，
function addEventListener(element,type,fn) {
    //判断浏览器是否支持这个方法
    if(element.addEventListener()){
        element.addEventListener(type,fn,false);
    }else if(element.attachEvent){
        element.attachEvent("on"+type,fn);
    }else{
        element["on"+type]=fn;
    }
}

/*
* element---任意的元素
* attr---属性
* */
function getAttrValue(element,attr) {
    return element.currentStyle?element.currentStyle[attr] : window.getComputedStyle(element,null)[attr]||0;
}



/*
* element----要移动的元素
* target----移动的目标
* 初级版本
* */
/*
* 终极版本的动画函数---有bug
*
* */
function animate(element,json,fn) {
    clearInterval(element.timeId);
    element.timeId=setInterval(function () {
        var flag=true;//假设都达到了目标
        for(var attr in json){
            if(attr=="opacity"){//判断属性是不是opacity
                var current= getAttrValue(element,attr)*100;
                //每次移动多少步
                var target=json[attr]*100;//直接赋值给一个变量,后面的代码都不用改
                var step=(target-current)/10;//(目标-当前)/10
                step=step>0?Math.ceil(step):Math.floor(step);
                current=current+step;
                element.style[attr]=current/100;
            }else if(attr=="zIndex"){//判断属性是不是zIndex
                element.style[attr]=json[attr];
            }else{//普通的属性

                //获取当前的位置----getAttrValue(element,attr)获取的是字符串类型
                var current= parseInt(getAttrValue(element,attr))||0;
                //每次移动多少步
                var target=json[attr];//直接赋值给一个变量,后面的代码都不用改
                var step=(target-current)/10;//(目标-当前)/10
                step=step>0?Math.ceil(step):Math.floor(step);
                current=current+step;
                element.style[attr]=current+"px";
            }
            if(current!=target){
                flag=false;//如果没到目标结果就为false
            }
        }
        if(flag){//结果为true
            clearInterval(element.timeId);
            if(fn){//如果用户传入了回调的函数
                fn(); //就直接的调用,
            }
        }
        console.log("target:"+target+"current:"+current+"step:"+step);
    },10);
}
