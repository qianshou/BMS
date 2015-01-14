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
                        echo "<td><a href=\"reader_book_display.php?isbn=$isbn\">查看</a></td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
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
    $("ul.nav li:contains('图书列表')").addClass("active").siblings().removeClass("active");
  </script>
</html>