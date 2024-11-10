<?php
	$number=$_GET['number'];
	if(preg_match("/[a-zA-Z]/","$number"))
	{
		echo"Characters not allowded";
	}
?>