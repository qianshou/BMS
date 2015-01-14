<?php 
	require_once("config.php");
	if(!check_user())
	{
		echo "<script>window.location.href='login.php';</script>";
		exit();
	}
	$tag = 1;
?>
<?php require_once("top_menu.php");?>
    <!--内容模块-->
    <div class="container">
		<div class="content_list_user ">
        <div class="container">
        <div class="span6 offset3">
        <form class="form-inline" method="post" action="fun.php?cmd=return"  name="borrow">
        图书ID： &nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="book_id" class="input-medium" required />
            <input type="hidden" name="search" value="sub" />
            &nbsp;&nbsp;&nbsp;&nbsp;
        <button  type="submit" class="btn" id="search">归还图书</button>
        </form>
        </div>
        </div>
        <div class="container content-list">
<?php
		$serverName = "localhost";
		$uid = "sa";
		$pwd = "123456";
	 
		$connectionInfo = array("UID"=>$uid,"PWD"=>$pwd,"Database"=>"MBOOK");
	 
		$conn = sqlsrv_connect( $serverName,$connectionInfo);
		sqlsrv_query($conn, "set names GB2312");

		
		$sql = "SELECT * FROM HLend ORDER BY 还书时间 DESC";
		$result = sqlsrv_query($conn ,$sql);
?>				
            <table class="table table-hover table-bordered">
                <thead>
                    <th>图书ISBN</th>
                    <th>图书ID</th>
                    <th>借书证号</th>                    
                    <th>借书时间</th>
                    <th>应还时间</th>
                </thead>
                <tbody>
<?php
						while(($row = sqlsrv_fetch($result)))
							{
									$lend_id     = sqlsrv_get_field( $result,1);
									$isbn        = sqlsrv_get_field( $result,2);
									$book_id     = sqlsrv_get_field( $result,3);
									$borrow_time = sqlsrv_get_field( $result,4,SQLSRV_PHPTYPE_STRING( SQLSRV_ENC_CHAR));
									$return_time = sqlsrv_get_field( $result,5,SQLSRV_PHPTYPE_STRING( SQLSRV_ENC_CHAR));
									echo "<tr>";
									echo "<td>".$isbn."</td>"."<td>".$book_id."</td>"."<td>".$lend_id."</td>"."<td>".$borrow_time."</td>"."<td class=\" text-info\">".$return_time."</td>";
									echo "</tr>";

							}
?>
              </tbody>
            </table>
<?php

?>
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
    $("ul.nav li:contains('归还图书')").addClass("active").siblings().removeClass("active");
	
	$("button#search").click(function(){

		if($("form[name=borrow] :input[name=book_id]").val()=="")
		{
			alert('图书ID不能为空');
			return false;
		}
	});
	
  </script>
</html>