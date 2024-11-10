<?php
session_start();
$email=$_SESSION['email'];
?>
<html>
<head>
<title>Caterer Side</title>
<style>
body{
	background-image:url("food1.jpg");
	color:white;
}
.btn{
			position:absolute;
			background-color:green;
			transform:translate(-50%,-50%);
			font-size:25px;
			color:white;
			left:70%;
			cursor:pointer;
			padding:5px;
			border-radius:4px;
		}

#back{
			margin-left:94%;
			font-size:20px;
			
			padding:3px;
			cursor:pointer;
			border-radius:3px;
		}
		#addMenu
		{
			top:28%;
		}
		#viewMenu{
			top:36%;
		}
		#deleteMenu{
			top:44%;
		}
		#UpdateMenu{
			top:52%;
		}
		
		#viewCustomer
		{
			top:70%;
			left:78%
		}
		#viewOrder{
			
			top:70%;
			left:62%;
		}
</style>
</head>
<body>
<a href="index.html"><input type="button" value="Back" id="back"></a>
	<a href="addMenu.html"><input type="button" value="Add Menu" class="btn" id="addMenu"></a>
		<a href="viewMenu.php"><input type="button" value="View Menu" class="btn" id="viewMenu"></a>
		<a href="deleteMenu.php"><input type="button" value="Delete Menu" class="btn" id="deleteMenu"></a>
		<a href="UpdateMenu.php"><input type="button" value="Update Menu" class="btn" id="UpdateMenu"></a>
	<a href="viewCustomersToCaterer.php"><input type="button" value="View Customers" class="btn" id="viewCustomer"></a>
	<a href="viewOrdersToCaterer.php"><input type="button" value="View Orders" class="btn" id="viewOrder"></a>
</body>
</html>