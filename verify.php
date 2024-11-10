<?php
session_start();
$upass=$_POST['upass'];
$uemail=$_POST['uemail'];
$_SESSION['uemail']=$_POST['uemail'];
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
	$sql="select * from register where uemail='$uemail'";
	$result=$cn->query($sql);
	$rowcount=$result->rowcount();
	if($rowcount>=1)
	{
		$sql1="select * from register where upass='$upass'";
		$result1=$cn->query($sql1);
		$rowcount1=$result1->rowcount();
		if($rowcount1>=1)
		{
			echo"<script>;
				alert('Login successfully!');
				document.location='home.php'
				</script>";
		}
		else
		{
			echo"<script>
			alert('Incorrect Password');
			document.location='loginForm.html'
			</script>";
		}
	}
	else
	{
		echo"<script>
				alert('No user found!Register yourself first');
				document.location='registerForm.html'
				</script>";
	}
	
	


?>
