<?php
include_once("{$_SERVER['DOCUMENT_ROOT']}/cpelecture/assets/init.php");
$user = unserialize($_SESSION["User"]);
//include_once "{$_SERVER['DOCUMENT_ROOT']}/cpelecture/manage/authentication.php";
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

//$userID="b5410506065";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <link href="/cpelecture/css/bootstrap.min.css" rel="stylesheet">
    <link href="/cpelecture/css/yocss.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  	<SCRIPT LANGUAGE="JavaScript">
		function showdiv(input){
			alert(input);
		}
		function showAlert() {
  			document.getElementById('alertDiv').style.display = "block";
		}
		function hideAlert() {
  			document.getElementById('alertDiv').style.display = 'none';
		}
		function removeLecture()
		{
			alert("YEAH");
		}
		/*function showUserLecture(nontri) {
			
    		document.getElementById("tableMarker").innerHTML="";
  			if (window.XMLHttpRequest) {
    			xmlhttp=new XMLHttpRequest();
  			} 
  			else { // code for IE6, IE5
   				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  			}
  			xmlhttp.onreadystatechange=function() {
    			if (xmlhttp.readyState==4 && xmlhttp.status==200) {
      				document.getElementById("tableMarker").innerHTML=xmlhttp.responseText;
    			}
			}
  			xmlhttp.open("GET","fetchlecture.php?id="+nontri,true);
  			xmlhttp.send();
		}*/
		
		function removeUserLecture(nontriUser,lectureID) {
			//alert("remove");
			
    		document.getElementById("tableMarker").innerHTML="";
  			if (window.XMLHttpRequest) {
    			xmlhttp=new XMLHttpRequest();
  			} 
  			else { // code for IE6, IE5
   				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  			}
  			xmlhttp.onreadystatechange=function() {
    			if (xmlhttp.readyState==4 && xmlhttp.status==200) {
      				document.getElementById("tableMarker").innerHTML=xmlhttp.responseText;
    			}
			}
  			xmlhttp.open("GET","removelecture.php?id="+nontriUser+"&lid="+lectureID,true);
  			xmlhttp.send();
  			showAlert();
		}
		function showLectureInModal(lectureID) {
    		document.getElementById("modal-body").innerHTML="";
  			if (window.XMLHttpRequest) {
    			xmlhttp=new XMLHttpRequest();
  			} 
  			else { // code for IE6, IE5
   				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  			}
  			xmlhttp.onreadystatechange=function() {
    			if (xmlhttp.readyState==4 && xmlhttp.status==200) {
      				document.getElementById("modal-body").innerHTML=xmlhttp.responseText;
    			}
			}
  			xmlhttp.open("GET","showlecture.php?lid="+lectureID,true);
  			xmlhttp.send();
		}
		function openPDF(urlToPdfFile) {
  			window.open(urlToPdfFile, 'pdf');
		}
	</SCRIPT>

  <body>
	<?php include("{$_SERVER['DOCUMENT_ROOT']}/cpelecture/assets/navbar.php"); ?>	
    
    <div class="page-header" id='divElement'>
 	 	<h1> Manage Your Lectures!</h1>
	</div>
	<div id='divElement'>
		<p>You can check your uploaded lectures and remove a lecture here.</p>
		<br>
	</div>
	
	<div id='alertDiv' style="display:none">
		<div id='divElement'>
			<div class="alert alert-success alert-dismissible fade in " role="alert" id="myAlert">
				<!--<a href='javascript:hideAlert();'>-->
					<button type="button" class="close" onclick="javascript:hideAlert();">
	 					<span aria-hidden="true">&times;</span>
	  					<span class="sr-only">Close</span>
					</button>
				<!--</a>-->
		        <strong>Removal Success!</strong> The lecture are removed from system.
			</div>
		</div>
	</div>

	<!--<a href="javascript:showUserLecture('b5410506065');">TEST</a>-->

	<div id='divElement'>
    	<div id='tableMarker'>
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
					<?php
					/*
					$databaseHandler = connectDatabase();
					$query = 'SELECT * FROM lecture WHERE nontriUserID=:id';
					$statement = $databaseHandler->prepare($query);
					$statement->bindParam(':id', $userID);
					$statement->execute();
					$result = $statement->fetchAll();
					$databaseHandler = NULL ; */
					$result=$user->myManager->fetchLecture($user->nontriUserID);
					$i=1;
					foreach($result as $r){ 
						$row['address']=$r->address;
						$row['LID']=$r->LID;
						$row['uploadDate']=$r->uploadDate;
						$row['status']=$r->status;
						$items=explode ( '/' , $row['address'] );
						echo "
							        <tr>
							            <td>".$i."</td>
							            <td>
							                ".$items[sizeof($items)-1];
							                $items2=explode( '.' , $items[sizeof($items)-1]);
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
						echo "	            </td>
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

					?>	         
	        </tbody>
	    </table>
	    <?php
							if ($i==1) {
						 	echo "<center><i>No lecture to manage.</i></center>";
						 	}  
		?>
	</div>
    	<div>
    <div>
    <!-- Modal -->
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
		        <h4 class="modal-title" id="myModalLabel">Lecture View</h4>
		     		</div>

		     		<div class="modal-body" id="modal-body"></div>

		      		<div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		      </div>
		    </div>
		  </div>
		</div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/cpelecture/js/bootstrap.min.js"></script>
  </body>
</html>