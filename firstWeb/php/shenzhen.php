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
    'name' => '深圳1',
    'speak' => 'shagnhai/风格各异的中外建筑，如海天堂构、黄荣远堂等s',
    'img'  => './images/1.jpg'
  ),
  array(
    'id' => 2,
    'name' => '深圳2',
    'speak' => 'shagnhai、 风格各异的中外建筑，如海天堂构、黄荣远堂等s',
    'img'  => './images/2.jpg'
  ),
  array(
    'id' => 3,
    'name' => '深圳3',
    'speak' => '这里荟萃了上千座中西合璧、 shagnhai，如海天堂构、黄荣远堂等s',
    'img'  => './images/3.jpg'
  ),
  array(
    'id' => 4,
    'name' => '深圳4',
    'speak' => '这里荟萃了上千座中西合璧、 风格各异的中外建筑，shagnhai、黄荣远堂等s',
    'img'  => './images/4.jpg'
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