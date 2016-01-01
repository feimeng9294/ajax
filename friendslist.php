<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>好友列表</title>
<style type="text/css">
* {
	margin:0px;
	padding:0px;
}
.main {
    width:300px;
	margin:0px auto;
	border:2px solid #000;
	margin-top:150px;
}
.main h2 {
    text-align:center;
	margin-bottom:30px;
}
</style>
<script type="text/javascript">
function change(val,obj){
	if(val=='over'){
		obj.style.color='red';
	}else if(val=='out'){
		obj.style.color="black";
	}
}
function openwindow(obj){
	/*因为是GET方式向服务器提交的，所以会产生乱码(这里可能因为浏览器   不同有的又没有乱码问题，有待探讨)，用encodeURI处理
	  这里在打开新窗口的同时，将要聊天的名字一起传过去！！
	  document.all是IE特有的属性，用此来判断是否是IE,否则就是火狐*/
	if(document.all){
		//IE浏览器
        window.open("talking.php?gettername="+obj.innerText,"_blank");
	}else{
		//FireFox浏览器
        window.open("talking.php?gettername="+obj.textContent,"_blank");
	}
	
}
</script>
</head>

<body>
<div class="main">
<h2>好友列表</h2>
<ul>
	<li onmouseover="change('over',this)" onmouseout="change('out',this)" onclick="openwindow(this)">王二</li>
	<li onmouseover="change('over',this)" onmouseout="change('out',this)" onclick="openwindow(this)">李四</li>
	<li onmouseover="change('over',this)" onmouseout="change('out',this)" onclick="openwindow(this)">张三</li>
</ul>
</div>


</body>
</html>