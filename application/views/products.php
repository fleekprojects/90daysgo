<section class="_product_banner" style="background-image:url(<?= base_url()?>assets/front/uploads/courses/<?= $workout->banner_image ?>);">
		<div class="_product_banner_inner">
		
			<!-- <h4>workout</h4> -->
			<h1 class="has_big_dumble">  <?= $workout->title ?> </h1>
			<!-- <h4>women</h4> -->
			<hr class="_one_hr">
			<hr class="_two_hr">
		</div>
		<h4 class="_product_price_like_button">$<?= $workout->price?></h4>
		<h5 style="color:white;" class="_cource_slogan"><?= $workout->short_text?></h5>
	</section>
	<section class="_btn_add_cart_bar">
		<div class="container text-center">
			
			 <?php if(isset($uorder)):
							if (!in_array($workout->title, $uorder)): ?>
			<a href="javascript:;" onclick="Addtocart(<?= $workout->id ?>)"  class="btn_add_cart">Add to Cart</a>
		<?php 
			endif; 
			else: ?>
			<a href="javascript:;" onclick="Addtocart(<?= $workout->id ?>)"  class="btn_add_cart">Add to Cart</a>

		<?php endif; ?>
		</div>
	</section>
	
	<section class="_product_choose_program">
		<div class="container">
			<div class="row title_sec text-center">
				<h3>Program Overview</h3>
			</div>
			
			<div class="row _product_choose_program_content">
				<?php 
				if(count($workoutfeatures) > 0):
				foreach($workoutfeatures as $workoutfeature): ?>
				<div class="col-md-4 col-sm-4 col-xs-6 _product_choose_program_col">
					<img src="<?= base_url()?>assets/front/images/icons/<?= $workoutfeature['image']; ?>" class="img-responsive" alt="" />
					<h5><?= $workoutfeature['title'] ?></h5>
				</div>
				<?php  endforeach;
						else:
						echo '<h5 class="text-center">No Result Found</h5>';
						endif;
				 ?>
			</div>
			
<!-- 				<div class="col-md-4 col-sm-4 col-xs-6 _product_choose_program_col">
					<img src="<?= base_url()?>assets/front/images/pro_icon2.png" class="img-responsive" alt="" />
					<h5>Gym Versions</h5>
				</div>
				<div class="col-md-4 col-sm-4 col-xs-6 _product_choose_program_col">
					<img src="<?= base_url()?>assets/front/images/pro_icon3.png" class="img-responsive" alt="" />
					<h5>Any Time Per Session</h5>
				</div>
				<div class="col-md-4 col-sm-4 col-xs-6 _product_choose_program_col">
					<img src="<?= base_url()?>assets/front/images/pro_icon4.png" class="img-responsive" alt="" />
					<h5>Cardio Balanced</h5>
				</div>
				<div class="col-md-4 col-sm-4 col-xs-6 _product_choose_program_col">
					<img src="<?= base_url()?>assets/front/images/pro_icon5.png" class="img-responsive" alt="" />
					<h5>X Per Week </h5>
				</div>
				<div class="col-md-4 col-sm-4 col-xs-6 _product_choose_program_col">
					<img src="<?= base_url()?>assets/front/images/pro_icon6.png" class="img-responsive" alt="" />
					<h5>Level</h5>
				</div> -->
			
		</div>
	</section>
	
	<section class="_product_calender_">
		<div class="container text-center">
			<h5>The Program</h5>
			<img src="<?= base_url()?>assets/front/uploads/courses/<?= $workout->demo_gif?>" class="img-responsive" alt="" />
			<h3><?= $workoutprogram ?> Day Program</h3>
		</div>
	</section>
	<section class="_product_lifestyle">
		<div class="container">
			<h5>Dont Compromise Your Lifestyle</h5>
			<img src="<?= base_url()?>assets/front/images/character.png" class="img-responsive" alt="" />
			<h3>Flexible Nutrition Guide</h3>
		</div>
	</section>
	
	<section class="_product_before_after">
		<div class="container">
			<div class="row title_sec text-center">
				<h3>Before / After Images</h3>
			</div>
			
			<div class="row _product_before_after_row">
				<?php 
					if(count($course_images) > 0):
					foreach($course_images as $course_image): ?>
				<div class="col-md-6 col-xs-12 col-sm-6 _product_before_col">
					
					<div class="col-md-6 col-xs-6 col-sm-6 _product_ba_img">
						<img style="height: 350px; max-width: 262px;" src="<?= base_url()?>assets/front/uploads/courses/courseimages/<?= $course_image['before_image']?>" title="Before Workout" alt="Before Workout"  class="img-responsive" />
					</div>
					<div class="col-md-6 col-xs-6 col-sm-6 _product_ba_img">
						<img  style="height: 350px; max-width: 262px;" src="<?= base_url()?>assets/front/uploads/courses/courseimages/<?= $course_image['after_image']?>" alt="After Workout" title="After Workout"  class="img-responsive" />
					</div>
					
				</div>
				<?php 
				endforeach;
					else:
					echo '<h5 class="text-center">No Result Found</h5>';
					endif;
					 ?>
			</div>
		</div>
	</section>
	
	<section class="_cant_find_bg _product_inner_cta">
		<div class="container text-center">
			<div class="row">
				<div class="col-md-12">
					<!-- <h4>workout</h4> -->
					<h1 class="has_big_dumble"><?= $workout->title ?></h1>
					<!-- <h4>goes here</h4> -->
					<hr class="_one_hr" />
					<hr class="_two_hr"/>
					<h3 class="_product_cta_price">$<?= $workout->price ?><h3>

					<?php if(isset($uorder)):
					
					 if (!in_array($workout->title, $uorder)): 
					 ?>
					<a href="javascript:void(0)" onclick="Addtocart(<?= $workout->id ?>)" class="btn_blue">Add to Cart</a>
					<?php endif; else: ?>
						<a href="javascript:void(0)" onclick="Addtocart(<?= $workout->id ?>)" class="btn_blue">Add to Cart</a>
				<?php  endif; ?>
				</div>
			</div>
		</div>
	</section>