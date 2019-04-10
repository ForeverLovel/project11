<?php
	session_start();
	function getconnect()
	{
		$con = new mysqli("127.0.0.1","root","");
		if($con->connect_error)
		{
			die("lost:".$con->connect_error);
		}
		mysqli_select_db($con,'team4');
		mysqli_query($con,"set names utf8");
		return $con;
	}
	
	function skip($message='',$url='')
	{
		if(empty($message)&&empty($url))
		{
			return;
		}

		if(empty($message))
		{
			echo "<script>
			window.location.href='$url';
			</script>";
			return;
		}elseif(empty($url))
		{
			echo "<script>alert('".$message."');
			</script>";
			return;
		}
		else
		{
			echo "<script>alert('".$message."');
			window.location.href='$url';
			</script>";
			return;
		}
	}
	function judge()
	{
		if($_SESSION["user"]==null)
		{
			skip("请先登录！","../login.html");
		}
		else {return;}
	}
	
?>
