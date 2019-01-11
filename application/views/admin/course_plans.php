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
                           <form class="form-horizontal" method="post" id="Addform" action="<?= base_url();?>admin/CoursePlans/AddRecord" enctype="multipart/form-data">
                              <input type="hidden" name="course_id" value="<?= $course_id ?>">
                              <input type="hidden" name="week_id" value="<?= $week_id ?>">
                              <div class="col-md-6">
                                 <label class="control-label" for="example-text-input">Plan Title</label>
                                 <div class="form-group">
                                    <input type="text" name="title" value="" placeholder="Enter Plan Title" class="form-control">
                                 </div>
                              </div> 
                              <div class="col-md-6">
                                 <label class="control-label" for="example-text-input">Day No.</label>
                                 <div class="form-group">
                                    <input type="number" step="1" min="1" max="7" name="day_no" value="" placeholder="Enter Day Number" class="form-control">
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <label class="control-label" for="example-text-input">Plan Video</label>
                                 <div class="form-group">
                                    <input type="file" name="video" class="form-control" accept="video/mp4">
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
               <form method="post" id="tblform" action="<?= base_url();?>admin/CoursePlans/DeleteRecord">
                  <table id="datatable-buttons" class="table table-striped table-bordered">
                     <thead>
                        <tr>
                           <th align="center"><input type="checkbox" name="chkAll" class="checkUncheckAll" ></th>
                           <th>Title</th>
                           <th>Day No.</th>
                           <th>Video</th>
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
                           <td><?= $rec['title']?></td>
						         <td><?= $rec['day_no']?></td>
                           <td><video width="320" height="240" controls autoplay muted>
                             <source src="<?= base_url()?>assets/front/uploads/courses/courseplans/<?= $rec['video']?>" type="video/mp4">
                             Sorry, your browser doesn't support the video element.
                           </video>
                           </td>
                           <td>
                              <div class="form-group">
                                 <label>
                                 <input type="checkbox" class="js-switch"  <?= ($rec['status']==1) ? 'checked' : '' ?> onclick="togglestatus(<?= $rec['id'] ?>,'CoursePlans')" />
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
                              <a class="btn btn-warning btn-edit" data-toggle="modal" data-target="#ModalEdit" <?= 'data-id="'.$rec['id'].'" data-title= "'.$rec['title'].'"data-dayno= "'.$rec['day_no'].'" data-video= "'.$rec['video'].'"'; ?>>
                                 <i class="fa fa-edit"></i></a>
                              <a class="btn btn-danger" onclick="doDelete(<?= $rec['id']; ?>)"><i class="fa fa-trash"></i></a>
                              <a class="btn btn-primary btn-feat" data-toggle="modal" title="Plan Sets/Reps" data-id="<?= $rec['id']?>" data-target="#ModalSets">
                                 <i class="fa fa-align-center"></i></a>
                             
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
                  <form class="form-horizontal" method="post" id="Editform" action="<?= base_url();?>admin/CoursePlans/EditRecord"  enctype="multipart/form-data" >
                   <input type="hidden" name="week_id" value="<?= $week_id ?>">
                   <input type="hidden" name="id" id="id" required>
                     <div class="form-group">
                        <div class="col-md-7">
                          <label class="control-label">Plan Title</label>
                          <input type="text" name="title" id="title" class="form-control" >
                        </div> 
                     </div> 
                     <div class="form-group">
         					<div class="col-md-7">
         					  <label class="control-label">Day No</label>
         					  <input type="number" min="1" max="7" name="day_no" id="day_no" class="form-control" >
                        </div> 
					      </div> 
                      <div class="form-group">
      						<div class="col-md-7">
      							<label class="control-label">Video </label>
      							<input type="file"  name="video" accept="video/mp4" class="form-control" >
                        </div>
                           <video width="320" height="240" controls >
                             <source  id="video" src="http://localhost/90days/assets/front/uploads/courses/courseplans/28-courseplan.mp4" type="video/mp4">
                             Sorry, your browser doesn't support the video element.
                           </video>
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
        <!-- Sets modal -->
      <div class="modal fade bs-example-modal-lg" id="ModalSets" tabindex="-1" role="dialog" aria-hidden="true">
         <div class="modal-dialog">
            <div class="modal-content">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                  </button>
                  <h4 class="modal-title" id="myModalLabel"><?= $parent[0]['title']." ".$title;?> |<small>Set/Reps</small></h4>
               </div>
               <div class="modal-body">
                  <div id="msgm"></div>
              <div id="single-row"></div>
              <div class="col-md-12">
                <input type="hidden" id="plan_id" name="plan_id">
                <button type="button" onclick="addSetRow()" class="btn btn-default" style="margin-left: 10px;"><i class="fa fa-plus"></i> Add More</button>
              </div>
              <div class="clearfix"></div>
               </div>
            </div>
         </div>
      </div>
      <!-- Edit Set modal -->
     
   </div>
