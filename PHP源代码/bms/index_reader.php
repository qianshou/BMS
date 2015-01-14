<?php 
	require_once("config.php");
	if(!check_reader())exit();
	$tag = 1;
	
	
	$lend_id = $_SESSION['reader_id'];
	
	//连接数据库模块
	$serverName = "localhost";
    $uid = "sa";
    $pwd = "123456";
 
    $connectionInfo = array("UID"=>$uid,"PWD"=>$pwd,"Database"=>"MBOOK");
 
    $conn = sqlsrv_connect( $serverName,$connectionInfo);
	sqlsrv_query($conn, "set names GB2312");
	
	$sql  = "SELECT * FROM TReader WHERE 借书证号='$lend_id'";
	
	$result        =  sqlsrv_query($conn ,$sql);
	$row           =  sqlsrv_fetch($result);
	$name          =  sqlsrv_get_field( $result,2);
	$sex           =  sqlsrv_get_field( $result,3);
	
	$sex    =   ($sex==1)? "男":"女"; 
	
	$birthdate     =  sqlsrv_get_field( $result,4,SQLSRV_PHPTYPE_STRING( SQLSRV_ENC_CHAR));
	$major         =  sqlsrv_get_field( $result,5);
	$book_lend_num =  sqlsrv_get_field( $result,6);
	$photo         =  sqlsrv_get_field( $result,7);
	$comment       =  sqlsrv_get_field( $result,8);
	$contact       =  sqlsrv_get_field( $result,9,SQLSRV_PHPTYPE_STRING( SQLSRV_ENC_CHAR));
	
	sqlsrv_close($conn);
?>
<?php require_once("top_menu_reader.php");?>
    <!--内容模块-->
    <div class="container">
		<div class="content_display_user">
            <table class="table table-bordered">
                    <thead>
                        <th colspan="3"><p class="text-center">读者信息表</p></th>
                    </thead>
                    <tbody>
                    	<tr>
                        	<td class="span3"><strong>借书证号</strong></td>
                        	<td class="span3"><?php echo $lend_id?></td>
                            <td class="span6" rowspan="6" style="padding-left:20px"><img src="image.php?type=reader&id=<?php echo $lend_id;?>" width="300px" height="200px"></td>
                        </tr>
                    	<tr>
                        	<td><strong>姓名</strong></td>
                        	<td><?php echo $name;?></td>
                        </tr>
                    	<tr>
                        	<td><strong>性别</strong></td>
                        	<td><?php echo $sex;?></td>
                        </tr>
                    	<tr>
                        	<td><strong>专业</strong></td>
                        	<td><?php echo $major;?></td>
                        </tr>
                    	<tr>
                        	<td><strong>出生年月</strong></td>
                        	<td><?php echo $birthdate;?></td>
                        </tr>
                    	<tr>
                        	<td><strong>借书量</strong></td>
                        	<td><?php echo $book_lend_num;?></td>
                        </tr>
                    	<tr>
                        	<td><strong>联系方式</strong></td>
                        	<td colspan="2"><?php echo nl2br(htmlspecialchars($contact));?></td>
                        </tr>
                        <tr>
                        	<td><strong>备注</strong></td>
                        	<td colspan="2"><?php echo $comment;?></td>
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
</html>