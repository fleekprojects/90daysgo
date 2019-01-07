<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= site_admin_title; ?> </title>

    <!-- Bootstrap -->
    <link href="<?= base_url(); ?>assets/admin/css/bootstrap/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?= base_url(); ?>assets/admin/css/fonts/font-awesome.min.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="<?= base_url(); ?>assets/admin/css/plugins/animate.min.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="<?= base_url(); ?>assets/admin/css/style.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/admin/css/custom.css" rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form id="adminlog" method="POST">
				<img src="<?= base_url().'assets/front/images/'.site_logo;?>" alt="<?= site_title;?>" class="admin_login_logo" />
              <h1>Admin Login</h1>
			  <div>
				<span id="msg" style="display:none;"></span>
			  </div>
              <div>
                <input type="text" class="form-control" placeholder="Username" name="user_name" required />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" name="password" required />
              </div>
              <div style="text-align: left;">
				<input type="checkbox" name="remember_me" id="reme"/>
				<label for="reme">Remember Me</label>
              </div>
              <div>
                <button type="submit" class="btn btn-default" id="sublog">Log in</button>
              </div>
              <div class="separator"></div>
            </form>
              <div class="col-sm-12" style="text-align: right;">
                <a href="javascript:;" data-toggle="modal" data-target="#ModalPass">Lost your password?</a>
              </div>

              <div class="clearfix"></div>
                <div class="clearfix"></div>
                <br />
          </section>
        </div>
		
	  <!-- Forgot Password modal -->
		  <div class="modal fade bs-example-modal-lg" id="ModalPass" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog">
			  <div class="modal-content">
				<div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
				  </button>
				  <h4 class="modal-title" id="myModalLabel">Forgot Password</h4>
				</div>
				<div class="modal-body">
				  <div id="msge"></div>
				  <form class="form-horizontal" method="post" id="adminfpass">
					<div class="form-group">
						<label class="control-label" for="example-text-input">Enter Your Registered Email</label>
						<input type="text" name="email" id="email" class="form-control" required>
					</div>
				</div>
				<div class="modal-footer">
					<input type="submit" value="Submit" class="btn btn-warning" >
				  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				  </form>
				</div>
			  </div>
			</div>
		  </div>
	  <!-- Forgot Password modal -->
      </div>
    </div>
    <!-- jQuery -->
	<script src="<?= base_url(); ?>assets/admin/js/jquery-3.3.1.js"></script>
	<script type="text/javascript">
		$('#adminlog input').keypress(function(e) {
			if (e.keyCode == 13) {
				$('#sublog').click();
			}
		});
		$("#adminlog").submit(function(e){
			e.preventDefault();
			var value =$("#adminlog").serialize() ;
			$.ajax({
				url:'<?php echo base_url();?>admin/login_auth',
				type:'POST',
				data:value,
				success:function(result){
					if(result==0){
						$("#msg").html('<div class="alert alert-danger alert-dismissable"><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Invalid UserName/Password.</b></div>');
						$("#msg").show();
						setTimeout(function(){$("#msg").hide(); }, 3000);

					}
					else{	
						window.location.href="<?php echo base_url();?>admin/dashboard";
					}
				},
				error: function (xhr, textStatus, errorThrown){
					alert(xhr.responseText);
				}
			});

		});

		$("#adminfpass").submit(function(e){
			e.preventDefault();
			var value =$("#adminfpass").serialize() ;
			$.ajax({
				url:'<?php echo base_url();?>admin/fpass',
				type:'POST',
				data:value,
				success:function(result){
					// if(result==0){
						// $("#msg").html('<div class="alert alert-danger alert-dismissable"><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Invalid UserName/Password.</b></div>');
						// $("#msg").show();
						// setTimeout(function(){$("#msg").hide(); }, 3000);

					// }
					// else{	
						// window.location.href="<?php echo base_url();?>admin/dashboard";
					// }
				},
				error: function (xhr, textStatus, errorThrown){
					alert(xhr.responseText);
				}
			});

		});
</script>
    <!-- Bootstrap -->
    <script src="<?= base_url(); ?>assets/admin/js/bootstrap/bootstrap.min.js"></script>
  </body>
</html>
