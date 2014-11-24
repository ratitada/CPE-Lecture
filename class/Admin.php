<?php include_once("AdminManager.php"); ?>
<?php
class Admin extends User
{
	public $myManager;
	public function __construct ($nontriUserID, $username, $password, $type)
	{
		$this->nontriUserID = $nontriUserID;
		$this->username = $username;
		$this->password = $password;
		$this->type = $type;
		
		$this->myManager = new AdminManager();
	}
}
?>