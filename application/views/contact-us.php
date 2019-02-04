<section class="_contact_pg_title">
	<div class="container text-center">
		<h2>Contact Us</h2>
		   <p>We are here and ready to help you!</p>
			<a href="<?= base_url(); ?>" class="btn_theme">
				<i class="fa fa-angle-left" aria-hidden="true"></i>  &nbsp;&nbsp;
				Back to Home
			</a>	
	</div>
</section>
<section class="_contact_pg_sec_1">
	<div class="container">
		<div class="row">
			<div class="col-md-5 col-sm-5 col-xs-12">
				
				<img src="<?=base_url()?>assets/front/images/contact.gif" style="width:72%;" >
			</div>
			<div class="col-md-7 col-sm-7 col-xs-12">
				<div id="msg"></div>
				<form action="<?= base_url();?>Contact/AddRecord" method="post" id="ConForm">
                  <div class="form-group">
                     <input type="text" name="full_name" class="form-control" placeholder="Full Name*">
                  </div>
                  <div class="form-group">
                     <input type="email" name="email" class="form-control" placeholder="Email Address*">
                  </div>
                  <div class="form-group">
                     <input type="text" name="subject" class="form-control" placeholder="Subject">
                  </div>
                  <div class="form-group">
                     <textarea name="message" class="form-control" placeholder="Message*" rows="4"></textarea>
                  </div>
                  <div class="submit-btn-contact">
					 <img id="loader" src="<?= base_url(); ?>assets/front/images/loader.gif" style="height:50px; float:right; display:none"/>
                     <input id="ConSub" type="submit" class="btn_theme" value="Send message">
                  </div>
               </form>
			</div>
		</div>
	</div>
</section>

<!-- Contact form end here -->
<script src="<?= base_url(); ?>assets/admin/js/validator/jquery.validate.min.js"></script>
<script type="text/javascript">
	$("#ConForm").submit(function(e) { 
		e.preventDefault();
		if ($('#ConForm').valid()) {
			$('#ConSub').hide();
			$('#loader').show();
			var action =$('#ConForm').attr('action');
			var value =$('#ConForm').serialize();
			$.ajax({
				url:action,
				type:'POST',
				data:value,
				success:function(result){
					if(result==0){
						$("#msg").html('<span style="color:red"><i class="fa fa-ban"></i><b> Error. Please Try Again Later!</b><br/></span>');
						$("#msg").show();
					}
					else if(result==1){	
						$("#msg").html('<div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b> Your Message has been sent.(temporary msg: mail sent to 90days@yopmail.com)</b></div>');
						$('#ConForm')[0].reset();
						$("#msg").show();
					}
					$('#ConSub').show();
					$('#loader').hide();
				},
				error: function (xhr, textStatus, errorThrown){
					alert(xhr.responseText);
				}
			});
		}

	});
   	$("#ConForm").validate({
   		rules: {
   		  full_name: "required",
		  email: {
			required: true,
			email: true
		  },
   		  subject: "required",
   		  message: "required"
   		}
   	});
</script>