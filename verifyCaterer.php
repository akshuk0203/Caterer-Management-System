<?php
session_start();
$pass=$_POST['pass'];
$email=$_POST['email'];
$_SESSION['email']=$_POST['email'];
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
	$sql="select * from caterer where cat_email='$email'";
	$result=$cn->query($sql);
	$rowcount=$result->rowcount();
	if($rowcount>=1)
	{
		$sql1="select * from caterer where cat_pass='$pass'";
		$result1=$cn->query($sql1);
		$rowcount1=$result1->rowcount();
		if($rowcount1>=1)
		{
			echo"<script>
				alert('Login successfully!');
				document.location='homeCaterer.php'
				</script>";
				
		}
		else
		{
			echo"<script>
			alert('Incorrect Password');
			document.location='loginCaterer.html'
			</script>";
		}
	}
	else
	{
		echo"<script>
				alert('No information found!');
				document.location='loginCaterer.html'
				</script>";
	}

?>
