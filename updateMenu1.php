<?php
$mi=$_POST['mi'];
$mn=$_POST['mname'];
$mp=$_POST['mprice'];
$mc=$_POST['mcategory'];
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
	
	$sql="update menu set i_name='$mn',i_price='$mp',i_category='$mc' where i_id='$mi'";
	$result=$cn->query($sql);
	echo"<script>
			alert('Updated menu Successfully');
			document.location='updateMenu.html'
			</script>";
?>