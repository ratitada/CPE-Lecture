<?php include_once("{$_SERVER['DOCUMENT_ROOT']}/cpelecture/assets/db_connector.php"); ?>
<?php
class SimpleManager {
	//protected $db;
	public function __construct() {
		//$this->db = DBConnector::connectToDB();
	}
	public function uploadLecture($uppingLect) {
		$db = DBConnector::connectToDB();
		$strSQL = "INSERT INTO lecture (nontriUserID, subjectID, teacherID, year, term, numClass, status, address) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
		$paramArr = array($uppingLect->nontriUserID, $uppingLect->subjectID, $uppingLect->teacherID, $uppingLect->year,
							$uppingLect->term, $uppingLect->numClass, $uppingLect->status, $uppingLect->address);
		
		//$result = $this->db->queryThis($strSQL, $paramArr);
		$result = $db->queryThis($strSQL, $paramArr);
	}
	public function deleteLecture($lectID) {
		$db = DBConnector::connectToDB();
		$strSQL = "DELETE FROM lecture WHERE LID = ?";
		$paramArr = array($lectID);
		//$result = $this->db->queryThis($strSQL, $paramArr);
		
		
		$result = $db->queryThis($strSQL, $paramArr);
	}
	public function fetchLecture($nontriUID) {
		$db = DBConnector::connectToDB();
		$strSQL = "SELECT * FROM lecture WHERE nontriUserID = ?";
		$paramArr = array($nontriUID);
		//$result = $this->db->queryThis($strSQL, $paramArr);
		$result = $db->queryThis($strSQL, $paramArr);
		return $result;
	}
	public function searchLecture($subjectID, $teacherID, $year, $term) {
		$db = DBConnector::connectToDB();
		$strSQL = "SELECT * FROM lecture";
		$strSQL .= " WHERE (status = 'Approved' AND ";
				
		//$strSQL .= "WHERE (";
		if ($subjectID != "ALL") { $strSQL .= "subjectID = '" . $subjectID . "' AND "; }
		if ($teacherID != "ALL") { $strSQL .= "teacherID = '" . $teacherID . "' AND "; }
		if ($year != "ALL") { $strSQL .= "year = '" . $year . "' AND "; }
		if ($term != "ALL") { $strSQL .= "term = '" . $term . "' AND "; }
			
		//- Trim end of string, make sure no white space at the end could be count
		//- 3 character mean " AND" at the end and minus one more because of index issue
		$strSQL = substr(trim($strSQL), 0, strlen($strSQL)-3-1);
			
		$strSQL .= ") ORDER BY uploadDate DESC";
		$paramArr = array();
		//$result = $this->db->queryThis($strSQL, $paramArr);
		$result = $db->queryThis($strSQL, $paramArr);
		//echo $strSQL;
		return $result;
	}
}
?>