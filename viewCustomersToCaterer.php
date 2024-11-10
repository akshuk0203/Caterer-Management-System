<html>
<head><title>Customer's Info</title>
<style>
	.container{
		margin-left:20%;
		font-size:20px;
		font-weight:530;
	}
	.title{
		margin-right:0.2rem;
	}
	#back{
		font-size:17px;
	}
</style>
</head>
<body bgcolor="lavender">
<a href="homeCaterer.php"><input type="button" value="back" id="back"></a>
<div class="container">
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
	
	$sql="select * from caterer where cat_email='$email'";
	$result=$cn->query($sql);
	$result->setFetchMode(PDO::FETCH_ASSOC);
	$row=$result->fetch();
	$cid=$row['c_id'];
	
	$sql1="select u_id from order1 where c_id='$cid'";
	$result1=$cn->query($sql1);
	$rowcount=$result1->rowcount();
	if($rowcount>0)
	{
		echo"No of Customers: $rowcount<br><br>";
		$i=1;
		foreach($result1 as $row1)
		{
			$sql2="select * from register where uid='$row1[0]'";
			$result2=$cn->query($sql2);
			$result2->setFetchMode(PDO::FETCH_ASSOC);
			$row2=$result2->fetch();
			 $uid=$row2['uid'];
			 $uname=$row2['uname'];
			 $uemail=$row2['uemail'];
			 $uphn=$row2['uphn'];
			 $uadd=$row2['uadd'];
			{
				echo"<label class='title'>Sr No</label>: $i<br>";
				echo"<label class='title'>Customer id:</label>  $uid<br>";
				echo"<label class='title'>Customer Name:</label> $uname <br>";
				echo"<label class='title'>Customer Email:</label> $uemail<br>";
				echo"<label class='title'>Customer Contact no:</label> $uphn<br>";
				echo"<label class='title'>Customer Address:</label> $uadd<br>";
				$i++;
			}
		}
	}
	else
	{
		echo"Customers Not Found Yet";
	}
?>
</div>
</body>
</html>