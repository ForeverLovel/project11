<?php
	//session_start();
	require("function.php");
	$count=$_GET['divcount']; //前端传过来div数量
	$con=getconnect();
	$sql="select content,portrait_src,title,img_src,nickname,count,likecount,com_count from article inner join user as U on article.user=U.username limit ".$count.",6;";
	$result=mysqli_query($con,$sql);
	$arr = array();
	$i=0;
	while($row=mysqli_fetch_assoc($result))
	{	//这篇文章的所有东西都在row里面
		$arr[$i]=$row;
		$i++;
	}
	echo json_encode($arr);
	// 关闭连接
	mysqli_close($con);
?>