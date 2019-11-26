<?php
  header('Cache-Control: no cache');
  session_cache_limiter('must-revalidate');
  session_start();
	$_SESSION['homepost']=$_POST;

	$_SESSION['name']=$user_name=$_POST['name'];
	$_SESSION['usn']=$susn=$_POST['usn'];
	$_SESSION['sem']=$sems=$_POST['sem'];
	$_SESSION['branch']=$sbranch=$_POST['branch'];
	$_SESSION['phone']=$mobno=$_POST['phn'];
	$_SESSION['email']=$mail=$_POST['email'];


    $check=substr($susn,5,2);
    $check=strtolower($check);

	if(!(($check=='cs' && $sbranch=='CSE') || ($check=='ec' && $sbranch=='ECE') || ($check=='is' && $sbranch=='ISE')))
	{
		print("<script type='text/javascript'>alert('Invalid USN and Branch. Try Again')</script>");
		exit(header("refresh:0;url=home.html"));
	}


	//db connectn and insertn of form data

	//$dbc=mysqli_connect("127.0.0.1:3307","root","","homedata");
	//if(!$dbc)
	//exit("Database error");

  $mdb=new MongoDB\Driver\Manager("mongodb://localhost");
  if(!$mdb)
	exit("Database error");

//  $dbc = $mdb->reval->test;
  //if(!$dbc)
	//exit("Error selecting database");

	//$dbser=mysqli_select_db($dbc,"homedata");

	//if(!$dbser)
	//exit("Error selecting database");
  $insert = new MongoDB\Driver\BulkWrite;

     //$sql ="INSERT INTO homedata VALUES ('$user_name','$susn','$sems','$sbranch','$mobno','$mail')";
	   //$result=$dbc->query($sql);

     $doc = array(
       "name" => $user_name,
       "usn" => $susn,
       "sems" => $sems,
       "branch" => $sbranch,
       "mobno" => $mobno,
       "mailid" => $mail
     );

     $insert->insert($doc);
     $result = $mdb->executeBulkWrite('reval.homedata', $insert);
	   if(!$result)
	{
	exit("Error entry");
	}
    //$dbc->close();


	include 'second.php';

?>