</div>
<script type="text/javascript">        
   $(document).ready(function(){
      $("#Addform").validate({
      rules: {
           title: {
      required: true
    },
        video: {
            required: true,
            accept: "video/mp4"
        }
  }
      });
      $("#Editform").validate({
       rules: {
           title: {
      required: true
    },
       video: {
            accept: "video/mp4"
        }
  }
      });
   });

 


   $(document).on("click",".btn-edit",function() {
      $("#id").val($(this).data("id"));
		$("#title").val($(this).data("title"));
		$("#day_no").val($(this).data("dayno"));
		$("#video").attr("src","<?=base_url();?>assets/front/uploads/courses/courseplans/"+$(this).data("video"));
		
	});
	
	$(".btn-feat").click(function(){
      $('#single-row').empty();
      var plan_id=$(this).data("id");
      $("#plan_id").val(plan_id);
      addSetRow(plan_id);
   });
  
    function addSetRow(planid){

      $.ajax({
         type: "POST",
         url: '<?=base_url()?>admin/courseplans/addSetRow',
         data: {plan_id:planid},
         success: function (data) {
            $('#single-row').append(data);
           
         },
         error: function (xhr, textStatus, errorThrown){
            alert(xhr.responseText);
         }
      });
   }
   
      $(document).on('click','.btn-ins-set',function(){
      var reps = $(this).parent().parent().find('.reps').val();
      var sets = $(this).parent().parent().find('input').val();
      var plan_id = $("#plan_id").val();
      var id= $(this).data("id");
      if(sets !== "" && reps !== ""){
         $.ajax({
            type: 'post',
            data: {'sets':sets,'reps':reps,'plan_id':plan_id,'id':id},
            url: '<?=base_url()?>admin/courseplans/saveSet',
            dataType: 'json',
            success: function (res) {
               $('#msgm').html("<div class='alert alert-success fade in'><a href='#' class='close' data-dismiss='alert'>×</a><strong>Set Saved</strong></div>");
               $("#msgm").show();
               setTimeout(function(){$("#msgm").hide(); }, 1000);
            },
            error: function (res) {
               $('#msgm').html("<div class='alert alert-danger fade in'><a href='#' class='close' data-dismiss='alert'>×</a><strong>Error ! Saving Set</strong></div>");
               $("#msgm").show();
               setTimeout(function(){$("#msgm").hide(); }, 1000);
            }
         });
      }
   });
      $(document).on('click','.btn-del-set',function(){
      var id= $(this).data("id");
      var maindiv=$(this).parent().parent();
      if(id==0){
         $(this).parent().parent().remove();
      }
      else{
         $.ajax({
            type: 'post',
            data: {'id':id},
            url: '<?=base_url()?>admin/courseplans/delSet',
            dataType: 'json',
            success: function (res) {
               $('#msgm').html("<div class='alert alert-success fade in'><a href='#' class='close' data-dismiss='alert'>×</a><strong>Set Deleted</strong></div>");
               $("#msgm").show();
               setTimeout(function(){$("#msgm").hide(); }, 1000);
               maindiv.remove();
            },
            error: function (res) {
               $('#msgm').html("<div class='alert alert-danger fade in'><a href='#' class='close' data-dismiss='alert'>×</a><strong>Error ! Deleting Set</strong></div>");
               $("#msgm").show();
               setTimeout(function(){$("#msgm").hide(); }, 1000);
            }
         });
      }
   });
</script>