
	<section class="_home_banner">
		<div class="_home_banner_inner">
			<h4>SORE today</h4>
			<h1>strong</h1>
			<h4>tomorrow</h4>
			<hr class="_one_hr" />
			<hr class="_two_hr"/>
			<?php if(empty($this->session->userdata('user_id'))): ?>
			<a href="<?=base_url()?>login" class="btn_theme">
				Signin
			</a>
			<?php else: ?>
			<a href="<?=base_url()?>dashboard" class="btn_theme">
				My Programs
			</a>	
			<?php endif; ?>
		</div>
		
		<a href="#down" class="_scroll_it_down">
			<i class="fa fa-angle-down"></i>
		</a>
	</section>
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
								<a href="javascript:void(0);" onclick="Addtocart(<?= $course_men['id']?>)"  class="btn_theme hover_white">
									Add to Cart
								</a>
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
								<a href="javascript:void(0);" onclick="Addtocart(<?= $course_women['id']?>)" class="btn_theme hover_white">
									Add to Cart
								</a>
							</div>
						</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</div>
	</section>
	
	<section class="_cant_find_bg">
		<div class="container text-center">
			<div class="row">
				<div class="col-md-12">
					<h2>Can’t find what</h2>
					<h3>you are looking for?</h3>
					<a href="https://tawk.to/chat/5c4eb5b751410568a108eeb2/default" target="_blank" class="btn_blue">Chat to us</a>
				</div>
			</div>
		</div>
	</section>
	