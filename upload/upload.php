<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Upload Area</title>
<link href="/cpelecture/css/bootstrap.min.css" rel="stylesheet">
<link href="/cpelecture/css/miki.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="/cpelecture/js/bootstrap.min.js"></script>
<?php include("{$_SERVER['DOCUMENT_ROOT']}/cpelecture/assets/navbar.php");
include_once ("{$_SERVER['DOCUMENT_ROOT']}/cpelecture/assets/init.php"); ?>
<?php
$db = DBConnector::connectToDB();
$strSQL = "SELECT * FROM subject";
$paramArr = array();
$allSubject = $db->queryThis($strSQL, $paramArr);

$strSQL = "SELECT * FROM teacher";
$paramArr = array();
$allTeacher = $db->queryThis($strSQL, $paramArr);
?>

<div class="page-header" style="margin-left:50px;">
  <h1>Upload Area <small>
  <h4>แบ่งปัน lecture ให้กับเพื่อนของคุณ</h4>
  </small></h1>
  <div class="hr"><hr/></div>
  <div class="register-content">
    <form action="write.php" method="post" class="form-horizontal" enctype="multipart/form-data">
      <div class="form-group">
        <label class="col-sm-2 control-label">Subject</label>
        <div class="col-sm-8">
          <select name="subject" class="form-control">
            <?php              
              for ($i=0 ; $i<count($allSubject) ; $i++)
              {
                  echo "<option value=\"".$allSubject[$i]->subjectID."\"> ";
                  echo $allSubject[$i]->subjectID." ";
                  echo $allSubject[$i]->subjectName."</option>";                 
              }
            ?>
          </select>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">Teacher</label>
        <div class="col-sm-8">
          <select name="teacher" class="form-control">
          <?php
            for ($i=0 ; $i<count($allTeacher) ; $i++)
            {
              for ($i=0 ; $i<count($allTeacher) ; $i++) 
              {
                echo "<option value=\"".$allTeacher[$i]->teacherID."\"> ";
                echo $allTeacher[$i]->teacherName." ";
                echo $allTeacher[$i]->teacherID."</option>";                
              }
            }
          ?>
          </select>
        </div>
      </div>      
      <div class="form-group">
        <label class="col-sm-2 control-label">Year</label>
        <div class="col-sm-2">
          <select name="year" class="form-control">
          <?php
            $startYear = 1989;
            $endYear = strftime("%Y");    
            for ($i=$endYear ; $i>=$startYear ; $i--)
            {
                echo "<option value='".$i."'>";
                echo $i;
                echo "</option>";
            }
          ?>
          </select>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">Semester</label>
        <div class="col-sm-10">
          <label class="radio-inline">
            <input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="first" checked> First
          </label>
          <label class="radio-inline">
            <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="second"> Second
          </label>
          <label class="radio-inline">
            <input type="radio" name="inlineRadioOptions" id="inlineRadio3" value="summer"> Summer
          </label>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">Class</label>
        <div class="col-sm-2">
          <select name="numclass" class="form-control">
          <?php
            $startClass = 1;
            $endClass = 30;
            for ($i=$startClass ; $i<=$endClass ; $i++)
            {
                echo "<option value='".$i."'>";
                echo $i;
                echo "</option>";
            }
          ?>
          </select>
        </div>
      </div>
      <div class="form-group">
        <div class="">
          <div class="col-sm-offset-2 col-sm-10">
            <input type="file" name="fileToUpload" id="fileToUpload"/>
          </div>
        </div>
      </div>      
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <input type="submit" value="Submit" class="btn btn-success">
        </div>
      </div>      
    </form>
  </div>  
</div>
</body>
</html>