<?php
	session_start();
	require("function.php");
	$self=$_SESSION['user'];//"user1";
	$title=$_GET['title'];
	$content=$_POST['pcontent'];
	if(empty($content))
	{
		echo "<script type='text/javascript'>
			alert('content cannot be empty');</script>";
		header("location:../comment.php?title=".$title);
	}
	else
	{
		$con=getconnect();
		$sql="select id from article where state=1 and title='$title';";
		$result=mysqli_query($con,$sql);
		$row=mysqli_fetch_assoc($result);
		$obj_id=$row['id'];
		$sql="insert comment(user,com_content,pa_id)values('$self','$content','$obj_id')";
		mysqli_query($con,$sql);
		$sql="update article set com_count=com_count+1 where title='$title'";
		//关闭当前界面
		echo "<script type='text/javascript'>
				window.close();</script>";
		header("location:../comment.php?title=".$title);
	}
?>