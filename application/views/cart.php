

	<section class="_mobile_only_sec _btn_mobil_checkout">

		<div class="_btn_rows_checkout">

			<a href="javascript:;"  class="_btn_checkout btn_cart_checkout">

				<img src="<?= base_url(); ?>assets/front/images/btn_checkout.png" class="img-responsive" />

			</a>

			<a href="javascript:;" class="_btn_checkout_paypal btn_cart_checkout">

				<img src="<?= base_url(); ?>assets/front/images/btn_checkout_paypal.png" class="img-responsive" />

			</a>

		</div>

	</section>

	

	<?php 

	if(count($cart) > 0):



	 ?>

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

					<input type="hidden" id="discount">

					<h3 class="pull-left" id="promo-code"></h3>

					<h4 class="pull-right" id="promo-rate"></h4>

				</div>

			</div>

			<div class="row _cart_sub_total">

				<h4>Sub Total <span id="subtotalshow">$<?= $items['subtotal']?>.00</span></h4>



			</div>	

					<div class="row _btn_rows_checkout">

				<form action="<?php echo base_url(); ?>/strip/charge.php" method="POST" id="firstform">
				<input type="hidden" name="pckg_amount" id="pckg_amount" value="<?= $items['subtotal']?>">
				<input type="hidden" name="items_name" id="items_name"  value="<?= $items['name']?>">
				<input type="hidden" name="items_coupon" id="items_coupon"  value="<?= $items['coupon']?>">
				<input type="hidden" name="pckg_month" id="pckg_month" value="1">
				<input type="hidden" name="pckg_decp" id="pckg_decp" value="90daysgo">	
				<script src="https://checkout.stripe.com/checkout.js" class="stripe-button" data-key="pk_test_eLg4IVsI9ESwYqIfjrmOEUvd"
				data-name="90daysgo" data-description="90daysgo">
				</script>
				</form>

				<a href="javascript:;" id="paypal-click" data-course="<?= $items['name']?>" data-price="<?= $items['subtotal']?>" class="_btn_checkout_paypal btn_cart_checkout">

					<img src="<?= base_url(); ?>assets/front/images/btn_checkout_paypal.png" class="img-responsive" />

				</a>

				<!-- <div id="paypal-button-container"></div> -->



<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" id="paypalform" method="post">

  <input type="hidden" name="cmd" value="_xclick">

  <input type="hidden" name="business" value="seller@designerfotos.com">

  <input type="hidden" name="item_name" id="itemname"  value="<?= $items['name']?>">

  <input type="hidden" name="item_number" id="item_number" >

  <input type="hidden" name="amount" id="amount" value="<?= $items['subtotal']?>">

  <input type="hidden" name="quantity" value="1">

  <input type="hidden" name="currency_code" value="USD">

  <input type="hidden" name="return" value="<?=base_url()?>Cart/Paymentdone">

  

</form>



   

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

							<?php if(isset($uorder)):

							 if (in_array($course_men['title'], $uorder)): ?>

							<div class="_choose_column-inner" style="background:#3d7cc9;"   >

							 <?php else: ?>

							<div class="_choose_column-inner"   >

							<?php endif;

							 	  else: ?>

								<div class="_choose_column-inner" >

								<?php endif; ?>

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

							<?php if(isset($uorder)):

							 if (in_array($course_women['title'], $uorder)): ?>



							<div class="_choose_column-inner" style="background:#3d7cc9;"   >

							 <?php else: ?>

							<div class="_choose_column-inner"   >

							<?php endif;

							 	  else: ?>

								<div class="_choose_column-inner" >

								<?php endif; ?>

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

 $(document).on("click","#paypal-click",function() {

      var course=$(this).data("course");

      var price=$(this).data("price");

      var discount=$('#discount').val();

      

      $.ajax({

		  url : 'Cart/AddOrder',

		  type: "POST",

		  data: {course: course,price: price,discount: discount} ,

		  success: function (data) {

			if(data == 0){

				window.location='<?=base_url()?>login';

			 

			}

			else if(data!=""){

				$('#item_number').val(data);

			    $("#paypalform").submit();

			}

			else{

				$('#profilemsg').html('<b style="color: error;">Error Submitting your request. Please Try Again. </b>');

			}

		  },

		  error: function (xhr, textStatus, errorThrown) 

		  {

			console.log(xhr.responseText);

		  }

		});

		

	});



	</script>