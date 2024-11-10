<?php
session_start();
$uid=$_SESSION['uid'];
$iname=$_POST['iname'];
$iprice=$_POST['iprice'];
$i_id=$_POST['i_id'];
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
		$quantity="";
		$grantTotal=0;
		$sql2="select * from cart where i_id='$i_id' and uid='$uid'";
		$result2=$cn->query($sql2);
		$rowcount2=$result2->rowcount();
		$result2->setFetchMode(PDO::FETCH_ASSOC);
		$row2=$result2->fetch();
		if($rowcount2>0)
		{
			$quantity=$row2['i_quantity'];
			$quantity++;
			$total=$quantity * $iprice;
			$sql="update cart set i_quantity='$quantity',total='$total' where i_id='$i_id' and uid='$uid'";
			$result2=$cn->query($sql);
		}
		else
		{
			$total1=1* $iprice;
			$sq2="insert into cart(uid,i_id,i_name,i_price,i_quantity,total)values('$uid','$i_id','$iname','$iprice',1,'$total1')";
			$result=$cn->query($sq2);
		}
		
		echo"<script>
		alert('Successfully added to cart');
		document.location='showMenu.php'
		</script>";
?>
