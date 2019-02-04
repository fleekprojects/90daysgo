<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>90 Days Go | Fitness Training Courses</title>


<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="https://fonts.googleapis.com/css?family=Aleo:400,700|Lato:400,700,900" rel="stylesheet">

<link href="<?= base_url(); ?>assets/front/css/custom.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://www.paypalobjects.com/api/checkout.js"></script>
<script src="https://checkout.stripe.com/checkout.js"></script>
</head>
<body>
<div class="wrapper">

<section class="_mobile_nav">
	<div class="_mobile_nav_inner">
		<a href="<?= base_url()?>" class="_btn_mobile_close">
			<i class="fa fa-times"></i>
		</a>
		<a href="index.html" class="_logo_link">
			<img src="<?= base_url(); ?>assets/front/images/logo.png" class="img-responsive _logo" alt="" />
		</a>
		
		<ul class="_mobile_menu">
			
				<?php if(!empty($this->session->userdata('user_id'))): ?>
				<li><a href="<?=base_url()?>dashboard">My Programs</a>
				</li>
				<li><a href="<?=base_url()?>change-password">Change Password</a>
				</li>
				<li>
					<a href="<?= base_url()?>logout">Logout</a>
				</li>
				<?php else: ?>
				<li>
					<a href="<?= base_url()?>login">Login</a>
				</li>
				<li>
					<a href="<?= base_url()?>signup">Register</a>
				</li>
					<?php endif; ?>
				<li>
					<a href="<?= base_url()?>contact-us">Contact us</a>
				</li>
		</ul>
		
		<p class="_mobile_policy">
			<a href="javascript:void(0);">Privacy Policy</a>
			<a href="javascript:void(0);" class="pull-right">Terms & Conditions</a>
		</p>
	</div>
</section>

	<header>
		 <div class="container">
			<div class="row">
				<div class="col-md-4 col-sm-4 col-xs-4 _header_menu">
					<a href="javascript:void(0);" class="btn_menu">
						<i class="fa fa-bars"></i>
					</a>
					<ul class="_main_menu">
						
						<?php if(!empty($this->session->userdata('user_id'))): ?>
						<li><a href="<?= base_url()?>">Home</a></li>	
						<li><a href="<?=base_url()?>dashboard">My Programs</a></li>
						<li><a href="<?=base_url()?>contact-us">Contact Us</a></li>
						<?php else: ?>
						<li>
							<a href="<?= base_url()?>login">Login</a>
						</li>
						<li>
							<a href="<?= base_url()?>signup">Register</a>
						</li>
						<?php endif; ?>
					</ul>
				</div>
				<div class="col-md-4 col-sm-4 col-xs-4 text-center _header_logo">
					<a href="<?= base_url(); ?>" class="_logo_link">
						<img src="<?= base_url(); ?>assets/front/images/logo.png" class="img-responsive _logo" alt="" />
					</a>
				</div>
				<div class="col-md-4 col-sm-4 col-xs-4 _header_cart">
					<ul class="_main_menu pull-right" style="margin-left: 15px;">
						
						<?php if(!empty($this->session->userdata('user_id'))): ?>
						<li class="_logged_in_dropdown"><a href="javascript:void(0);" class="_logged_in_dropdown_anchor"><i class="fa fa-user"></i> Welcome <?= $this->session->userdata('user_name')?> <i class="fa fa-caret-down"></i></a>
						
							<ul class="_profile_sub_menu">
								<li><a href="<?=base_url()?>change-password">Change Password</a>
									
								</li>
								<li>
									<a href="<?= base_url()?>logout">Logout</a>
								</li>
							</ul>
							
						</li>
						
						<?php endif; ?>
					</ul>
					<a href="<?= base_url()?>cart" class="_header_basket">
						<img src="<?= base_url(); ?>assets/front/images/cart_icon.png" alt="" class="img-responsive cart_icon" /><span class="_basket_count"><?= (($this->cart->contents()!="") ? count($this->cart->contents()) : 0) ?></span>
					</a>
				</div>
			</div>
		 </div>
	</header>
	
         <!-- header end here -->
         <?php  $this->load->view($view,$viewData); ?>
         <!-- // End Content -->
         <footer>
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center">
					<a href="<?=base_url()?>">
						<img src="<?= base_url(); ?>assets/front/images/logo_footer.png" class="img-responsive _footer_logo" alt="90 Days" />
					</a>
					<ul class="social_menu">
						<li>
							<a href="javascript:void(0);">
								<i class="fa fa-facebook-square"></i>
							</a>
						</li>
						<li>
							<a href="javascript:void(0);">
								<i class="fa fa-youtube-play"></i>
							</a>
						</li>
						<li>
							<a href="javascript:void(0);">
								<i class="fa fa-twitter"></i>
							</a>
						</li>
						<li>
							<a href="javascript:void(0);">
								<i class="fa fa-linkedin-square"></i>
							</a>
						</li>
					</ul>
					
					<ul class="_footer_menu">
						<li>
							<a href="<?=base_url()?>">
								Home
							</a>
						</li>
						<li>.</li>
						<li>
							<a href="<?=base_url()?>terms-conditions">
								Terms & Conditions
							</a>
						</li>
						<li>.</li>
						<li>
							<a href="<?=base_url()?>privacy-policy">
								Privacy Policy
							</a>
						</li>
						<li>.</li>
						<li>
							<a href="<?= base_url()?>contact-us">
								Contact us
							</a>
						</li>
					</ul>
					<div class="_disclaimer">
						<p>
							Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. 
						</p>
					</div>
				</div>
			</div>
		</div>
	</footer>
	<section class="_copy_right">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					 <p>
						<a>&copy; 90 Days Go. All Right Reserved</a>
					 </p>
				 </div>
			</div>
		</div>
	</section>
