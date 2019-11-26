<!DOCTYPE HTML>
<html>
<head>
	<title>Revaluation Application</title>
<link rel="stylesheet" type="text/css" href="stylesecond.css" />
<style type="text/css">
.button {
	background-color: #555555;
	color: white;
	border: none;
	padding: 15px 32px;
	text-align: center;
	transition: all 0.5s;
	text-decoration: none;
	display: inline-block;
	font-size: 20px;
	position: absolute;
	left:640px;
	top:950px;
}
.button:hover {
	background-color: #e7e7e7;
	color: black;
}

</style>

</head>
<body style="background-color:#b3b3b3;">
<div class="header">
<div class="logo">
<a href="http://www.bmsce.ac.in/" target="_blank">
<img src="BMS_logo.png" height="70px" width="65px" alt="BMSCE" />
</a>
</div>
<h1 style="position:absolute;left:525px;top:10px;">BMS College of Engineering<br/><h5 style="position:absolute;left:625px;top:55px;">( Autonomous College Under VTU )</h5></h1><br/>
</div>

<br/>
<div class="h1">
<h1 align="center">Payment Gateway</h1>
</div>
<br/><br/>

<h3 style="position:absolute; left:575px; font-family:sans-serif;">Successfully Applied For Revaluation</h3><br/><br/>
<h3 style="position:absolute; left:550px; font-family:sans-serif;">Make Payment Or Contact The Department</h3><br/><br>
<h3 style="position:absolute; left:625px; font-family:sans-serif;">Number of subjects : <?php $checkbox1=$_POST['check'];
	$checkbox1=$_POST['check'];
	$numsub=sizeof($checkbox1);
	$cost=300*$numsub;
	 echo "<h3 style='position:absolute; left:825px; font-family:sans-serif;'>".$numsub."</h3>";?><br/><br/></h3>
<h3 style="position:absolute; left:670px; font-family:sans-serif;">Amount :  <?php echo "<h3 style='position:absolute; left:770px; font-family:sans-serif;'>".$cost."</h3>"; ?>     </h3>


<br/><br/>
<pre>
<h2 style="position:absolute;left:420px; top:450px; font-family:'Open Sans',sans-serif">Tez                                                                   Paytm</h2>
</pre>

<pre>
<img src="tez.png" alt="tez" style="width:300px; height:300px; position:absolute;left:300px;top:550px;"/>               <img src="paytm.png" alt="tez" style="width:300px; height:300px; position:absolute;left:800px;top:550px;"/>
</pre><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>


<?php
	session_start();

	$checkbox1=$_POST['check'];
	$type=$_POST['type'];
	//print_r($type);



	$s=implode($checkbox1);
	$t=trim($s,"|");
	$a=explode("|",$t);
	//print($type);



	if($checkbox1)
	{

	//$dbc=mysqli_connect("127.0.0.1:3306","root","");

	//if(!$dbc)
//	exit("Database error");

$mdb=new MongoDB\Driver\Manager("mongodb://localhost");
if(!$mdb)
exit("Database error");

	//$dbser=mysqli_select_db($dbc,"homedata");
//	if(!$dbser)
//		exit("Error selecting database");



		date_default_timezone_set("Asia/Kolkata");



				for($i=0,$j=1;$i<count($a);$i=$i+2,$j=$j+2)
				{
      // $sql ="INSERT INTO applydata VALUES ('".$_SESSION['name']."','".$_SESSION['usn']."','".$_SESSION['branch']."','".$_SESSION['sem']."','$a[$j]','$a[$i]','".date('y/m/d h:i:sa')."')";
	   //$result=mysqli_query($dbc,$sql);
		// print("test");
		 $doc = array(
			 "name" => $_SESSION['name'],
			 "usn" => $_SESSION['usn'],
			 "branch" => $_SESSION['branch'],
			 "sem" => $_SESSION['sem'],
			 "subname" => $a[$j],
			 "subcode" => $a[$i],
			 "type" => $type,
			 "date" => date("Y-m-d"),
		 );
		 $insert = new MongoDB\Driver\BulkWrite;
		$insert->insert($doc);
		$mdb->executeBulkWrite('reval.applydata', $insert);

		 // if(!$result)
		 // 	{
			// 	exit("Error entry");
			// }
		}
}

	else
	{
		print("<script type='text/javascript'>alert('No Subject selected. Try Again')</script>");
		header('refresh:0;url=/second.php');
		exit;
	}
//	$dbc->close();

session_destroy();


?>

<br/><br/><br/>
<button type="button" class="button" 	onclick="location.href='/front.html'">OKAY</button>
</body>


</html>
