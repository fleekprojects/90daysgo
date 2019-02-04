	<section class="_sign_in_up">
		<img src="<?=base_url()?>assets/front/images/dots-4.png" class="img-responsive _dots_4" alt="" />
		<div class="_sign_in_up_inner">
			<form id="newchangepasswordform" method="POST">
			<h3>Change Password</h3>
			<div id="msg"></div>
			<input type="password" id="opassword" name="opassword" class="txt_user_s" placeholder="| Old Password" required />
			<input type="password" id="password" name="password" class="txt_user_s" placeholder="| New Password" required />
			<input type="password" id="cpassword"  class="txt_user_s" placeholder="| Confirm Password" required />
			<input type="submit" value="Submit" class="btn_user_s" />
			</form>
		</div>
	</section>