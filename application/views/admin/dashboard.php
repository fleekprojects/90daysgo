<div class="">
   <div class="row top_tiles">
      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
         <div class="tile-stats">
            <div class="icon"><i class="fa fa-caret-square-o-right"></i></div>
            <div class="count"><?= $counters['received']; ?></div>
            <h3>Received</h3>
            <p>Trade Ins</p>
         </div>
      </div>
      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
         <div class="tile-stats">
            <div class="icon"><i class="fa fa-check"></i></div>
            <div class="count"><?= $counters['paid']; ?></div>
            <h3>Paid </h3>
            <p>Trade Ins</p>
         </div>
      </div>
      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
         <div class="tile-stats">
            <div class="icon"><i class="fa fa-refresh"></i></div>
            <div class="count"><?= $counters['recycled']; ?></div>
            <h3>Recycled</h3>
            <p>Trade Ins</p>
         </div>
      </div>
      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
         <div class="tile-stats">
            <div class="icon"><i class="fa fa-reply"></i></div>
            <div class="count"><?= $counters['returned']; ?></div>
            <h3>Returned</h3>
            <p>Trade Ins</p>
         </div>
      </div>
   </div>
</div>