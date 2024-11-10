<?php
session_start();
$email=$_SESSION['email'];
$i_name=$_POST['mid'];
$i_price=$_POST['mprice'];
$i_category=$_POST['mcategory'];
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
    $sql = "INSERT INTO menu(i_name, i_price, i_category, cat_id) VALUES ('$i_name', '$i_price', '$i_category', '$cid')";
    $result = $cn->query($sql);

    if ($result) {
        echo"<script>
			alert('Successfully Added to Menu');
			document.location='addMenu.html'
			</script>";
    } 

	
?>