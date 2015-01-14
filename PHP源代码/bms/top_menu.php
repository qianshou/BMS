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
              <li class="active"><a href="index_admin.php">首页</a></li>
              <li><a href="book_borrow.php">借阅图书</a></li>
              <li><a href="book_return.php">归还图书</a></li>
              <li class="dropdown">
              <a class="dropdown-toggle" id="drop3" role="button" data-toggle="dropdown" href="#">图书管理<b class="caret"></b></a>
                <ul id="menu1" class="dropdown-menu" role="menu" aria-labelledby="drop3">
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="book_manage.php?cmd=list">图&nbsp;书&nbsp;列&nbsp;表</a></li>
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="book_search.php">图&nbsp;书&nbsp;查&nbsp;询</a></li>
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="book_manage.php?cmd=add">添&nbsp;加&nbsp;图&nbsp;书</a></li>
                </ul>        
              </li>
              
              <li class="dropdown">
              <a class="dropdown-toggle" id="drop2" role="button" data-toggle="dropdown" href="#">读者管理 <b class="caret"></b></a>
                <ul id="menu2" class="dropdown-menu" role="menu" aria-labelledby="drop2">
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="user_manage.php?cmd=list">读&nbsp;者&nbsp;列&nbsp;表</a></li>
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="user_manage.php?cmd=add">添&nbsp;加&nbsp;读&nbsp;者</a></li>
                </ul>
              </li>
              <li><a href="fun.php?cmd=backup_database">数据库备份</a></li>
              <li><a href="fun.php?cmd=logout">注销账户</a></li>
            </ul>
          </div>
        </div>         
    </div>