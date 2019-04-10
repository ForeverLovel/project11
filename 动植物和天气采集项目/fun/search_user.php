<?php
	require("function.php");
	//judge();
	$con = getconnect();	
	$user=$_GET['user'];//$_GET['tent']; //搜索内容
	$sql="select * from user  where username like '%$user%' and state=1";
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
