<?php 
	require_once("config.php");
	if(!check_reader())
	{
		echo "<script>window.location.href='login.php';</script>";
		exit();
	}
	$tag = 1;
	
	$isbn = $_GET['isbn'];
	
	//连接数据库模块
	$serverName = "localhost";
    $uid = "sa";
    $pwd = "123456";
 
    $connectionInfo = array("UID"=>$uid,"PWD"=>$pwd,"Database"=>"MBOOK");
 
    $conn = sqlsrv_connect( $serverName,$connectionInfo);
	sqlsrv_query($conn, "set names GB2312");
	
	$sql  = "SELECT  * FROM TBook WHERE TBook.ISBN='$isbn'";
	
	$result        =  sqlsrv_query($conn ,$sql);
	$row           =  sqlsrv_fetch($result);
	
	$book_name     =  sqlsrv_get_field( $result,1);
	$author        =  sqlsrv_get_field( $result,2);	
	$publisher     =  sqlsrv_get_field( $result,3);	
	$publish_date  =  sqlsrv_get_field( $result,4,SQLSRV_PHPTYPE_STRING( SQLSRV_ENC_CHAR));	
	$price         =  sqlsrv_get_field( $result,5);	
	$fuben_num     =  sqlsrv_get_field( $result,6);	
	$store_num     =  sqlsrv_get_field( $result,7);	
	$type_num      =  sqlsrv_get_field( $result,8);	
	$content_view  =  sqlsrv_get_field( $result,9);		
	
	$sql     = "SELECT * FROM  TBLend WHERE ISBN='$isbn' AND 是否借出=0";
	$result  =  sqlsrv_query($conn ,$sql);
	
?>
<?php require_once("top_menu_reader.php");?>
    <!--内容模块-->
    <div class="container">
		<div class="content_display_book">
            <table class="table table-bordered">
                    <thead>
                        <th colspan="3"><p class="text-center">图书信息表</p></th>
                    </thead>
                    <tbody>
                    	<tr>
                        	<td><strong>ISBN</strong></td>
                        	<td><?php echo $isbn;?></td>
                             <td class="span6" rowspan="9" style="padding-left:20px"><img src="image.php?type=book&isbn=<?php echo $isbn;?>" width="300px" height="200px">
                        </tr>
                    	<tr>
                        	<td><strong>书名</strong></td>
                        	<td><?php echo $book_name;?></td>
                        </tr>
                    	<tr>
                        	<td><strong>出版社</strong></td>
                        	<td><?php echo $publisher;?></td>
                        </tr>
                    	<tr>
                        	<td><strong>出版年月</strong></td>
                        	<td><?php echo $publish_date;?></td>
                        </tr>
                    	<tr>
                        	<td class="span2"><strong>价格</strong></td>
                        	<td><?php echo $price;?></td>
                        </tr>
                    	<tr>
                        	<td><strong>可借图书ID</strong></td>
                        	<td><p class="text-error">
								<?php 
                                  while(($row=sqlsrv_fetch_array($result)))
								  {
									  echo $row['图书ID']." ";
								  }
                                ?>
                                </p>
                            </td>
                        </tr>                        
                    	<tr>
                        	<td><strong>复本量</strong></td>
                        	<td><?php echo $fuben_num;?></td>
                        </tr>
                        <tr>
                        	<td><strong>库存量</strong></td>
                        	<td><p class="text-error"><?php echo $store_num;?></p></td>
                        </tr>
                        <tr>
                        	<td><strong>分类号</strong></td>
                        	<td><?php echo $type_num;?></td>
                        </tr>
                        <tr>
                        	<td><strong>内容预览</strong></td>
                        	<td colspan="2"><?php echo $content_view;?></td>
                        </tr>
                    </tbody>
                </table>
        </div>
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
<?php
	sqlsrv_close($conn);
?>