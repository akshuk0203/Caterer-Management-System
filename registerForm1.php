<?php
session_start();
$_SESSION['uname']=$_POST['uname'];
$_SESSION['uemail']=$_POST['uemail'];
$_SESSION['umobno']=$_POST['umobno'];
$_SESSION['uadd']=$_POST['uadd'];
$uname=$_POST['uname'];
$uemail=$_POST['uemail'];
?>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<style>
	*{
		box-sizing: border-box;
		font-family: "Poppins", sans-serif;
	}
	body{
		background: linear-gradient(#2980b9, #8e44ad);
		height: 100vh;
		overflow: hidden;
	}
	.center{
		position: absolute;
		top: 45%;
		left: 50%;
		transform: translate(-50%, -50%);
		width: 400px;
		height:330px;
		background: white;
		border-radius: 10px;
	}
	
	.txt_field input{
		width: 98%;
		height: 28px;
		font-size: 16px;
		margin-left:5px;
		margin-top:-20px;
		outline:none;
	}
	
	.txt_field label{
		margin-left: 10px;
		transform: translateY(-50%);
		font-size: 20px;
		margin-top:80px;
		font-weight:70%;
	}

	.txt_field .label1{
		margin-left: 10px;
		transform: translateY(-50%);
		font-size: 20px;
		margin-top:30px;
	}
	
	input[type="submit"]{
		margin-top:30px;
		margin-left:19%;
		width: 60%;
		height: 40px;
		border: 1px solid;
		background: #2691d9;
		border-radius: 25px;
		font-size: 18px;
		color: #e9f4fb;
		font-weight: 500;
		cursor: pointer;
	}
	#backbtn
	{
		font-size:25px;
		cursor:pointer;
		margin:5px;
	}
	</style>
	<script>
	function Check()
	{
			flag=true;
			var pass=document.getElementById('pass').value;	
				if(pass==null||pass=="")
				{
					flag=false;
					document.getElementById('error1').innerHTML = "Required field";
					document.getElementById('error1').style.color="red";
				}
				else
				{
					let le=pass.length;
					if(le<6)
					{
						flag=false;
						document.getElementById('error1').innerHTML = "Password less than 6 characters";
						document.getElementById('error1').style.color="red";
					}
					else{
						document.getElementById('error1').innerHTML = "";
					}
				}
				
				var confirmpass=document.getElementById('confirmpass').value;
				if(confirmpass=="")
				{
					document.getElementById('error2').innerHTML = "";
				}
				else
				{
					if(pass==confirmpass)
					{}
					else{
						flag=false;
						document.getElementById('error2').innerHTML = "Password must be same";
						document.getElementById('error2').style.color="red";
					}
				}
				
				return flag;
	}
	</script
</head>
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
	$sql1="select * from register where uemail='$uemail'";
	$result1=$cn->query($sql1);
	$rowcount=$result1->rowcount();
	if($rowcount>0)
	{
		echo"<script>
			alert('Account already exist!');
			document.location='registerForm.html'
			</script>";
	}
	else{
?>
<body>
	<div class="center">
	<form action="insertRecord.php" method="post" onsubmit=" return Check()">

		<a href="registerForm.html"><span class="glyphicon glyphicon-arrow-left" id="backbtn"></span></a>
		<div class="txt_field">
			<label>Create Password</label>
			<input type="password" name="upass" id="pass" required>
			<div id="error1"></div>
		</div>
		<div class="txt_field">
			<label class="label1">Confirm Password</label>
			<input type="password" name="confirmpass" id="confirmpass" required>
			<div id="error2"></div>
		</div>
		<input type="submit">
	</form>
	</div>
</body>
<?php
	}
?>
</body>
</html>	
