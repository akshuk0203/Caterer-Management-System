<?php
session_start();
$_SESSION['uid']=$_POST['uid'];
$_SESSION['o_date']=$_POST['o_date'];
$_SESSION['o_time']=$_POST['o_time'];
$_SESSION['grantTotal']=$_POST['grantTotal'];
$_SESSION['o_add']=$_POST['o_add'];
$o_date=$_POST['o_date'];
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

$sql="select c_id, cat_system_name from caterer";
$result=$cn->query($sql);
$rowcount=$result->rowcount();

if($rowcount>=1)
{
	echo"Available caterers:<br> ";
		$sql1="select c_id,count(*) as count from order1 group by c_id";
		$result1=$cn->query($sql1);
		$rowcount1=$result1->rowcount();
		if($rowcount1<=0)
		{
			$sql="select c_id, cat_system_name from caterer";
			$result=$cn->query($sql);
			foreach($result as $row)
			{
				echo"$row[1]"."<form method='post' action='ShowMenu.php'>
				<input type='hidden' name='cid' value='$row[0]'>
				<input type='submit' name='Show Menu' value='Show Menu'>
				</form>";
				echo"<br>";
			}
		}
		else
		{
			foreach($result as $row)
			{
				$cid=$row['c_id'];
				echo"caterer id:$row[0]<br>";
				$sql2="select c_id,count(*) as count from order1 where c_id='$row[0]' and o_date='$o_date' group by c_id";
				$result2=$cn->query($sql2);
				$rowcount2=$result2->rowcount();
				if($rowcount2<=0)
				{
					$sql3="select c_id,cat_system_name from caterer where c_id='$row[0]'";
					$result3=$cn->query($sql3);
					$result3->setFetchMode(PDO::FETCH_ASSOC);
					$row3=$result3->fetch();
					$cat_system_name=$row3['cat_system_name'];
					$c_id=$row3['c_id'];
					echo"$cat_system_name"."<form method='post' action='ShowMenu.php'>
					<input type='hidden' name='cid' value='$c_id'>
					<input type='submit' name='Show Menu' value='Show Menu'>
					</form>";
				}
				else
				{
					$result2->setFetchMode(PDO::FETCH_ASSOC);
					$row2=$result2->fetch();
					$count=$row2['count'];
					$sql3="select c_id,cat_system_name from caterer where c_id='$cid'";
					$result3=$cn->query($sql3);
					$result3->setFetchMode(PDO::FETCH_ASSOC);
					$row3=$result3->fetch();
					$cat_system_name=$row3['cat_system_name'];
					$c_id=$row3['c_id'];
					if($count<2)
					{
							echo"$cat_system_name"."<form method='post' action='ShowMenu.php'>
							<input type='hidden' name='cid' value='$c_id'>
							<input type='submit' name='Show Menu' value='Show Menu'>
							</form>";
					}
					else
					{
						echo"$cat_system_name not available<br>";
					}
				}
			}
		}
}
else
{
	echo"No caterer available";
}
?>