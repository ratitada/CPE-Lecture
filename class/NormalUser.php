<?php include_once ("User.php");?>
<?php //include_once ("SimpleManager.php");?>
<?php
class NormalUser extends User
{
	public $myManager;
	public function __construct ($nontriUserID, $username, $password, $type)
	{
		$this->nontriUserID = $nontriUserID;
		$this->username = $username;
		$this->password = $password;
		$this->type = $type;		
		
		$this->myManager = new SimpleManager();
	}
}
?>