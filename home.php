
<html>
<?php
	session_start();
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
			$uemail=$_SESSION['uemail'];
			$sql1="select * from register where uemail='$uemail'";
			$result1=$cn->query($sql1);
			$result1->setFetchMode(PDO::FETCH_ASSOC);
			$row=$result1->fetch();
			$uid=$row['uid'];
?>
<head>
<style>

:root{
    --main-color:#d3ad7f;
    --bg:#010103e8;
    --border:.1rem solid rgba(255,255,255,.3);
}

.header{
    background: var(--bg);
    display: flex;
    justify-content: space-between;
    padding: 1.5rem;
    border-bottom: black;
   position:sticky;
    top: 0; left: 0; right: 0;
    z-index: 1000;
    
}

.header .navbar a{
    margin: auto 1rem 0.2rem auto;
    font-size: 1.8rem;
    color:#fff;
    margin-left: 4rem;
    align-items: flex-end;
    margin-top: 40%;
}

.header  .navbar a:hover{
    color: var(--main-color);
    padding-bottom: .5rem;
}

#login{
	margin-left:5rem;
	color:balck;
	font-size:1.2rem;
	cursor:pointer;
}
#home{
	color:balck;
	font-size:1.2rem;
	cursor:pointer;
}


.about .row{
	position:static;
    display: flex;
    align-items: center;
    flex-wrap: wrap;
}

.about .row .image{
    flex: 1 1 35rem;
}

.about .row .image img{
	height:45rem;
   width: 43rem;
}

.about .row .content{
    flex: 1 1 45rem;
    padding: 2rem;
}

.about .row .content p{
  font-size: 1.6rem;
    color: black;
    padding: 1rem 0;
    line-height: 1.8;
}

.menu .heading{
    
    font-size: 33px;
    font-weight: 450;
    font-family: Georgia, 'Times New Roman', Times, serif;
    margin: 3rem ;
    text-align: center;
}
.top{
	background:lavender;
}
.subtop{
	padding:10px;
}
.form1{
	padding:10px;
	border:thick solid black;
	border-width:2px;
	width:28%;
	margin-left:35%;
	border-radius:13px;
}
.box-container{
	font-size:18px;
	font-weight:600px;
}
.item{
	padding:7px;
}
.submit{
	background:Thistle;
	cusror:pointer;
	border-radius:5px;
}

.orderTitle{
	margin-left:40%;
	font-size:28px;
}
.order{
	font-size:20px;
}

.availability{
	font-size:20px;
	margin-left:40px;
}
.availability .submit{
	font-size:20px;
}
.contact{
	font-size:20px;
	padding:10px;
}
.contact .form1 .inputBox{
	margin:10px;
	padding:5px;
}
.contact .form1 .inputBox input{
	height:2rem;
	width:20rem;
	font-weight:450;
	font-size:18px;
}
.contact .submit{
	font-size:20px;
	margin:10px;
}

</style>
</head>
<body>
<div class="top">
 <header class="header">
      <nav class="navbar">
         <a href="#about">About</a>
         <a href="#menu">Menu</a>
		  <a href="#availability">Availability</a>
		  <a href="#order">Order</a>
		  <a href="#contact">Contact</a>
		 <a href="loginForm.html"> <input type="button" name="back" value="Back to Login" id="login"></a>
		 <a href="index.html"> <input type="button" name="back" value="Back to Home" id="home"></a>
		 <!--<input type="button" value="My Cart" class="button">-->
      </nav>        
  </header>
  <section class="about" id="about" >
       <div class="row" >
           <div class="image">
               <img src="https://cdn.vox-cdn.com/thumbor/aNM9cSJCkTc4-RK1avHURrKBOjU=/1400x1400/filters:format(jpeg)/cdn.vox-cdn.com/uploads/chorus_asset/file/20059022/shutterstock_1435374326.jpg">
			 </div>
           <div class="content">
				<p class="heading">HAVE A FUNCTION? WE'VE GOT THE CATERING</p>
               <p> 
					Above and beyond Catering we known for our cansistency,timeliness and fresh menus.We flawlessly execute
					events of every shape and size.Whether you're looking for an energizing,productivity-boosting lunch break or 
					a rewarding celebration goals.we're dedicated to creating something truly incredible. 					
               </p>
                    <p>
                       Chef-made food,exactly when you want
                    </p>
                    
           </div>
       </div>
   </section>
  	<section class="availability" id="availability">
		<h1 class="orderTitle"> Check Availability of Caterer </h1>
			<form action= "checkAvailability.php" method="post">
			<h3>Enter order details:</h3>
			<h4>Date: <input type="date" name="o_date" id="o_date" required></h4>
			<h4>Time: <input type="time" name="o_time" id="o_time" required></h4>
			<h4>Venue: <input type="type" name="o_add" id="o_add" required></h4>
			<input type="hidden" name="uid" value="<?php echo $uid ;?>">
			<input type="hidden" name="grantTotal" value="<?php echo $grantTotal ;?>">
			<input type="submit" value="Check availability" id="check" class="submit">
			</form>
		
	</section>
	<section class="order" id="order">
	<?php
	$sql2="select * from order1 where u_id='$uid'";
	$result2=$cn->query($sql2);
	$rowcount=$result2->rowcount();
	if($rowcount>0)
	{
		echo'<h1 class="orderTitle"> Order </h1>';
		echo"<h3>Total No of orders placed: $rowcount</h3><br>";
		foreach($result2 as $row2)
		{
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
		
		
			echo'<table border="1px">
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
						<td>    $row3[2] </td>
						<td>	$row3[3]</td>
						<td>	$row3[4]</td>
						<td>	$row3[5]</td>
					</tr>
				";
			}
			echo'</table><br><br>';
		}
	}
	else
	{
		echo"No orders placed yet";
	}
?>
	
	
	</section>
	<section class="contact" id="contact">
    
        <h1 class="heading" align="center"> <span>contact</span> us </h1>
    
        
    
            
            <form action="" align="center" class="form1">
                <h3>Get in touch</h3>
                <div class="inputBox">
                    <input type="text" placeholder="name">
                </div>
                <div class="inputBox">
                    <input type="email" placeholder="email">
                </div>
                <div class="inputBox"> 
                    <input type="tel" placeholder="number" maxlength="10">
                </div>
				<div class="inputBox"> 
                    <input type="text" placeholder="Description" id="des">
                </div>
				
                <input type="submit" value="contact now" class="submit">
            </form>
    
       
    
    </section>
	</div>
  <body>
  </html>