

	<section class="_single_workout_banner" style="background-image:url(<?= base_url()?>assets/front/uploads/courses/<?= $coursedetails->banner_image ?>);">
		<div class="_single_workout_banner_inner">
			<h1 class="has_big_dumble"><?=$courseplan->title?></h1>
				<?php if(!empty($nextcourseplan)):
				 ?>
				<a href="<?=base_url()?>dashboard-workout/<?=$nextcourseplan->slug?>" class="btn_big_blue">Next</a>
			<?php else: ?>
				<a href="<?=base_url()?>start-workout/<?=$coursedetails->slug?>" class="btn_big_blue">Next</a>
			<?php endif; ?>
		</div>
	</section>
	
	
	<section class="_single_workout_vidoe">
		<div class="container">
			<div class="row title_sec text-center">
				<h3><?=$courseplan->title?></h3>
			</div>
			<div class="row">
				<div class="_single_workout_video_inner">
					<video width="100%" controls>
					  <source src="<?=base_url()?>assets/front/uploads/courses/courseplans/<?=$courseplan->video?>" type="video/mp4">
					  Your browser does not support HTML5 video.
					</video>
				</div>
			</div>
		</div>	
	</section>
	
	<section class="_single_workout_sets">
		<div class="container">
			<div class="row text-center">
				<h3>Sets</h3>
				<ul class="_single_sets_ul">
					<?php 
					if(count($plansets)>0):
						foreach($plansets as $planset): 
						 ?>
							<li>
								<a href="javascript:;" class="sets" data-id="<?= $planset['id']?>" data-reps="<?= $planset['reps']?>"><?= $planset['sets']?></a>
							</li>
						<?php endforeach;
						else:
							echo 'No Result Found';
						endif;
				 	?>
				</ul>
			</div>
		</div>
	</section>
	
	
	<section class="_single_workout_sets _single_workout_reps">
		<div class="container">
			<div class="row text-center">
				<?php if(count($plansets)>0): ?>
				<h3>Reps</h3>
				<ul class="_single_sets_ul">
					<li>
						<a id="reps" href="javascript:;"><?= $plansets[0]['reps']?></a>
					</li>
				</ul>
			<?php endif;
					if(!empty($nextcourseplan)):
				 ?>
				<a href="<?=base_url()?>dashboard-workout/<?=$nextcourseplan->slug?>" class="btn_big_blue">Next</a>
			<?php else: ?>
				<a href="<?=base_url()?>start-workout/<?=$coursedetails->slug?>" class="btn_big_blue">Next</a>
			<?php endif; ?>
			</div>
		</div>
	</section>
	
	<section class="_cant_find_bg _single_workout_cta">
		<div class="container text-center">
			<div class="row">
				<div class="col-md-12">
					<h2>FINISHED</h2>
					<h3>WORKOUT</h3>
				</div>
			</div>
		</div>
		<a href="javascript:void(0)" class="btn_blue">End</a>
	</section>
	<script type="text/javascript">
		 $(document).on("click",".sets",function() {
		 $('.sets').removeClass('active');
		$("#reps").html($(this).data("reps"));
		$(this).addClass('active');
		
	});

	</script>