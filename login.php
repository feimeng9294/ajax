<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="library/bootstrap.css"/>
<script type="text/javascript" src="library/bootstrap.js"></script>
<title>欢迎使用聊天工具</title>
<style type="text/css">
* {
	margin:0px;
	padding:0px;
}
.center {
margin-top:150px;
padding-left:500px;
}
</style>
</head>

<body>
<div class="container center">
<form action="logincontroller.php" method="post" class="form-horizontal">
<h3>欢迎使用聊天工具</h3>

<fieldset>
<div class="control-group">
<label for="username" class="control-label">用户名</label>
<div class="controls">
<input type="text" name="username" value="" id="username" placeholder="请输入用户名"/>
</div>
</div>

<div class="control-group">
<label for="password" class="control-label">密码</label>
<div class="controls">
<input type="password" name="password" value="" id="password" placeholder="请输入密码"/>
</div>
</div>
</fieldset>

<div class="btn-group">
<button class="btn btn-primary" type="submit">登入</button>
<a href="register.php" target="blank" class="btn btn-danger">注册</a>
</div>
</form>
</div>
</body>
</html>
