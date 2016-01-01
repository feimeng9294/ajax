<?php
//告诉浏览器返回的格式是xml格式
header("Content-Type: text/xml;charset=utf-8");
//告诉浏览器不要缓存
header("Cache-Control: no-cache");

include("library/messagemodel.class.php");

if(isset($_POST['username'])){
	$username=$_POST['username'];
}
if(isset($_POST['gettername'])){
	$gettername=$_POST['gettername'];
}
if(isset($_POST['content'])){
	$content=$_POST['content'];
}

//将拼装的语句写入到日志文件中,方便随时调试
//$temp="用户->".$username."接收->".$gettername.'内容->'.$content."\r\n";
//file_put_contents("current.log",$temp,FILE_APPEND);//FILE_APPEND标志表示追加写入

$messagemodel=new messagemodel();

//如果发送内容为空，则不住数据库中添加
if(!empty($content)){
    $messagemodel->add($username,$gettername,$content);
}

$messageinfo=$messagemodel->get($username,$gettername);
echo $messageinfo;//只需echo即将结果打回给ajax引擎
//file_put_contents("current.log",$messageinfo,FILE_APPEND);