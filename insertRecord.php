<?php
session_start();
$upass=$_POST['upass'];
$confirmpass=$_POST['confirmpass'];
$uname=$_SESSION['uname'];
$uemail=$_SESSION['uemail'];
$umobno=$_SESSION['umobno'];
$uadd=$_SESSION['uadd'];
if($upass==$confirmpass)
{
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
		$sql="insert into register(uname,uemail,uphn,uadd,upass,confirmpass)values('$uname','$uemail','$umobno','$uadd','$upass','$confirmpass')";
		$result=$cn->query($sql);
		echo"<script>
			alert('Registered Successfully');
			document.location='home.php'
			</script>";
	
}

?>
