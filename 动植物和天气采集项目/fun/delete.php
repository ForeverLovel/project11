<?php
	require("function.php");
	$con=getconnect();
	$user = $_GET['user'];
	$sql="update user set state=0 where username='$user'";
	mysqli_query($con,$sql);
	skip("删除成功","../admin.php");
?>