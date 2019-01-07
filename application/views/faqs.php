<div class="clear"></div>
<script>
    $(document).ready(function(){
		    $(function () {
                $('.panel-collapse').on('show.bs.collapse', function (e) {
                    $(e.target).closest('.panel').siblings().find('.panel-collapse').collapse('hide');
                });
            })
		})
		
    
</script>



<div class="latest-faq-title">
   <!-- Latest blog title start here -->
   <h2>OCBuyBack Help Center</h2>
   <p>Here you will find the most commonly asked questions</p>
   <div class="back-btn">
      <!-- Back btn start here -->
      <p><a href="<?= base_url(); ?>"><i class="fa fa-angle-left" aria-hidden="true"></i> Back to Home</a></p>
   </div>
   <!-- Back btn end here -->
</div>
<!-- Latest blog title end here -->  
</div> <!-- main header end here -->
<div class="clear"></div>
<div class="container">
   <div class="row">
      <div class="col-md-12">
         <div class="tabbable-panel">
            <div class="tabbable-line">
               <ul class="nav nav-tabs ">
                  <li class="active"><a href="#quotes-orders" data-toggle="tab">Quotes & Orders</a></li>
                  <li><a href="#iphones-ipads" data-toggle="tab">iPhones & iPad</a></li>
                  <li><a href="#shipping" data-toggle="tab">Shipping</a></li>
               </ul>
               <div class="tab-content">
                  <div class="tab-pane active" id="quotes-orders">
                     <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
					  <?php
					   foreach($quotes as $faq){ ?>
                        <div class="panel panel-default">
                           <div class="panel-heading" role="tab" id="heading<?= $faq['id']; ?>">
                              <h4 class="panel-title">
                                 <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?= $faq['id']; ?>" aria-expanded="true" aria-controls="collapse<?= $faq['id']; ?>">
                                 <i class="more-less glyphicon glyphicon-plus"></i>
                                 <?= $faq['question']; ?>
                                 </a>
                              </h4>
                           </div>
                           <div id="collapse<?= $faq['id']; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?= $faq['id']; ?>">
                              <div class="panel-body">
                                 <p><?= $faq['answer']; ?></p>
                              </div>
                           </div>
                        </div>
					   <?php } ?>
					 </div>
                     <!-- panel-group -->
                  </div>
                  <div class="tab-pane" id="iphones-ipads">
                     <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
					  <?php
					   foreach($iphones as $faq){ ?>
                        <div class="panel panel-default">
                           <div class="panel-heading" role="tab" id="heading<?= $faq['id']; ?>">
                              <h4 class="panel-title">
                                 <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?= $faq['id']; ?>" aria-expanded="true" aria-controls="collapse<?= $faq['id']; ?>">
                                 <i class="more-less glyphicon glyphicon-plus"></i>
                                 <?= $faq['question']; ?>
                                 </a>
                              </h4>
                           </div>
                           <div id="collapse<?= $faq['id']; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?= $faq['id']; ?>">
                              <div class="panel-body">
                                 <p><?= $faq['answer']; ?></p>
                              </div>
                           </div>
                        </div>
					   <?php } ?>
					 </div>
                     <!-- panel-group -->
                  </div>
                  <div class="tab-pane" id="shipping">
                     <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
					  <?php
					   foreach($shipping as $faq){ ?>
                        <div class="panel panel-default">
                           <div class="panel-heading" role="tab" id="heading<?= $faq['id']; ?>">
                              <h4 class="panel-title">
                                 <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?= $faq['id']; ?>" aria-expanded="true" aria-controls="collapse<?= $faq['id']; ?>">
                                 <i class="more-less glyphicon glyphicon-plus"></i>
                                 <?= $faq['question']; ?>
                                 </a>
                              </h4>
                           </div>
                           <div id="collapse<?= $faq['id']; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?= $faq['id']; ?>">
                              <div class="panel-body">
                                 <p><?= $faq['answer']; ?></p>
                              </div>
                           </div>
                        </div>
					   <?php } ?>
					 </div>
                     <!-- panel-group -->
                  </div>
               </div>
            </div>
			<p>Still need help? <a href="<?=base_url();?>contact-us">Contact us. </p>
		 </div>
	  </div>
   </div>
</div>
<script>

function toggleIcon(e) {
$(e.target)
.prev('.panel-heading')
.find(".more-less")
.toggleClass('glyphicon-plus glyphicon-minus');
}
$('.panel-group').on('hidden.bs.collapse', toggleIcon);
$('.panel-group').on('shown.bs.collapse', toggleIcon);

</script>    
        