<div class="">
<div class="row">
   <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
         <div id="msg"></div>
         <div class="x_title">
            <h2>Recent <?= $title; ?> |<small>List</small></h2>
            <?php  if(count($records) > 0 ) { ?>
            <!--<button type="button" class="btn btn-danger margin pull-right" onClick="doDelete()" style="margin-right:auto" >Delete</button>-->
            <?php } ?>
            <div class="clearfix"></div>
         </div>
         <div class="x_content">
            <div id="msg"><?php  if($this->session->flashdata('message')){
               echo $this->session->flashdata('message');
               }  
                ?>
            </div>
            <form method="post" id="ordertbl" action="<?= base_url();?>admin/Categories/DeleteRecord">
               <table id="order-datatable-buttons" class="table table-striped table-bordered">
                  <thead>
                     <tr>
                        <th align="center"><input type="checkbox" name="chkAll" class="checkUncheckAll" ></th>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Trade Type</th>
                        <th>Payment</th>
                        <th>Order Total</th>
                        <th>Status</th>
                        <!--<th>Date Added</th>-->
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
                        <td>
						<span style="font-size:0"><?= $rec['created_at']; ?></span>
						<a style="color: #72b6f1; font-weight: 700;" href="javascript:;" onclick="get_details(<?= $rec['id']; ?>)"><?= $rec['order_code']; ?></a><br/>
                           <?php
                              if($rec['status'] == "" && $rec['trade_details']=='Shipping Kit with Prepaid Label'){
                              	echo '<span class="label label-primary"><i class="fa fa-info"></i>&nbsp; Shipping Kit Sent</span>';
                              }
                              else if($rec['status'] == "" ){
                              	echo '<span class="label label-primary"><i class="fa fa-play-circle"></i>&nbsp; Initiated</span>';
                              }
                              else if($rec['status'] == "received" ){
                              	echo '<span class="label label-success"><i class="fa fa-check"></i>&nbsp; Received</span>';
                              }
                              else if($rec['status'] == "paid" ){
                              	echo '<span class="label label-success"><i class="fa fa-check"></i>&nbsp; Paid</span>';
                              }
                              else if($rec['status'] == "recycled" ){
                              	echo '<span class="label label-success"><i class="fa fa-recycle"></i>&nbsp; Recycled</span>';
                              }
                              else if($rec['status'] == "returned" ){
                              	echo '<span class="label label-success"><i class="fa fa-undo"></i>&nbsp; Returned</span>';
                              }
                              else if($rec['status'] == "cancelled" ){
                              	echo '<span class="label label-success"><i class="fa fa-times"></i>&nbsp; Cancelled</span>';
                              }
                                ?><br>
                           <b style="font-size: 11px;"><?= date('jS M Y h:i:s A', strtotime($rec['created_at'])); ?></b>
                        </td>
                        <td><?= $rec['first_name'].' '.$rec['last_name']; ?></td>
                        <td><?= $rec['email']; ?></td>
                        <td><?= $rec['phone']; ?></td>
                        <td><?= $rec['trade_details']; ?></td>
                        <td><?= ($rec['pay_type'] == 1 ? 'Paypal' : 'Check'); ?></td>
                        <td>$<?= $rec['amount']; ?></td>
                        <td>
                           <select class="form-control" id="o_st<?= $rec['id'] ?>" onchange='change_order_status(<?= $rec['id']; ?>)' >
						   <?php if(!isset($pstatus) || $pstatus !=1){ ?>
                              <option <?= ($rec['status'] == "" ? 'selected' : ''); ?> value="">Pending</option>
                              <option <?= ($rec['status'] == "received" ? 'selected' : ''); ?> value="received">Received</option>
						   <?php } ?>
                              <option <?= ($rec['status'] == "paid" ? 'selected' : ''); ?> value="paid">Paid</option>
                              <option <?= ($rec['status'] == "recycled" ? 'selected' : ''); ?> value="recycled">Recycled</option>
                              <option <?= ($rec['status'] == "returned" ? 'selected' : ''); ?> value="returned">Returned</option>
                              <option <?= ($rec['status'] == "cancelled" ? 'selected' : ''); ?> value="cancelled">Cancelled</option>
                              <?php
                                 if($rec['trade_details']=='Shipping Kit with Prepaid Label'){
                                 	echo '<option '.($rec['status'] == "shipping_kit_sent" ? 'selected' : '').' value="shipping_kit_sent">Shipping Kit Sent</option>';
                                 } ?>
                           </select>
                        </td>
                        <!--  <td>
                           <span style="font-size:0"><?= $rec['created_at']; ?></span>
                           <? date('jS M Y h:i:s A', strtotime($rec['created_at'])); ?>
                           </td>-->
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
   <!-- Detail modal -->
   <div class="modal fade bs-example-modal-lg" id="ModalOdet" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
               </button>
               <h4 class="modal-title" id="myModalLabel"><?= $title; ?> |<small>View Details</small></h4>
            </div>
            <div class="modal-body" id="detail_view">
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
         </div>
      </div>
   </div>
   <!-- Detail modal --> 
   <!-- Requote modal -->
   <div class="modal fade bs-example-modal-lg" id="ModalRequote" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
               </button>
               <h4 class="modal-title" id="myModalLabel"><span class="orderdetails"></span></h4>
            </div>
            <form action="<?= base_url() ?>admin/Trades/requestsubmit" method="POST" >
               <div class="modal-body" >
                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group">
                           <label>REASON</label>
                           <select class="form-control" name="requote_reason" id="reasondrop">
                              <option>Select a reason</option>
                              <option value="Wrong Condition">Wrong Condition</option>
                              <option value="Device Missing">Device Missing</option>
                              <option value="Other">Other</option>
                           </select>
                        </div>
                     </div>
                     <input type="hidden" name="order_detail_id" id="orderdetailid" >
                  </div>
                  <div class="row" id="otheroptionshow" style="display: none;">
                     <div class="col-md-6">
                        <div class="form-group">
                           <label>NEW PRICE</label>
                           <input type="text" name="new_price" placeholder="NEW PRICE (ex. 170)" class="form-control">
                        </div>
                     </div>
                  </div>
                  <div class="row" id="wrongoptionshow" style="display: none;">
                     <div class="col-md-6">
                        <div class="form-group">
                           <label>CONDITION RECEIVED</label>
                           <select class="form-control" name="req_condition" id="con_rec">
                              <option value="">Please select a condition</option>
                           </select>
                        </div>
                     </div>
                  </div>
                  <div class="row" id="reasonsshow" style="display: none;">
                     <div class="col-md-6">
                        <div class="form-group">
                           <label>REASON DESCRIPTION</label>
                           <textarea class="form-control" name="requote_details" rows="5"></textarea>
                        </div>
                     </div>
                  </div>
                  <div class="modal-footer">
                     <button type="submit" class="btn btn-default pull-right">Requote Now / Send Offer Email</button>
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
               </div>
            </form>
         </div>
      </div>
      <!-- Requote modal -->
   </div>
   <!-- Seller modal -->
   <div class="modal fade bs-example-modal-lg" id="ModalSeller" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
               </button>
               <h4 class="modal-title" id="myModalLabel"><span class="orderdetails"></span></h4>
            </div>
            <form action="<?= base_url() ?>admin/Trades/requestsubmit" method="POST">
               <div class="modal-body" >
                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group">
                           <label>ISSUE</label>
                           <select class="form-control" name="issue" id="issuedrop">
                              <option value="">Select an issue</option>
                              <option  value="1">Google Locked</option>
                              <option  value="2">iCloud Locked</option>
                              <option  value="3">ESN Financed</option>
                           </select>
                        </div>
                        <input type="hidden" name="order_detail_id" id="order_detail_id" > 
                        <input type="hidden" name="action" value="seller" > 
                     </div>
                  </div>
                  <div class="row" id="esnoptionshow" style="display: none;">
                     <div class="col-md-6">
                        <div class="form-group">
                           <label>ESN</label>
                           <input type="text" name="esn" placeholder="Device ESN" class="form-control">
                        </div>
                     </div>
                  </div>
                  <div class="modal-footer">
                     <button type="submit" class="btn btn-default pull-right">Send action email</button>
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
   <!-- Seller modal -->
