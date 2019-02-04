<div class="">
   <div class="page-title">
      <div class="title_left">
         <h3>Manage <?=$title;?></h3>
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
                        <h2><i class="fa fa-align-left"></i> <?= $title;?> | <small>Add New</small></h2>
                     </a>
                     <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                        <div class="panel-body">
                           <form class="form-horizontal" method="post" id="Addform" action="<?= base_url();?>admin/Users/AddRecord" enctype="multipart/form-data">
                              
                              <div class="col-md-6">
                                 <label class="control-label" for="example-text-input">User Name</label>
                                 <div class="form-group">
                                    <input type="text" name="user_name" value="" placeholder="Enter User Name" class="form-control">
                                 </div>
                              </div> 
                              <div class="col-md-6">
                                 <label class="control-label" for="example-text-input">Email Address</label>
                                 <div class="form-group">
                                    <input type="email" name="email" value="" placeholder="Enter Email Address" class="form-control">
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <label class="control-label" for="example-text-input">Password</label>
                                 <div class="form-group">
                                    <input type="password" placeholder="Enter Password" name="password" class="form-control" ">
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
               <h2><?= $title;?> |<small>View</small></h2>
               <?php  if(count($records) > 0 ) { ?>
               <button type="button" class="btn btn-danger margin pull-right" onClick="doDelete()" style="margin-right:auto" >Delete</button>
               <?php } ?>
               <div class="clearfix"></div>
            </div>
            <div class="x_content">
               <form method="post" id="tblform" action="<?= base_url();?>admin/Users/DeleteRecord">
                  <table id="datatable-buttons" class="table table-striped table-bordered">
                     <thead>
                        <tr>
                           <th align="center"><input type="checkbox" name="chkAll" class="checkUncheckAll" ></th>
                           <th>User Name</th>
                           <th>Email Address</th>
                           <th>No of Orders</th>
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
                           <td><?= $rec['user_name']?></td>
						         <td><?= $rec['email']?></td>
						         <td><?= $rec['orders']?></td>
                           <td>
                              <div class="form-group">
                                 <label>
                                 <input type="checkbox" class="js-switch"  <?= ($rec['status']==1) ? 'checked' : '' ?> onclick="togglestatus(<?= $rec['id'] ?>,'Users')" />
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
                              <a class="btn btn-warning btn-edit" data-toggle="modal" data-target="#ModalEdit" <?= 'data-id="'.$rec['id'].'" data-username= "'.$rec['user_name'].'"data-email= "'.$rec['email'].'"'; ?>>
                                 <i class="fa fa-edit"></i></a>
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
                  <h4 class="modal-title" id="myModalLabel"><?= $title;?> |<small>Edit</small></h4>
               </div>
               <div class="modal-body">
                  <div id="msge"></div>
                  <form class="form-horizontal" method="post" id="Editform" action="<?= base_url();?>admin/Users/EditRecord"  enctype="multipart/form-data" >
                   <input type="hidden" name="id" id="id" required>
                     <div class="form-group">
                        <div class="col-md-7">
                          <label class="control-label">User Name</label>
                          <input type="text" name="user_name" id="user_name" class="form-control" >
                        </div> 
                     </div> 
                     <div class="form-group">
         					<div class="col-md-7">
         					  <label class="control-label">Email Address</label>
         					  <input type="email" name="email" id="email" class="form-control" >
                        </div> 
					      </div> 
                      <div class="form-group">
      						<div class="col-md-7">
      							<label class="control-label">Password </label>
      							<input type="password"  name="password" class="form-control" > 
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
           user_name: {
      required: true
    },    
     email: {
      required: true
    }, 
    password : {
       required: true,
       maxlength: 8
    }
     
  }
      });
      $("#Editform").validate({
       rules: {
             user_name: {
      required: true
    },    
     email: {
      required: true
    }
  }
      });
   });
 $(document).on("click",".btn-edit",function() {
      $("#id").val($(this).data("id"));
    $("#user_name").val($(this).data("username"));
    $("#email").val($(this).data("email"));
    
  });
</script>