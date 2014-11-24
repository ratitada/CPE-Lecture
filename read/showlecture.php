<?php
include_once("{$_SERVER['DOCUMENT_ROOT']}/cpelecture/assets/init.php");
$address = $_GET['address'];
$type = $_GET['type'];
if ($type=='pdf') {
	echo "<center>
		<iframe src=".$address." alt=''  width='700' height='450'>
		</center>
		";
}
else
{
	//var_dump($address);
	//echo $type."<br>";

	echo "<center>
		<img src='".$address."' alt=''  width='700'>
		</center>
		";
}
?>