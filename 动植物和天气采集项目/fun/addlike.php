<?php
	require("/function.php");
	 $con=getconnect();
	$title=$_POST['title'];   //"第一篇文章标题"
	//加点赞数
	mysqli_query($con,"update article set likecount=likecount+1 where state=1 and title='$title'");
	mysqli_close();
?>