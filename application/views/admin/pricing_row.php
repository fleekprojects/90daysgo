<?php
if(isset($pricing) &&  !empty($pricing)){
	$pid=$pricing[0]['id'];
	$model='<select name="model_id" id="model-'.$pid.'" class="form-control">';
		 foreach($models AS $mod){
			$model .= '<option value="'.$mod['id'].'" '.($pricing[0]['model_id']==$mod['id'] ? "selected" : "").'>'.$mod['title'].'</option>';
		 }
	$model .= '</select>';
	
	$provider='<select name="provider_id" id="provider-'.$pid.'" class="form-control">';
		 foreach($providers AS $pro){
			$provider .= '<option value="'.$pro['id'].'" '.($pricing[0]['provider_id']==$pro['id'] ? "selected" : "").'>'.$pro['title'].'</option>';
		 }
	$provider .= '</select>';
	
	$storage='<select name="storage_id" id="storage-'.$pid.'" class="form-control">';
		 foreach($storages AS $sto){
			$storage .= '<option value="'.$sto['id'].'" '.($pricing[0]['storage_id']==$sto['id'] ? "selected" : "").'>'.$sto['title'].'</option>';
		 }
	$storage .= '</select>';
	
	$condition='<select name="condition_id" id="condition-'.$pid.'" class="form-control">';
		 foreach($conditions AS $con){
			$condition .= '<option value="'.$con['id'].'" '.($pricing[0]['condition_id']==$con['id'] ? "selected" : "").'>'.$con['title'].'</option>';
		 }
	$condition .= '</select>';
	
	$price='<input type="number" name="price" id="price-'.$pid.'" value="'.$pricing[0]['price'].'" placeholder="Enter Price" min="1" step="any" class="form-control" style="max-width: 100px;">';
	
	
	echo json_encode(array(
		'model'=>$model,
		'provider'=>$provider,
		'storage'=>$storage,
		'condition'=>$condition,
		'price'=>$price,
	));
}
else{
	?>
	<div class="col-md-12">
	 <input type="hidden" name="category_id[]" value="<?= $cid; ?>">
	 <div class="col-md-4">
		<div class="form-group">
		   <label class="control-label">Model: </label>
		   <select name="model_id[]" class="search-select form-control">
			  <option value="">[Not Selected]</option>
			  <?php
				 foreach($models AS $mod){
					echo '<option value="'.$mod['id'].'" '.($mid==$mod['id'] ? "selected" : "").'>'.$mod['title'].'</option>';
				 }
			   ?>
		   </select>
		</div>
	 </div>
	 <div class="col-md-2">
		<div class="form-group">
		   <label class="control-label">Provider: </label>
		   <select name="provider_id[]" class="form-control">
			  <option value="">[Not Selected]</option>
			  <?php
				 foreach($providers AS $pro){
					echo '<option value="'.$pro['id'].'" '.($pid==$pro['id'] ? "selected" : "").'>'.$pro['title'].'</option>';
				 }
				 ?>
		   </select>
		</div>
	 </div>
	 <div class="col-md-2">
		<div class="form-group">
		   <label class="control-label">Storage: </label>
		   <select name="storage_id[]" class="form-control">
			  <option value="">[Not Selected]</option>
			  <?php
				 foreach($storage AS $sto){
					echo '<option value="'.$sto['id'].'" '.($sid==$sto['id'] ? "selected" : "").'>'.$sto['title'].'</option>';
				 }
				 ?>
		   </select>
		</div>
	 </div>
	 <div class="col-md-2">
		<div class="form-group">
		   <label class="control-label">Condition: </label>
		   <select name="condition_id[]" class="form-control">
			  <option value="">[Not Selected]</option>
			  <?php
				 foreach($condition AS $con){
					echo '<option value="'.$con['id'].'" '.($coid==$con['id'] ? "selected" : "").'>'.$con['title'].'</option>';
				 }
				 ?>
		   </select>
		</div>
	 </div>
	 <div class="col-md-2">
		<div class="form-group">
		   <label class="control-label">Price: </label>
		   <input type="number" name="price[]" value="" placeholder="Enter Price" min="1" step="any" class="form-control">
		</div>
	 </div>
	</div>
<?php
}
?>