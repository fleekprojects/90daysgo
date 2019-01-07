
	<section class="_mobile_only_sec _btn_mobil_checkout">
		<div class="_btn_rows_checkout">
			<a href="javascript:;" class="_btn_checkout btn_cart_checkout">
				<img src="<?= base_url(); ?>assets/front/images/btn_checkout.png" class="img-responsive" />
			</a>
			<a href="javascript:;" class="_btn_checkout_paypal btn_cart_checkout">
				<img src="<?= base_url(); ?>assets/front/images/btn_checkout_paypal.png" class="img-responsive" />
			</a>
		</div>
	</section>
	<?php if(count($cart) > 0): ?>
	<section class="_full_cart_content">
		<?php foreach($cart as $items): ?>
		<div class="container">
			<div class="row _my_cart">
				<h4>My Cart (<span><?= count($cart)?></span>)</h4>		
			</div>
			<div id="cartmsg"></div>
			
			<div class="row _item_in_cart">
				<ul class="_ul_item_in_cart">
					<li>
						<img style="width: 10%;" src="<?= base_url(); ?>assets/front/uploads/courses/<?= $items['image']?>" class="img-responsive" alt="" />
						<h4><?= $items['name']?></h4>
						<h3>$<?= $items['price']?>.00</h3>
						<input type="hidden" id="subtotal" value="<?= $items['subtotal']?>">
						<a href="javascript:;" onclick="RemovetoCart('<?=$items['rowid']?>')"class="_rmv_frm_cart">
							<i class="fa fa-times"></i>
						</a>
					</li>
				</ul>
			</div>
		
			<div class="row _cart_promo">

				<h6 class="_cart_promo_lable"><i class="fa fa-ticket"></i> Enter a Promo Code</h6>
				<div id="promomsg"></div>
					<input type="text" required="" id="promo_code" placeholder="Enter promo code here" class="_promo_field" /> 
					<input type="button" onclick="PromoApply()" value="Apply" class="btn_blue _promo_button"/>
				<div id="promo_show" style="display: none;">
					<input type="hidden" id="promo_id">
					<h3 class="pull-left" id="promo-code"></h3>
					<h4 class="pull-right" id="promo-rate"></h4>
				</div>
			</div>
			<div class="row _cart_sub_total">
				<h4>Sub Total <span id="subtotalshow">$<?= $items['subtotal']?>.00</span></h4>

			</div>
			<div class="row _btn_rows_checkout">
				<a href="javascript:;" class="_btn_checkout btn_cart_checkout">
					<img src="<?= base_url(); ?>assets/front/images/btn_checkout.png" class="img-responsive" />
				</a>
				<a href="javascript:;" data-cid="<?= $items['id']?>" data-price="<?= $items['id']?>" data-="<?= $items['id']?>"  class="_btn_checkout_paypal btn_cart_checkout">
					<img src="<?= base_url(); ?>assets/front/images/btn_checkout_paypal.png" class="img-responsive" />
				</a>
				<div id="paypal-button-container"></div>
			</div>
			
		</div>
		<?php endforeach; ?>
	</section>
<?php else: ?>
	<section class="_empty_cart_content">
		<img src="<?= base_url(); ?>assets/front/images/dots-4.png" class="img-responsive _dots_4" alt="" />
		<div class="container text-center">
			<h3>Your Cart is Empty</h3>
			<p>
				Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris 
			</p>
		</div>
	</section>
<?php endif; ?>
	<section class="_choose_program" id="down">
	
		<img src="<?= base_url(); ?>assets/front/images/dots-4.png" class="img-responsive _dots_4" alt="" />
		<div class="container">
			<div class="row title_sec text-center">
				<h3>Choose a Program</h3>
			</div>
			<div class="row">
				<div class="col-md-6 col-sm-6 col-xs-12 _men_col_choose">
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12 text-center category_title">
							<h4 class="_has_dumble"><?=$mens->title?></h4>
						</div>  
						<?php foreach($course_mens as $course_men): ?>
						<div class="col-md-6 col-xs-6 col-sm-6 _choose_column">
							<div class="_choose_column-inner">
								<a href="<?=base_url()?>workout/<?= $mens->slug?>/<?= $course_men['slug']?>"> 
								<img src="<?= base_url(); ?>assets/front/uploads/courses/<?= $course_men['image']?>" alt="" class="img-responsive" />
								<h3><?= $course_men['title']?></h3>
								</a>
								<!-- <a href="javascript:void(0);" onclick="Addtocart(<?= $course_men['id']?>)"  class="btn_theme hover_white">
									Add to Cart
								</a> -->
							</div>
						</div>
						<?php endforeach; ?>
					</div>
				</div>
				
				<div class="col-md-6 col-sm-6 col-xs-12 _women_col_choose">
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12 text-center category_title"> 
							<h4 class="_has_dumble"><?=$womens->title?></h4>
						</div>
						<?php foreach($course_womens as $course_women): ?>
						<div class="col-md-6 col-xs-6 col-sm-6 _choose_column">
							<div class="_choose_column-inner">
								<a href="<?=base_url()?>workout/<?= $womens->slug?>/<?= $course_women['slug']?>">
								<img src="<?= base_url(); ?>assets/front/uploads/courses/<?= $course_women['image']?>" alt="" class="img-responsive" />
							</a>
								<h3><?= $course_women['title']?></h3>
								<!-- <a href="javascript:void(0);" onclick="Addtocart(<?= $course_women['id']?>)" class="btn_theme hover_white">
									Add to Cart
								</a> -->
							</div>
						</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</div>
	</section>

<script type="text/javascript">
	var subtotal=$('#subtotal').val();
paypal.Button.render({
env: 'sandbox', // sandbox | production
// PayPal Client IDs - replace with your own
// Create a PayPal app: https://developer.paypal.com/developer/applications/create
client: {
sandbox:    'AQdevkIiLL2H0Fl_V88qHI9J2VAq65Kq05PPoNPdw6uds_JUXvyRtFLyhp-hRfhBxumrXB0hQRzQPV6F',
production: '90days'
},
// Show the buyer a 'Pay Now' button in the checkout flow
commit: true,
// payment() is called when the button is clicked
payment: function(data, actions) {
// Make a call to the REST api to create the payment
return actions.payment.create({
payment: {
transactions: [
{
amount: { total: subtotal, currency: 'USD' }
}
]
}
});
},
// onAuthorize() is called when the buyer approves the payment
onAuthorize: function(data, actions) {
// Make a call to the REST api to execute the payment
return actions.payment.execute().then(function() {

window.location.href = "<?= base_url()?>"+'ordersubmit';
});
}
}, '#paypal-button-container');
</script>
	