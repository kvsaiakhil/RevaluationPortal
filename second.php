<!DOCTYPE html>
<html lang="en">

<head>
<title>Revaluation Application</title>
<style type="text/css">
.button{
  border-radius: 15px;
  background: #444;
  padding: 0px;
  width: 130px;
  height: 35px;
color:white;
position:absolute;
left:505px;
}
</style>
</head>

<body  style="background-image: linear-gradient(to right,black 50%,red 120% ),url('r.jpg');
    background-blend-mode:overlay;background-repeat:no-repeat;background-size:1800px 1500px">

    <link rel="stylesheet" type="text/css" href="stylesecond.css" />

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
<h1 align="center">Select Subjects for Revaluation</h1>
</div>
<br/><br/>

<ul>
  <li><a href="front.html">Home</a></li>
  <li><a href="http://www.bmsce.in/about-us-0" target="_blank" >About</a></li>
  <li><a href="login.html">Login</a></li>
  <li><a href="contact.html">Contact</a></li>
 </ul>



<?php

  $usns=strtoupper($_SESSION['usn']);

	echo "<h3 style='position:absolute; left:450px; font-family:sans-serif;'>Name : ".$_SESSION['name']."</h3>";
	echo "<h3 style='position:absolute; left:850px; font-family:sans-serif;'>USN : " .$usns."</h3><br/><br/><br/>";
	echo "<h3 style='position:absolute; left:450px; font-family:sans-serif;'> Semster : " .$_SESSION['sem']."</h3>";
	echo "<h3 style='position:absolute; left:850px; font-family:sans-serif;'> Branch : " .$_SESSION['branch']."</h3><br/><br/><br/><br/><br/><br/><br/><br/>";

?>

</p>

<form name="subjects" action="third.php" method="POST">

<?php


	//db connection

