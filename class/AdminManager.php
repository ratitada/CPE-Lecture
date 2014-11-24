<?php include_once("SimpleManager.php");?>
<?php
class AdminManager extends SimpleManager {
	public function __construct() {
		parent::__construct();
	}
	public function fetchPendingLecture() {
		$db = DBConnector::connectToDB();
		$strSQL = "SELECT * FROM lecture WHERE status = 'Pending'";
		$paramArr = array();
		//$result = $this->db->queryThis($strSQL, $paramArr);
		$result = $db->queryThis($strSQL, $paramArr);
		return $result;
	}
	public function approveLecture($LID) {
		$db = DBConnector::connectToDB();
		$strsql = "UPDATE lecture SET status = 'Approved' WHERE LID = ?";
		$paramArr = array($LID);
		//$this->db->queryThis($strsql, $paramArr);
		$db->queryThis($strsql, $paramArr);
	}
}
?>