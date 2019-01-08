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
                           <form class="form-horizontal" method="post" id="Addform" action="<?= base_url();?>admin/CourseImage/AddRecord" enctype="multipart/form-data">
                              <input type="hidden" name="course_id" value="<?= $course_id ?>">
                              <div class="col-md-6">
                                 <label class="control-label" for="example-text-input">Before Image</label>
                                 <div class="form-group">
                                    <input type="file"  name="beforeimg" class="form-control" accept="image/*" required="">
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <label class="control-label" for="example-text-input">After Image</label>
                                 <div class="form-group">
                                    <input type="file"  name="afterimg" class="form-control" accept="image/*" required="">
                                 </div>
                              </div>
                              <div class="col-md-12">
                               
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
               <form method="post" id="tblform" action="<?= base_url();?>admin/CourseImage/DeleteRecord">
                  <table id="datatable-buttons" class="table table-striped table-bordered">
                     <thead>
                        <tr>
                           <th align="center"><input type="checkbox" name="chkAll" class="checkUncheckAll" ></th>
                           <th>Before Image</th>
                           <th>After Image</th>
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
                           <td><img src="<?=base_url();?>assets/front/uploads/courses/courseimages/<?= ($rec['before_image'] != "" ? $rec['before_image'] : "dummy.png"); ?>"  style="max-height:30px;" /></td>
                           <td><img src="<?=base_url();?>assets/front/uploads/courses/courseimages/<?= ($rec['after_image'] != "" ? $rec['after_image'] : "dummy.png"); ?>"  style="max-height:30px;" /></td>
                           <td>
                              <div class="form-group">
                                 <label>
                                 <input type="checkbox" class="js-switch"  <?= ($rec['status']==1) ? 'checked' : '' ?> onclick="togglestatus(<?= $rec['id'] ?>,'CourseImage')" />
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
                              <a class="btn btn-warning btn-edit" data-toggle="modal" data-target="#ModalEdit" <?= 'data-id="'.$rec['id'].'"    data-beforeimg="'.$rec['before_image'].'" data-afterimg= "'.$rec['after_image'].'"'; ?>><i class="fa fa-edit"></i></a>
                              <a class="btn btn-danger" onclick="doDelete(<?= $rec['id']; ?>)"><i class="fa fa-trash"></i></a>
                             
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
                  <form class="form-horizontal" method="post" id="Editform" action="<?= base_url();?>admin/CourseImage/EditRecord"  enctype="multipart/form-data" >
                   <input type="hidden" name="id" id="id" required>
                     <div class="form-group">
						<div class="col-md-7">
							<label class="control-label">Before Image</label>
							<input type="file" name="before_image" id="before" class="form-control" >
						</div>
						<div class="col-md-5">
							<img id="before_image" style="width: 150px; margin-top: 10px;"/>
						</div>
                     </div>
                     <div class="form-group">
						<div class="col-md-7">
							<label class="control-label">After Image</label>
							<input type="file" name="after_image" id="after" class="form-control" >
						</div>
						<div class="col-md-5">
							<img id="after_image" style="width: 150px; margin-top: 10px;"/>
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
     
   </div>
</div>
<script type="text/javascript">        
   $(document).ready(function(){
   	$("#Addform").validate({
		rules: {
		  beforeimg: { 
         extension: "png|jpeg|jpg"
        }, 
        afterimg: {
			extension: "png|jpeg|jpg"
		  }
   		},
		messages: {
		  beforeimg: {
         extension: "Only PNG, JPG and JPEG files are allowed."
        },
         afterimg: {
			extension: "Only PNG, JPG and JPEG files are allowed."
		  }
		}
   	});
   	$("#Editform").validate({
		rules: {
   		  afterimg: "required",
		  afterimg: {
			extension: "png|jpeg|jpg"
		  }
   		},
		messages: {
		  afterimg: {
			afterimg: "Only PNG, JPG and JPEG files are allowed."
		  }
		}
   	});
   });
   
   $(".btn-edit").click(function(){
		$("#id").val($(this).data("id"));
		$("#before_image").attr("src","<?=base_url();?>assets/front/uploads/courses/courseimages/"+$(this).data("beforeimg"));
		$("#after_image").attr("src","<?=base_url();?>assets/front/uploads/courses/courseimages/"+$(this).data("afterimg"));
	});
	
	$(".btn-feat").click(function(){
		$("#course_image_id").val($(this).data("id"));
	});
  
   
</script>