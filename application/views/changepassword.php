	<section class="_sign_in_up">
		<img src="<?=base_url()?>assets/front/images/dots-4.png" class="img-responsive _dots_4" alt="" />
		<div class="_sign_in_up_inner">
			<form id="changepasswordform" method="POST">
				<div id="msg"></div>
			<h3>Change Password</h3>
			
			<input type="password" id="password" name="password" class="txt_user_s" placeholder="| Password" />
			<input type="hidden" name="token" value="<?= $slug?>">
			<input type="password" id="cpassword"  class="txt_user_s" placeholder="| Confirm Password" />
			<input type="submit" value="Submit" class="btn_user_s" />
			</form>
		</div>
	</section>