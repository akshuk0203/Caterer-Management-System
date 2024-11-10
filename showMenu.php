 <html>
 <head>
	<title>Menu</title>
 </head>
 <body>
 <section class="menu" id="menu">
 <?php
session_start();
if(isset($_POST['cid']))
{
	$_SESSION['cid']=$_POST['cid'];
}
$cid=$_SESSION['cid'];
$uid=$_SESSION['uid'];
$o_date=$_SESSION['o_date'];
$o_time=$_SESSION['o_time'];
$o_add=$_SESSION['o_add'];
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
?>
      <h1 class="heading"><span>Menu</span> </h1>
	  <?php
	  $sql2="select i_id,i_category from menu where cat_id='$cid' group by i_category";
	  $result2=$cn->query($sql2);
	  foreach($result2 as $row2)
	  {
		  $cat_title=$row2['i_category'];
	  ?>
	  <div class="subtop">
	  <h2 class="title"><?php echo "$cat_title";?></h2>
		<table class="box-container">
			<tr>
				<th>Name</th>
				<th>Price</th>
			</tr>
			<?php 
				$sql="select i_name,i_price,i_id from menu where i_category='$cat_title' and cat_id='$cid'";
				$result=$cn->query($sql);
				$rowcount=$result->rowcount();
				if($rowcount>=1)
				{
					foreach($result as $row)
					{
			?>
			<tr>
				<form class="box" action="addToCart.php" method="post">
					<td class="item"><input type="hidden" name="iname" value="<?php echo $row[0] ?>"><?php echo $row[0] ?></td>
					<td class="item"><input type="hidden" name="iprice" value="<?php echo $row[1] ?>"><?php echo $row[1] ?></td>
					<input type="hidden" class="submit" name="i_id" value="<?php echo $row[2] ?>">
					<td><input type="submit" value="Add to cart" class="submit"></td>
				</form>
			</tr>
			<?php
					}
				}
			?>
		</table>
	<?php  
		}
	?>
	</div>

		<?php

			$sql1="select * from register where uid='$uid'";
			$result1=$cn->query($sql1);
			$result1->setFetchMode(PDO::FETCH_ASSOC);
			$row=$result1->fetch();
			$grantTotal=0;
				$sql3="select i_id,i_name,i_price,i_quantity,total from cart where uid='$uid'";
				$result3=$cn->query($sql3);
				$rowcount3=$result3->rowcount();
				if($rowcount3>=1)
				{
					echo'<form class="box1" method="post">';//RemoveFromCart.php
					echo'<h2 align="center">My Cart</h2>
					<h3>Quantity of people:<input type="text" name="user_quantity"><br>
						<button type="submit" name="action" value="Apply">
					<table align="center" border=1px>
					<tr>
						<th>Menu name</th>
						<th>price</th>
						<th>Quantity</th>
						<th>Total</th>
					</tr>';
					foreach($result3 as $row)
					{
			?>
					<tr>
						<div class="box1" >
							<input type="hidden" name="uid" value="<?php echo $uid ;?>">
							<input type="hidden" name="mid" value="<?php echo $row[0] ;?>">
							<td class="menu-name"><input type="hidden" name="mname" value="<?php echo $row[1] ?>"><?php echo $row[1] ?></td>
							<td class="menu-price"><input type="hidden" name="mprice" value="<?php echo $row[2] ?>"><?php echo $row[2] ?></td>
							<td class="menu-quantity"><input type="hidden" name="mquantity" value="<?php echo $row[3] ?>"><?php echo $row[3] ?></td>
							<td class="total"><input type="hidden" name="total" value="<?php echo $row[4] ?>"><?php echo $row[4] ?></td>
							<td><button type="submit" value="Remove" class="submit" name="action">Remove</td>
						</div>
					</tr>
					<?php
					}
					
					$sql5="select SUM(total)AS 'grantTotal' from cart where uid='$uid'";
					$result5=$cn->query($sql5);
					$result5->setFetchMode(PDO::FETCH_ASSOC);
					$row5=$result5->fetch();
					$grantTotal=$row5['grantTotal'];
					?>
					<tr>
						<th colspan='3'>Grant Total</th>
						<td class="grantTotal"><input type="hidden" name="grantTotal" value="<?php echo $grantTotal?>"> <?php echo $grantTotal?></td>
					</tr>
					</table>
					<button type="submit" value="PlaceOrder" name="action" class="submit">Place Order</button>
					</form>
					<?php
					if ($_SERVER['REQUEST_METHOD'] === 'POST') {
						if (isset($_POST['action'])) {
							switch ($_POST['action']) {
								case 'Remove':
									echo"<script>
									document.location='RemoveFromCart.php'
									</script>";
									exit();
								case 'PlaceOrder':
									echo"<script>
									document.location='addOrder.php'
									</script>";
									exit();
							}
						}
					}
				}
					?>
			</section>
		</body>
	</html>
	