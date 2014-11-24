<?php
	session_start();
?>
<?php include_once ("{$_SERVER['DOCUMENT_ROOT']}/cpelecture/assets/db_connector.php"); ?>

<?php include_once ("{$_SERVER['DOCUMENT_ROOT']}/cpelecture/class/User.php"); ?>
<?php include_once ("{$_SERVER['DOCUMENT_ROOT']}/cpelecture/class/NormalUser.php"); ?>
<?php include_once ("{$_SERVER['DOCUMENT_ROOT']}/cpelecture/class/Admin.php"); ?>
<?php include_once ("{$_SERVER['DOCUMENT_ROOT']}/cpelecture/class/SimpleManager.php"); ?>
<?php include_once ("{$_SERVER['DOCUMENT_ROOT']}/cpelecture/class/AdminManager.php"); ?>
<?php include_once ("{$_SERVER['DOCUMENT_ROOT']}/cpelecture/class/Lecture.php"); ?>

<?php
if (basename($_SERVER['PHP_SELF']) != "index.php" &&
	basename($_SERVER['PHP_SELF']) != "login.php") {
	include_once ("{$_SERVER['DOCUMENT_ROOT']}/cpelecture/assets/authentication.php"); 
}
?>
<link href="/cpelecture/css/bootstrap.min.css" rel="stylesheet">
<link href="/cpelecture/css/miki.css" rel="stylesheet">
<link href="/cpelecture/css/yocss.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="/cpelecture/js/bootstrap.min.js"></script>