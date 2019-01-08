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
                           <form class="form-horizontal" method="post" id="Addform" action="<?= base_url();?>admin/CourseWeeks/AddRecord" enctype="multipart/form-data">
                              <input type="hidden" name="course_id" value="<?= $course_id ?>">
                               <div class="form-group">
                                    <div class="col-md-12">
                                    <label>No of Weeks:</label>
                                  <select class="form-control search-select" id="noofweeks" name="" >
                                    <option value=""> Please Select</option>
                                     <?php for ($i=6; $i <= 12 ; $i++) { 
                                      echo '<option value="'.$i.'">'.$i.' Weeks</option>';
                                       } ?>
                                  </select>
                                 </div> 
                               </div> 
                             <div id="courseappend"></div>
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
               <form method="post" id="tblform" action="<?= base_url();?>admin/CourseWeeks/DeleteRecord">
                  <table id="datatable-buttons" class="table table-striped table-bordered">
                     <thead>
                        <tr>
                           <th align="center"><input type="checkbox" name="chkAll" class="checkUncheckAll" ></th>
                           <th>Week No.</th>
                           <th>Week Title</th>
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
                           <td><?= $rec['week_no']?></td>
                           <td><?= $rec['title']?></td>
                           <td>
                              <div class="form-group">
                                 <label>
                                 <input type="checkbox" class="js-switch"  <?= ($rec['status']==1) ? 'checked' : '' ?> onclick="togglestatus(<?= $rec['id'] ?>,'CourseWeeks')" />
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
                              <a class="btn btn-warning btn-edit" data-toggle="modal" data-target="#ModalEdit" <?= 'data-id="'.$rec['id'].'"    data-title= "'.$rec['title'].'"'; ?>><i class="fa fa-edit"></i></a>
                              <a class="btn btn-danger" onclick="doDelete(<?= $rec['id']; ?>)"><i class="fa fa-trash"></i></a>
                               <a class="btn btn-info btn-feat" href="<?=base_url()?>admin/courseplans/<?= $course_id ?>/<?= $rec['id']?>"><i class="fa fa-edit"></i></a>
                             
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
                  <form class="form-horizontal" method="post" id="Editform" action="<?= base_url();?>admin/CourseWeeks/EditRecord"  enctype="multipart/form-data" >
                   <input type="hidden" name="id" id="id" required>
                     <div class="form-group">
						<div class="col-md-7">
							<label class="control-label">Week Title</label>
							<input type="text" name="title" id="title" class="form-control" >
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
         title: {
      required: true
    }}
      });
      $("#Editform").validate({
       rules: {
         title: {
      required: true
    }}
      });
   });
 $("#noofweeks").on('change', function(){
    var weekno=$(this).val();
   $('#courseappend').empty();

    for (i =1; i <= weekno; i++){
    $('#courseappend').append('<div class="form-group"><div class="col-md-6"><label>Week '+ i +' Title:</label><input type="text"  class="form-control"  required name="title[]"></div></div>');
      }

 })


   $(".btn-edit").click(function(){
      $("#id").val($(this).data("id"));
		$("#title").val($(this).data("title"));
		
	});
	
	$(".btn-feat").click(function(){
		$("#course_image_id").val($(this).data("id"));
	});
  
   
</script>