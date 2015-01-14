<meta charset="GB2312">
<?php
	if(!$tag)exit();
	$serverName = "localhost";
    $uid = "sa";
    $pwd = "123456";
 
    $connectionInfo = array("UID"=>$uid,"PWD"=>$pwd,"Database"=>"MBOOK");
 
    $conn = sqlsrv_connect( $serverName,$connectionInfo);
	sqlsrv_query($conn, "set names GB2312");
	
	$sql = "SELECT 借书证号,专业,姓名  FROM  TReader";
	$result = sqlsrv_query($conn ,$sql);
	
?>
<div class="content_list_user">
	<table class="table table-hover table-bordered">
		<thead>
        	<th>借书证号</th>
            <th>专业</th>
            <th>姓名</th>
            <th>查看</th>
            <th>编辑</th>
            <th>删除</th>
        </thead>
        <tbody>
        	<?php
				while(($row=sqlsrv_fetch_array($result)))
				{
					$lend_id = $row['借书证号'];
					$major   = $row['专业'];
					$name    = $row['姓名'];
					echo "<tr>";
					echo "<td>".$lend_id."</td>"."<td>".$major."</td>"."<td>".$name."</td>";
					echo "<td><a href=\"user_display.php?id=$lend_id\">查看</a></td><td><a href=\"user_update.php?id=$lend_id\">编辑</a></td><td><a href=\"fun.php?cmd=delete_user&id=".trim($lend_id)."\" name=\"".trim($lend_id)."\" id=\"delete\">删除</a></td>";
					echo "</tr>";
				}
			?>
        </tbody>
	</table>
</div>    
<?php 	sqlsrv_close($conn);?>