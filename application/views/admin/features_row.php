<?php
if(isset($features) &&  !empty($features)){
	foreach($features as $feature){
	?>
	<div class="col-md-12">
	 <div class="col-md-5">
		<div class="form-group">
		   <label class="control-label">Icon: </label>
		   <select name="icon" class="search-select form-control">
			  <option value="">[Not Selected]</option>
			  <?php
				 foreach($icons AS $icon){
					echo '<option value="'.$icon['title'].'" '.($feature['icon']==$icon['title'] ? "selected" : "").'>'.$icon['title'].'</option>';
				 }
			   ?>
		   </select>
		</div>
	 </div>
	 <div class="col-md-5">
		<div class="form-group">
		   <label class="control-label">Feature: </label>
		   <input type="text" name="feature" value="<?= $feature['title']; ?>" placeholder="Enter Feature Title" class="form-control" >
		 </div>
	 </div>
	 <div class="col-md-2">
		<a class="btn-ins" data-id="<?= $feature['id']; ?>"><i class="fa fa-check"></i></a>
		<a class="btn-del" data-id="<?= $feature['id']; ?>"><i class="fa fa-times"></i></a>
	 </div>
	</div>
	<?php
	}
}
else{
	?>
	<div class="col-md-12">
	 <div class="col-md-5">
		<div class="form-group">
		   <label class="control-label">Icon: </label>
		   <select name="icon" class="search-select form-control">
			  <option value="">[Not Selected]</option>
			  <?php
				 foreach($icons AS $icon){
					echo '<option value="'.$icon['title'].'" '.($ico==$icon['title'] ? "selected" : "").'>'.$icon['title'].'</option>';
				 }
			   ?>
		   </select>
		</div>
	 </div>
	 <div class="col-md-5">
		<div class="form-group">
		   <label class="control-label">Feature: </label>
		   <input type="text" name="feature" value="" placeholder="Enter Feature Title" class="form-control" >
		 </div>
	 </div>
	 <div class="col-md-2">
		<a class="btn-ins" data-id="0"><i class="fa fa-check"></i></a>
		<a class="btn-del" data-id="0"><i class="fa fa-times"></i></a>
	 </div>
	</div>
<?php
}
?>