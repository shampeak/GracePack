<?php
include("../vendor/autoload.php");

//错误提示
$error_reporting       = E_ALL ^ E_NOTICE;
ini_set('error_reporting', $error_reporting);
//error_reporting(0);




echo 'Hello Grace';


$config = [
    'hostname'      => '127.0.0.1',         //服务器地址
    'port'          => '3306',              //端口
    'username'      => 'root',              //用户名
    'password'      => 'root',              //密码
    'database'      => 'nw',                //数据库名
    'charset'       => 'utf8',              //字符集设置
    'pconnect'      => 1,                   //1  长连接模式 0  短连接
    'quiet'         => 0,                   //安静模式 生产环境的
    'slowquery'     => 1,                   //对慢查询记录
//        'rootpath'      => '../App/',
];

$db = new Grace\Db\Db($config);

$res = $db->getall("select * from dy_user");
print_r($res);


