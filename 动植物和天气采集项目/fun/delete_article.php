<?php
	require("function.php");
	$con=getconnect();
	$title = $_GET['title'];
	$sql="update article set state=0 where title='$title'";
	mysqli_query($con,$sql);
	//skip("删除成功","../admin.php");
?>