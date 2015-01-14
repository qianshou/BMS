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
	<?php
		if($_GET['cmd'] == "add")
		{
			require_once("book_add.php");
		}
		if($_GET['cmd'] == "list" || $_GET['cmd']=="")
		{
			require_once("book_list.php");
		}
	?>
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