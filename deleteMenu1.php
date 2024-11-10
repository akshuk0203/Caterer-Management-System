<?php
$selectedid=$_POST['mid'];
$selectedname=$_POST['mname'];
$choice=$_POST['choice'];

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
	
	switch($choice)
	{
		case 1:
			$sql="delete from menu where i_id='$selectedid'";
			$result=$cn->query($sql);
			echo"<script>
			
			alert('Successfully Removed from Menu );
			document.location='deleteMenu.php'
			</script>";
			break;
			
		case 2:
			$sql="delete from menu where i_name='$selectedname'";
			$result=$cn->query($sql);
			echo"<script>
			alert('Successfully Removed from Menu);
			document.location='deleteMenu.php'
			</script>";
			break;
	}
?>