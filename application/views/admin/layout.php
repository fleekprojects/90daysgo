<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?=site_admin_title?></title>

    <!-- Bootstrap -->
    <link href="<?= base_url(); ?>assets/admin/css/bootstrap/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?= base_url(); ?>assets/admin/css/fonts/font-awesome.min.css" rel="stylesheet">
	<!-- Datatables -->
    <link href="<?= base_url(); ?>assets/admin/css/datatables/jquery.dataTables.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/admin/css/datatables/responsive.dataTables.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/admin/css/datatables/buttons.dataTables.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/admin/css/datatables/fixedHeader.dataTables.min.css" rel="stylesheet">
	<!-- bootstrap-daterangepicker -->
    <link href="<?= base_url(); ?>assets/admin/css/plugins/daterangepicker.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?= base_url(); ?>assets/admin/css/plugins/nprogress.min.css" rel="stylesheet">
	<!-- Switchery -->
    <link href="<?= base_url(); ?>assets/admin/css/plugins/switchery.min.css" rel="stylesheet">
    <!-- Select2 -->
    <link href="<?= base_url(); ?>assets/admin/css/plugins/select2.min.css" rel="stylesheet">
    <!-- Text Editor -->
    <link href="<?= base_url(); ?>assets/admin/summernote/summernote.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="<?= base_url(); ?>assets/admin/css/style.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/admin/css/custom.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/admin/css/jquery-ui.css" rel="stylesheet">
	<!-- Head JS -->
	<script src="<?= base_url(); ?>assets/admin/js/jquery-3.3.1.js"></script>
	<script src="<?= base_url(); ?>assets/admin/js/jquery-ui.js"></script>
	<script src="<?= base_url(); ?>assets/admin/js/validator/jquery.validate.min.js"></script>
	<script src="<?= base_url(); ?>assets/admin/js/validator/additional-methods.min.js"></script>
	<style type="text/css">

  .error{
	color: #E74C3C;
    font-weight: 100;
  }