</div>


<script>

	var baseurl="<?= base_url()?>";
	jQuery(document).ready(function($){

		$('.btn_menu').click(function(){
			$('._mobile_nav').addClass('active_open');
		});
		$('._btn_mobile_close').click(function(){
			$('._mobile_nav').removeClass('active_open');
		});
		$('._logged_in_dropdown_anchor').click(function(){
			$('._profile_sub_menu').fadeToggle();
		});
		
		
		// Add smooth scrolling to all links
		$("a").on('click', function(event) {

		// Make sure this.hash has a value before overriding default behavior
		if (this.hash !== "") {
		  // Prevent default anchor click behavior
		  event.preventDefault();

		  // Store hash
		  var hash = this.hash;

		  // Using jQuery's animate() method to add smooth page scroll
		  // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
		  $('html, body').animate({
			scrollTop: $(hash).offset().top
		  }, 800, function(){

			// Add hash (#) to URL when done scrolling (default click behavior)
			window.location.hash = hash;
		  });
		} // End if
		});
	});
var handler = StripeCheckout.configure({
  key: 'pk_test_1vbqHzMFJMtGk8QbiMCkqMW0',
  image: 'https://stripe.com/img/documentation/checkout/marketplace.png',
  locale: 'auto',
  token: function(token) {
    // You can access the token ID with `token.id`.
    // Get the token ID to your server-side code for use.
    
  },
  opened: function() {
  	console.log("Form opened");
  },
  closed: function() {
  	console.log("Form closed");
  }
});

$('#stripe-click').on('click', function(e) {

	var subtotal=$('#subtotal').val();
  // Open Checkout with further options:
  handler.open({
    name: '90daysgo',
    description: '2 widgets',
    amount: subtotal
  });
  e.preventDefault();
});

// Close Checkout on page navigation:
$(window).on('popstate', function() {
  handler.close();
});
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5c4eb5b751410568a108eeb2/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();

</script>



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>

<script src="<?= base_url(); ?>assets/front/js/custom_javascript.js"></script>
</body>
</html>

