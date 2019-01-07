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
			<?php  if(count($records) > 0 ) { ?>
				<button type="button" class="btn btn-danger margin pull-right" onClick="doDelete()" style="margin-right:auto" >Delete</button>
			<?php } ?>
				<a href="<?= base_url();?>admin/posts/AddNew" class="btn btn-default margin pull-right" style="margin-right:5px"><i class="fa fa-plus"></i> Add New Post</a>
			<div class="clearfix"></div>
		  </div>
		  <div class="x_content">
			<form method="post" id="tblform" action="<?= base_url();?>admin/posts/DeleteRecord">
			<table id="datatable-buttons" class="table table-striped table-bordered">
			  <thead>
				<tr>
				  <th align="center"><input type="checkbox" name="chkAll" class="checkUncheckAll" ></th>
				  <th>Image</th>
				  <th>Type</th>
				  <th>Title</th>
				  <th>Slug</th>
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
				  <td><img src="<?=base_url();?>assets/uploads/blogs/<?= ($rec['image'] != "" ? $rec['image'] : "dummy.png"); ?>"  style="max-height:50px;" /></td>
				  <td><?= $rec['post_type']; ?></td>
				  <td><?= $rec['title']; ?></td>
				  <td><?= $rec['slug']; ?></td>
				  <td>
				   <div class="form-group">
					<label>
					  <input type="checkbox" class="js-switch"  <?= ($rec['status']==1) ? 'checked' : '' ?> onclick="togglestatus(<?= $rec['id'] ?>,'Blogs')" />
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
					<a class="btn btn-warning btn-editc btn-sm" href="posts/edit/<?= $rec['id']; ?>">
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
	</div>
</div>
  