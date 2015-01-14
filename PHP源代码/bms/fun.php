<?php 	session_start();?>
<meta charset="GB2312">
<?php 
	//连接数据库模块
	$serverName = "localhost";
    $uid = "sa";
    $pwd = "123456";
 
    $connectionInfo = array("UID"=>$uid,"PWD"=>$pwd,"Database"=>"MBOOK");
 
    $conn = sqlsrv_connect( $serverName,$connectionInfo);
	sqlsrv_query($conn, "set names GB2312");
	
	
	//注销用户模块
	if($_GET['cmd'] == "logout")
	{
		session_destroy();
		echo "<script>window.location='login.php';</script>";
		exit();
	}
	
	//归还图书模块
	if($_GET['cmd'] == "return")
	{
		
		 $book_id  =  htmlspecialchars(trim($_POST['book_id']));
		
		 $sql = "DELETE FROM TLend WHERE 图书ID=$book_id";
		 $result = sqlsrv_query($conn , $sql);
		 $errors = sqlsrv_errors();
		 
 		 if($errors)
		 {
			 echo "<script>alert('还书失败');window.history.back(-1)</script>";
		 }
		 else	//插入数据成功
		 {
			 echo "<script>alert('还书成功');window.location='book_return.php';</script>";
		 }
	}
	
	
	//借阅图书模块
	if($_GET['cmd'] == "borrow")
	{
		
		 $isbn     =  htmlspecialchars(trim($_POST['isbn']));
		 $book_id  =  htmlspecialchars(trim($_POST['book_id']));
		 $lend_id  =  htmlspecialchars(trim($_POST['lend_id']));
		
		 $sql = "DECLARE @out_str char(30) DECLARE @con int EXEC @con = Book_Borrow '$lend_id','$isbn',$book_id,@out_str OUTPUT SELECT @con AS 返回值 ,@out_str AS 输出结果";
		 $result = sqlsrv_query($conn , $sql);
		 $row    = sqlsrv_fetch_array($result);
		 
		 $return_value = $row['返回值'];
		 $output       = $row['输出结果'];
		  
		 if($outpur)
		 {
			 echo "<script>alert(\"借阅图书失败，原因是：$output\");</script>";
			 echo "<script>window.history.go(-1);</script>";
		 }
		 else	//插入数据成功
		 {
			echo "<script>alert(\"借阅图书成功\");</script>";
			echo "<script>window.location='book_borrow.php';</script>";
		 }
	}
	
	//备份数据库模块
	if($_GET['cmd'] == "backup_database")
	{
		
		 $sql = "EXEC DB_backup 'C:\AppServ\www\bms\backup\backup.bak'";
		 $result = sqlsrv_query($conn , $sql);
		 $errors = sqlsrv_errors();
		 if( $errors[0][0] != '01000')
		 {
			 echo "<script>alert('fail to back up database');window.history.back(-1)</script>";
		 }
		 else	//插入数据成功
		 {
			echo "<script>alert('succeed in backing up database');window.location='book_manage.php?cmd=list';</script>";
		 }
	}
	
	//删除图书模块
	if($_GET['cmd'] == "delete_book")
	{
		 $isbn    =  htmlspecialchars(trim($_GET['isbn']));
		
		 $sql = "DELETE FROM  TBook  WHERE ISBN = '$isbn'";
		 $result = sqlsrv_query($conn , stripslashes($sql));
		 
		 if( ($errors = sqlsrv_errors() ) != null)
		 {
			 echo "delete data error";
			 exit();	//插入数据失败
		 }
		 else	//插入数据成功
		 {
			echo "<script>window.location='book_manage.php?cmd=list';</script>";
		 }
	}
	
	//修改图书信息模块
	if($_GET['cmd'] == "update_book")
	{
		$isbn         =  htmlspecialchars(trim($_POST['isbn']));
		$type_num     =  htmlspecialchars(trim($_POST['type_num']));
		$bookname     =  htmlspecialchars(trim($_POST['bookname']));
		$author       =  htmlspecialchars(trim($_POST['author']));
		$publisher    =  htmlspecialchars(trim($_POST['publisher']));
		$publish_date =  htmlspecialchars(trim($_POST['publish_date']));
		$price        =  htmlspecialchars(trim($_POST['price']));
		$fuben_num    =  htmlspecialchars(trim($_POST['fuben_num']));
		$store_num    =  htmlspecialchars(trim($_POST['store_num']));
		$content_view =  htmlspecialchars(trim($_POST['content_view']));
		
		$photo_path =  htmlspecialchars(trim($_FILES['photo']['tmp_name']));
		
		 $sql = "UPDATE TBook SET ISBN = '$isbn',分类号 = '$type_num',书名 = '$bookname',作译者 = '$author' ,出版社 = '$publisher' ,出版年月 = '$publish_date' ,价格 = $price ,复本量 = $fuben_num,库存量 = $store_num ,内容提要='$content_view' WHERE ISBN = '$isbn'";
		 $result = sqlsrv_query($conn , stripslashes($sql));
		 if($_FILES['photo']['tmp_name'] != "")
		 { 
			 $sql = "UPDATE TBook SET  封面照片 =  (SELECT * FROM OPENROWSET(BULK '$photo_path',SINGLE_BLOB) AS note) WHERE ISBN = '$isbn'";
			 $result = sqlsrv_query($conn , $sql);
		 }
		 if( ($errors = sqlsrv_errors() ) != null)
		 {
			 echo "update book data error";
			 exit();	//插入数据失败
		 }
		 else	//插入数据成功
		 {
			echo "<script>window.location='book_manage.php?cmd=list';</script>";
		 }
	}	
	
    //插入图书信息模块
	if($_GET['cmd'] == "add_book")
	{
		$isbn         =  htmlspecialchars(trim($_POST['isbn']));
		$type_num     =  htmlspecialchars(trim($_POST['type_num']));
		$bookname     =  htmlspecialchars(trim($_POST['bookname']));
		$author       =  htmlspecialchars(trim($_POST['author']));
		$publisher    =  htmlspecialchars(trim($_POST['publisher']));
		$publish_date =  htmlspecialchars(trim($_POST['publish_date']));
		$price        =  htmlspecialchars(trim($_POST['price']));
		$fuben_num    =  htmlspecialchars(trim($_POST['fuben_num']));
		$store_num    =  htmlspecialchars(trim($_POST['store_num']));
		$content_view =  htmlspecialchars(trim($_POST['content_view']));
		
		$photo_path =  htmlspecialchars(trim($_FILES['photo']['tmp_name']));
		
		
		$sql = "INSERT INTO TBook(ISBN,书名,作译者,出版社,出版年月,价格,复本量,库存量,分类号,内容提要) VALUES('$isbn','$bookname','$author','$publisher','$publish_date',$price,$fuben_num,$store_num,'$type_num','$content_view')";
		$result = sqlsrv_query($conn , stripslashes($sql));
		
		 if( ($errors = sqlsrv_errors() ) != null)
		 {
			 echo "insert book info error<br/>";
			 echo $sql;
			 exit();	//插入数据失败
		 }
		 
		 $sql = "EXEC Book_Generate '$isbn',$fuben_num";
		 $result = sqlsrv_query($conn , stripslashes($sql));
		
		 if( ($errors = sqlsrv_errors() ) != null)
		 {
			 echo "insert book_lend info error";
			 exit();	//插入数据失败
		 }
		 
		 $sql = "UPDATE TBook SET  封面照片 =  (SELECT * FROM OPENROWSET(BULK '$photo_path',SINGLE_BLOB) AS note) WHERE ISBN = $isbn";
		 $result = sqlsrv_query($conn , $sql);
		 if( ($errors = sqlsrv_errors() ) != null)
		 {
			 echo "insert photo error";
			 exit();	//插入数据失败
		 }
		 else	//插入数据成功
		 {
			echo "<script>window.location='book_manage.php?cmd=list';</script>";
		 }
	}
		
	//删除用户模块
	if($_GET['cmd'] == "delete_user")
	{
		$len_num    =  htmlspecialchars(trim($_GET['id']));
		
		if($len_num == "")exit();	//可能有人暴库
		
		 $sql = "DELETE FROM  TReader  WHERE 借书证号 = $len_num";
		 $result = sqlsrv_query($conn , stripslashes($sql));
		 
		 if( ($errors = sqlsrv_errors() ) != null)
		 {
			 echo "delete data error";
			 exit();	//插入数据失败
		 }
		 else	//插入数据成功
		 {
			 echo "<script>window.location='user_manage.php?cmd=list';</script>";
		 }
	}
	
	
	//修改用户信息模块
	if($_GET['cmd'] == "update_user")
	{
		$len_num    =  htmlspecialchars(trim($_POST['len_num']));
		$name       =  htmlspecialchars(trim($_POST['name']));
		$password   =  htmlspecialchars(trim($_POST['password']));
		$major      =  htmlspecialchars(trim($_POST['major']));
		$sex        =  htmlspecialchars(trim($_POST['sex']));
		$sex        =  ($sex=="男")? 1:0;
		$birth_date =  htmlspecialchars(trim($_POST['birth_date']));
		$contact    =  trim($_POST['contact']);
		$comment    =  htmlspecialchars(trim($_POST['comment']));	
		$photo_path =  htmlspecialchars(trim($_FILES['photo']['tmp_name']));
		
		if($len_num == "")exit();	//可能有人暴库
		
		$sql = "UPDATE TReader SET 姓名 = '$name',密码 = '$password',专业 = '$major',性别 = $sex ,出生年月 = '$birth_date' ,备注 = '$comment' ,联系方式 = '$contact' WHERE 借书证号 = '$len_num'";
		 $result = sqlsrv_query($conn , stripslashes($sql));
		 if($_FILES['photo']['tmp_name'] != "")
		 { 	
			 $sql = "UPDATE TReader SET  照片 =  (SELECT * FROM OPENROWSET(BULK '$photo_path',SINGLE_BLOB) AS note) WHERE 借书证号 = '$len_num'";
			 $result = sqlsrv_query($conn , $sql);
		 }
		 if( ($errors = sqlsrv_errors() ) != null)
		 {
			 echo "update data error";
			 exit();	//插入数据失败
		 }
		 else	//插入数据成功
		 {
			if($_GET['type']=="admin")
			{
				echo "<script>window.location='user_manage.php?cmd=list';</script>";
			}
			else if($_GET['type']=="reader")
			{
				echo "<script>window.location='index_reader.php';</script>";
			}
		 }
	}
	
	//插入用户信息模块
	if($_GET['cmd'] == "add_user")
	{
		$len_num    =  htmlspecialchars(trim($_POST['len_num']));
		$name       =  htmlspecialchars(trim($_POST['name']));
		$password   =  htmlspecialchars(trim($_POST['password']));
		$major      =  htmlspecialchars(trim($_POST['major']));
		$sex        =  htmlspecialchars(trim($_POST['sex']));
		$sex        =  ($sex=="男")? 1:0;
		$birth_date =  htmlspecialchars(trim($_POST['birth_date']));
		$contact    =  $_POST['contact'];
		$comment    =  htmlspecialchars(trim($_POST['comment']));	
		$photo_path =  htmlspecialchars(trim($_FILES['photo']['tmp_name']));
		
		if($len_num == "")exit();	//可能有人暴库
		
		$sql = "INSERT INTO TReader(借书证号,姓名,密码,专业,借书量,性别,出生年月,联系方式,备注) VALUES('$len_num','$name','$password','$major',0,$sex,'$birth_date','$contact','$comment')";
		$result = sqlsrv_query($conn , stripslashes($sql));
		
		 if( ($errors = sqlsrv_errors() ) != null)
		 {
			 echo "insert info error";
			 exit();	//插入数据失败
		 }
		 $sql = "UPDATE TReader SET  照片 =  (SELECT * FROM OPENROWSET(BULK '$photo_path',SINGLE_BLOB) AS note) WHERE 借书证号 = $len_num";
		 $result = sqlsrv_query($conn , $sql);
		 if( ($errors = sqlsrv_errors() ) != null)
		 {
			 echo "insert photo error";
			 exit();	//插入数据失败
		 }
		 else	//插入数据成功
		 {
			echo "<script>window.location='user_manage.php?cmd=list';</script>";
		 }
	}
	
	//验证用户登录功能模块
	if($_GET['cmd'] == "login")
	{
		if($_GET['from'] == "reader")			//读者登陆模块
		{
			$lend_num = htmlspecialchars(trim($_POST['lend_num']));
			$password = htmlspecialchars(trim($_POST['password']));
			
			$sql = "SELECT * FROM dbo.TReader WHERE 借书证号='".$lend_num."'";
	        $result = sqlsrv_query($conn , $sql);
	
			$row = sqlsrv_fetch_array($result);
			if($row['密码'] == $password)
			{
				$_SESSION['reader_id'] = $row['借书证号'];
				$_SESSION['key']      = md5("bms".md5($row['密码']));
				echo "<script>window.location='index_reader.php'</script>";
			}
			else
			{
				echo "用户名或密码错误,<a href=\"login.php\">重新登录</a>。";
			}
		}
		else if($_GET['from'] == "admin")		//管理员登陆模块
		{
			$username = htmlspecialchars(trim($_POST['username']));
			$password = htmlspecialchars(trim($_POST['password']));
			
			$sql = "SELECT * FROM dbo.Administrator WHERE 用户名='".$username."'";
	        $result = sqlsrv_query($conn , $sql);
	
			$row = sqlsrv_fetch_array($result);
			if($row['密码'] == $password)
			{
				$_SESSION['admin']     = $row['用户名'];
				$_SESSION['admin_key'] = md5("bms".md5($row['密码']));
				$_SESSION['comment']   = $row['备注'];
				echo "<script>window.location='index_admin.php'</script>";
			}
			else
			{
				echo "用户名或密码错误,<a href=\"login.php\">重新登录</a>。";
			}
					
		}
	}
sqlsrv_close($conn);