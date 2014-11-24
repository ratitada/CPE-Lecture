<?php include_once("{$_SERVER['DOCUMENT_ROOT']}/cpelecture/assets/init.php"); ?>
<?php
	$_SESSION = array();
	session_destroy();
?>
<script language="javascript">
	window.location = '/cpelecture/index.php';
</script>