<?php
//mysql类
class mysql {
    private $conn;
    private static $ins;

    protected function __construct() {
        $this->connect("localhost","root","root");
        $this->select_db("talkingroom");
        $this->setChar("utf8");
    }

    public static function getIns() {
        if(!(self::$ins instanceof self)) {
            self::$ins = new self();
        }

        return self::$ins;
    }

    public function __destruct() {
    }

    public function connect($h,$u,$p) {
        $this->conn = mysql_connect($h,$u,$p);
        if(!$this->conn) {
            $err = new Exception('连接失败');
            throw $err;
        }
    }

    protected function select_db($db) {
        $sql = 'use ' . $db;
        $this->query($sql);
    }

    protected function setChar($char) {
        $sql = 'set names ' . $char;
        return $this->query($sql);
    }

    public function query($sql) {

        $res = mysql_query($sql,$this->conn);
        return $res;
    }

    public function autoExecute($table,$arr,$mode='insert',$where = ' where 1 limit 1') {
        /*    insert into tbname (username,passwd,email) values ('',)
        /// 把所有的键名用','接起来
        // implode(',',array_keys($arr));
        // implode("','",array_values($arr));
        */
        
        if(!is_array($arr)) {
            return false;
        }

        if($mode == 'update') {
            $sql = 'update ' . $table .' set ';
            foreach($arr as $k=>$v) {
                $sql .= $k . "='" . $v ."',";
            }
            $sql = rtrim($sql,',');
            $sql .= $where;
            
            return $this->query($sql);
        }

        $sql = 'insert into ' . $table . ' (' . implode(',',array_keys($arr)) . ')';
        $sql .= ' values (\'';
        $sql .= implode("','",array_values($arr));
        $sql .= '\')';

        return $this->query($sql);
    
    }

    public function getAll($sql) {
        $res = $this->query($sql);
        
        $list = array();
        while($row = mysql_fetch_assoc($res)) {
            $list[] = $row;
        }
        //释放结果集
		mysql_free_result($res);
        return $list;
    }

    public function getRow($sql) {
        $res = $this->query($sql);
        
        return mysql_fetch_assoc($res);
    }

    public function getOne($sql) {
        $rs = $this->query($sql);
        $row = mysql_fetch_row($rs);
        return $row[0];
    }

    // 返回影响行数的函数
    public function affected_rows() {
        return mysql_affected_rows($this->conn);
    }

    // 返回最新的auto_increment列的自增长的值
    public function insert_id() {
        return mysql_insert_id($this->conn);
    }

    //取出指定表中的所有字段名,传入该字段所在偏移量
	public function getfields($res,$i){
		return mysql_field_name($res,$i);
	}
	//得到结果集中字段的总数
	public function getcountfields($res){
		return mysql_num_fields($res);
	}
}
