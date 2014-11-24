<?php include_once("{$_SERVER['DOCUMENT_ROOT']}/cpelecture/assets/init.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<!-- ====================start nav bar==================== -->
<nav class="navbar navbar-inverse" role="navigation">
  <div class="container-fluid"> 
  
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      <a class="navbar-brand" href="/cpelecture/index.php" style="color:#CCC;"><span class="glyphicon glyphicon-book"></span> CPE Lecture</a> </div>
    
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
                
        <li <?php if (basename($_SERVER['PHP_SELF']) == "read.php") {echo "class=active";} ?>
			><a href="/cpelecture/read/read.php">Reading Area</a></li>
        <li <?php if (basename($_SERVER['PHP_SELF']) == "upload.php") {echo "class=active";} ?>
			><a href="/cpelecture/upload/upload.php">Upload Area</a></li>
        <li <?php if (basename($_SERVER['PHP_SELF']) == "manage.php") {echo "class=active";} ?>
			><a href="/cpelecture/manage/manage.php">Manage Area</a></li>
		<?php
		if (isset($_SESSION["User"])) {
			$user = unserialize($_SESSION["User"]);
			if ($user->type=="A") {
				echo "<li ";
				if (basename($_SERVER['PHP_SELF']) == "approve.php") {echo "class=active";}
				echo "><a href=\"/cpelecture/manage/approve.php\">Approve Area</a></li>";
			}
		}
        ?>
      </ul>
      
      <ul class="nav navbar-nav navbar-right">
      	<?php
			if (isset($_SESSION["User"])) {
				$user = unserialize($_SESSION["User"]);
				echo "<h4 style=\"margin-top:15px; color:white;\">".$user->username;
				echo "<a href=\"../login/logout.php\">  Logout</a></h4>";
			}
		?>
      </ul>
      
    </div>
    <!-- /.navbar-collapse --> 
  </div>
  <!-- /.container-fluid --> 
</nav>
<!-- ====================end nav bar==================== --> 
</body>
</html>