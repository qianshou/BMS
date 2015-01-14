<meta charset="GB2312">
<?php
	if(!$tag)exit();
	?>
<div class="content_add_user span10 offset1">
    <form class="form-horizontal" name="add_reader" method="post" enctype="multipart/form-data" action="fun.php?cmd=add_user">
      <div class="control-group">
        <label class="control-label" for="len_num">借书证号</label>
        <div class="controls">
          <input type="text" id="len_num"  name="len_num">
        </div>
      </div>
      
      <div class="control-group">
        <label class="control-label" for="name">姓 名</label>
        <div class="controls">
          <input type="text" id="name"  name="name">
        </div>
      </div>
      
       <div class="control-group">
        <label class="control-label" for="password">密 码</label>
        <div class="controls">
            <input type="text" name="password" id="password"/>
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
            <input class="span1" type="radio" name="sex" id="sex" value="男" checked >男
            <input  class="span1 offset3" type="radio" name="sex" id="sex" value="女">女
        </div>
      </div>
      
      <div class="control-group">
        <label class="control-label" for="birth_date">出生年月</label>
        <div class="controls input-append date form_date" style="margin-left:20px" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
            <input size="16" type="text" value="" readonly name="birth_date">
            <span class="add-on"><i class="icon-remove"></i></span>
            <span class="add-on"><i class="icon-th"></i></span>
        </div>
        <input type="hidden" id="dtp_input2" value="" /><br/>
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
            <textarea rows="6" cols="20" name="contact" id="contact"></textarea>
        </div>
      </div>
      
       <div class="control-group">
        <label class="control-label" for="comment">备 注</label>
        <div class="controls">
            <textarea rows="3" cols="20" name="comment" id="comment"></textarea>
        </div>
      </div>              
      
      <div class="control-group">
        <div class="controls">
          <button type="submit" class="btn">添加</button>
        </div>
      </div>
    </form>
</div>    