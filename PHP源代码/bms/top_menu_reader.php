<?php
	if(!$tag)exit();
	?>
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
    <link href="css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
    <script type="text/javascript" src="js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
    <script type="text/javascript" src="js/locales/bootstrap-datetimepicker.fr.js" charset="UTF-8"></script>
    <style type="text/css">
	      /* Customize the navbar links to be fill the entire space of the .navbar */
      .navbar .navbar-inner {
        padding: 0;
      }
      .navbar .nav {
        margin: 0;
        display: table;
        width: 100%;
      }
      .navbar .nav >li {
        display: table-cell;
        width: 1%;
        float: none;
      }
      .navbar .nav >li a {
        font-weight: bold;
        text-align: center;
        border-left: 1px solid rgba(255,255,255,.75);
        border-right: 1px solid rgba(0,0,0,.1);
      }
      .navbar .nav >li:first-child a {
        border-left: 0;
        border-radius: 3px 0 0 3px;
      }
      .navbar .nav >li:last-child a {
        border-right: 0;
        border-radius: 0 3px 3px 0;
      }
    </style>
  </head>
  <body>
  <div class="container" style="position:relative">
   	<!--通用头部部分-->
    <div class="container top-one">
        <div class="span8 offset1 con">
        <h2>图书信息管理系统（BMS）</h2>
        </div>
	</div>
    
    <!--菜单模块-->   
    
    <div class="container menu">
        <div class="navbar">
          <div class="navbar-inner">
            <ul class="nav">
              <li class="active"><a href="index_reader.php">个人信息</a></li>
              <li><a href="reader_update.php?id=<?php echo $lend_id;?>">修改个人信息</a></li>
               <li><a href="reader_book_list">图书列表</a></li>
              <li><a href="reader_book_search.php">图书查询</a></li>
              <li><a href="reader_borrow_info.php">当前借阅</a></li>
              <li><a href="fun.php?cmd=logout">注销账户</a></li>
            </ul>
          </div>
        </div>         
    </div>