<div class="">
   <div class="page-title">
      <div class="title_left">
         <h3>Manage <?= $parent[0]['title']." ".$title;?></h3>
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
                        <h2><i class="fa fa-align-left"></i> <?= $parent[0]['title']." ".$title;?> | <small>Add New</small></h2>
                     </a>
                     <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                        <div class="panel-body">
                           <form class="form-horizontal" method="post" id="Addform" action="<?= base_url();?>admin/Courses/AddRecord">
                              <div class="col-md-6">
                                 <label class="control-label" for="example-text-input">Course Name</label>
                                 <div class="form-group">
                                    <input type="hidden" name="parent_id" value="<?= $parent[0]['id']; ?>">
                                    <input type="text" name="title" value="" placeholder="Enter Course Name" class="form-control">
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <label class="control-label" for="example-text-input">Price</label>
                                 <div class="form-group">
                                    <input type="number" step="any" min="0" name="price" value="" placeholder="Enter Price" class="form-control">
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <label class="control-label" for="example-text-input">Cover Image</label>
                                 <div class="form-group">
                                    <input type="file" name="image" class="form-control" accept="image/*">
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <label class="control-label" for="example-text-input">Banner Image</label>
                                 <div class="form-group">
                                    <input type="file" name="banner_image" class="form-control" accept="image/*">
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <label class="control-label" for="example-text-input">Demo Image (GIF)</label>
                                 <div class="form-group">
                                    <input type="file" name="demo_gif" class="form-control" accept="image/*">
                                 </div>
                              </div>
                              <div class="col-md-9">
                                 <label class="control-label" for="example-text-input">Marketing Text</label>
                                 <div class="form-group">
                                  
                                    <input type="text" name="short_text" class="form-control"><br/>
									<input type="submit" id="addSubmit" value="Submit" class="btn btn-default margin pull-right" >
                                 </div>
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
               <h2><?= $parent[0]['title']." ".$title;?> |<small>View</small></h2>
               <?php  if(count($records) > 0 ) { ?>
               <button type="button" class="btn btn-danger margin pull-right" onClick="doDelete()" style="margin-right:auto" >Delete</button>
               <?php } ?>
               <div class="clearfix"></div>
            </div>
            <div class="x_content">
               <form method="post" id="tblform" action="<?= base_url();?>admin/Courses/DeleteRecord">
                  <table id="datatable-buttons" class="table table-striped table-bordered">
                     <thead>
                        <tr>
                           <th align="center"><input type="checkbox" name="chkAll" class="checkUncheckAll" ></th>
                           <th>Course</th>
                           <th>Price</th>
                           <th>Marketing Text</th>
                           <th>Cover</th>
                           <th>Banner</th>
                           <th>Demo</th>
                           <th>Status</th>
                           <th>Date Added</th>
                           <th>Date Modified</th>
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
						   <td><?= $rec['title']; ?></td>
						   <td>$<?= $rec['price']; ?></td>
						   <td><?= $rec['short_text']; ?></td>
                           <td><img src="<?=base_url();?>assets/front/uploads/courses/<?= ($rec['image'] != "" ? $rec['image'] : "dummy.png"); ?>"  style="max-height:30px;" /></td><td><img src="<?=base_url();?>assets/front/uploads/courses/<?= ($rec['banner_image'] != "" ? $rec['banner_image'] : "dummy.png"); ?>"  style="max-height:30px;" /></td>
                           <td><img src="<?=base_url();?>assets/front/uploads/courses/<?= ($rec['demo_gif'] != "" ? $rec['demo_gif'] : "dummy.png"); ?>"  style="max-height:30px;" /></td>
                           <td>
                              <div class="form-group">
                                 <label>
                                 <input type="checkbox" class="js-switch"  <?= ($rec['status']==1) ? 'checked' : '' ?> onclick="togglestatus(<?= $rec['id'] ?>,'courses')" />
                                 </label>
                              </div>
                           </td>
                           <td>
                              <span style="font-size:0"><?= $rec['created_at']; ?></span>
                              <?= date('jS M Y ', strtotime($rec['created_at'])); ?>
                           </td>
                           <td>
                              <span style="font-size:0"><?= $rec['updated_at']; ?></span>
                              <?= ($rec['updated_at'] == "" ? "" : date('jS M Y', strtotime($rec['updated_at']))); ?>
                           </td>
                           <td>
                              <a class="btn btn-warning btn-edit" data-toggle="modal" data-target="#ModalEdit" <?= 'data-id="'.$rec['id'].'" data-title="'.$rec['title'].'" data-price="'.$rec['price'].'" data-stext="'.$rec['short_text'].'" data-img="'.$rec['image'].'" data-bimg="'.$rec['banner_image'].'" data-dimg= "'.$rec['demo_gif'].'"'; ?>><i class="fa fa-edit"></i></a>
                              <a class="btn btn-info btn-feat" data-toggle="modal" data-target="#ModalFeat"  title="Add Feature/Icon" data-id="<?= $rec['id']; ?>"><i class="fa fa-list"></i></a>
                              <a class="btn btn-danger" onclick="doDelete(<?= $rec['id']; ?>)"><i class="fa fa-trash"></i></a>
                              <a class="btn btn-primary btn-feat" title="Before/After Images" href="<?=base_url()?>admin/courseimages/<?= $rec['id']; ?>"><i class="fa fa-anchor"></i></a>
                                 <a class="btn btn-dark btn-feat" title="Course Weeks" href="<?=base_url()?>admin/courseweeks/<?= $rec['id']; ?>"><i class="fa fa-calendar"></i></a>
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
      <!-- Edit modal -->
      <div class="modal fade bs-example-modal-lg" id="ModalEdit" tabindex="-1" role="dialog" aria-hidden="true">
         <div class="modal-dialog">
            <div class="modal-content">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                  </button>
                  <h4 class="modal-title" id="myModalLabel"><?= $parent[0]['title']." ".$title;?> |<small>Edit</small></h4>
               </div>
               <div class="modal-body">
                  <div id="msge"></div>
                  <form class="form-horizontal" method="post" id="Editform" action="<?= base_url();?>admin/Courses/EditRecord">
                     <div class="form-group col-md-12">
                        <label class="control-label">Course Name</label>
						<input type="hidden" name="parent_id" value="<?= $parent[0]['id']; ?>">
						<input type="text" name="title" id="title" placeholder="Enter Course Name" class="form-control">
                        <input type="hidden" name="id" id="id" required>
                     </div>
                     <div class="form-group col-md-12">
						<label class="control-label">Price</label>
						<input type="number" step="any" min="0" id="price" name="price" placeholder="Enter Price" class="form-control">
                     </div>
                     <div class="form-group col-md-12">
						<label class="control-label">Marketing Text</label>
						
                   <input type="text" name="short_text" id="stext" class="form-control">
                     </div>
                     <div class="form-group">
						<div class="col-md-7">
                     <label class="control-label">Cover Image</label>
                     <input type="file" name="image" id="image" class="form-control" >
                  </div>
                  <img id="show_img" style="width: 150px; margin-top: 10px;"/>
                  <div class="col-md-7">
							<label class="control-label">Banner Image</label>
							<input type="file" name="banner_image" id="banner_image" class="form-control" >
						</div>
						<div class="col-md-5">
							<img id="show_banner_image" style="width: 150px; margin-top: 10px;"/>
						</div>
                     </div>
                     <div class="form-group">
						<div class="col-md-7">
							<label class="control-label">Demo GIF</label>
							<input type="file" name="demo_gif" id="demo" class="form-control" >
						</div>
						<div class="col-md-5">
							<img id="show_demo_gif" style="width: 150px; margin-top: 10px;"/>
						</div>
                     </div>
               </div>
               <div class="modal-footer">
               <input type="submit" value="Submit" class="btn btn-warning" >
               <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
               </form>
               </div>
            </div>
         </div>
      </div>
      <!-- Edit modal -->
      <!-- Fea modal -->
      <div class="modal fade bs-example-modal-lg" id="ModalFeat" tabindex="-1" role="dialog" aria-hidden="true">
         <div class="modal-dialog">
            <div class="modal-content">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                  </button>
                  <h4 class="modal-title" id="myModalLabel"><?= $parent[0]['title']." ".$title;?> |<small>Features</small></h4>
               </div>
               <div class="modal-body">
                  <div id="msgm"></div>
				  <div id="single-row"></div>
				  <div class="col-md-12">
					 <input type="hidden" id="course_id" name="course_id">
					 <button type="button" onclick="addFeatureRow()" class="btn btn-default" style="margin-left: 10px;"><i class="fa fa-plus"></i> Add More</button>
				  </div>
				  <div class="clearfix"></div>
               </div>
            </div>
         </div>
      </div>
      <!-- Edit modal -->
   </div>
