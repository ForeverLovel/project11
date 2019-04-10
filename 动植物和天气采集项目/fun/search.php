<?php
	require("function.php");
	//judge();
	$con = getconnect();	
	$content=$_GET['txt'];//$_GET['tent']; //搜索内容
	$sql="select content,portrait_src,title,img_src,nickname,count,likecount,com_count from article inner join user as U on article.user=U.username where title like ".
		"'%".$content."%' or content like '%".$content."%';";
	$result=mysqli_query($con,$sql);
	$arr = array();
	$i=0;
	while($row=mysqli_fetch_assoc($result))
	{
		//$arr=$row;
		/*echo $row['user'];
		echo "<br>";*/
		//$str= json_encode($row);
		$arr[$i]=$row;
		$i++;

	}
	echo json_encode($arr);


?>
