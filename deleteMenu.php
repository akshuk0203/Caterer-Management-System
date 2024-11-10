<html>
<head>
<style>
body{
	background:#F2F3F4;
	color:green;
}
.container{
	font-size:22px;
	margin-top:10%;
	font-weight:550;
}
select{
	font-size:17px;
}

.remove{
	background:#e6e6fa;
	border-radius:4px;
	font-size:18px;
	width:8%;
	font-weight:500;
	font-family:Monospaced;
}
#backbtn
	{
		font-size:20px;
		cursor:pointer;
		margin:20px;
	}
</style>
</head>
<body bgcolor="#ffb6c1">
<a href="homeCaterer.php"><input type="submit" value="Back" id="backbtn"></a>
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
?>
<form action="deleteMenu1.php" method="post" align="center" class="container">
<h3>Choose one to delete record from menu:</h3><br>
	<input type="radio" name="choice" value="1">     Menu id:<select name="mid">
		<?php
			$sql="select i_id from menu";
			$result=$cn->query($sql);
			foreach($result as $row)
			{
		?>
			<option value="<?php echo $row[0];?>"><?php echo $row[0];?></option>
		<?php
			}
		?>
		</select><br><br>

	<input type="radio" name="choice" value="2">     Menu Name:<select name="mname">
		<?php
			$sql="select i_name from menu";
			$result=$cn->query($sql);
			foreach($result as $row)
			{
		?>
			<option value="<?php echo $row[0];?>"><?php echo $row[0];?></option>
		<?php
			}
		?>
		</select><br><br>
	<input type="submit" value="Remove" class="remove">
</form>
</body>
</html>