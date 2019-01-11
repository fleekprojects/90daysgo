<?php

if(isset($plan_sets) &&  !empty($plan_sets)){
	foreach($plan_sets as $plan_set){
	?>
	<div class="col-md-12">
	 <div class="col-md-4">
		<div class="form-group">
		   <label class="control-label">Sets: </label>
		   <input type="number" step="any" value="<?=$plan_set['sets']?>" min="0" max="20" name="sets">
		</div>
	 </div>
	 <div class="col-md-4">
		<div class="form-group">
		   <label class="control-label">Reps: </label>
		    <input type="number"  step="any" value="<?=$plan_set['reps']?>" min="0" max="1000" class="reps" name="reps">
		 </div>
	 </div>
	 <div class="col-md-2">
		<a class="btn-ins-set" data-id="<?= $plan_set['id']; ?>"><i class="fa fa-check"></i></a>
		<a class="btn-del-set" data-id="<?= $plan_set['id']; ?>"><i class="fa fa-times"></i></a>
		
	 </div>
	</div>
	<?php
	}
}
else{
	?>
	<div class="col-md-12">
	 <div class="col-md-4">
		<div class="form-group">
		   <label class="control-label">Sets: </label>
		   <input type="number" step="any"  min="0" max="20" name="sets">
		</div>
	 </div>
	 <div class="col-md-4">
		<div class="form-group">
		   <label class="control-label">Reps: </label>
		      <input type="number"  step="any"  min="0" max="1000" name="reps" class="reps">
		 </div>
	 </div>
	 <div class="col-md-2">
		<a class="btn-ins-set" data-id="0"><i class="fa fa-check"></i></a>
		<a class="btn-del-set" data-id="0"><i class="fa fa-times"></i></a>
	 </div>
	</div>
<?php
}
?>