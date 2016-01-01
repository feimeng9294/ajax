<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="library/js_library.js" type="text/javascript"></script>
<title>好友列表</title>


<style type="text/css">
* {
	margin:0px;
	padding:0px;
}
.main {
    width:300px;
	margin:0px auto;
	margin-top:150px;
	text-align:center;
}
.main h2 {
	margin-bottom:30px;
}
.main h2 span {
    color:red;
	font-weight:200px;
}
</style>


<?php
//此名代码要放在上面，因为下文有要引用$username的地方
if(isset($_GET['gettername'])){
    $gettername=$_GET['gettername'];
}

//这里我们取出session中保存的username登入用户
session_start();
$username=$_SESSION['username'];
?>


<script type="text/javascript">
/*window.resizeTo(800,700);*/
var myXMLHttpRequest;
function send(){
    myXMLHttpRequest=getXMLHttpObject();
	if(myXMLHttpRequest){
		var url="controller.php";
		var data=
			"content="+$("content").value+
			"&gettername=<?php echo $gettername; ?>"+
			"&username=<?php echo $username; ?>";
		//window.alert(url+data);
        myXMLHttpRequest.open("post",url,true);
		//如果是post传输，则一定要加下面这句话
		myXMLHttpRequest.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		myXMLHttpRequest.send(data);
		//window.alert("测试");
		//确定回调函数为chuli
		myXMLHttpRequest.onreadystatechange=function chuli(){
			if(myXMLHttpRequest.readyState==4){
				if(myXMLHttpRequest.status==200){
					//处理返回的数据

			}	}
		}

        //将发送的语句显示在聊天框中
		$("message").value+='我说：'+$("content").value+new Date().toLocaleString()+"\r\n";
	}
}




function get(){
    myXMLHttpRequest=getXMLHttpObject();
	if(myXMLHttpRequest){
		var url="controller.php";
		var data=//这里只传发送者和接收者过去，那么处理页面就不会add到数据库中，而get的方法仍然可以运行的
			"&gettername=<?php echo $gettername; ?>"+
			"&username=<?php echo $username; ?>";
		//window.alert(url+data);
        myXMLHttpRequest.open("post",url,true);
		//如果是post传输，则一定要加下面这句话
		myXMLHttpRequest.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		myXMLHttpRequest.send(data);
		//window.alert("测试");
		//确定回调函数为chuli
		myXMLHttpRequest.onreadystatechange=function chuli(){
			if(myXMLHttpRequest.readyState==4){
				if(myXMLHttpRequest.status==200){
					//处理返回的数据
					//window.alert("测试");
					var messageinfo=myXMLHttpRequest.responseXML;
					/*
					接收到的messageinfo将是一个：
					<message>
					<message_id>16</message_id><username>李四</username><gettername>王二</gettername><content>你好王二</content><sendtime>2015-04-01 10:26:57</sendtime><isget>0</isget>
					<message_id>20</message_id><username>李四</username><gettername>王二</gettername><content>你好王二</content><sendtime>0000-00-00 00:00:00</sendtime><isget>0</isget>
					……
					</message>
		            */
					var contents=messageinfo.getElementsByTagName("content");
					var sendtime=messageinfo.getElementsByTagName("sendtime");
                    //window.alert(contents.length);
					if(contents.length!=0){
						for(var i=0;i<contents.length;i++){
                            $("message").value+="<?php echo $gettername; ?>说 ："+contents[i].childNodes[0].nodeValue+""+sendtime[i].childNodes[0].nodeValue+'\r\n';
						     //$('message').value+="你好";
						}
                    }
			}	}
		}


	}
}


//用触发器间隔5秒触发函数一次
window.setInterval("get()",5000);
</script>


</head>
<body>
<div class="main">
<h2><span><?php echo $username; ?></span>正在和<span><?php echo $gettername; ?></span>聊天</h2>
<textarea type="textarea" id="message" cols="35" rows="5" value=""/></textarea>
<input type="text" id="content" value=""/>
<input type="button" value="发送信息" onclick="send()"/>
</div>
</body>
</html>