<style>
   .note-popover .popover-content, .panel-heading.note-toolbar {
   padding: 0 0 10px 5px !important;
   margin: 0 !important;
   }
   .note-editor .note-editing-area {
   position: relative;
   margin-top: 5px;
   }
</style>
<div class="">
   <div class="page-title">
      <div class="title_left">
         <h3>Manage <?= $title; ?></h3>
      </div>
   </div>
   <hr noshade>
   <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
         <div class="x_panel">
            <div class="x_title">
               <h2><?= $title; ?> |<small>Edit</small></h2>
               <div class="clearfix"></div>
            </div>
            <div class="x_content">
               <div class="col-md-10 col-md-offset-1">
                  <form class="form-horizontal" method="post" id="Editform" action="<?= base_url();?>admin/Blogs/EditRecord">
                     <div class="col-md-12">
                        <label class="control-label" for="example-text-input">Post Type</label>
                        <select name="post_type" class="form-control">
							<option value="blog" <?= ($rec['post_type']=='blog'?'selected':''); ?>>Blog</option>
							<option value="page" <?= ($rec['post_type']=='page'?'selected':''); ?>>Page</option>
						</select>
                     </div>
                     <div class="col-md-12">
					  <div class="form-group">
                        <label class="control-label" for="example-text-input">Post Title</label>
                        <input type="hidden" name="id" value="<?= $rec['id']; ?>">
                        <input type="text" name="title" value="<?= $rec['title']; ?>" placeholder="Enter Post Title" class="form-control">
					  </div>
                     </div>
                     <div class="col-md-12">
                        <label class="control-label" for="example-text-input">Slug</label>
                        <input type="text" name="slug" value="<?= $rec['slug']; ?>" placeholder="Enter Blog Slug" class="form-control">
                     </div>
                     <div class="col-md-12">
                        <label class="control-label">Featured Image</label>
					  <div class="form-group">
						<div class="col-md-10">
                        <input type="file" name="image" class="form-control">
						</div>
						<div  class="col-md-2">
						<img src="<?=base_url();?>assets/uploads/blogs/<?= ($rec['image'] != "" ? $rec['image'] : "dummy.png"); ?>"  style="max-height:50px;" />
						</div>
					  </div>
                     </div>
                     <div class="col-md-12">
					  <div class="form-group">
                        <label class="control-label" for="example-text-input">Short Description</label>
                        <textarea name="description" placeholder="Enter Short Description" class="form-control" rows="3"><?= $rec['description']; ?></textarea>
						</div>
                     </div>
                     <div class="col-md-12">
					  <div class="form-group">
                        <label class="control-label" for="example-text-input">Post Content</label>
                        <textarea name="content" class="summernote"><?= $rec['content']; ?></textarea>
					  </div>
                     </div>
                     <div class="col-md-12">
						<div id="msge"></div>
                        <input type="submit" value="Submit" class="btn btn-default" style="width:100%" >
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<script type="text/javascript">        
   $(document).ready(function(){
   	$("#Editform").validate({
   		rules: {
   		  title: "required",
   		  slug: "required",
   		  content: "required",
		  image: {
			extension: "png|jpeg|jpg"
		  }
   		},
		messages: {
		  image: {
			extension: "Only PNG, JPG and JPEG files are allowed."
		  }
		}
   	});
   	$('.summernote').summernote({
   		placeholder: 'Enter Blog Content here...',
   		tabsize: 2,
   		height: 300
   	});
   });
</script>