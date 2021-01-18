<?php

	$mes='';
	if(isset($_POST['user']))
	{
		$user=$_POST['user'];
		$name=$_POST['name'];
		$pass=$_POST['pass'];
		$repass=$_POST['repass'];
		$mobile=$_POST['mobile'];
		$captcha=$_POST['captcha'];
		
		//Kiem tra CAPTCHA
		if($captcha != $_SESSION['captcha'])
		{
			$mes = 'Mã xác nhận nhập không đúng';
		}
		
		//Kiem Tra Email
		elseif(filter_var($user,FILTER_VALIDATE_EMAIL)===false)
		{
			$mes= "<script> alert('Email không hợp lệ'); </script>";
		}
		//Kiem Tra Pass
		elseif(strlen($pass)<6)
		{
			$mes= 'Mật khẩu tối thiểu 6 ký tự';
		}
		//Kiem Tra Nhap lai pass
		elseif($pass!=$repass)
		{
			$mes= 'Nhập lại mật khẩu chưa đúng';			
		}
		else //Du lieu hop le => insert vao DB
		{
			//Mã Hóa password
			$pass = hash('sha512',$pass);
			
			$sql="insert into `dt_user` (`email`,`password`,`name`,`mobile`) values ('$user','$pass','$name','$mobile')";
			$rs=mysqli_query($link,$sql);
			if($rs==false)
			{
				$mes= 'Đăng ký không thành công, Email đã tồn tại';
			}
			else
			{
				$mes= 'Đăng ký thành công, Hệ thống sẽ chuyển đến trang đăng nhập sau 3s nữa';
				$_SESSION['email']=$user;
?>

			<script>	
					setTimeout("window.location='?mod=dangnhap';",3000);
			</script>
            
<?php				
			}
		}
	}
?>

<div class="container" style="background:url(img/logo/bg.jpg)">
<div class="row">
	
    <div class="col-md-5 col-sm-12 col-xs-12">
    	
    	<form action="" method="post" style="margin-bottom:60px">             	   
        <fieldset>
        	<legend><h3 style="text-align:center; font-weight:bold">Đăng Ký Tài Khoản</h3></legend>
            
            <div align="center" style="color:#F00; font-size:18px; font-weight:bold; margin-top:10px;">
				<?=$mes?><br>&nbsp;
            </div>
            
            <ul class="form_lh">
            	<li>Họ và Tên*</li>
            	<li><input type="text" name="name" class="col-md-12 col-sm-12 col-xs-12" style="width:100%" required
                value="<?php if(isset($name)) echo $name ?>" ></li>
        	</ul><br/>
            <ul class="form_lh">
            	<li>Email*</li>
                <li><input type="email" name="user" id="user" class="col-md-12 col-sm-12 col-xs-12" style="width:100%" required
                value="<?php if(isset($user)) echo $user ?>" onblur="Ajax()" > <div id="loi"></div>
                </li>
            </ul><br/>
            <ul class="form_lh">
            	<li>Mật khẩu*</li>
                <li><input type="password" name="pass" class="col-md-12 col-sm-12 col-xs-12" style="width:100%" required ></li>	
            </ul><br/>
            <ul class="form_lh">
            	<li>Nhập lại mật khẩu*</li>
                <li><input type="password" name="repass" class="col-md-12 col-sm-12 col-xs-12" style="width:100%" required ></li>	
            </ul><br/>
             <ul class="form_lh">
            	<li>Số điện thoại*</li>
                <li><input type="text" name="mobile" class="col-md-12 col-sm-12 col-xs-12" style="width:100%" required
                 value="<?php if(isset($mobile)) echo $mobile ?>" ></li>	
            </ul><br/>
            <ul class="form_lh">
            	<li>Mã xác nhận*</li>
                <li><input type="text" name="captcha" class="col-md-6 col-sm-6 col-xs-6" required/>&nbsp;
                 	<img id="i-captcha" src="lib/captcha/captcha.php" alt="captcha" />
                 	<button type="button" style="background-color:#FCF" onclick="document.getElementById('i-captcha').src='lib/captcha/captcha.php?rand='+Math.random()">
                    	<img src="img/logo/refresh.png" alt="" />
                     </button>
                </li>	
            </ul><br/>
            <ul class="form_lh">
            	<button type="submit" class="btn btn-danger" style="margin-top:10px">Đăng Ký</button>
            </ul>	
        </fieldset>    
        </form>

    </div>
    
</div>
</div>    
	

<!-- OnBlur Dòng nhập Email để kiểm tra đã tồn tại hay chưa -->
<script>
	function Ajax()
	{
		//Kiểm tra Email không được trống 
		if(document.getElementById('user').value=='')
		{			
			document.getElementById('user').focus();
		}
		
		//Nếu có nhập Email thì kiểm tra xem có tồn tại hay chưa
		else
		{
			$.ajax({
				url:'AJAX/ajax.php',
				type:'POST',
				data:{email:$('#user').val()},
			})
			.done(function(data)
			{
				$('#loi').html(data);	
			})
		}
	}
</script>