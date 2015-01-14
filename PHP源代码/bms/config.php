<?php 	session_start();?>
<meta charset="GB2312">
<?php 	
	//管理员权限验证模块
	function check_user()
	{
		//连接数据库模块
		$serverName = "localhost";
		$uid = "sa";
		$pwd = "123456";
	 
		$connectionInfo = array("UID"=>$uid,"PWD"=>$pwd,"Database"=>"MBOOK");
	 
		$conn = sqlsrv_connect( $serverName,$connectionInfo);
		sqlsrv_query($conn, "set names GB2312");
		
		$username = $_SESSION['admin'];
		$sql = "SELECT * FROM Administrator WHERE 用户名='$username'";
		$result = sqlsrv_query($conn , $sql);
		$row    = sqlsrv_fetch_array($result);
		$password = $row['密码'];
		if($_SESSION['admin_key'] == md5("bms".md5($password)))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	function check_reader()
	{
		//连接数据库模块
		$serverName = "localhost";
		$uid = "sa";
		$pwd = "123456";
	 
		$connectionInfo = array("UID"=>$uid,"PWD"=>$pwd,"Database"=>"MBOOK");
	 
		$conn = sqlsrv_connect( $serverName,$connectionInfo);
		sqlsrv_query($conn, "set names GB2312");
		
		$id = $_SESSION['reader_id'];
		$sql = "SELECT * FROM TReader WHERE 借书证号='$id'";
		$result = sqlsrv_query($conn , $sql);
		$row    = sqlsrv_fetch_array($result);
		$password = $row['密码'];
		if($_SESSION['key'] == md5("bms".md5($password)))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	