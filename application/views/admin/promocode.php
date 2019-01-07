<div class="">
   <div class="page-title">
      <div class="title_left">
         <h3>Manage <?= $title; ?></h3>
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
                        <h2><i class="fa fa-align-left"></i> <?= $title; ?> | <small>Add New</small></h2>
                     </a>
                     <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                        <div class="panel-body">
                           <form class="form-horizontal" method="post" id="Addform" action="<?= base_url();?>admin/PromoCode/AddRecord">
                              <div class="form-group">
                                 <label class="col-md-2 control-label" for="example-text-input">Code</label>
                                 <div class="col-md-6">
                                    <input type="text" name="code" value="" placeholder="Enter Code" class="form-control">
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label class="col-md-2 control-label" for="example-text-input">Description</label>
                                 <div class="col-md-6">
                                    <textarea name="descp" placeholder="Enter Short Code Description" class="form-control" rows="2" cols="3"></textarea>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label class="col-md-2 control-label" for="example-text-input">Rate</label>
                                 <div class="col-md-6">
                                    <input type="text" name="price" value="" placeholder="Enter Rate" class="form-control">
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label class="col-md-2 control-label" for="example-text-input">Valid From</label>
                                 <div class="col-md-6">
                                    <input type="text" name="valid_from" value="" id="from" placeholder="Select Valid From Date" class="form-control datepicker">
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label class="col-md-2 control-label" for="example-text-input">Valid To</label>
                                 <div class="col-md-6">
                                    <input type="text" id="to" name="valid_to" placeholder="Select Valid To Date" value=""  class="form-control datepicker">
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label class="col-md-2 control-label" for="example-text-input">Valid No Of Times</label>
                                 <div class="col-md-6">
                                    <input type="number" name="valid_times" value="" placeholder="Enter Code" class="form-control">
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="col-md-8">
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
               <h2><?= $title; ?> |<small>View</small></h2>
               <?php  if(count($records) > 0 ) { ?>
               <button type="button" class="btn btn-danger margin pull-right" onClick="doDelete()" style="margin-right:auto" >Delete</button>
               <?php } ?>
               <div class="clearfix"></div>
            </div>
            <div class="x_content">
               <form method="post" id="tblform" action="<?= base_url();?>admin/PromoCode/DeleteRecord">
                  <table id="datatable-buttons" class="table table-striped table-bordered">
                     <thead>
                        <tr>
                           <th align="center"><input type="checkbox" name="chkAll" class="checkUncheckAll" ></th>
                           <th>Code</th>
                           <th>Rate</th>
                           <th>Valid From</th>
                           <th>Valid To</th>
                           <th>Valid Times</th>
                           <th>No of Usage</th>
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
                     <td><?= $rec['code']; ?></td>
                     <td><?= $rec['price']; ?>%</td>
                     <td><?= date('jS M Y ', strtotime($rec['valid_from'])); ?></td>
                     <td><?= date('jS M Y ', strtotime($rec['valid_to'])); ?></td>
                     <td><?= $rec['valid_times']; ?></td>
						   <td><?= $rec['code_usage']; ?></td>
                           <td>
                              <div class="form-group">
                                 <label>
                                 <input type="checkbox" class="js-switch"  <?= ($rec['status']==1) ? 'checked' : '' ?> onclick="togglestatus(<?= $rec['id'] ?>,'PromoCode')" />
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
                             
                              <a class="btn btn-warning btn-edit btn-sm" data-toggle="modal" data-target="#ModalEdit" data-id="<?= $rec['id']; ?>" data-code="<?= $rec['code']; ?>" data-price="<?= $rec['price']; ?>" data-descp="<?= $rec['descp']; ?>" data-valid-from="<?= $rec['valid_from']; ?>" data-valid-to="<?= $rec['valid_to']; ?>" data-valid-times="<?= $rec['valid_times']; ?>">
                              <i class="fa fa-edit"></i></a>
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
      <!-- Edit modal -->
      <div class="modal fade bs-example-modal-lg" id="ModalEdit" tabindex="-1" role="dialog" aria-hidden="true">
         <div class="modal-dialog">
            <div class="modal-content">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                  </button>
                  <h4 class="modal-title" id="myModalLabel"><?= $title; ?> |<small>Edit</small></h4>
               </div>
               <div class="modal-body">
                  <div id="msge"></div>
                  <form class="form-horizontal" method="post" id="Editform" action="<?= base_url();?>admin/PromoCode/EditRecord">
                 
                       <div class="form-group">
                                 <label class="col-md-2 control-label" for="example-text-input">Code</label>
                                 <div class="col-md-6">
                                    <input type="text" name="code" id="code" value="" placeholder="Enter Code" class="form-control">
                                      <input type="hidden" name="id" id="id" required>
                                 </div>
                              </div>
                     <div class="form-group">
                                 <label class="col-md-2 control-label" for="example-text-input">Description</label>
                                 <div class="col-md-6">
                                    <textarea name="descp"  id="descp" placeholder="Enter Short Code Description" class="form-control" rows="2" cols="3"></textarea>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label class="col-md-2 control-label" for="example-text-input">Rate</label>
                                 <div class="col-md-6">
                                    <input type="text" id="price" name="price" value="" placeholder="Enter Rate" class="form-control">
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label class="col-md-2 control-label" for="example-text-input">Valid From</label>
                                 <div class="col-md-6">
                                    <input type="text"  name="valid_from" value="" id="edit_from" placeholder="Select Valid From Date" class="form-control datepicker">
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label class="col-md-2 control-label" for="example-text-input">Valid To</label>
                                 <div class="col-md-6">
                                    <input type="text" id="edit_to" name="valid_to" placeholder="Select Valid To Date" value=""  class="form-control datepicker">
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label class="col-md-2 control-label" for="example-text-input">Valid No Of Times</label>
                                 <div class="col-md-6">
                                    <input type="number" id="valid_times" name="valid_times" value="" placeholder="Enter Code" class="form-control">
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
   		  code: "required"
   		}
   	});
   	$("#Editform").validate({
		rules: {
   		  code: "required"
   		}
   	});
   });
   var dateToday = new Date();
var dates = $("#from, #to").datepicker({
    defaultDate: "+1w",
    minDate: dateToday,
    onSelect: function(selectedDate) {
        var option = this.id == "from" ? "minDate" : "maxDate",
            instance = $(this).data("datepicker"),
            date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
        dates.not(this).datepicker("option", option, date);
    }
});
var dates = $("#edit_from, #edit_to").datepicker({
    defaultDate: "+1w",
    minDate: dateToday,
    onSelect: function(selectedDate) {
        var option = this.id == "edit_from" ? "minDate" : "maxDate",
            instance = $(this).data("datepicker"),
            date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
        dates.not(this).datepicker("option", option, date);
    }
});
 $(document).on("click",".btn-edit",function() {
      $("#id").val($(this).data("id"));
    $("#code").val($(this).data("code"));
      $("#descp").val($(this).data("descp"));
      $("#price").val($(this).data("price"));
      $("#edit_from").val($(this).data("valid-from"));
      $("#edit_to").val($(this).data("valid-to"));
      $("#valid_times").val($(this).data("valid-times"));
      
   });
</script>
