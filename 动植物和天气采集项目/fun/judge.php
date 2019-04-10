<?php
	require("function.php");
	//创建连接
	judge();
	$con = getconnect();
	//将接收来的数据插入数据库
	$username = $_POST['username'];
	$password =md5($_POST['password']); // $_POST['password']; //
	echo "the username is :".$username;
	echo "the password is :".$password;
	
	/*$sql3 = "SELECT username,password FROM user where username='$username' and password='$password'";
	$result3 = mysqli_query($con,$sql3);
	if(mysqli_num_rows($result3)==1)
	if(!strcmp($username,"admin"))
	{
			skip("管理员","../admin.php");
	}
	
	//从数据库读取数据判断用户数据是否正确
	$sql4 = "SELECT * FROM user where username='$username' and password='$password' and state=1;";
	$result = mysqli_query($con,$sql4);
	if(mysqli_num_rows($result)==1)
	{	
		$row=mysqli_fetch_array($result);
		$_SESSION['user']=$username;
		$_SESSION['nickname']=$row['nickname'];
		$_SESSION['portrait_src']=$row["portrait_src"];
		
		skip("登录成功","../login_home.php");
	}
	else {
	     	skip("用户名或密码错误","../home.php");
		}
	mysqli_close($con);*/
?>


