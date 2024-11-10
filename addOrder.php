<?php
session_start();
$cid=$_SESSION['cid'];
$uid=$_SESSION['uid'];
$o_date=$_SESSION['o_date'];
$o_time=$_SESSION['o_time'];
$o_add=$_SESSION['o_add'];
if($_POST['grantTotal'])
{
	echo "inside";
	$_SESSION['grantTotal']=$_POST['grantTotal'];
}
$grantTotal=$_SESSION['grantTotal'];
$_SESSION['date']=date("l jS \of F Y h:i:s A");

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
$sql="insert into order1(u_id,c_id,o_date,o_time,o_total,o_add)values('$uid','$cid','$o_date','$o_time','$grantTotal','$o_add')";
$result=$cn->query($sql);

echo"<script>
			alert('Order successfully placed');
			</script>";
			
$sql2="select AUTO_INCREMENT from information_schema.TABLES where table_schema='cms' and table_name='order1'";
$result2=$cn->query($sql2);
$result2->setFetchMode(PDO::FETCH_ASSOC);
$row2=$result2->fetch();
$oid=$row2['AUTO_INCREMENT'];	
$oid--;	
$sql1="select * from cart";
$result1=$cn->query($sql1);
foreach($result1 as $row1)
{
	$sql="insert into cart_order1(o_id,uid,i_id,i_name,i_price,i_quantity,total)values('$oid','$row1[0]','$row1[1]','$row1[2]','$row1[3]','$row1[4]',$row1[5])";
	$result=$cn->query($sql);
}

$sql4="delete from cart";
$result4=$cn->query($sql4);
?>
<html>
<head>
<title>Your Bill</title>
<style>
.title{
	font-size:17px;
	font-weight:600;
}
.title1{
	font-size:20px;
	font-weight:700;
	margin-left:30%;
}
.container{
	width:600px;
	margin-left:25%;
	border:thick solid black;
	border-width:1px;
	padding:10px;
	background:lavender;
}
#pay{
	width:30%;
	cursor:pointer;
	border-radius:5px;
	margin-left:65%;
	margin-top:10%;
	background:plum;
	font-size:18px;
}
</style>
</head>
<body>
<div class="container">
<?php
	$sql3="select c_id,cat_system_name from caterer where c_id='$cid'";
	$result3=$cn->query($sql3);
	$result3->setFetchMode(PDO::FETCH_ASSOC);
	$row3=$result3->fetch();
	$cat_system_name=$row3['cat_system_name'];
?>

<?php
	$sql2="select * from register where uid='$uid'";
	$result2=$cn->query($sql2);
	$result2->setFetchMode(PDO::FETCH_ASSOC);
	$row2=$result2->fetch();
?>
<a href="home.php"><input type="button" name="back" value="Back"></a>
<label align="center" class="title1"><?php  echo "$cat_system_name"; ?></label><br><br>
<label class="title">Order ID:</label><?php echo $oid;  ?><br>
<label class="title">Customer name:</label><?php echo $row2['uname'];  ?><br>
<label class="title">Email:       </label><?php echo $row2['uemail'];  ?><br>
<label class="title">Contact no:  </label><?php echo $row2['uphn'];  ?><br>
<label class="title">Venue:     </label><?php echo $o_add;  ?><br>
<label class="title">Placed order on date: </label><?php echo $_SESSION['date']; ?><br>
<label class="title">Placed order for date:</label><?php echo "$o_date"." $o_time" ;?><br><br>

<?php
	$sql4="select * from cart_order1 where o_id='$oid'";
	$result4=$cn->query($sql4);
	$i=1;
?>
<table border="1px">
	<tr>
		<th>Sr No</th>
		<th>Menu Name</th>
		<th>Price</th>
		<th>Quantity</th>
		<th>Total</th>
	</tr>
	<?php
		foreach($result4 as $row4)
		{
			?>
				<tr>
					<td><?php echo $i;?></td>
					<td><?php echo $row4[3];?></td>
					<td><?php echo $row4[4];?></td>
					<td><?php echo $row4[5];?></td>
					<td><?php echo $row4[6];?></td>
				</tr>
			<?php
			$i++;
		}
	?>
	<tr>
		<th colspan="4">GranTotal</th>
		<td><?php echo $grantTotal; ?></td>
	<tr>
</table>

	<input type="button" value="Pay" id="pay"> 



</div>
</body>
</html>