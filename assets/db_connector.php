<?php
class DBConnector{
	private static $_instance = null;
	private $myPDO;
	private function __construct() {
		$hostname="localhost";
		$username="root";
		$password="";
		$dbname="cpelecture";
		
		$dsn = "mysql:host=".$hostname.";dbname=".$dbname;
		//____end variable declaration____
		$this->myPDO = new PDO($dsn,$username,$password);
	}
	public static function connectToDB() {
		if (self::$_instance ==	null) {
			self::$_instance = new DBConnector();
		}
		return self::$_instance;
	}
	public function queryThis($strsql, $valueList) {
		$query = $this->myPDO->prepare($strsql);
		$i=1;
		foreach ($valueList as $x) {
			$query->bindValue($i, $x);
			$i++;
		}
		$execStatus = $query->execute();
		$result = $query->fetchAll(PDO::FETCH_OBJ);
		return $result;
	}
}
?>