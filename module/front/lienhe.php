
<div class="container" style="background:url(img/logo/bg.jpg)">
<div class="row">
	
    <div class="col-md-7 col-sm-7 col-xs-12">
    <div id="form_lienhe">
    	<form action="?mod=xulylienhe" method="post">
        <fieldset>
        	<legend><h3 style="text-align:center; font-weight:bold">Liên Hệ Với Chúng Tôi !</h3></legend>
            <ul class="form_lh">
            	<li>Họ và tên*</li>
            	<li><input type="text" name="name" class="col-md-12 col-sm-12 col-xs-12" style="width:100%" required ></li>
        	</ul>
            <ul class="form_lh">
            	<li>Email*</li>
                <li><input type="email" name="email" class="col-md-12 col-sm-12 col-xs-12" style="width:100%" required ></li>
            </ul>
            <ul class="form_lh">
            	<li>Tiêu Đề</li>
                <li><input type="text" name="subject" class="col-md-12 col-sm-12 col-xs-12" style="width:100%" ></li>	
            </ul>
            <ul class="form_lh">
            	<li>Nội Dung*</li>
                <li><textarea type="text" name="content" style="width:100%; height:100px" required
                 class="col-md-12 col-sm-12 col-xs-12" ></textarea>
                </li>	
            </ul>
            <ul class="form_lh">
            	<button type="submit" class="btn btn-danger" style="margin-top:10px">Gửi</button>
            </ul>	
        </fieldset>    
        </form>
    </div>
    </div>
    
    <div class="col-md-5 col-sm-5 col-xs-12" style="margin-top:60px">
                <form action="?mod=danhgia" method="post" id="danh_gia">

                <!--Tieu đề câu hỏi -->
                <?php
					$sql="select `id`,`content` from `dt_question` where `active`=1";
					$rs=mysqli_query($link,$sql);
					$r=mysqli_fetch_assoc($rs);
				?>
                
                <p style="text-align:center; font-weight:bold; font-size:18px; text-decoration:underline">
                	<?=$r['content'];?>
                </p>
                
                <ul class="form_lh" style="margin-top:20px">
                <!--Những đáp án trả lời -->        
                <?php
					$sql="select `id`,`content` from `dt_answer` where `question_id`=1";
					$rs=mysqli_query($link,$sql);
					
					while($r=mysqli_fetch_assoc($rs)) {
				?>        
                	<li><label><input name="answer" type="radio" value="<?=$r['id'] ?>" > <?=$r['content']; ?></li></label> 
                <?php } ?>
                                                  
                </ul>
                <button type="submit" class="btn btn-default" style="margin-top:10px; margin-left:40px">Bình chọn</button>   
                </form> 
        
    </div>
    
</div>
</div>