</style>
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="<?= base_url(); ?>" class="site_title" target="_blank">
				<img src="<?= base_url().'assets/front/images/'.site_logo;?>" style="max-width: 100%;" />
			  </a>
            </div>
            <div class="clearfix"></div>
            <br />
            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <ul class="nav side-menu">
				  <li><a href="<?= base_url(); ?>admin/dashboard"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>	
				  <li><a><i class="fa fa-edit"></i>CMS <span class="fa fa-chevron-down"></span></a>
					  <ul class="nav child_menu">
						<li><a href="<?= base_url(); ?>admin/posts">Blogs/Pages</a></li>
						<li><a href="<?= base_url(); ?>admin/faqs">Faqs</a></li>
						<li><a href="<?= base_url(); ?>admin/contact-queries">Contact/Queries</a></li>
					  </ul>
				  </li>
				  <li><a href="<?= base_url(); ?>admin/orders"><i class="fa fa-cubes"></i> <span>Orders</span></a></li>
				  <li><a href="<?= base_url(); ?>admin/promocode"><i class="fa fa-tag"></i> <span>Promo code</span></a></li>
				</ul>

				<h3>Course Plans</h3>
                <ul class="nav side-menu">
					<?php
					  $side_cat=$viewData['side_cat'];
					  unset($viewData['side_cat']);
					  foreach($side_cat AS $scat){
						echo '<li><a href="'.base_url().'admin/courses?parent='.$scat['id'].'"><i class="fa fa-circle-o"></i> <span>'.$scat['title'].'</span></a></li>';
					  }
					?>
                </ul>
				<h3>Workout Settings</h3>
                <ul class="nav side-menu">
					<li><a><i class="fa fa-edit"></i>Courses <span class="fa fa-chevron-down"></span></a>
					  <ul class="nav child_menu">
						<?php
						  foreach($side_cat AS $scat){
							echo '<li><a href="'.base_url().'admin/courses?parent='.$scat['id'].'">'.$scat['title'].'</a></li>';
						  }
						?>
					  </ul>
					</li>
					<li><a href="<?= base_url(); ?>admin/parents"><i class="fa fa-sitemap"></i> <span>Parents</span></a></li>
                </ul>
              </div>
            </div>
            <!-- /sidebar menu -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>
               <div class="nav toggle">
                <a data-toggle="modal" data-target="#conModal"  ><i class="fa fa-gears"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Admin <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a data-toggle="modal" data-target="#proModal"> Update Profile</a></li>
                    <li><a href="<?= base_url('admin/logout')?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->
         <!-----------------Settings Modal ------------------>
    <form role="form" id="settingsform" method="post" action="<?= base_url().'admin/updatesettings'; ?>" enctype="multipart/form-data" name="frmPage">
    <div class="modal fade" id="conModal"  tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h3 class="panel-title" id="myModalLabel">Update Website Settings</h3>
         </div>
         
         <div class="modal-body">
           <div id="settingsmsg"></div>
          <div class="form-group col-md-6">
           <label>Site Name:</label>
           <input type="text" name="site_title" value="<?=site_title?>" class="form-control" required />
          </div>
          <div class="form-group col-md-6">
           <label>Admin Site Name:</label>
           <input type="text" name="site_admin_title" value="<?=site_admin_title?>" class="form-control" required />
          </div>
          <div class="form-group col-md-6">
           <label>Site Email:</label>
           <input type="text" name="site_email" value="<?=site_email?>" class="form-control" required />
          </div>
          <div class="form-group col-md-6">
           <label>Contact No:</label>
           <input type="text" name="site_contact" value="<?=site_contact?>" class="form-control" required />
          </div>
          <div class="form-group col-md-6">
           <label>Address:</label>
           <input type="text" name="site_address" value="<?=site_address?>" class="form-control" required>
          </div>
          <div class="form-group col-md-6">
           <label>Website:</label>
           <input type="text"   name="site_url" value="<?=site_url?>" class="form-control" required />
          </div> 
		  
          <div class="form-group col-md-6">
           <label>Timezone:</label>
           <input type="text"   name="site_timezone" value="<?=site_timezone?>" class="form-control" required />
          </div> 
		  <div class="form-group col-md-6">
           <label>Site Logo:</label>
           <input type="file" name="site_logo" class="form-control" />
          </div>

          <div class="form-group col-md-6">
           <label>SMTP Host:</label>
           <input type="text" name="smtp_host" value="<?=smtp_host?>" class="form-control" >
          </div>
          <div class="form-group col-md-6">
           <label>SMTP Email:</label>
           <input type="text" name="smtp_email" value="<?=smtp_email?>" class="form-control" >
          </div>
          <div class="form-group col-md-6">
           <label>SMTP Password:</label>
           <input type="password" name="smtp_password" value="" class="form-control">
           <p> leave empty if don't want to change </p>
          </div>
          <div class="form-group col-md-6">
           <label>SMTP Port:</label>
           <input type="number" step="any" min="0" name="smtp_port" value="<?=smtp_port?>" class="form-control">
          </div>
          <div class="clearfix"></div>
         </div>
         <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal"> Close</button>
          <button type="submit" class="btn btn-warning"><i class="fa fa-plus"></i>   Update</button>
         </div>
      </div>
     </div>
    </div>
   </form>
   <!----------------------/Settings Modal ----------------------->
   
         <!-----------------Profile Modal ------------------>
    <form role="form" id="profileform" method="post" action="<?= base_url().'admin/updateprofile'; ?>" >
    <div class="modal fade" id="proModal"  tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h3 class="panel-title" id="myModalLabel">Update Profile Settings</h3>
         </div>
         
         <div class="modal-body">
           <div id="profilemsg"></div>
          <div class="form-group col-md-6">
           <label>User Name:</label>
           <input type="text" name="user_name" value="<?= $_SESSION['admin_user_name']; ?>" class="form-control" required />
          </div>
          <div class="form-group col-md-6">
           <label>Admin Email:</label>
           <input type="text" name="user_email" value="<?= $_SESSION['admin_email']; ?>" class="form-control" required />
          </div>
          <div class="form-group col-md-6">
           <label>Admin Password:</label>
           <input type="password" name="user_password" value="" class="form-control">
           <p> leave empty if don't want to change </p>
          </div>
          <div class="clearfix"></div>
         </div>
         <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal"> Close</button>
          <button type="submit" class="btn btn-warning"><i class="fa fa-plus"></i>   Update</button>
         </div>
      </div>
     </div>
    </div>
   </form>
   <!----------------------/Settings Modal ----------------------->

        <!-- page content -->
        <div class="right_col" role="main">
			<?php  $this->load->view($view,$viewData); ?>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Powered by <?= site_title; ?></a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>
	
    <!-- Bootstrap -->
    <script src="<?= base_url(); ?>assets/admin/js/bootstrap/bootstrap.min.js"></script>
    <!-- DataTables -->
    <script src="<?= base_url(); ?>assets/admin/js/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url(); ?>assets/admin/js/datatables/dataTables.responsive.min.js"></script>
    <script src="<?= base_url(); ?>assets/admin/js/datatables/dataTables.buttons.min.js"></script>
    <script src="<?= base_url(); ?>assets/admin/js/datatables/buttons.flash.min.js"></script>
    <script src="<?= base_url(); ?>assets/admin/js/datatables/jszip.min.js"></script>
    <script src="<?= base_url(); ?>assets/admin/js/datatables/pdfmake.min.js"></script>
    <script src="<?= base_url(); ?>assets/admin/js/datatables/vfs_fonts.js"></script>
    <script src="<?= base_url(); ?>assets/admin/js/datatables/buttons.html5.min.js"></script>
    <script src="<?= base_url(); ?>assets/admin/js/datatables/buttons.print.min.js"></script>
    <script src="<?= base_url(); ?>assets/admin/js/datatables/buttons.colVis.min.js"></script>
    <script src="<?= base_url(); ?>assets/admin/js/datatables/dataTables.fixedHeader.min.js"></script>
	<!-- bootstrap-daterangepicker -->
	<script src="<?= base_url(); ?>assets/admin/js/plugins/daterangepicker.min.js"></script>
    <!-- FastClick -->
    <script src="<?= base_url(); ?>assets/admin/js/plugins/fastclick.min.js"></script>
    <!-- NProgress -->
    <script src="<?= base_url(); ?>assets/admin/js/plugins/nprogress.min.js"></script>
    <!-- Moment JS -->
    <script src="<?= base_url(); ?>assets/admin/js/plugins/moment.min.js"></script>
    <!-- Switchery -->
    <script src="<?= base_url(); ?>assets/admin/js/plugins/switchery.min.js"></script>
    <!-- jquery.inputmask -->
    <script src="<?= base_url(); ?>assets/admin/js/plugins/jquery.inputmask.bundle.min.js"></script>
    <!-- Sweet Alert -->
    <script src="<?= base_url(); ?>assets/admin/js/plugins/sweetalert.min.js"></script>
    <!-- Select2 -->
    <script src="<?= base_url(); ?>assets/admin/js/plugins/select2.min.js"></script>
    <!-- Text Editor -->
    <script src="<?= base_url(); ?>assets/admin/js/plugins/summernote.js"></script>
    <!-- Custom Theme Scripts -->
	<script> var baseurl="<?= base_url();?>";</script>
    <script src="<?= base_url(); ?>assets/admin/js/custom.min.js"></script>
    <script src="<?= base_url(); ?>assets/admin/js/scripts.js"></script>
  <script>

</script>
  </body>
</html>