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
		<div class="container">
        <div class="span10 offset1">
        <form class="form-inline" method="post" action="" target="_self">
        检索条件：
            <select name="type">
              <option value="书名">书名</option>
              <option value="ISBN">ISBN</option>
              <option value="作译者">作译者</option>
              <option value="出版社">出版社</option>
            </select>
        &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;关键字：
            <input type="text" name="key_word" />
            <input type="hidden" name="search" value="sub" />
           &nbsp;&nbsp;  &nbsp;&nbsp;<button  type="submit" class="btn" id="search">查询</button>
        </form>
        </div>
        </div>
        <div class="container">
        <div class="content-list">
<?php
	if($_POST['search'] == 'sub')
	{
		$serverName = "localhost";
		$uid = "sa";
		$pwd = "123456";
	 
		$connectionInfo = array("UID"=>$uid,"PWD"=>$pwd,"Database"=>"MBOOK");
	 
		$conn = sqlsrv_connect( $serverName,$connectionInfo);
		sqlsrv_query($conn, "set names GB2312");
		
		$type     = $_POST['type'];
		$type     = ($type == "")? "ISBN":$type;
		
		$key_word = $_POST['key_word'];
		
		$sql = "SELECT * FROM TBook WHERE $type like '%$key_word%'";
		$result = sqlsrv_query($conn ,$sql);
?>				
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
<?php
	}
?>
			</div>
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
  </script>
</html>