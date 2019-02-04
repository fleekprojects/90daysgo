
<style>
.note-popover .popover-content, .panel-heading.note-toolbar {
    padding: 0 0 10px 5px !important;
    margin: 0 !important;
}
.note-editor.note-frame .note-editing-area .note-editable {
   padding-top: 20px !important;
}
.note-toolbar-wrapper{
	height:100%;
}

</style>			  
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
                        <a class=" panel-heading" role="tab" id="headingOne" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                           <h2><i class="fa fa-align-left"></i> <?= $title; ?> | <small>Add New</small></h2>
                        </a>
                        <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                          <div class="panel-body">
						  <form class="form-horizontal" method="post" id="Addform" action="<?= base_url();?>admin/faqs/AddRecord">
							<div class="form-group">
								<label class="col-md-2 control-label" for="example-text-input">Question</label>
								<div class="col-md-10">
									<textarea name="question" placeholder="Enter Question" class="form-control" rows="1"></textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label" for="example-text-input">Answer</label>
								<div class="col-md-10">
									<textarea name="answer" class="summernote" placeholder="Enter Answer" ></textarea>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-4">
									<input type="submit" id="addSubmit" value="Submit" class="btn btn-default" >
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
					<form method="post" id="tblform" action="<?= base_url();?>admin/Faqs/DeleteRecord">
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th align="center"><input type="checkbox" name="chkAll" class="checkUncheckAll" ></th>
                          <th>Question</th>
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
						<input class="chkIds" type="checkbox" name="ids[]" id="chk-<?= $rec['id'] ?>" value="<?= $rec['id'] ?>"  /></td>
                          <td><?= $rec['question']; ?></td>
                          <td>
						   <div class="form-group">
                            <label>
                              <input type="checkbox" class="js-switch"  <?= ($rec['status']==1) ? 'checked' : '' ?> onclick="togglestatus(<?= $rec['id'] ?>,'Faqs')" />
                            </label>
                          </div></td>
                          <td>
							<span style="font-size:0"><?= $rec['created_at']; ?></span>
							<?= date('jS M Y ', strtotime($rec['created_at'])); ?>
						  </td>
                          <td>
							<span style="font-size:0"><?= $rec['updated_at']; ?></span>
							<?= ($rec['updated_at'] == "" ? "" : date('jS M Y', strtotime($rec['updated_at']))); ?>
						  </td>
                          <td>
							<a class="btn btn-warning btn-editc btn-sm" data-toggle="modal" data-target="#ModalEdit" data-id="<?= $rec['id']; ?>">
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
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel"><?= $title; ?> |<small>Edit</small></h4>
                        </div>
                        <div class="modal-body">
						  <div id="msge"></div>
						  <form class="form-horizontal" method="post" id="Editform" action="<?= base_url();?>admin/faqs/EditRecord">
							<div class="form-group">
								<label class="control-label" for="example-text-input">Question</label>
								<textarea name="question" id="question" placeholder="Enter Question" class="form-control" rows="1"></textarea>
								<input type="hidden" name="id" id="id" required>
							</div>
							<div class="form-group">
								<label class="control-label" for="example-text-input">Answer</label>
								<textarea name="answer" id="answer" placeholder="Enter Answer" class="summernote" ></textarea>
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
  
    <!-- bootstrap-wysiwyg -->
    <script type="text/javascript">        

	$(document).ready(function(){
		$('.summernote').summernote({
			placeholder: 'Enter Answer here...',
			tabsize: 2,
			height: 100
		});
		$("#Addform").validate({
			rules: {
			  question: "required",
			  answer: "required"
			}
		});
		$("#Editform").validate({
			rules: {
			  question: "required",
			  answer: "required"
			}
		});
	});
	$(".btn-editc").click(function(){
		var id=$(this).data("id");
		$.ajax({
			url:"<?= base_url();?>admin/faqs/get_record",
			type:'POST',
			dataType:'JSON',
			data:{'id':id},
			success:function(result){
				$('#id').val(result.id),
				$('#question').val(result.question),
				$('#answer').summernote("code", result.answer);
				$(".note-editor .note-editing-area").css("position", "initial");
				$(".note-toolbar-wrapper").css("height", "100%");
			},
			error: function (xhr, textStatus, errorThrown){
				alert(xhr.responseText);
			}
		});
	});
	
  </script>
  