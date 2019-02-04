
	<section class="_dashboard_banner" style="background-image:url(<?= base_url()?>assets/front/uploads/courses/<?= $coursedetails->banner_image ?>);">
		<div class="_dashboard_banner_inner">
			<h4 >
				Start Your Workout
			</h4>
		</div>
	</section>
	<section class="_user_area_weeks">
	<img src="<?=base_url()?>assets/front/images/dots-4.png" class="img-responsive _dots_4" alt="">
		<div class="container">
			<div class="row title_sec text-center">
				<h3>Week</h3>
			</div>
			<div class="row _weeks_numbers">
				<div class="col-md-12 text-center">
					<ul>
						<?php foreach($weeks as $week): ?>
						<li class="<?= ($week['week_no']==1 ? 'active_week' : '')?> weeks" id="week<?=$week['id']?>">
							<a href="javascript:;" onclick="weekClick(<?=$week['id']?>,<?=$week['week_no']?>)"><?php 
								$num_length = strlen((string)$week['week_no']);
								if($num_length ==1){
									echo '0'.$week['week_no'];
								}else{
									echo $week['week_no'];	
								}
							 ?></a>
						</li>
					<?php  endforeach;
						
					?>

					</ul>
				</div>
			</div>
			<div class="_week_days row planshow">
				<?php
				if(count($courseplans) > 0):
					$i=0;
					foreach($courseplans as $courseplan): ?>
				<script type="text/javascript">
					$( document ).ready(function() {
					worout_finished('1','<?=$courseplan['day_no']?>','<?=$this->session->userdata('user_id')?>','<?=$courseplan['course_id']?>','<?=$courseplan['slug']?>','wk<?=$i?>');
					});	
				</script>		
				<div id="wk<?php echo $i++; ?>" class="_week_day col-md-6 col-sm-6 col-xs-12 _week_monday ">
					<div class="_week_day_inner">						
						<a class="chk_week_day" weekid="1" dayno="<?=$courseplan['day_no']?>" userid="<?=$this->session->userdata('user_id')?>" coursid="<?=$courseplan['course_id']?>" slg="<?=$courseplan['slug']?>" href="javascript:void(0);">
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
			<?php endforeach; else : 
					echo '<h5 class="text-center ">No Result Found</h5>';
				endif;
				
			?>
			</div>
			
		</div>
	</section>
	<section class="_week_ntritions">
	<img src="<?=base_url()?>assets/front/images/dots-4.png" class="img-responsive _dots_4" alt="">
		<div class="container text-center">
			<h3 id="weekid">Week 1 Nutritions</h3>
			<?php if(count($weeks)> 0):
				?>
			<p id="nutritioncontent">
				<?= (!empty($weeks[0]['content']) ? $weeks[0]['content'] : 'No Result Found' )?>
			</p>
			<?php else: ?>
			<p id="nutritioncontent">
			No Result Found
			</p>
			<?php endif; ?>
			<!--<a href="javascript:;" onclick="StartWorkout()"  class="btn_blue">Start</a>-->
		
		</div>
	</section>