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
		<div id="msg"></div>
		<div class="x_panel">
		  <div class="x_title">
			<h2><?= $title; ?> |<small>View</small></h2>
			<div class="clearfix"></div>
		  </div>
		  <div class="x_content">
			<form method="post" id="tblform" action="<?= base_url();?>admin/Contact/DeleteRecord">
			<table id="datatable-buttons" class="table table-striped table-bordered">
			  <thead>
				<tr>
				  <th>Order Code</th>
				  <th>Course</th>
				  <th>Customer</th>
				  <th>Email Address</th>
				  <th>Discount Code</th>
				  <th>Amount</th>
				  <th>Paid via</th>
				  <th>Status</th>
				  <th>Date Added</th>
				</tr>
			  </thead>
			  <tbody>
			  <?php
				foreach($records AS $rec){
			  ?>
				<tr>
				  <td><?= $rec['order_code']; ?></td>
				  <td><?= $rec['course_name']; ?></td>
				  <td><?= $rec['user_name']; ?></td>
				  <td><?= $rec['email']; ?></td>
				  <td><?= (!empty($rec['discount_code']) ? $rec['discount_code'] : 'No Discount'); ?></td>
				  <td>$<?= $rec['paid_amount']; ?></td>
				  <td><?= ($rec['payment_gateway'] == 1 ? "Paypal" : "Stripe"); ?></td>
				  <td>
				   <div class="form-group">
					<label>
					  <input type="checkbox" class="js-switch"  <?= ($rec['status']==1) ? 'checked' : '' ?> onclick="togglestatus(<?= $rec['id'] ?>,'Orders')" />
					</label>
				   </div>
				  </td>
				  <td>
					<span style="font-size:0"><?= $rec['created_at']; ?></span>
					<?= date('jS M Y ', strtotime($rec['created_at'])); ?>
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
</div>
  