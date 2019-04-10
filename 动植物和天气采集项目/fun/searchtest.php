<?php
	require("function.php");
	//judge();
	$con = getconnect();	
	//$content=$_GET['txt'];//$_GET['tent']; //搜索内容
	$sql="select * from article where title like '%这%' or content like '%这%';";
	$result=mysqli_query($con,$sql);
	$arr = array();
	$str = array();
	$i=0;
	while($row=mysqli_fetch_assoc($result))
	{
		//$arr=$row;
		/*echo $row['user'];
		echo "<br>";*/
		$arr[$i]= $row;
		$i++;

	}
	
	echo json_encode($arr);

?>
