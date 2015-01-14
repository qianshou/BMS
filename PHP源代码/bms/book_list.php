<meta charset="GB2312">
<?php
	if(!$tag)exit();
	$serverName = "localhost";
    $uid = "sa";
    $pwd = "123456";
 
    $connectionInfo = array("UID"=>$uid,"PWD"=>$pwd,"Database"=>"MBOOK");
 
    $conn = sqlsrv_connect( $serverName,$connectionInfo);
	sqlsrv_query($conn, "set names GB2312");
	
	$sql = "SELECT ISBN,书名,作译者,库存量  FROM  TBook";
	$result = sqlsrv_query($conn ,$sql);
	
?>
<div class="content_list_user">
	<table class="table table-hover table-bordered">
		<thead>
        	<th>ISBN</th>
            <th>书名</th>
            <th>作译者</th>
            <th>库存量</th>
            <th>查看</th>
            <th>编辑</th>
            <th>删除</th>
        </thead>
        <tbody>
        	<?php
				while(($row=sqlsrv_fetch_array($result)))
				{
					$isbn      = $row['ISBN'];
					$bookname  = $row['书名'];
					$author    = $row['作译者'];
					$store_num = $row['库存量'];
					echo "<tr>";
					echo "<td>".$isbn."</td>"."<td>《".$bookname."》</td>"."<td>".$author."</td>"."<td>".$store_num."</td>";
					echo "<td><a href=\"book_display.php?isbn=$isbn\">查看</a></td><td><a href=\"book_update.php?isbn=$isbn\">编辑</a></td><td><a href=\"fun.php?cmd=delete_book&isbn=".trim($isbn)."\">删除</a></td>";
					echo "</tr>";
				}
			?>
        </tbody>
	</table>
</div>    
<?php 	sqlsrv_close($conn);?>