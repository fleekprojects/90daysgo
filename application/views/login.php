

	
	<section class="_sign_in_up">
		<img src="<?=base_url()?>assets/front/images/dots-4.png" class="img-responsive _dots_4" alt="" />
		<div class="_sign_in_up_inner">
		  <form id="userlog" method="POST">
		  
			<h3>Sign in</h3>			<div id="msg"></div>
			<input type="text" name="user_name" class="txt_user_s" placeholder="| Email Address" />
			<input type="password" name="password" id="password" class="txt_user_s" placeholder="| Password" />
			<input type="checkbox" name="remember_me" id="reme"/>
				<label for="reme">Remember Me</label>
			<input type="submit" value="SignIn" class="btn_user_s btn_blue_login" />
			</form>
			<p>
				<a href="<?=base_url()?>signup" class="_no_account pull-left"><i class="fa fa-circle-o"></i> Don't have account?</a>
				<a href="<?=base_url()?>forgot" class="_forget_password pull-right"> Forget Password</a>
			</p>
		</div>
	</section>
	
	