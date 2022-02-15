<?php
	class student{
		private static $instance;
		
		private $host;
		private $user;
		private $pwd;
		private $dbname;
		private $port;
		private $charset;
		
		private $link;
		private $sql;
		
		
		private function __construct($parameter){
			$this->parameter_init($parameter);
			$this->connect__init();
		}
		private function __clone(){
			
		}
		public static function getinstance($parameter){
			if(!self::$instance instanceof self)
				self::$instance=new self($parameter);
			return self::$instance;
		}
		//初始化配置信息
		private function parameter_init($parameter){
			$this->host=$parameter['host']??'127.0.0.1';
			$this->user=$parameter['user']??'root';
			$this->pwd=$parameter['pwd']??'root';
			$this->port=$parameter['port']??'3306';
			$this->dbname=$parameter['dbname']??'mysql';
			$this->charset=$parameter['charset']??'gb2312';
		}
		//初始化连接
		private function connect__init(){
			
			$this->link=mysqli_connect($this->host,$this->user,$this->pwd,$this->dbname);
			
			if(mysqli_connect_error ()){
				echo '数据库连接失败</br>';
				echo '错误信息'.mysqli_connect_error().'</br>';
				echo '错误码：'.mysqli_connect_errno().'</br>';
				die($this->link);
			}mysqli_set_charset($this->link,$this->charset);
		}
		//执行数据库增删改查语句
		private function execute($sql){
			if(!$resource=mysqli_query($this->link,$sql)){
				echo 'Sql 语句执行失败</br>';
				echo '错误信息：'.mysqli_error($this->link);
				echo '错误码：'.mysqli_connect_errno().'</br>';
				echo '错误的SQl语句'.$sql,'</br>';
				die($this->link);
			}
			return $resource;
		}
		//执行增删改语句
		public function exec($sql){
			echo($this->sql.'这里没显示');
			$strr =array('Insert','update','delete');
			foreach($strr   as $value){
				echo ($value).'????<hr>';
			if(stristr($this->sql,$value )){
				return $this->execute($sql);
			}
			}

		}
		//获取最后插入的编号
		public function getinsert_id(){
			return mysqli_insert_id($this->link);
		}
	}

	$parameter =array(
		'host'=>'127.0.0.1',
		'user'=>'admin',
		'dbname'=>'shop',
		'pwd'=>'admin12345',
		'port'=>'3306',
		'charset'=>'utf8'
	);

	$inst=student::getinstance($parameter);
	$sql="INSERT INTO shop.abc  VALUES ('','李军找', '男', 40)";
	$abcd=$inst->exec($sql);
	var_dump($abcd);
		//)echo "插入编号为:{$inst->getinsert_id()}";
	//print_r($inst);
	//$instan=student::getinstance($parameter);

echo '<pre>';
//var_dump($inst);
//if($inst===$instan){
//	echo 'their are the same';
//}else{
//	echo '不一样';
//}



//class single_class1{
//	private static $instance;
//	//用私有属性修饰目的禁止实例化本类
//	private  function __construct(){
//		echo '构造函数';
//	}
//	private function __clone(){
//		echo '禁止克隆';
//	}
//	public static function getinstance(){
//		// self::getinstance()=new self;
//		echo '只能通过静态方法调用本getinstance方法'.'<hr>';
//		if(self::$instance instanceof self)
//		self::$instance=new self;
//		return self::$instance;
//			
//			
//	}
//	function __destruct(){
//		print "Destroying " . $this->name . "\n";
//	}
//	
//}
//class cde extends single_class1{
//	public function efg(){
//		echo '</br>以下为继承的方法<hr>';
//		return parent::getinstance();
//	}
//}
//
//$a=single_class1::getinstance();
//$b=single_class1::getinstance();
//$c=single_class1::getinstance();
//
//var_dump($a,$b,$c);
//
//
//
//
//$e=new cde();
//$e->efg();
//$f=clone $e;

//$b=clone single_class1;
//$a=new single_class1;
		?>