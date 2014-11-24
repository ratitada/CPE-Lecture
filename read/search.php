<?php include_once ("{$_SERVER['DOCUMENT_ROOT']}/cpelecture/assets/init.php"); ?>
<?php
$subject = $_REQUEST["subject"];
$teacher = $_REQUEST["teacher"];
$year = $_REQUEST["year"];
$term = $_REQUEST["term"];

$user = unserialize($_SESSION["User"]);
$result = $user->myManager->searchLecture($subject, $teacher, $year, $term);

if (count($result)==0) {
	echo "<center><i>\"No such file you searching for\"</i></center>";
	return;
}

echo "<thead>";
echo "<tr>";
echo "<th>#</th>";
echo "<th>File Name</th>";
echo "<th>Upload Date</th>";
echo "<th style=\"text-align:center;\">Class</th>";
echo "</tr>";
echo "</thead>";
echo "<tbody>";
	$i=1;
	foreach($result as $iResult) {
		$filename = end(explode("/", $iResult->address));
		$filetype = end(explode(".", $iResult->address));
		$absAddress = "/cpelecture/".$iResult->address;
		if ($filetype != "pdf") {
			$filetype = "image";
		}
echo "<tr>
	  <td>".$i."</td>
	  <td>".$filename."
	  	<button type='button' class='btn btn-xs btn-primary' data-toggle='modal' data-target='#myModal' onclick=\"javascript:showLectureInModal('".$absAddress."', '".$filetype."')\";><span class='glyphicon glyphicon-search' aria-hidden='true'></span>
		</button></td>
	  <td>".$iResult->uploadDate."</td>
	  <td align=\"center\">".$iResult->numClass."</td>
	  </tr>";
	  $i++;
	  } 
echo "</tbody>";
?>