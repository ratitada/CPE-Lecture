<?php
if (!isset($_SESSION["User"])) {
	?>
    <script language="javascript">
		//window.alert('Please login');
		window.location = '/cpelecture/index.php';
	</script>
    <?php
}
?>