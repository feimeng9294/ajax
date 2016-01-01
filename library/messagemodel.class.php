<?php
include("mysql.class.php");

class messagemodel{
	private $table="message";
	private $mysql;
	function __construct(){
        $mysqltool=mysql::getIns();
		$this->mysql=$mysqltool;
	}
	//向服务器发送信息
	function add($username,$gettername,$content){
		$sql="insert into ".$this->table." (username,gettername,content,sendtime) values('$username','$gettername','$content',now())";

		//这里可以写入日志文件中，看看$sql语句是不是有问题！
		//file_put_contents("current.log",$sql,FILE_APPEND);

		$this->mysql->query($sql);
		$num=$this->mysql->affected_rows();
		if($num){
			return 1;//1只是一个状态码，代表sql语句执行成功
		}else{
			return 0;//代表sql语句执行失败
		}
	}

    //向服务器取消息
	function get($username,$gettername){
		$sql1="select * from ".$this->table." where gettername='$username' and username='$gettername' and isget=0";
		$list=$this->mysql->getAll($sql1);
		//取完之后要把isget字段改为1，说明这个信息已经取过了
		$sql2="update ".$this->table." set isget=1 where gettername='$username' and username='$gettername'";
		$this->mysql->query($sql2);
        //file_put_contents("current.log",$sql1,FILE_APPEND);
		//file_put_contents("current.log",$sql2,FILE_APPEND);
        //这里不能直接返回结果集,因为controller.php(相当于服务器)，要返回给客户端的是json格式(假设我们已敲定用json)，所以要做成相应的Text文本返回
		//return $list;

	    //XML格式
		$messageinfo="<message>";
		for($i=0;$i<count($list);$i++){
			$messageinfo.="<message_id>{$list[$i]['message_id']}</message_id><username>{$list[$i]['username']}</username><gettername>{$list[$i]['gettername']}</gettername><content>{$list[$i]['content']}</content><sendtime>{$list[$i]['sendtime']}</sendtime><isget>{$list[$i]['isget']}</isget>";
		}
        $messageinfo.="</message>";
		return $messageinfo;
	}

}