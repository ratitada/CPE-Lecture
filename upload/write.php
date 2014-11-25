<?php include_once ("{$_SERVER['DOCUMENT_ROOT']}/cpelecture/assets/init.php"); ?>
<?php
	$user = unserialize($_SESSION["User"]);	
	$nontriUserID = $user->nontriUserID;
	$subjectID = $_POST["subject"];
	$teacherID = $_POST["teacher"];
	$year = $_POST["year"];
	$term = $_POST["inlineRadioOptions"];
	$numClass = $_POST["numclass"];
	$today = date("Y-m-d");
	$status = "Pending";	

	//------------------------ Start File Upload Part ----------------------
	$fullFileName = explode('.', basename($_FILES["fileToUpload"]["name"])); //เอาชื่อไฟล์เดิมมา split เพื่อดูนามสกุล
	$address = "lecture/".$subjectID."_".$year."_".$teacherID."_".$term."_".$numClass."_".$nontriUserID.".".$fullFileName[count($fullFileName)-1];
	$target_file = "../".$address;
	$uploadOk = 1;	
	// Check if file already exists
	if (file_exists($target_file))
	{
	    //echo "Sorry, file already exists.";
		?>
			<script language="javascript">
				window.alert('Sorry, this file is already exists.');
				window.location = '/cpelecture/upload/upload.php';
			</script>			
		<?php
		return;
	    $uploadOk = 0;
	}	
	// Check file size
	if ($_FILES["fileToUpload"]["size"] > 10000000)
	{
	    echo "Sorry, your file is too large.";
	    $uploadOk = 0;
		?>
			<script language="javascript">
				window.alert('Sorry, your file is too large.');
				window.location = '/cpelecture/upload/upload.php';
			</script>			
		<?php
		return;
	}	
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0)
	{
	    echo "Sorry, your file was not uploaded.";
		?>
			<script language="javascript">
				window.alert('Sorry, your file is too large.');
				window.location = '/cpelecture/upload/upload.php';
			</script>			
		<?php
		return;
	// if everything is ok, try to upload file
	}
	else
	{
	    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) 
	    {
	        //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
	        $uppingLect = new Lecture($nontriUserID, $subjectID, $teacherID, $year, $term, $numClass, $status, $today, $address);
	        $user->myManager->uploadLecture($uppingLect);
			?>
				<script language="javascript">
					window.alert('Your file has been uploaded. Wait for admin to approve.');
					window.location = '/cpelecture/read/read.php';
				</script>			
			<?php
			return;
	    }
	    else 
	    {
	        //echo "Sorry, there was an error uploading your file.";
			?>
				<script language="javascript">
					window.alert('Sorry, there was an error uploading your file.');
					window.location = '/cpelecture/upload/upload.php';
				</script>
			<?php
			return;
	    }
	}
	//----------------------- End File Upload Part ----------------------
?>
<script language="javascript">
	window.location = '/cpelecture/read/read.php';
</script>