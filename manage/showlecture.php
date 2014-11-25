<?php
include_once("{$_SERVER['DOCUMENT_ROOT']}/cpelecture/assets/init.php");
$user = unserialize($_SESSION["User"]);
//include_once "{$_SERVER['DOCUMENT_ROOT']}/cpelecture/manage/authentication.php";
//$id = $_GET['id'];
$lid = $_GET['lid'];
function connectDatabase() {
	$databaseHost = 'localhost';
	$databaseUser = 'root';
	$databasePassword = '';
	$databaseName = 'cpelecture';

	try {
		$databaseHandler = new PDO("mysql:host=$databaseHost;dbname=$databaseName;charset=utf8", $databaseUser, $databasePassword);
		$databaseHandler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $databaseHandler;
	}
	catch (PDOException $ex) {
		debugLog($ex->getMessage());
		die();
	}
}

$databaseHandler = connectDatabase();
$query = 'SELECT address FROM lecture WHERE LID=:lid';
$statement = $databaseHandler->prepare($query);
$statement->bindParam(':lid', $lid);
$statement->execute();
$result = $statement->fetchAll();
$databaseHandler = NULL ;

foreach($result as $row){ 
	$items=explode ( '/' , $row['address'] );
	$items2=explode( '.' , $items[sizeof($items)-1]);
	if ($items2[1]=='pdf') {
		echo "<center>
		<iframe src='../".$row['address']."' alt=''  width='700' height='450'>
		</center>
		";
	}
	else
	{
		echo "<center>
			<img src='../".$row['address']."' alt=''  width='700'>
			</center>
		";
	}
}
?>