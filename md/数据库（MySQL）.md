##数据库（MySQL） 
###**一：初始化**
1.下载
https://dev.mysql.com/downloads/mysql/

2.安装（cmd）
1）C:\Windows\system32>cd C:\Develop\mysql\bin（安装路径）

2）C:\Develop\mysql\bin>mysqld --initialize --user=mysql --console （会有密码出现）

3）C:\Develop\mysql\bin>mysqld --install MySQL      >yn=NTdrq464
    Service successfully installed.
    
4）C:\Develop\mysql\bin>net start MySQL
MySQL 服务正在启动 .
MySQL 服务已经启动成功。

5）C:\Develop\mysql\bin>mysql -u root -p
Enter password: ************  （输入最开始的密码）

6）mysql> set password for root@localhost = password('123456');（修改密码 不行的话下一个）
Query OK, 0 rows affected, 1 warning (0.00 sec)

6.1）ALTER USER 'root'@'localhost' IDENTIFIED BY '新密码';
    
7）mysql> exit;
Bye

8）C:\Develop\mysql\bin>mysql -u root -p
Enter password: ****** （新的密码）

9）mysql> show databases;
+--------------------+
| Database           |
+--------------------+
| information_schema |
| mysql              |
| performance_schema |
| sys                |
+--------------------+
4 rows in set (0.00 sec)

10）mysql> exit;
Bye

//兼容问题
11）mysql -u root -p

12) use mysql

13) ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY '123456';

14) FLUSE PRIVILEGES;


###**二：基本查询语句**
1.查询语句
select `内容` from 数据库;

2.新增语句
insert into users value (1,2,3,`我爱你`);
insert into users values (1,2,3,`我爱你`);
insert into users (`列名`,`列名`,`列名`,`列名`) value (1,2,3,`我爱你`);

3.删除语句
delete from users where title ='ufo' and id >1;
delete from users where id in(1,2,3,4);

4.更新语句
updata users set title = 'ceo',name='zhangsan' where id = 1;

5.count语句(输出id的个数)
select count(id) from user;

6.limit语句（限制数据的长度）
select * from user limit 2;

select * from user limit 4,2;(从索引为4开始取两个数据长度)

skip=（page-1）* length；

###**三：php请求MySQL**
1.先配置php.ini 
解开：entension php_mysqli_

2.php代码执行语句连接数据库
```
$connectsion=mysqli_connect('127.0.0.1','root',‘密码’,'数据库')；
if(!$connectsion){
    exit("连接数据库错误。");
} 
```

3.一般流程
连接到查询
```
<?php 

//编码方式
header ( "Content-type:text/html;charset=utf-8" );


//查询数据库
$conn=mysqli_connect('localhost','root','123456','demo');
//编码
//mysqli_set_charset($conn,'utf8');

//判断库
if (!$conn) {
	echo "连接数据库失败！";
}
//查询表
$query=mysqli_query($conn,'select * from id_name ;');
//判断表
if (!$query) {
	echo "查询数据失败！";
}
//遍历表
while($row=mysqli_fetch_assoc($query)){
	var_dump($row);
}

//释放查询结果集
mysqli_free_result($query);
//关闭连接数据库
mysql_close($conn);
```

中文问题
使用 iconv('utf-8','gbk','原始文件')