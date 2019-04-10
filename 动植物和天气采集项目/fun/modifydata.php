<?php
	require("function.php");
	judge();
	$username=$_SESSION['user'];
	echo $username;
	$con=getconnect();
    $nickname = $_POST["nickname"];
    $password = $_POST["password"];
    $sex = $_POST["sex"];
    $brief = $_POST["brief"];
	/*var_dump($nickname);
	var_dump($password);
	var_dump($sex);
	var_dump($brief);*/
		if($_FILES["file"]["error"])
		{
			echo $_FILES["file"]["error"];
		}
		else
		{
			//控制上传文件的类型，大小
			if($_FILES["file"]["type"]=="image/jpeg" || $_FILES["file"]["type"]=="image/png" || $_FILES["file"]["type"]=="image/jpg")
			{
				//找到文件存放的位置
				$savePath = "../touxiang/";
				$filename = $savePath.$_FILES["file"]["name"];
				
				$savePath2="touxiang/".$_FILES["file"]["name"];
				$_SESSION['portrait_src']=$savePath2;
				//转换编码格式
				$filename = iconv("UTF-8","gb2312",$filename);
				
				move_uploaded_file($_FILES["file"]["tmp_name"],$filename);
				// var_dump($filename);
				if(!empty($password))
				{
					$password=md5($password);
					$sql="update user set portrait_src='$savePath2',password='$password',nickname='$nickname',sex='$sex',brief='$brief' where username='$username'";
					
				mysqli_query($con,$sql);
				}
				else{
				$sql="update user set portrait_src='$savePath2',nickname='$nickname',sex='$sex',brief='$brief' where username='$username';";
					
				mysqli_query($con,$sql);
				
				//var_dump($savePath2);
				skip("修改成功","../login_home.php");
				}
			}
			else
			{
				skip("文件类型不正确！","../complete.html");
			}
		}

	mysqli_close($con);

		
?>