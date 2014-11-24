<?php include_once ("../class/NormalUser.php");?>
<?php include_once ("../class/Admin.php");?>
<?php
//$tempuser=new Admin("b5410506065","Yo","FrungJai",'A');
//$tempuser=new NormalUser("b5410506065","Yo","FrungJai",'N');
//$_SESSION["User"] = $tempuser;
//$_SESSION["User"] = serialize($tempuser);

if(isset($_SESSION["User"]) && !empty($_SESSION["User"])) {
//	print("found session");
//	$userID=$_SESSION["UserInfo"]->nontriUserID;
//	$_SESSION["UserInfo"]->username;
//	$_SESSION["UserInfo"]->type;
	//$userID=$_SESSION["UserInfo"]->nontriUserID;
	//$userName=$_SESSION["UserInfo"]->username;
	//$user=$_SESSION["User"];
	$user=unserialize($_SESSION["User"]);
}
else
{
	//print("no session");
	//$userID="b5410506065";
	//$userName="Yo";
	//$user=new Admin("b5410506065","Yo","FrungJai",'N');
	//$user=new NormalUser("b5410506065","Yo","FrungJai",'N');
	//print_r($user->myManager->fetchLecture('b5410506065'));
	echo "<script>window.location = '../login/login.php'</script>";
}
?>