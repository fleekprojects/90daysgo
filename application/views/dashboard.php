<section class="_dashboard_banner">
		<div class="_dashboard_banner_inner">
			<a href="#" class="btn_blue">
				Start Your Workout
			</a>
		</div>
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
						<li class="active_week">
							<a href="javascript:;"><?=$week['week_no']?></a>
						</li>
					<?php  endforeach; ?>
					</ul>
				</div>
			</div>
			<div class="_week_days row">
				<div class="_week_day col-md-6 col-sm-6 col-xs-12 _week_monday day_active">
					<div class="_week_day_inner">						<a href="#">							<span class="_week_day_title">Monday</span>
							<span class="_week_day_workout">Chest and Tricep</span>						</a>
					</div>
				</div>
				<div class="_week_day col-md-6 col-sm-6 col-xs-12 _week_monday">
					<div class="_week_day_inner">						<a href="#">
						<span class="_week_day_title">Tuesday</span>
						<span class="_week_day_workout">Recovery</span>						</a>
					</div>
				</div>
				<div class="_week_day col-md-6 col-sm-6 col-xs-12 _week_monday">
					<div class="_week_day_inner">						<a href="#">
						<span class="_week_day_title">Wednesday</span>						<span class="_week_day_workout">Back and Biceps</span>						</a>
					</div>
				</div>
				<div class="_week_day col-md-6 col-sm-6 col-xs-12 _week_monday">
					<div class="_week_day_inner">						<a href="#">
						<span class="_week_day_title">Thursday</span>						<span class="_week_day_workout">Legs and Abs</span>						</a>
					</div>
				</div>
				<div class="_week_day col-md-6 col-sm-6 col-xs-12 _week_monday">
					<div class="_week_day_inner">						<a href="#">
						<span class="_week_day_title">Friday</span>
						<span class="_week_day_workout">Recovery</span>						</a>
					</div>
				</div>
				<div class="_week_day col-md-6 col-sm-6 col-xs-12 _week_monday">
					<div class="_week_day_inner">						<a href="#">
						<span class="_week_day_title">Saturday</span>
						<span class="_week_day_workout">Rest Day</span>						</a>
					</div>
				</div>
				<div class="_week_day col-md-6 col-sm-6 col-xs-12 _week_monday">
					<div class="_week_day_inner">						<a href="#">
						<span class="_week_day_title">Sunday</span>
						<span class="_week_day_workout">Chest and Tricep</span>						</a>
					</div>
				</div>
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