</div>
<script type="text/javascript">        
   $(document).ready(function(){
   	$("#Addform").validate({
		rules: {
   		  title: "required",
           short_text: {
            required: true,
            maxlength: 35
            },
		     image: {
         extension: "png|jpeg|jpg"
        },
        banner_image: {
			extension: "png|jpeg|jpg"
		  }
   		},
		messages: {
		  image: {
         extension: "Only PNG, JPG and JPEG files are allowed."
        },
        banner_image: {
			extension: "Only PNG, JPG and JPEG files are allowed."
		  }
		}
   	});
   	$("#Editform").validate({
		rules: {
   		  title: "required",
            short_text: {
            required: true,
            maxlength: 35
            },
		  image: {
         extension: "png|jpeg|jpg"
        },
        banner_image: {
			extension: "png|jpeg|jpg"
		  }
   		},
		messages: {
		  image: {
         extension: "Only PNG, JPG and JPEG files are allowed."
        },
        banner_image: {
			extension: "Only PNG, JPG and JPEG files are allowed."
		  }
		}
   	});
   });
   
   // $(".btn-edit").click(function(){
	$(document).on("click",".btn-edit",function() { 
		$("#id").val($(this).data("id"));
		$("#title").val($(this).data("title"));
		$("#price").val($(this).data("price"));
		$("#stext").val($(this).data("stext"));
		$("#show_img").attr("src","<?=base_url();?>assets/front/uploads/courses/"+$(this).data("img"));
		$("#show_demo_gif").attr("src","<?=base_url();?>assets/front/uploads/courses/"+$(this).data("dimg"));
      $("#show_banner_image").attr("src","<?=base_url();?>assets/front/uploads/courses/"+$(this).data("bimg"));
	});
	
	$(".btn-feat").click(function(){
		$('#single-row').empty();
		var course_id=$(this).data("id");
		$("#course_id").val(course_id);
		addFeatureRow(course_id);
	});
	
	function addFeatureRow(course_id){
		$.ajax({
			type: "POST",
			url: 'courses/addFeatureRow',
			data: {course_id:course_id},
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
	
	$(document).on('click','.btn-ins',function(){
		var icon = $(this).parent().parent().find('select').val();
		var feature = $(this).parent().parent().find('input').val();
		var course_id = $("#course_id").val();
		var id= $(this).data("id");
		if(icon !== "" && feature !== ""){
			$.ajax({
				type: 'post',
				data: {'icon':icon,'title':feature,'course_id':course_id,'id':id},
				url: 'courses/saveFeature',
				dataType: 'json',
				success: function (res) {
					$('#msgm').html("<div class='alert alert-success fade in'><a href='#' class='close' data-dismiss='alert'>×</a><strong>Feature Saved</strong></div>");
					$("#msgm").show();
					setTimeout(function(){$("#msgm").hide(); }, 1000);
				},
				error: function (res) {
					$('#msgm').html("<div class='alert alert-danger fade in'><a href='#' class='close' data-dismiss='alert'>×</a><strong>Error ! Saving Feature</strong></div>");
					$("#msgm").show();
					setTimeout(function(){$("#msgm").hide(); }, 1000);
				}
			});
		}
	});
	
	$(document).on('click','.btn-del',function(){
		var id= $(this).data("id");
		var maindiv=$(this).parent().parent();
		if(id==0){
			$(this).parent().parent().remove();
		}
		else{
			$.ajax({
				type: 'post',
				data: {'id':id},
				url: 'courses/delFeature',
				dataType: 'json',
				success: function (res) {
					$('#msgm').html("<div class='alert alert-success fade in'><a href='#' class='close' data-dismiss='alert'>×</a><strong>Feature Deleted</strong></div>");
					$("#msgm").show();
					setTimeout(function(){$("#msgm").hide(); }, 1000);
					maindiv.remove();
				},
				error: function (res) {
					$('#msgm').html("<div class='alert alert-danger fade in'><a href='#' class='close' data-dismiss='alert'>×</a><strong>Error ! Deleting Feature</strong></div>");
					$("#msgm").show();
					setTimeout(function(){$("#msgm").hide(); }, 1000);
				}
			});
		}
	});
	
</script>