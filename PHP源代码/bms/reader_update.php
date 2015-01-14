<?php 
	require_once("config.php");
	if(!check_reader())
	{
		echo "<script>window.location.href='login.php';</script>";
		exit();
	}
	$tag = 1;
	
	$lend_id = $_GET['id'];
	if($lend_id != $_SESSION['reader_id'])
	{
		echo "<script>window.location.href='index_reader.php'</script>";
		exit();
	}
	
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
	
	$password      =  sqlsrv_get_field( $result,1);
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
        <div class="content_update_user span10 offset1">
            <form class="form-horizontal" name="update_reader" method="post" enctype="multipart/form-data" action="fun.php?type=reader&cmd=update_user">
              <div class="control-group">
                <label class="control-label" for="len_num">借书证号</label>
                <div class="controls">
                  <input  class="uneditable-input" readonly type="text" id="len_num"  name="len_num" value="<?php echo $lend_id;?>">
                </div>
              </div>
              
              <div class="control-group">
                <label class="control-label" for="name">姓 名</label>
                <div class="controls">
                  <input type="text" id="name"  name="name" value="<?php echo $name;?>">
                </div>
              </div>
              
               <div class="control-group">
                <label class="control-label" for="password">密 码</label>
                <div class="controls">
                    <input type="text" name="password" id="password" value="<?php echo $password;?>"/>
                </div>
              </div>
              
              
              <div class="control-group">
                <label class="control-label" for="major">专业名</label>
                <div class="controls">
                <select name="major" id="major">
                  <option value="计算机">计算机</option>
                  <option value="通信工程">通信工程</option>
                  <option value="心理学">心理学</option>
                  <option value="播音主持">播音主持</option>
                  <option value="广播电视编导">广播电视编导</option>
                </select>
                </div>
              </div>
              
              <div class="control-group">
                <label class="control-label" for="sex">性 别</label>
                <div class="controls">
                    <input class="span1" type="radio" name="sex" id="sex" value="男">男
                    <input  class="span1 offset3" type="radio" name="sex" id="sex" value="女">女
                </div>
              </div>
              
              <div class="control-group">
                <label class="control-label" for="birth_date">出生年月</label>
                 <div class="controls input-append date form_date_update" style="margin-left:20px" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input" data-link-format="yyyy-mm-dd">
                    <input size="16" type="text" value="<?php echo $birthdate;?>" readonly name="birth_date">
                    <span class="add-on"><i class="icon-remove"></i></span>
                    <span class="add-on"><i class="icon-th"></i></span>
                </div>
                <input type="hidden" id="dtp_input" value="" /><br/>
              </div>
              
               <div class="control-group">
                <label class="control-label" for="photo">照 片</label>
                <div class="controls">
                    <input type="file" name="photo" id="photo"accept="image/jpeg" />
                </div>
              </div>
              
               <div class="control-group">
                <label class="control-label" for="contact">联系方式</label>
                <div class="controls">
                    <textarea rows="6" cols="20" name="contact" id="contact"><?php echo $contact;?></textarea>
                </div>
              </div>
              
               <div class="control-group">
                <label class="control-label" for="comment">备 注</label>
                <div class="controls">
                    <textarea rows="3" cols="20" name="comment" id="comment"><?php echo $comment;?></textarea>
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
$("ul.nav li:contains('修改个人信息')").addClass("active").siblings().removeClass("active");

$('.form_date_update').datetimepicker({
		//language:  'fr',
		weekStart: 1,
		todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		minView: 2,
		forceParse: 0
	});

$("select[name=major]").val(["<?php echo trim($major);?>"]);;
$(":radio[name=sex]").val(["<?php echo $sex;?>"]);


</script>
</html>