//	$con=mysqli_connect("127.0.0.1:3307","root","","subjects");
//	if(!$con)
//		exit("Database connect error");

  $mdb=new MongoDB\Driver\Manager("mongodb://localhost");
  if(!$mdb)
  exit("Database error");

  //$dbc = $mdb->reval->test;

	//table selection

	$var=$_SESSION['sem'].$_SESSION['branch'];
  if($var=='VIIISE'||$var=='VIIIISE')
  {
    print("<script type='text/javascript'>alert('Not Yet Available for the current Semester And Branch')</script>");
		exit(header("refresh:0;url=home.html"));
  }

	switch($var)
	{
		case 'ICSE' : $tab="1comman";
					   break;
		case 'IECE' : $tab="1comman";
					   break;
		case 'IISE' : $tab="1comman";
					   break;
		case 'IICSE': $tab="2comman";
					    break;
		case 'IIISE': $tab="2comman";
					    break;
		case 'IIECE':  $tab="2comman";
					    break;
		case 'IIICSE' : $tab="3cse";
						break;
		case 'VCSE' : $tab="5cse";
						break;
		case 'VIICSE' : $tab="7cse";
						break;
		case 'IVCSE' : $tab="4cse";
						break;
		case 'IVECE' : $tab="4ece";
						break;
		case 'VICSE' : $tab="6cse";
						break;
		case 'VIECE' : $tab="6ece";
						break;
		case 'IIIISE' : $tab="3ise";
						break;
		case 'IVISE' : $tab="4ise";
						break;
		case 'VISE' : $tab="5ise";
						break;
		case 'VIISE' : $tab="6ise";
						break;
		case 'IIIECE' : $tab="3ece";
						break;
		case 'VCSE' : $tab="5ece";
						break;
		case 'VIIECE' : $tab="7ece";
						break;
	}

	//Prints 8 sem subjects


	if($var=='VIIICSE' || $var=='VIIIECE')
	{
		switch($var)
		{
			case 'VIIICSE' : $tab="8cs";
							  break;
			case 'VIIIECE' : $tab="8ece";
							  break;
		}

	//$sql="SELECT serial,subcode,subname,fee FROM $tab";
	//$result=$con->query($sql);

  $table = 'subjects.'.$tab;

  $filter = [];
  $options = [];

  $query = new MongoDB\Driver\Query($filter, $options);
  $result = $mdb->executeQuery($table, $query);
  $result->setTypeMap(['root' => 'array', 'document' => 'array', 'array' => 'array']);

	if(!$result)
	{
	exit("Error selecting table");
	}



	//if($result->num_rows>0)
  if($result)
	{
	echo "<table align='center'><tr><th class='text-left'>Serial </th><th class='text-left'>Subject Code </th><th class='text-left'>Subject Name </th><th class='text-left'>Fee </th><th class='text-left'> Type </th><th class='text-left'> Select </th></tr>";
	//for($i=1;$row=$result->fetch_assoc();$i++)
  foreach($result as $row)
	{
		echo "<tr align='center'><td class='text-left'>" .$i. "</td><td class='text-left'>" .$row["subcode"]. "</td><td class='text-left'>" .$row["subname"]. "</td><td class='text-left'>" .$row["fee"]. "</td><td class='text-left'><select name='type' required><option value='Revaluation'>Revaluation</option><option value='Retotalling'>Retotalling</option></select></td><td class='text-left'><input type='checkbox' name='check[]' id='check[]' value='".$row["subcode"]."|".$row['subname']."|"."'></td></tr>";
	}
	}

  //Prints elective subjects

	$tab="subjects.elective";

  $filter = [];
  $options = [];

  $query = new MongoDB\Driver\Query($filter, $options);
  $result = $mdb->executeQuery($tab, $query);
  $result->setTypeMap(['root' => 'array', 'document' => 'array', 'array' => 'array']);

	//$sql="SELECT serial,subcode,subname,fee FROM $tab";
	//$result=$con->query($sql);


	if(!$result)
	{
	exit("Error selecting table");
	}



	//if($result->num_rows>0)
  if($result)
	{
	//for($i;$row=$result->fetch_assoc();$i++)
  foreach($result as $row)
	{
		echo "<tr align='center'><td class='text-left'>" .$i. "</td><td class='text-left'>" .$row["subcode"]. "</td><td class='text-left'>" .$row["subname"]. "</td><td class='text-left'>" .$row["fee"]. "</td><td class='text-left'><select name='type' required><option value='Revaluation'>Revaluation</option><option value='Retotalling'>Retotalling</option></select></td><td class='text-left'><input type='checkbox' name='check[]' id='check[]' value='".$row["subcode"]."|".$row['subname']."|"."'></td></tr>";
    $i++;
	}
	echo "</table>";
	}
	}

	// Prints if not last sem

	else
	{

	//$dbs=mysqli_select_db($con,"subjects");
	//if(!$dbs)
	//	exit("Error selecting");

	//$sql="SELECT serial,subcode,subname,fee FROM $tab";
  //$result=$con->query($sql);

  $mdb=new MongoDB\Driver\Manager("mongodb://localhost");
  if(!$mdb)
  exit("Database error");


  $table = 'subjects.'.$tab;

  $filter = [];
  $options = [];

  $query = new MongoDB\Driver\Query($filter, $options);
  $result = $mdb->executeQuery($table, $query);
  $result->setTypeMap(['root' => 'array', 'document' => 'array', 'array' => 'array']);



	if(!$result)
	{
	exit("Error selecting table");
	}



	//if($result->num_rows>0)
  if($result)
	{
	echo "<table align='center'><tr><th class='text-left'>Serial </th><th class='text-left'>Subject Code </th><th class='text-left'>Subject Name </th><th class='text-left'>Fee </th><th class='text-left'> Type </th><th class='text-left'> Select </th></tr>";
	//for($i=0;$row=$result->fetch_assoc();$i++)
  foreach($result as $row)
	{
		echo "<tr align='center'><td class='text-left'>" .$row['serial']. "</td><td class='text-left'>" .$row["subcode"]. "</td><td class='text-left'>" .$row["subname"]. "</td><td class='text-left'>" .$row["fee"]. "</td><td class='text-left'><select name='type'><option value='Revaluation'>Revaluation</option><option value='Retotalling'>Retotalling</option></select></td><td class='text-left'><input type='checkbox' name='check[]' id='check[]' value='".$row["subcode"]."|".$row['subname']."|"."'></td></tr>";

	}
	echo "</table>";
	}
	}

	//end of file
?>

<br/>
<br/>
<br/>
<input type="button" class="button"  name="back" value="Back" onclick="location.href='home.html';" />
<input type ="reset" class="rcorners2"  name="reset" value="Reset" />
<input type ="submit" class="rcorners3"  name="submit" value="Proceed to Pay" /><br/><br/><br/>
</form>

</body>
</html>