</div>
<script>
   var this_cond;
   var cond_arr = <?= json_encode($conditions); ?>;
   
   $("#reasondrop").on('change',function(){
    var getValue=$(this).val();
    if(getValue=='Other'){
      $('#otheroptionshow').show();
      $('#reasonsshow').show();
      $('#wrongoptionshow').hide();
    }
    else if(getValue=='Wrong Condition'){
   $.each(cond_arr,function(key, value){
    if(value.title != this_cond){
   $("#con_rec").append('<option value=' + value.id + '>' + value.title + '</option>');
    }
   });
       $('#otheroptionshow').hide();
       $('#wrongoptionshow').show();
        $('#reasonsshow').show();
   
    }
    else{
      $('#wrongoptionshow').hide();
        $('#otheroptionshow').hide();
        $('#reasonsshow').hide();
    }
   }); 
   $("#issuedrop").on('change',function(){
    var getValue=$(this).val();
    if(getValue=='ESN Financed'){
      $('#esnoptionshow').show();
    }
    else{
      $('#esnoptionshow').hide();
    }
   });
   // $('#ordertbl').DataTable( {
   //        "order": [[ 0, "desc" ]]
   //    } );
   function get_details(id){
   	$.ajax({
   		url:"<?= base_url(); ?>admin/trades/get_order",
   		type:'POST',
   		data:{'id':id},
   		success:function(result){
   			$("#detail_view").html(result);
   			$("#ModalOdet").modal("show");
   		},
   		error: function (xhr, textStatus, errorThrown){
   			console.log(xhr.responseText);
   		}
   	});
   }
   function change_order_status(id){
   var status=$("#o_st"+id).val();
   	$.ajax({
   		url:"<?= base_url(); ?>admin/trades/ch_status",
   		type:'POST',
   		data:{'id':id,'status':status},
   		success:function(result){
   			$("#msg").html('<div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b> Status Updated!</b></div>');
   $("#msg").show();
   // setTimeout(function(){$("#msg").hide(); }, 1000);
   setTimeout(location.reload(), 1000);
   		},
   		error: function (xhr, textStatus, errorThrown){
   			console.log(xhr.responseText);
   		}
   	});
   }
   
   function change_order_action(action,id){
         if(action=='requote'){
                    $.ajax({
                     url:"<?= base_url(); ?>admin/trades/get_order_details",
                     type:'POST',
                     data:{'id':id,'action':action},
                     success:function(result){
                        var dataSave = $.parseJSON(result);
   			
                        $("#orderdetailid").val(dataSave.id);
                        $(".orderdetails").html('Order #'+dataSave.order_code+' / '+dataSave.device+'_'+dataSave.provider+'_'+dataSave.storage+'_'+dataSave.condition+' / <strong>Requote</strong>');
   			this_cond=dataSave.condition;
                    
                     },
                     error: function (xhr, textStatus, errorThrown){
                        console.log(xhr.responseText);
                        }
                     });
   
               $("#ModalRequote").modal("show");
         }
         else if(action=='seller'){
   
                 $.ajax({
                     url:"<?= base_url(); ?>admin/trades/get_order_details",
                     type:'POST',
                     data:{'id':id,'action':action},
                     success:function(result){
                        var dataSave = $.parseJSON(result);
                        $("#order_detail_id").val(dataSave.id);
                        $(".orderdetails").html('Order #'+dataSave.order_code+' / '+dataSave.device+'_'+dataSave.provider+'_'+dataSave.storage+'_'+dataSave.condition+' / <strong>Action Required</strong>');
                    
                     },
                     error: function (xhr, textStatus, errorThrown){
                        console.log(xhr.responseText);
                        }
                     });
          $("#ModalSeller").modal("show");
   
         } 
         else{
               $.ajax({
               url:"<?= base_url(); ?>admin/trades/Ch_action",
               type:'POST',
               data:{'id':id,'action':action},
               success:function(result){
                  $("#msg").html('<div class="alert alert-warning alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Request Sent ! Please check your mail.</b></div>');
          
               setTimeout(function(){$("#msg").hide(); }, 1000);
               setTimeout(location.reload(), 1000);
               },
               error: function (xhr, textStatus, errorThrown){
                  console.log(xhr.responseText);
               }
            });
         }
   
   }
   
   
</script>