<?php 
	require_once("config.php");
	if(!check_user())
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
	
	$sql  = "SELECT * FROM TBook WHERE ISBN='$isbn'";
	
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
	
	sqlsrv_close($conn);
?>
<?php require_once("top_menu.php");?>
    <!--内容模块-->
    <div class="container">
        <div class="content_update_user span10 offset1">
          <form class="form-horizontal" name="add_reader" method="post" enctype="multipart/form-data" action="fun.php?cmd=update_book">
      <div class="control-group">
        <label class="control-label" for="isbn">图书ISBN</label>
        <div class="controls">
          <input type="text" id="isbn"  name="isbn" value="<?php echo $isbn;?>">
        </div>
      </div>

      <div class="control-group">
        <label class="control-label" for="type_num">分类号</label>
        <div class="controls">
             <input type="text" name="type_num" id="type_num" value="<?php echo $type_num;?>"/>
        </div>
      </div>    

      <div class="control-group">
        <label class="control-label" for="bookname">书 名</label>
        <div class="controls">
          <input type="text" id="bookname"  name="bookname" value="<?php echo $book_name;?>">
        </div>
      </div>
      
       <div class="control-group">
        <label class="control-label" for="author">作译者</label>
        <div class="controls">
            <input type="text" name="author" id="author" value="<?php echo $author;?>"/>
        </div>
      </div>
      
      
       <div class="control-group">
        <label class="control-label" for="publisher">出版社</label>
        <div class="controls">
            <input type="text" name="publisher" id="publisher" value="<?php echo $publisher;?>"/>
        </div>
      </div>
           
      <div class="control-group">
        <label class="control-label" for="publish_date">出版年月</label>
        <div class="controls input-append date form_date" style="margin-left:20px" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
            <input size="16" type="text" readonly name="publish_date" value="<?php echo $publish_date;?>">
            <span class="add-on"><i class="icon-remove"></i></span>
            <span class="add-on"><i class="icon-th"></i></span>
        </div>
        <input type="hidden" id="dtp_input2" value="" /><br/>
      </div>
      
       <div class="control-group">
        <label class="control-label" for="photo">图书封面</label>
        <div class="controls">
            <input type="file" name="photo" id="photo"accept="image/jpeg" />
        </div>
      </div>
      
       <div class="control-group">
        <label class="control-label" for="price">价格</label>
        <div class="controls">
             <input type="text" name="price" id="price" value="<?php echo $price;?>"/>
        </div>
      </div>    
      
       <div class="control-group">
        <label class="control-label" for="content_view">内容提要</label>
        <div class="controls">
            <textarea rows="6" cols="20" name="content_view" id="content_view"><?php echo $content_view;?></textarea>
        </div>
      </div>     
     
      <div class="control-group">
        <label class="control-label" for="fuben_num">复本量</label>
        <div class="controls">
             <input type="text" name="fuben_num" id="fuben_num" value="<?php echo $fuben_num;?>"/>
        </div>
      </div>      
     
      
      <div class="control-group">
        <label class="control-label" for="store_num">库存量</label>
        <div class="controls">
             <input type="text" name="store_num" id="store_num" value="<?php echo $store_num;?>"/>
        </div>
      </div>   
      
      <div class="control-group">
        <div class="controls">
          <button type="submit" class="btn">修&nbsp;&nbsp;改</button>
        </div>
      </div>
      
    </form>
    
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
$("ul.nav li:contains('图书管理')").addClass("active").siblings().removeClass("active");

$('.form_date').datetimepicker({
		//language:  'fr',
		weekStart: 1,
		todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		minView: 2,
		forceParse: 0
	});
</script>
</html>