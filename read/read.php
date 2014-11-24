<?php include_once("{$_SERVER['DOCUMENT_ROOT']}/cpelecture/assets/init.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Reading Area</title>
<style>
.scrollable-menu {
    height: auto;
    max-height: 200px;
    overflow-x: hidden;
}
</style>
<script language="javascript">
$(function(){
$(".dropdown-menu").on('click', 'li a', function(){
  //var selText = $(this).text();
  var selTextOld = $(this).html();
  var selText = selTextOld.match("<p>(.*)</p>")[1];
  //window.alert(selText);

 $(this).parent('li').siblings().removeClass('active');
    //$('#vl').val($(this).attr('data-value'));
	$(this).parents('.btn-group').find('.selection').html(selText);
	$(this).parents('.btn-group').find('.form-control').val($(this).attr('data-value'));
  $(this).parents('li').addClass("active");
  
});
});
</script>
<script language="javascript">
	function echoValue(id) {
		window.alert('this is' + id + ' ' + document.getElementById(id).value);
	}
	
	function sendSearch() {
		var subject = document.getElementById('selSubject').value;
		var teacher = document.getElementById('selTeacher').value;
		var year = document.getElementById('selYear').value;
		var term = document.getElementById('selTerm').value;
		var my_data = '&subject='+subject
						+'&teacher='+teacher
						+'&year='+year
						+'&term='+term;
		$.ajax({
			type: 'POST',
			url: '/cpelecture/read/search.php',
			data: my_data,
			success: listSearch
		})
	}
	function listSearch(e) {
		document.getElementById('tableLabel').innerHTML = "Searching Result";
		document.getElementById('searchResult').innerHTML = e;
	}
	function showLectureInModal(address, type) {
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
		xmlhttp.open("GET","showlecture.php?address="+address+"&type="+type,true);
		xmlhttp.send();
	}
</script>
</head>

<body>
<!-- ====================start nav bar==================== -->
<?php include_once("{$_SERVER['DOCUMENT_ROOT']}/cpelecture/assets/navbar.php"); ?>
<!-- ====================end nav bar==================== --> 

<!-- Yo format -->
<div class="container" id="divElement">
<!-- end Yo format -->

<!-- ================== start page header <not page title> =============== -->
<div class="page-header">
  
  <h1>Reading Area <small>
    <h4></h4>
    </small></h1>
</div>
<div id='divElement'>
		<p>Here, you can search any lecture you wish.</p>
        <p>Note: Choose an option in each dropdown list to specify your search or omit it if you want to see all.</p>
		<br>
	</div>
<!-- ================== end page header <not page title> ================= --> 

<!-- ==================================== start ALL dropdown of searching option ================================= -->

<!-- ============================ start of SUBJECT dropdown menu =========================== -->
<?php
$db = DBConnector::connectToDB();
$strSQL = "SELECT * FROM subject";
$paramArr = array();
$allSubject = $db->queryThis($strSQL, $paramArr);
?>
<div style="display:inline;">
  <div class="btn-group">
  	<a class="btn btn-default dropdown-toggle btn-blog " data-toggle="dropdown" href="#" id="dropdownMenu1" style="width:150px;">
  		<span class="selection pull-left">Select Subject/All</span>
    	<span class="pull-right glyphiconglyphicon-chevron-down caret" style="float:right;margin-top:10px;"></span>
    </a>
    
    <ul class="dropdown-menu scrollable-menu" role="menu" aria-labelledby="dropdownMenu1">
    
      <li><a data-value="ALL">
        <p>ALL</p>
        <h4>Include all subjects in the list.</h4>
      </a></li>
      
	<?php
		$i=0;
    	for ($i=0 ; $i<count($allSubject) ; $i++) {
      		echo "<li><a data-value='".$allSubject[$i]->subjectID."'>";
        	echo "<p>".$allSubject[$i]->subjectID."</p>";
        	echo "<h4>".$allSubject[$i]->subjectName."</h4>";
      		echo "</a></li>";
	  	}
	?>
    </ul>
    <input type="hidden" class="form-control" id="selSubject" value="ALL"/>
  </div>
  <!--Use to display the selected list in menu in stead of hide it like above-->
  <!--<div style="display:inline;"><input type="text" class="form-control" placeholder="Username" id="option1" style="width:200px;" readonly="readonly" onmouseover="this.style.cursor='pointer'; " onclick="echoValue(this.id)"></div>-->
 
</div>
<!-- ============================ end of SUBJECT dropdown menu =========================== -->

<!-- ============================ start of TEACHER dropdown menu =========================== -->
<?php
$strSQL = "SELECT * FROM teacher";
$paramArr = array();
$allTeacher = $db->queryThis($strSQL, $paramArr);
?>
<div style="display:inline;">
  <div class="btn-group">
  	<a class="btn btn-default dropdown-toggle btn-blog " data-toggle="dropdown" href="#" id="dropdownMenu1" style="width:250px;">
  		<span class="selection pull-left">Select Teacher/All</span>
    	<span class="pull-right glyphiconglyphicon-chevron-down caret" style="float:right;margin-top:10px;"></span>
    </a>
    
    <ul class="dropdown-menu scrollable-menu" role="menu" aria-labelledby="dropdownMenu1">
    
      <li><a class="" data-value="ALL">
        <p>ALL</p>
        <h4>Include all teachers in the list.</h4>
      </a></li>
      
	<?php
		$i=0;
    	for ($i=0 ; $i<count($allTeacher) ; $i++) {
      		echo "<li><a data-value='".$allTeacher[$i]->teacherID."'>";
        	echo "<p>".$allTeacher[$i]->teacherName."</p>";
        	echo "<h4>".$allTeacher[$i]->teacherID."</h4>";
      		echo "</a></li>";
	  	}
	?>
    </ul>
  <input type="hidden" class="form-control" id="selTeacher" value="ALL"/>
  </div>
</div>
<!-- ============================ end of TEACHER dropdown menu =========================== -->

<!-- ============================ start of YEAR dropdown menu =========================== -->
<div style="display:inline;">
  <div class="btn-group">
  	<a class="btn btn-default dropdown-toggle btn-blog " data-toggle="dropdown" href="#" id="dropdownMenu1" style="width:100px;">
  		<span class="selection pull-left">Year/All</span>
    	<span class="pull-right glyphiconglyphicon-chevron-down caret" style="float:right;margin-top:10px;"></span>
    </a>
    
    <ul class="dropdown-menu scrollable-menu" role="menu" aria-labelledby="dropdownMenu1">
    
      <li><a data-value="ALL">
        <p>ALL</p>
      </a></li>
      
	<?php
		$i=0;
		$startYear = 1989;
		$endYear = strftime("%Y");
		
    	for ($i=$endYear ; $i>=$startYear ; $i--) {
      		echo "<li><a data-value='".$i."'>";
        	echo "<p>".$i."</p>";
      		echo "</a></li>";
	  	}
	?>
    </ul>
    <input type="hidden" class="form-control" id="selYear" value="ALL"/>
  </div>
  
</div>
<!-- ============================ end of YEAR dropdown menu =========================== -->
<!-- ============================ start of SEMESTER dropdown menu =========================== -->
<div style="display:inline;">
  <div class="btn-group">
  	<a class="btn btn-default dropdown-toggle btn-blog " data-toggle="dropdown" href="#" id="dropdownMenu1" style="width:120px;">
  		<span class="selection pull-left">Semester/All</span>
    	<span class="pull-right glyphiconglyphicon-chevron-down caret" style="float:right;margin-top:10px;"></span>
    </a>
    
    <ul class="dropdown-menu scrollable-menu" role="menu" aria-labelledby="dropdownMenu1">
    
      <li><a data-value="ALL">
        <p>ALL</p>
      </a></li>
      <li><a data-value="first">
        <p>First</p>
      </a></li>
      <li><a data-value="second">
        <p>Second</p>
      </a></li>
      <li><a data-value="summer">
        <p>Summer</p>
      </a></li>
    </ul>
    <input type="hidden" class="form-control" id="selTerm" value="ALL"/>
  </div>
  
</div>
<!-- ============================ end of ONE dropdown menu =========================== -->


<!--==================================== debug code ================================== -->
<!-- To test the value of each option
1. Uncomment the following code.
2. Change argument of echoValue to specific element id.
3. Run and click on a button on the screen.
-->
<br><br />
<div style="text-align:center;"><button type="button" class="btn btn-success" onclick="sendSearch()"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Search</button>
</div>
<!--================================ end debug code ================================== -->
<!-- ==================================== end ALL dropdown of searching option ================================= -->

<h3 id="tableLabel">Latest Upload</h3>
<!-- ==================================== start search result - copy from yo- manage.php ======================= -->
<div id="divElement">
	    	<div class="col-md-6" id='divElement'>
	          <table class="table table-hover" id="searchResult"> 
	            <thead>
	              <tr>
	                <th>#</th>
	                <th>File Name</th>
	                <th>Upload Date</th>
	                <th style="text-align:center;">Class</th>
	              </tr>
	            </thead>
	            <tbody>
	            <?php
				$db = DBConnector::connectToDB();
				$result = $db->queryThis("SELECT * FROM lecture WHERE status = 'Approved' ORDER BY uploadDate DESC", array());
				$i=1;
	            foreach ($result as $iResult) { 
					if ($i==10) {
						break;
					}
	            	$filename = end(explode("/", $iResult->address));
					$filetype = end(explode(".", $iResult->address));
					$absAddress = "/cpelecture/".$iResult->address;
					if ($filetype != "pdf") {
						$filetype = "image";
					}
					echo "<tr>
						  <td>".$i."</td>
						  <td>".$filename."<button type='button' class='btn btn-xs btn-primary' data-toggle='modal' data-target='#myModal' onclick=\"javascript:showLectureInModal('".$absAddress."', '".$filetype."')\";><span class='glyphicon glyphicon-search' aria-hidden='true'></span>
						  </button></td>
						  <td>".$iResult->uploadDate."</td>
						  <td align=\"center\">".$iResult->numClass."</td>
						  </tr>";
					$i++;
				} 
	            ?>
	            </tbody>
	          </table>
	        </div>
</div>
<!-- ==================================== end search result - copy from yo- manage.php ======================= -->

</div>
<!-- /Yo format -->

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

</body>
</html>
