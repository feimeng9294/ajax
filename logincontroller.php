<?php
//登入控制器
if(isset($_POST['username'])){
	$username=$_POST['username'];
}
if(isset($_POST['password'])){
	$password=$_POST['password'];
}
//对用户身份进行验证，不合法则跳转到登入首页，合法则转到聊天页
if(true){
	//身份验证通过则将username登入用户写入session 
	session_start();
	$_SESSION['username']=$username;
	//跳转到好友列表页
	header("Location: friendslist.php");
}else{
	//登入失败，重新登入
	header("Location: login.php");
}