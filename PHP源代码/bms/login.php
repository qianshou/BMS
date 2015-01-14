<!DOCTYPE html>
<html>
  <head>
    <title>欢迎登陆图书管理系统</title>
    <link rel="shortcut icon" href="./img/ICON.png" />
    <meta charset="GB2312">
  
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/qianshou.css" rel="stylesheet">
	<script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </head>
  <body>
  <div class="container">
   	<!--通用头部部分-->
    <div class="container top-one">
        <div class="span8 offset1 con">
        <h2>图书信息管理系统（BMS）</h2>
        </div>
	</div>
    <div class="alert fade in">
        <button class="close" data-dismiss="alert" type="button">×</button>
        <strong style="margin-right:300px;">测试读者用户:201102&nbsp;&nbsp;&nbsp;&nbsp;密码：12345</strong>
       <strong>测试管理员用户：qianshou&nbsp;&nbsp;&nbsp;&nbsp;密码：123456</strong>
    </div>
    <!--登陆表单-->   
    
    <div class="container login">
        <div class="span8 offset1 tabbable tabs-left"> 
          <ul class="nav nav-tabs">
            <li class="active"><a href="#tab1" data-toggle="tab">读者登陆</a></li>
            <li><a href="#tab2" data-toggle="tab">管理员登陆</a></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="tab1">
             <form class="form-horizontal" action="fun.php?cmd=login&from=reader" method="post" name="reader">
              <div class="control-group">
                <label class="control-label" for="lend_num">借书证号</label>
                <div class="controls">
                  <input type="text" id="lend_num" placeholder="借书证号" name="lend_num">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="inputPassword">读者密码</label>
                <div class="controls">
                  <input type="password" id="inputPassword" placeholder="密码" name="password">
                </div>
              </div>
              <input type="hidden" name="reader" value="login" />
              <div class="control-group">
                <div class="controls">
                  <button type="submit" class="btn" name="reader">登&nbsp;&nbsp;&nbsp;&nbsp;陆</button>
                </div>
              </div>
            </form>    
            </div>
            <div class="tab-pane" id="tab2">
             <form class="form-horizontal" action="fun.php?cmd=login&from=admin" method="post" name="admin">
              <div class="control-group">
                <label class="control-label" for="username">管理用户名</label>
                <div class="controls">
                  <input type="text" id="username" placeholder="用户名" name="username">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="inputPassword">管理员密码</label>
                <div class="controls">
                  <input type="password" id="inputPassword" placeholder="密码" name="password">
                </div>
              </div>
              <input type="hidden" name="admin" value="login" />
              <div class="control-group">
                <div class="controls">
                  <button type="submit" class="btn btn-primary" name="admin">登&nbsp;&nbsp;&nbsp;&nbsp;陆</button>
                </div>
              </div>
            </form>    
            </div>
          </div>
        </div>    
    </div>
    
    <!--也页脚模块-->
    
   <div class="container footer">
   <hr>
   <p class="text-center text-info">版权所有<sup>&copy;</sup>  山东师范大学 信息科学与工程学院 2011级 计信 赵哲</p>
   </div>
   
   </div>
   <script>
   $("button[name=admin]").click(function(){
	   if($("form[name=admin] :input[name=username]").val()=="")
	   {
	        alert("用户名不允许为空");
			return false;
	   }
	   if($("form[name=admin] :input[name=password]").val()=="")
	   {
		    alert("密码不允许为空");
			return false;   
	   }
   });
   $("button[name=reader]").click(function(){
	   if($("form[name=reader] :input[name=lend_num]").val()=="")
	   {
		    alert("借书证号不允许为空");
			return false;   
	   }
	   if($("form[name=reader] :input[name=password]").val()=="")
	   {
			alert("密码不允许为空");   
			return false;
	   }
   });
   </script>
  </body>
</html>