<?php

$pass=$_POST['pass'];
$email=$_POST['email'];
	try
	{
	$host="localhost";
	$port=3306;
	$dbname="CMS";
	$dbuser="root";
	$dbpass="";
	
	$cn=new PDO("mysql:host=$host; port=$port; dbname=$dbname", $dbuser,$dbpass);
	}
	catch(PDOException $e)
	{
	echo $e->getMessage();
	die();
	}
	$sql="select * from admin where email='$email'";
	$result=$cn->query($sql);
	$rowcount=$result->rowcount();
	if($rowcount>=1)
	{
		$sql1="select * from admin where pass='$pass'";
		$result1=$cn->query($sql1);
		$rowcount1=$result1->rowcount();
		if($rowcount1>=1)
		{
			echo"<script>;
				alert('Login successfully!');
				document.location='HomeAdmin.html'
				</script>";
		}
		else
		{
			echo"<script>
			alert('Incorrect Password');
			document.location='loginAdmin.html'
			</script>";
		}
	}
	else
	{
		echo"<script>
				alert('Invalid details');
				document.location='loginAdmin.html'
				</script>";
	}
	
	


?>
