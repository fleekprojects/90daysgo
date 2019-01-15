<section class="_dashboard_banner" style="background-image:url(<?= base_url()?>assets/front/uploads/courses/<?= $coursedetails->banner_image ?>);">
	<?php if(empty($startworkoutexist)): ?>
		<div class="_dashboard_banner_inner">
			<a href="javascript:;" onclick="StartWorkout()" class="btn_blue">
				Start Your Workout
			</a>
			<span class="c" style="color:white;" ></span>
		</div>
	<?php endif; ?>
	</section>
	
	<section class="_user_area_weeks">
		<div class="container">
			<div class="row title_sec text-center">
				<h3>Week</h3>
			</div>
			<div class="row _weeks_numbers">
				<div class="col-md-12 text-center">
					<ul>
						<?php foreach($weeks as $week): ?>
						<li class="<?= ($week['week_no']==1 ? 'active_week' : '')?> weeks" id="week<?=$week['id']?>">
							<a href="javascript:;" onclick="weekClick(<?=$week['id']?>)"><?=$week['week_no']?></a>
						</li>
					<?php  endforeach; ?>
					</ul>
				</div>
			</div>
			<div class="_week_days row planshow">
				<?php  foreach($courseplans as $courseplan): ?>
				<div class="_week_day col-md-6 col-sm-6 col-xs-12 _week_monday ">
					<div class="_week_day_inner">						<a href="<?=base_url()?>dashboard-workout/<?=$courseplan['slug']?>">
						<?php if($courseplan['day_no']==1):
							echo '<span class="_week_day_title">Monday</span>';
							elseif($courseplan['day_no']==2):
							echo'<span class="_week_day_title">Tuesday</span>';
							elseif($courseplan['day_no']==3):
							echo'<span class="_week_day_title">Wednesday</span>';
							elseif($courseplan['day_no']==4):
							echo'<span class="_week_day_title">Thursday</span>';
							elseif($courseplan['day_no']==5):
							echo'<span class="_week_day_title">Friday</span>';
							elseif($courseplan['day_no']==6):
							echo'<span class="_week_day_title">Saturday</span>';
							else:
							echo'<span class="_week_day_title">Sunday</span>';
							endif;
							?>		
							<span class="_week_day_workout"><?=$courseplan['title']?></span>						</a>
					</div>
				</div>
			<?php endforeach; ?>
			</div>
			
		</div>
	</section>
	<section class="_week_ntritions">
		<div class="container text-center">
			<h3>Week 1 Nutritions</h3>
			<p>
				Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris 
			</p>
			<a href="javascript:;" class="btn_blue">Start</a>
		</div>
	</section>