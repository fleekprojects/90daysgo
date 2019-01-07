<div class="clear"></div>
<div class="latest-blog-title">
   <!-- Latest blog title start here -->
   <h2>latest blogs</h2>
   <p>A directory of wonderful things</p>
   <div class="back-btn">
      <!-- Back btn start here -->
      <p><a href="<?= base_url(); ?>"><i class="fa fa-angle-left" aria-hidden="true"></i> Back to Home</a></p>
   </div>
   <!-- Back btn end here -->
</div>
<!-- Latest blog title end here -->  
</div> <!-- main header end here -->
<div class="clear"></div>
<div class="blog-page-row-1">
   <!-- blog row start here -->
   <!-- Blog title end here -->
   <div class="blog-inner-posts">
      <div class="container">
         <div class="row">
    <!--        <div class="blog-cate-title">
               <p><a href="#">Business</a></p>  
            </div>-->
            <!-- Blog cate title end here -->
         </div>
      </div>
      <!-- Blog inner posts start here -->
      <div class="container">
         <div class="row">
		 <?php
		  foreach($blogs as $blog){ ?>
            <div class="col-md-4">
               <div class="blog-col-1">
                  <div class="blog-thumb">
                     <img src="<?= base_url(); ?>assets/uploads/blogs/<?= $blog['image']; ?>" alt="" />
                  </div>
                  <div class="blog-content">
                     <strong><a href="<?= base_url().$blog['slug']; ?>" target="_blank"><?= $blog['title']; ?></a></strong>
                     <p>By OCBuyBack on <?= date('jS M Y',strtotime($blog['created_at'])); ?></p>
                  </div>
               </div>
            </div>
		  <?php } ?>
            
         </div>
         <!-- Blog inner posts end here -->
      </div>
      <!-- blog row end here -->
   </div>
   
        <div class="blog-cate-title">
             <!--  <p><a href="#">Load More</a></p>  -->
            </div>
   
   
   
</div>
<!-- Blog page row 1 end here -->		
<div class="clear"></div>


<!-- Blog page row 1 end here -->