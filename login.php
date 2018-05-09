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
}
.button:hover {
  background-color: #e7e7e7;
  color: black;
}

</style>

</head>
<body  style="background-color:#8A989B">
<div class="header">
<div class="logo">
<a href="http://www.bmsce.ac.in/" target="_blank">
<img src="BMS_logo.png" height="70px" width="65px" alt="BMSCE" />
</a>
</div>
<h1 style="position:absolute;left:480px;top:10px;">BMS College of Engineering<br/><h5 style="position:absolute;left:580px;top:55px;">( Autonomous College Under VTU )</h5></h1><br/>
</div></div>
<br/>
<br/>
<br/>
<br/>

<?php
if(isset($_POST["name"], $_POST["pass"]))
  {

      $name = $_POST["name"];
      $password = $_POST["pass"];

    if(!($name=='bmsce' && $password=='bms@123'))
      {
        print("<script type='text/javascript'>alert('Invalid USN or Password')</script>");
        exit(header("refresh:0;url=login.html"));
      }
    else
      {
        $dbc=mysqli_connect("127.0.0.1:3307","root","","homedata");

      	if(!$dbc)
      	exit("Database error");

      	$dbser=mysqli_select_db($dbc,"homedata");

      	if(!$dbser)
      	exit("Error selecting database");

           $sql ="SELECT * FROM applydata ORDER BY subcode";
      	   $result=$dbc->query($sql);
      	   if(!$result)
      	{
      	exit("Error Table");
      	}

      	if($result->num_rows>0)
      	{
      	echo "<table align='center'><tr><th>Name</th><th>USN</th><th>Branch</th><th>Sem</th><th>Subject Name</th><th>Subject Code</th><th>Type</th><th>Time</th></tr>";
      	for($i=1;$row=$result->fetch_assoc();$i++)
      	{
      		echo "<tr align='center'><td>" .$row['name']. "</td><td>" .$row["usn"]. "</td><td>" .$row["branch"]. "</td><td>" .$row["sem"]. "</td><td>" .$row["subname"]. "</td><td>" .$row["subcode"]. "</td><td>" .$row['type']. "</td><td>" .$row['date']. "</td></tr>";
      	}
        echo "</table>";
      	}

        else
        {
          print("<script type='text/javascript'>alert('Database Empty')</script>");
          exit(header("refresh:0;url=login.html"));
        }
          $dbc->close();

      }


}
 ?>
<br/><br/><br/><br/>
<button type="button" class="button" style="position:relative; left:45%;" onclick="location.href='/front.html';">Exit</button>

</body>
</html>
