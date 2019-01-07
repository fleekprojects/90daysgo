<div class="">
   <div class="page-title">
      <div class="title_left">
         <h3>Manage <?= $category[0]['title']." ".$title;?></h3>
      </div>
   </div>
   <hr noshade>
   <div class="clearfix"></div>
   <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
         <div class="x_panel">
            <div class="x_content">
               <div id="msg"><?php  if($this->session->flashdata('message')){
                  echo $this->session->flashdata('message');
                  }  
                   ?>
               </div>
               <!-- start accordion -->
               <div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
                  <div class="panel">
                     <a class="panel-heading" role="tab" id="headingOne" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <h2><i class="fa fa-align-left"></i> <?= $category[0]['title']." ".$title;?> | <small>Add New</small></h2>
                     </a>
                     <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                        <div class="panel-body">
                           <form class="form-horizontal" method="post" action="<?= base_url();?>admin/Pricing/AddRecord" id="Addform2" >
                              <div id="single-row"></div>
                              <div class="col-md-12">
                                 <button type="button" onclick="addPricingRow()" class="btn btn-default" style="margin-left: 10px;"><i class="fa fa-plus"></i> Add More</button>
                                 <button type="button" onclick="copyPricingRow()" class="btn btn-default" style="margin-left: 10px;"><i class="fa fa-copy"></i> Copy</button>
                                 <button type="submit" id="addSubmit2" class="btn btn-warning pull-right margin"><i class="fa fa-check"></i> Save</button>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- end of accordion -->
            </div>
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
         <div class="x_panel">
            <div class="x_title">
               <h2><?= $category[0]['title']." ".$title;?> |<small>View</small></h2>
               <?php  if(count($records) > 0 ) { ?>
               <button type="button" class="btn btn-danger margin pull-right" onClick="doDelete()" style="margin-right:auto" >Delete</button>
               <?php } ?>
			   <button type="button" class="btn btn-warning margin pull-right" data-toggle="modal" data-target="#ModalAdd"><i class="fa fa-plus"></i>Add New Model</button>
               <div class="clearfix"></div>
            </div>
            <div class="x_content">
				<div id="msge"></div>
               <form method="post" id="tblform" action="<?= base_url();?>admin/Pricing/DeleteRecord">
                  <table id="datatable-buttons" class="table table-striped table-bordered">
                     <thead>
                        <tr>
                           <th align="center"><input type="checkbox" name="chkAll" class="checkUncheckAll" ></th>
                           <th>Model</th>
                           <th>Provider</th>
                           <th>Storage</th>
                           <th>Condition</th>
                           <th>Price</th>
                           <th>Status</th>
                           <th>Last Updated</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php
                           foreach($records AS $rec){
                            ?>
                        <tr>
                           <td align="center">
                              <input class="chkIds" type="checkbox" name="ids[]" id="chk-<?= $rec['id'] ?>" value="<?= $rec['id'] ?>"  />
                           </td>
                           <td id="mod-<?= $rec['id']; ?>"><?= $rec['model_title']; ?></td>
                           <td id="pro-<?= $rec['id']; ?>"><?= $rec['provider_title']; ?></td>
                           <td id="sto-<?= $rec['id']; ?>"><?= $rec['storage_title']; ?></td>
                           <td id="con-<?= $rec['id']; ?>"><?= $rec['condition_title']; ?></td>
                           <td id="pri-<?= $rec['id']; ?>">$<?= $rec['price']; ?></td>
                           <td>
                              <div class="form-group">
                                 <label>
                                 <input type="checkbox" class="js-switch"  <?= ($rec['status']==1) ? 'checked' : '' ?> onclick="togglestatus(<?= $rec['id'] ?>,'Pricing')" />
                                 </label>
                              </div>
                           </td>
                           <td>
                              <span style="font-size:0"><?= $rec['updated_at']; ?></span>
                              <?= ($rec['updated_at'] == "" ? date('jS M Y ', strtotime($rec['created_at'])) : date('jS M Y', strtotime($rec['updated_at']))); ?>
                           </td>
                           <td>
                              <a class="btn btn-warning btn-edit btn-sm" href="javascript:;" onclick="get_tbl_form(<?= $rec['id']; ?>)" id="editpri-<?= $rec['id']; ?>"><i class="fa fa-edit"></i></a>
                              <a class="btn btn-success btn-edit btn-sm" href="javascript:;" onclick="save_tbl_form(<?= $rec['id']; ?>)" id="savepri-<?= $rec['id']; ?>" style="display:none"><i class="fa fa-check"></i></a>
                              <a class="btn btn-danger btn-sm" onclick="doDelete(<?= $rec['id']; ?>)"><i class="fa fa-trash"></i></a>
                           </td>
                        </tr>
                        <?php
                           }
                           ?>
                     </tbody>
                  </table>
               </form>
            </div>
         </div>
      </div>
   </div>
		 <!-- Add modal -->
		  <div class="modal fade bs-example-modal-lg" id="ModalAdd" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog">
			  <div class="modal-content">
				<div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
				  </button>
				  <h4 class="modal-title" id="myModalLabel"><?= $category[0]['title']." ".$title;?> |<small>Add</small></h4>
				</div>
				<div class="modal-body">
				  <div id="msge"></div>
				  <form class="form-horizontal" method="post" id="Addform" action="<?= base_url();?>admin/Models/AddRecord">
					<div class="form-group">
						<label class="control-label" for="example-text-input">Model Name</label>
						<input type="hidden" name="category_id" value="<?= $category[0]['id']; ?>" required>
						<input type="text" name="title" id="title" value="" placeholder="Enter Model Name" class="form-control">
					</div>
					<div class="form-group">
						<label class="control-label" for="example-text-input">Image</label>
						<input type="file" name="image" class="form-control">
					</div>
				</div>
				<div class="modal-footer">
				  <input type="submit" style="float:right;" id="addSubmit" value="Submit" class="btn btn-success" >
				  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				  </form>
				</div>
			  </div>
			</div>
		  </div>
		 <!-- Add modal -->
