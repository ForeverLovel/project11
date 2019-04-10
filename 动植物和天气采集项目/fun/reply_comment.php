<?php
	require("function.php");
	$con=getconnect();
	$self=$_SESSION['user'];
	$com_content=$_GET['comcontent'];//评论内容
	$to_user=$_GET['touser'];	//回复对象
	$reply_content=$_POST['reply_content'];//回复内容
	$title2=$_GET['title'];
	$sql="select id from comment where state=1 and com_content='$com_content'";
	$result=mysqli_query($con,$sql);
	$row=mysqli_fetch_assoc($result); //找出评论id
	$pc_id=$row['id'];
	
	
	$sql2="insert reply(user,reply_content,reply_obj,pc_id)values('$self','$reply_content','$to_user','$pc_id')";
	mysqli_query($con,$sql2);
	//关闭当前界面
	$k="../comment.php?title=".$title2;
	skip("回复成功",$k);
?>