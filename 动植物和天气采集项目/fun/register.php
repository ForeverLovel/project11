<?php
	require("function.php");
	$con = getconnect();
	$path = "/^[a-zA-Z0-9]+([-_.][a-zA-Z0-9]+)*@([a-zA-Z0-9]+[-.])+([a-z]{2,5})$/";//邮箱
	$path2="/^(13|14|15|17|18)[0-9]{9}$/";//手机号
	//接收来的数据
	$usern =$_POST['username'];
	$passw =md5($_POST['password']);
	$yzm= $_POST['inputcode'];
	//$passw2 = $_POST['password2'];
	
	if($usern=="")
	{
		skip("The username is empty!","../home.php");
	}
	else if((preg_match($path,$usern)==0)&&(preg_match($path2,$usern)==0))
	{
		skip("The user name is not formatted correctly!","../home.php");
	}
	else if($passw=="")
	{
		skip("The password is empty","../home.php");
	}
	
	else 
	{//从数据读取数据判断是否注册
		$sql4 = "SELECT * FROM user where username=".$usern." and state=1 ;";
		$result = mysqli_query($con,$sql4);
		if(strcmp(strtolower($yzm),strtolower($yzm))!=0)
		{
			skip("The code is incorrect!","../home.php");
		}
		else if(mysqli_num_rows($result)>0)
		{
			skip("This username has been registered!","../home.php");
		}
		
		else 
		{	
			$_SESSION['user']=$usern;
			$sql3 = "insert user (username,password)values('$usern','$passw')";
			mysqli_query($con,$sql3);
			skip("Registered successful!","../complete.html");
		}
	}
?>



