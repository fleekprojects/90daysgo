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
                                 <label class="control-label" for="example-text-input">Sets</label>
                                 <div class="form-group">
                                    <input type="number" step="any" min="0" name="sets" value="" placeholder="Enter Sets" class="form-control">
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <label class="control-label" for="example-text-input">Reps</label>
                                 <div class="form-group">
                                    <input type="number" step="any" min="0" name="reps" value="" placeholder="Enter Reps" class="form-control">
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
               <h2><?= $category[0]['title']." ".$title;?> |<small>View</small></h2>
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
                           <th>Video</th>
                           <th>Sets</th>
                           <th>Reps</th>
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
                           <?php 
                           
                           // $size = '100x100';
                           // $start = 1;
                           // $frames = 10;
                           
                           // $FFmpeg = new FFmpeg;                           

                           // // APPPATH . '../vendor/olaferlandsen/ffmpeg-php-class/src/FFmpeg.php'
                           // $FFmpeg->input( 'C:\xampp7.1\htdocs\90days\assets\front\uploads\courses\courseplans\16-courseplan.mp4')->hflip()->output( 'C:\xampp7.1\htdocs\90days\assets\front\uploads\courses\courseplans\18-courseplan.3gp' )->ready();
                           // print($FFmpeg->command);

                           ?>
                           <td><video width="320" height="240" controls autoplay muted>
                             <source src="<?= base_url()?>assets/front/uploads/courses/courseplans/<?= $rec['video']?>" type="video/mp4">
                             Sorry, your browser doesn't support the video element.
                           </video>
                           </td>
                           <td><?= $rec['sets']?></td>
                           <td><?= $rec['reps']?></td>
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
                              <a class="btn btn-warning btn-edit" data-toggle="modal" data-target="#ModalEdit" <?= 'data-id="'.$rec['id'].'"    data-sets= "'.$rec['sets'].'" data-video= "'.$rec['video'].'" data-reps= "'.$rec['reps'].'"'; ?>><i class="fa fa-edit"></i></a>
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
                  <h4 class="modal-title" id="myModalLabel"><?= $category[0]['title']." ".$title;?> |<small>Edit</small></h4>
               </div>
               <div class="modal-body">
                  <div id="msge"></div>
                  <form class="form-horizontal" method="post" id="Editform" action="<?= base_url();?>admin/CoursePlans/EditRecord"  enctype="multipart/form-data" >
                   <input type="hidden" name="id" id="id" required>
                     <div class="form-group">
            <div class="col-md-7">
              <label class="control-label">Sets</label>
              <input type="number" min="1" max="100" name="sets" id="sets" class="form-control" >
            </div>
                     </div>
                     <div class="form-group">
                  <div class="col-md-7">
                     <label class="control-label">Reps</label>
                     <input type="number" min="1" max="100" name="reps" id="reps" class="form-control" >
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
     
   </div>
</div>
<script type="text/javascript">        
   $(document).ready(function(){
      $("#Addform").validate({
      rules: {
        video: {
            required: true,
            accept: "video/mp4"
        }
  }
      });
      $("#Editform").validate({
       rules: {
       video: {
            required: true,
            accept: "video/mp4"
        }
  }
      });
   });



   $(document).on("click",".btn-edit",function() {
      $("#id").val($(this).data("id"));
    $("#sets").val($(this).data("sets"));
      $("#reps").val($(this).data("reps"));
		$("#video").attr("src","<?=base_url();?>assets/front/uploads/courses/courseplans/"+$(this).data("video"));
		
	});
	
	$(".btn-feat").click(function(){
		$("#course_image_id").val($(this).data("id"));
	});
  
   
</script>