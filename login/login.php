<?php include_once("{$_SERVER['DOCUMENT_ROOT']}/cpelecture/assets/init.php"); ?>

<?php
$username = $_POST["username"];
$password = $_POST["password"];
$paramArr = array($username, $password);
$strSQL = "SELECT * FROM account WHERE (nontriUserID = ? AND password = ?)";
$db = DBConnector::connectToDB();
$result = $db->queryThis($strSQL, $paramArr);

$authorizedURL = "/cpelecture/read/read.php";

if (count($result)==1) {
	var_dump($result[0]->nontriUserID);
	$user;
	if ($result[0]->type=="N") {
		$user = new NormalUser($result[0]->nontriUserID, $result[0]->username, $result[0]->password, $result[0]->type);
	}
	else {
		$user = new Admin($result[0]->nontriUserID, $result[0]->username, $result[0]->password, $result[0]->type);
	}
	$_SESSION["User"] = serialize($user);
	header('Location: '.$authorizedURL);
}
else {
	?>
    <script language="javascript">
		window.alert("Wrong username or password, please try again");
		window.location = '/cpelecture/index.php';
	</script>
    <?php
}
?>