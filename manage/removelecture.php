<?php
include_once("{$_SERVER['DOCUMENT_ROOT']}/cpelecture/assets/init.php");
$user = unserialize($_SESSION["User"]);
//include_once "{$_SERVER['DOCUMENT_ROOT']}/cpelecture/manage/authentication.php";
$id = $_GET['id'];
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
$query = 'SELECT * FROM lecture WHERE LID=:lid';
$statement = $databaseHandler->prepare($query);
$statement->bindParam(':lid', $lid);
$statement->execute();
$result = $statement->fetchAll();
foreach($result as $row){ 
	$flgDelete = unlink("../".$row['address']);
}

/*$databaseHandler = connectDatabase();
$query = 'DELETE FROM lecture WHERE LID=:lid';
$statement = $databaseHandler->prepare($query);
$statement->bindParam(':lid', $lid);
$statement->execute();*/
$result =$user->myManager->deleteLecture($lid);

/*$databaseHandler = connectDatabase();
$query = 'SELECT * FROM lecture WHERE nontriUserID=:id';
$statement = $databaseHandler->prepare($query);
$statement->bindParam(':id', $id);
$statement->execute();
$result = $statement->fetchAll();
$databaseHandler = NULL ;*/
$result =$user->myManager->fetchLecture($id);
//print_r($result);
echo "
	<div class='col-md-6' id='divElement'>
	    <table class='table table-hover'> 
	        <thead>
	            <tr>
	            	<th>#</th>
	            	<th>File Name</th>
	            	<th>Upload Date</th>
	            	<th>Status</th>
	            	<th></th>
	            </tr>
	        </thead>
	    	<tbody>
	";
$i=1;
// ".$row['subjectID']."_".$row['year']."_".$row['teacherID']."_".$row['term']."_".$row['class'].".pdf
foreach($result as $r){ 
	$row['address']=$r->address;
	$row['LID']=$r->LID;
	$row['uploadDate']=$r->uploadDate;
	$row['status']=$r->status;
	$items=explode ( '/' , $row['address'] );
	$items2=explode( '.' , $items[sizeof($items)-1]);
		echo "
		        <tr>
		            <td>".$i."</td>
		            <td>
		                ".$items[sizeof($items)-1];
	if ($items2[1]=='pdf') {
					echo "<!--<a href=../".$row['address']." target=\"_BLANK\">-->
								<button type='button' class='btn btn-xs btn-primary' onclick='javascript:openPDF(\"../".$row['address']."\");'>
								    <span class='glyphicon glyphicon-search' aria-hidden='true'></span>
								</button>
							<!--</a>-->";
	}
	else
	{

		                echo "<!--<a href='javascript:showLectureInModal(".$row['LID'].");'>-->
								<button type='button' class='btn btn-xs btn-primary' data-toggle='modal' data-target='#myModal' onclick='javascript:showLectureInModal(".$row['LID'].");'>
								    <span class='glyphicon glyphicon-search' aria-hidden='true'></span>
								</button>
							<!-- </a>-->";
		           
	} 
	echo " </td>
		            <td>".$row['uploadDate']."</td>
		            <td>".$row['status']."</td>
		            <td>
		               	<!--<a href='javascript:removeUserLecture(\"".$user->nontriUserID."\",".$row['LID'].");'>-->
							<button type='button' class='btn btn-xs btn-danger' onclick='javascript:removeUserLecture(\"".$user->nontriUserID."\",".$row['LID'].");'>
							    <span class='glyphicon glyphicon-trash' aria-hidden='true'></span>
							</button>
						<!--</a>-->
		            </td>
		        </tr>
		  ";
		  $i++;
}       

echo "
	        </tbody>
	    </table>";
	
	  if ($i==1) {
			echo "<center><i>No lecture to manage</i></center>";
		}  
echo "</div>";
?>