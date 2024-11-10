<html>
<head>
<style>
body{
	color:black;
	font-weight:bolder;
	font-size:22px;
	background:#F2F3F4;
	color:green;
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
<a href="homeCaterer.php"><input type="submit" value="Back" id="backbtn"><br> </a>
<?php
session_start();
$email=$_SESSION['email'];
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
	//$sql2="select i_id,i_category from menu where cat_id= '$email' group by i_category";
	$sql="select * from caterer where cat_email='$email'";
	$result=$cn->query($sql);
	$result->setFetchMode(PDO::FETCH_ASSOC);
	$row=$result->fetch();
	$cid=$row['c_id'];
	$sql2="select distinct i_category from menu where cat_id='$cid'";
	$result2=$cn->query($sql2);
	 foreach($result2 as $row2)
	 {
		 $cat_title=$row2['i_category'];
	
		$sql="select * from menu where i_category='$cat_title'";
		$result=$cn->query($sql);
		$rowcount=$result->rowcount();
		if($rowcount>0)
		{
			echo"<u>$cat_title</u>:<br>";
			echo'<table>
			<tr>
				<th>Menu id</th>
				<th>Menu name</th>
				<th>Menu price</th>
			</tr>';
			foreach($result as $row)
			{
				echo"<tr>
					<td>$row[0]</td>
					<td>$row[1]</td>
					<td>$row[2]</td>
				</tr>";
			}
			echo'</table><br><br>';
		}
	 }
?>

</body>
</html>