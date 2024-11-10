<html>
<head>
<style>
body{
	color:black;
	font-weight:bolder;
	font-size:22px;
}
td{
	font-size:18px;
}
th{
	font-size:20px;
}
#backbtn
	{
		font-size:20px;
		cursor:pointer;
		margin:20px;
	}
</style>
</head>
<body bgcolor='#ffb6c1'>
<a href="HomeAdmin.html"><input type="submit" value="Back" id="backbtn"></a>
<?php
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
	$sql2="select * from caterer";
	$result2=$cn->query($sql2);
		$rowcount2=$result2->rowcount();
		if($rowcount2>0)
		{
			echo'<table border="2px">
			<tr>
				<th>Caterer id</th>
				<th>Business name</th>
				<th>Email</th> 
				<th>Contact number</th> 
				<th>Address</th> 
			</tr>';
			foreach($result2 as $row)
			{
				echo"<tr>
					<td>$row[0]</td>
					<td>$row[1]</td>
					<td>$row[2]</td>
					<td>$row[3]</td>
					<td>$row[4]</td>
				</tr>";
			}
			echo'</table><br><br>';
		}
	 
?>

</body>
</html>