</div>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script> 
   $(document).ready(function(){
	 addPricingRow();
	 $("#Addform").validate({
		rules: {
   		  title: "required",
		  image: {
			extension: "png|jpeg|jpg"
		  }
   		},
		messages: {
		  image: {
			extension: "Only PNG, JPG and JPEG files are allowed."
		  }
		}
	 });
   });
   function addPricingRow(){
      $.ajax({
   	  type: "POST",
	  data: {"cat_id":<?= $category[0]['id']; ?>},
   	  url: 'pricing/addPricingRow',
   	  success: function (data) {
   		$('#single-row').append(data);
		$('select').select2({
			placeholder: "Please Select",
		});
   	  },
   	  error: function (xhr, textStatus, errorThrown){
   		alert(xhr.responseText);
   	  }
   	});
   }
   function copyPricingRow(){
	  var subarr = [];
	  $('#single-row').children().last().children().children().find('select').each(function(){
		subarr.push($(this).val());
	  });
	  $.ajax({
		type: "POST",
		data: {"cat_id":<?= $category[0]['id']; ?>,mid:subarr[0],pid:subarr[1],sid:subarr[2],coid:subarr[3]},
		url: 'pricing/addPricingRow',
		success: function (data) {
			$('#single-row').append(data);
			$('select').select2({
				placeholder: "Please Select",
			});
		},
		error: function (xhr, textStatus, errorThrown){
			alert(xhr.responseText);
		}
	  });
   }
   function get_tbl_form(id){
	  
      $.ajax({
   	  type: "POST",
	  data: {"cat_id":<?= $category[0]['id']; ?>,"id":id},
   	  url: 'pricing/editPricingRow',
   	  dataType: 'JSON',
   	  success: function (data) {
		  $("#editpri-"+id).hide();
		  $("#savepri-"+id).show();
		  $("#mod-"+id).html(data.model);
		  $("#pro-"+id).html(data.provider);
		  $("#sto-"+id).html(data.storage);
		  $("#con-"+id).html(data.condition);
		  $("#pri-"+id).html(data.price);
   	  },
   	  error: function (xhr, textStatus, errorThrown){
   		alert(xhr.responseText);
   	  }
   	});
   }
   function save_tbl_form(id){
	  var model=$("#model-"+id).val();
	  var provider=$("#provider-"+id).val();
	  var storage=$("#storage-"+id).val();
	  var condition=$("#condition-"+id).val();
	  var price=$("#price-"+id).val();
      $.ajax({
   	  type: "POST",
	  data: {"category_id":<?= $category[0]['id']; ?>,"model_id":model,"provider_id":provider,"storage_id":storage,"condition_id":condition,"price":price,"id":id},
   	  url: 'pricing/EditRecord',
   	  dataType: 'JSON',
   	  success: function (result) {
		  if(result.success==1){	
			$("#msge").html('<div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b> Record Updated!</b></div>');
			$("#msge").show();
			$("#editpri-"+id).show();
			$("#savepri-"+id).hide();
			$("#mod-"+id).text(result.data[0].model);
			$("#pro-"+id).text(result.data[0].provider);
			$("#sto-"+id).text(result.data[0].storage);
			$("#con-"+id).text(result.data[0].condition);
			$("#pri-"+id).text(result.data[0].price);
			
			setTimeout(function(){$("#msge").hide(); }, 1000);
		  }
		  else if(result==2){	
			$("#msge").html('<div class="alert alert-warning alert-dismissable"><i class="fa fa-warning"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b> Record Already Exists!</b></div>');
			$("#msge").show();
			setTimeout(function(){$("#msge").hide(); }, 1000);
		  }
		  else{
			$("#msge").html('<div class="alert alert-danger alert-dismissable"><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b> Error. Please Try Again!</b></div>');
			$("#msge").show();
			setTimeout(function(){$("#msge").hide(); }, 1000);

		  }
   	  },
   	  error: function (xhr, textStatus, errorThrown){
   		alert(xhr.responseText);
   	  }
   	});
   }

   $("#Addform2").submit(function(e) { 
		e.preventDefault(); // avoid to execute the actual submit of the form.
		// if ($('#Addform2').valid()) {
			var action =$('#Addform2').attr('action');
			var value =new FormData(this);
			$.ajax({
				url:action,
				type:'POST',
				data:value,
				processData: false,
                contentType: false,
				success:function(result){
					if(result==0){
						$("#msg").html('<div class="alert alert-danger alert-dismissable"><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">Ã—</button><b> Error. Please Try Again!</b></div>');
						$("#msg").show();
						setTimeout(function(){$("#msg").hide(); }, 1000);

					}
					else if(result==1){	
						$("#msg").html('<div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">Ã—</button><b> Record Inserted!</b></div>');
						$("#msg").show();
						setTimeout(function(){location.reload(); }, 1000);
					}
					else if(result==2){	
						$("#msg").html('<div class="alert alert-warning alert-dismissable"><i class="fa fa-warning"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">Ã—</button><b> Record Already Exists!</b></div>');
						$("#msg").show();
						setTimeout(function(){$("#msg").hide(); }, 1000);
					}
				},
				error: function (xhr, textStatus, errorThrown){
					alert(xhr.responseText);
				}
			});
		// }
	});
</script>