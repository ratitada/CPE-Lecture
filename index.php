<?php include_once("{$_SERVER['DOCUMENT_ROOT']}/cpelecture/assets/init.php"); ?>
<?php
if (isset($_SESSION["User"])) {
	?>
    <script language="javascript">
		//window.alert('Please login');
		window.location = '/cpelecture/read/read.php';
	</script>
    <?php
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Home</title>
</head>
<body>
<?php include("{$_SERVER['DOCUMENT_ROOT']}/cpelecture/assets/navbar.php"); ?>
<div class="login-logo"></div>
<div class="front-signin">	
		<form action="./login/login.php" method="post">
			<div class="form-group">
				<label for="username">Username</label>
				<input type="text" name="username" id="username" class="form-control">
			</div>
			<div class="form-group">
				<label for="password">Password</label>
				<input type="password" name="password" id="password" class="form-control">				
			</div>			
			<table style="width:100%">
				<tbody>
					<td align="left"><a href="register.php"><h5><u>Register</u></h5></a></td>
					<td align="right"><input type="submit" value="Sign in" class="btn btn-primary"></td>
				</tbody>
			</table>
		</form>
	</div>

</body>
</html>