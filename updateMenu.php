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
#backbtn
	{
		font-size:20px;
		cursor:pointer;
		margin:20px;
	}
.submit{
	top-margin:15%;
	background:#e6e6fa;
	border-radius:4px;
	font-size:18px;
	width:8%;
	font-weight:500;
	font-family:Monospaced;
}
input{
	font-size:17px;
	margin-left:10px;
	font-family:Monospaced;
}
select{
	font-size:17px;
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
<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" bgcolor="#ffb6c1" align="center">
Select menu id to update record:
 Menu id:<select name="mid" value="<?php echo $_POST['mid']; ?>">
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
		<input type="submit" value="Select" class="submit">
</form>
<?php
if(isset($_POST['mid']))
{
	$mid=$_POST['mid'];
	$sql1="select * from menu where i_id ='$mid'";
	$result1=$cn->query($sql1);
	$result1->setFetchMode(PDO::FETCH_ASSOC);
	$row1=$result1->fetch();
	$mn=$row1['i_name'];
	$mp=$row1['i_price'];
	$mc=$row1['i_category'];
}
?>
<form action="updateMenu1.php" method="post" align="center" bgcolor="#ffb6c1">
Edit details you want to update:
Menu id:<?php if(isset($_POST['mid'])){echo $_POST['mid'];}?><br><input type="hidden" value="<?php if(isset($_POST['mid'])){ echo $_POST['mid'];} ?>" name="mi">

Menu-name:<input type="text" name="mname" value="<?php if(isset($_POST['mid'])){ echo $mn;} ?>"><br>

Menu-price:<input type="text" name="mprice" value="<?php if(isset($_POST['mid'])){echo $mp;} ?>"><br>

Menu-category:<input type="text" name="mcategory" value="<?php if(isset($_POST['mid'])){ echo $mc; }?>"><br>

<input type="submit" value="Update" class="submit">
</form>
</body>
</html>