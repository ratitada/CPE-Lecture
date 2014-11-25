<?php
class Lecture {
	public $nontriUserID, $subjectID, $teacherID, $year, $term, $numClass, $status, $uploadDate, $address;
	public function __construct($nontriUserID, $subjectID, $teacherID, $year, $term, $numClass, $status, $uploadDate, $address) {
		$this->nontriUserID = $nontriUserID;
		$this->subjectID = $subjectID;
		$this->teacherID = $teacherID;
		$this->year = $year;
		$this->term = $term;
		$this->numClass = $numClass;
		$this->status = $status;
		$this->uploadDate = $uploadDate;
		$this->address = $address;
	}
}
?>