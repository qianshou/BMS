<?php
    $serverName = "localhost";
    $uid = "sa";
    $pwd = "123456";
  
    $connectionInfo = array("UID"=>$uid,"PWD"=>$pwd,"Database"=>"MBOOK");
  
    $conn = sqlsrv_connect( $serverName,$connectionInfo);
     
	if($_GET['type']=='reader')
	{
		$id = $_GET['id'];
		$sql = "select * from TReader where ΩË È÷§∫≈ = '$id'";
		$result = sqlsrv_query($conn , $sql);
		$row = sqlsrv_fetch_array($result);
		 
		Header( "Content-type: image/jpeg");
		echo $row['’’∆¨'];		
	}
	
	if($_GET['type']=='book')
	{
		$isbn = $_GET['isbn'];
		$sql = "select * from TBook where ISBN = '$isbn'";
		$result = sqlsrv_query($conn , $sql);
		$row = sqlsrv_fetch_array($result);
		 
		Header( "Content-type: image/jpeg");
		echo $row['∑‚√Ê’’∆¨'];		
	}
	