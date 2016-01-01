//js函数库

//创建ajax引擎
function getXMLHttpObject (){
	var XMLHttpObject;
	//不同的浏览器获取XmlHttpRequest对象不同，IE6/IE7/IE8不同，IE9已经和W3C一样了
	if(window.ActiveXObject){
		XMLHttpObject=new ActiveXObject("Microsoft.XMLHTTP");
	}else{
		XMLHttpObject=new XMLHttpRequest();
	}
	return XMLHttpObject;
}

function $(id){
	return document.getElementById(id);
}