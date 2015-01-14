<?php 
	require_once("config.php");
	if(!check_reader())
	{
		echo "<script>window.location.href='login.php';</script>";
		exit();
	}
	$tag = 1;
?>
<?php require_once("top_menu_reader.php");?>
    <!--内容模块-->
    <div class="container">
	<?php
        if(!$tag)exit();
        $serverName = "localhost";
        $uid = "sa";
        $pwd = "123456";
     
        $connectionInfo = array("UID"=>$uid,"PWD"=>$pwd,"Database"=>"MBOOK");
     
        $conn = sqlsrv_connect( $serverName,$connectionInfo);
        sqlsrv_query($conn, "set names GB2312");
		
		$reader_id = $_SESSION['reader_id'];
		
		$sql    = "SELECT * FROM TReader WHERE 借书证号='$reader_id'";
		$result = sqlsrv_query($conn ,$sql);
		$row    = sqlsrv_fetch_array($result);
		
        $sql = "SELECT *  FROM  RBL WHERE 借书证号='$reader_id'";
        $result = sqlsrv_query($conn ,$sql);
        
    ?>
    <div class="content_current_borrow">
    	<p>读者：<?php echo $row['姓名'];?>您好：</p>
        <p class="text-info">您一共借阅图书：<?php echo $row['借书量'];?>本。</p>
        <?php if($row['借书量']>0)
		{
		?>
        <p style="margin-bottom:30px;">您的借书信息如下：</p>
        <table class="table table-hover table-bordered">
            <thead>
                <th>ISBN</th>
                <th>书名</th>
                <th>图书ID</th>
                <th>借书时间</th>
                <th>还书时间</th>
                <th>查看</th>
            </thead>
            <tbody>
                <?php
                   while(($row = sqlsrv_fetch($result)))
				   {
						$isbn        = sqlsrv_get_field( $result,3);
						$book_name   = sqlsrv_get_field( $result,4);
						$publisher   = sqlsrv_get_field( $result,5);
						$price       = sqlsrv_get_field( $result,6);
						$book_id     = sqlsrv_get_field( $result,7);
						$borrow_time = sqlsrv_get_field( $result,8,SQLSRV_PHPTYPE_STRING( SQLSRV_ENC_CHAR));
						$return_time = sqlsrv_get_field( $result,9,SQLSRV_PHPTYPE_STRING( SQLSRV_ENC_CHAR));
                        echo "<tr>";
                        echo "<td>".$isbn."</td>"."<td>《".$book_name."》</td>"."<td>".$book_id."</td>"."<td>".$borrow_time."</td>"."<td>".$return_time."</td>";
                        echo "<td><a href=\"reader_book_display.php?isbn=$isbn\">查看</a></td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
       <?
		}
		?>
    </div>    
    <?php 	sqlsrv_close($conn);?>
    </div>
    
        <!--也页脚模块-->
        
       <div class="container footer">
           <hr>
           <p class="text-center text-info">版权所有<sup>&copy;</sup>  山东师范大学 信息科学与工程学院 2011级 计信 赵哲</p>
       </div>
   </div>
  </body>
  <script>
    $("ul.nav li:contains('当前借阅')").addClass("active").siblings().removeClass("active");
  </script>
</html>