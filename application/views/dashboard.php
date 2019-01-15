<section class="_dashboard_banner" style="background-image:url(<?= base_url()?>assets/front/images/banner.jpg">
		<div class="_dashboard_banner_inner">
			<!-- <a href="#" class="btn_blue">
				Start Your Workout
			</a> -->
		</div>
	</section>
	
		<section class="_product_before_after">
		<div class="container">
			<div class="row title_sec text-center">
				<h3>My Program</h3>
			</div>
			
			<div class="row _product_before_after_row">
				<div class="col-md-6 col-xs-12 col-sm-6 _product_before_col">
					<?php 
					if(count($ordercourses) > 0):
					foreach($ordercourses as $ordercourse): ?>
					<div class="col-md-6 col-xs-6 col-sm-6 _product_ba_img">
						<a href="<?=base_url()?>start-workout/<?= $ordercourse['slug']?>" title="<?= $ordercourse['title']?> Workout">
						<img src="<?= base_url()?>assets/front/uploads/courses/<?= $ordercourse['image']?>" alt="<?= $ordercourse['title']?>"  class="img-responsive" />
						<h3><?= $ordercourse['title']?></h3>
					</a>
					</div>
					<?php 
				endforeach;
					else:
					echo '<h5 class="text-center">No Result Found</h5>';
					endif;
					 ?>
				</div>
			
			</div>
			
		</div>
	</section>