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
?>
<html>
<head>
<title>Received Orders</title>
<style>
body{
	background:lavender;
}
#back{
		font-size:17px;
	}
</style>
</head>
<body>
<a href="homeCaterer.php"><input type="button" value="back" id="back"></a>
<h2>Order Received:</h2>
<?php
	$sql="select * from caterer where cat_email='$email'";
	$result=$cn->query($sql);
	$result->setFetchMode(PDO::FETCH_ASSOC);
	$row=$result->fetch();
	$cid=$row['c_id'];
	
	$sql2="select * from order1 where c_id='$cid'";
	$result2=$cn->query($sql2);
	$rowcount=$result2->rowcount();
	if($rowcount>0)
	{
		echo"Total No of order received: $rowcount";
		foreach($result2 as $row2)
		{
			//Customer id 
			$sql4="select * from register where uid='$row2[1]'";
			$result4=$cn->query($sql4);
			$result4->setFetchMode(PDO::FETCH_ASSOC);
			$row4=$result4->fetch();
			$uid=$row4['uid'];
			echo"Customer id: $uid";
			
			//Get order details from id
			$oid=$row2['o_id'];
			$sql5="select * from order1 where o_id='$oid'";
			$result5=$cn->query($sql5);
			$result5->setFetchMode(PDO::FETCH_ASSOC);
			$row5=$result5->fetch();
			$odate=$row5['o_date'];
			$otime=$row5['o_time'];
			$ototal=$row5['o_total'];
			$oadd=$row5['o_add'];
			echo"Order id:$oid<br>";
			echo"Order date:$odate<br>";
			echo"Order time:$otime<br>";
			echo"Order total:$ototal<br>";
			echo"Order address:$oadd<br>";
		
		
			echo'<table>
			<tr>
				<th>Item_id</th>
				<th>Name</th>
				<th>Price</th>
				<th>Quantity</th>
			</tr>';
			$sql3="select * from cart_order1 where o_id='$oid'";
			$result3=$cn->query($sql3);
			foreach($result3 as $row3)
			{
			
				echo"
					<tr>
						<td>    $row2[2] </td>
						<td>	$row3[3]</td>
						<td>	$row3[4]</td>
						<td>	$row3[5]</td>
					</tr>
				";
			}
			
		}
	}
	else
	{
		echo"No orders received yet";
	}
?>
</body>
</html>