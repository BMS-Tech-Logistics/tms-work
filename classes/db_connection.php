<?php

 class database_connection
{
    
	private $host='localhost';
	private $user='root';
	private $password='';
	private $db_name='tms_demo';
	protected $connect;

		public function __construct(){
			$this->connect=mysqli_connect($this->host,$this->user,$this->password,$this->db_name);
            $this->connect->set_charset("utf8");
			if(!$this->connect){
				die('Connection Error!!!!!!!'.mysqli_error($this->connect));
			}
            date_default_timezone_set("Asia/Dhaka");
		}
}

?>