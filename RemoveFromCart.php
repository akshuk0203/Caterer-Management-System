<?php
session_start();
$uid=$_POST['uid'];
$i_id=$_POST['mid'];
$i_quantity=$_POST['mquantity'];
$i_price=$_POST['mprice'];
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
		$sql2="select * from cart where i_id='$i_id' and uid='$uid'";
		$result2=$cn->query($sql2);
		$rowcount2=$result2->rowcount();
		$result2->setFetchMode(PDO::FETCH_ASSOC);
		$row2=$result2->fetch();
		if($rowcount2>0)
		{
			$quantity=$row2['i_quantity'];
			if($quantity==1)
			{
				$sql3="delete from cart where i_id='$i_id' and uid='$uid'";
				$result3=$cn->query($sql3);
			}
			if($quantity>1)
			{
				echo"quantity before:$quantity";
				$quantity--;
				echo"quantity after:$quantity";
				$total=$quantity * $i_price;
				$sql="update cart set i_quantity='$quantity',total='$total' where i_id='$i_id' and uid='$uid'";
				$result2=$cn->query($sql);
			}
			echo"<script>
			alert('Item removed from cart');
			document.location='showMenu.php'
			</script>";
		}

?>