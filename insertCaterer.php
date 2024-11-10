<?php
session_start();
$cpass=$_POST['cpass'];
$c_confirmpass=$_POST['c_confirmpass'];
$cname=$_SESSION['cname'];
$cemail=$_SESSION['cemail'];
$cmobno=$_SESSION['cmobno'];
$cadd=$_SESSION['cadd'];
if($cpass==$c_confirmpass)
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
		$sql="insert into caterer(cat_system_name,cat_email,cat_contact,cat_add,cat_pass,cat_confirmpass)values('$cname','$cemail','$cmobno','$cadd','$cpass','$c_confirmpass')";
		$result=$cn->query($sql);
		echo"<script>
			alert('Registered Successfully');
			</script>";
	
}
?>
