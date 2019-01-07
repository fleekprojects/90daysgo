<div class="clear"></div>
<div class="latest-sell-title">
   <!-- Latest blog title start here -->
   <h2><?= $post['title']; ?></h2>
   <p><?= $post['description']; ?></p>
   <div class="back-btn">
      <!-- Back btn start here -->
      <p><a href="<?= base_url(); ?>"><i class="fa fa-angle-left" aria-hidden="true"></i> Back to Home</a></p>
   </div>
   <!-- Back btn end here -->
</div>
<div class="clear"></div>
</div>
<div id="banner">
   <div class="jumbotron blog-detail">
      <div class="container">
         <div class="row text-center">
            <p>
               <?= $post['content']; ?>
            </p>
         </div>
      </div>
   </div>
</div>