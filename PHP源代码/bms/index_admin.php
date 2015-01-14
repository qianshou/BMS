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
    <div class="content_admin">
        <table class="table table-bordered">
            <thead>
                <tr align="center">
                    <td colspan="2" align="center">
                        <h4><p class="text-center">欢迎登陆图书管理系统（BMS)</p></h4>
                    </td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <strong>管理员用户</strong>
                    </td>
                    <td>
                       <p class="text-info"> <?php echo $_SESSION['admin'];?> </p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <strong>备  注</strong>
                    </td>
                    <td>
                      <p class="text-info"> <?php echo $_SESSION['comment'];?> </p>
                    </td>
                </tr>  
                <tr>
                    <td>
                        <strong>您具有的权限</strong>
                    </td>
                    <td>
                        <img src="img/admin_privilege.png"/>
                    </td>
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