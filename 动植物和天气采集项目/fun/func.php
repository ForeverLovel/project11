<?php
		require("function.php");
		//判断文件上传是否出错
		$con=getconnect();
		$user=$_SESSION["user"];
		$title=$_POST["title"];   //传过来的title
		$content= str_replace("<br>","\r\n",$_POST["content"]);    //传过来的内容
		if($_FILES["file"]["error"])
		{
			echo $_FILES["file"]["error"];
		}
		else
		{
			//控制上传文件的类型，大小
			if(($_FILES["file"]["type"]=="image/jpeg" || $_FILES["file"]["type"]=="image/png" || $_FILES["file"]["type"]=="image/jpg"))
			{
				//找到文件存放的位置
				$savePath = "../upload/";
				$filename = $savePath.$_FILES["file"]["name"];
				
				$savePath2="upload/".$_FILES["file"]["name"];
			   
				 
				//转换编码格式
				$filename = iconv("UTF-8","gb2312",$filename);
				// var_dump($filename);

				move_uploaded_file($_FILES["file"]["tmp_name"],$filename);
				$sql="insert article(user,img_src,title,content)values('$user','$savePath2','$title','$content');";
				mysqli_query($con,$sql);
				skip("发布成功！","../login_home.php");
				
			}
			else
			{
				skip("文件类型不正确！","../login_home.php");
			}
		}
		
?>
