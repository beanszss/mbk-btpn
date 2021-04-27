<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Mobility-cPnel</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url()?>assets/images/fav/favicon-32x32.png">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/backend/plugins/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/backend/plugins/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/backend/dist/css/AdminLTE.min.css">
  
</head>

<body class="login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="#"><b>Mobility</b>-cPanel</a>
    </div>
    <div class="login-box-body">
      
      <h1 class="text-center"><?php echo lang('login_heading');?></h1>
      <p class="text-center"><?php echo lang('login_subheading');?></p>

      <?php if($message == TRUE): ?>
        <div class="alert alert-warning alert-dismissable close" id="infoMessage">
          <a href="#" style="text-decoration:none;" class="close" data-dismiss="alert" aria-label="close" aria-hidden="true">&times;</a>
          <?php echo $message;?>
        </div>
      <?php endif;?>

      <?php echo form_open("auth/login");?>

      <div class="form-group has-feedback">
        <input type="text" name="identity" class="form-control" value="" id="identity" placeholder="Username">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>

      <div class="form-group has-feedback">
          <input type="password" class="form-control" name="password" value="" id="password"  placeholder="Password" />
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback" style="padding-bottom: 10px;">
        <?php echo form_submit('submit', lang('login_submit_btn'), 'class="btn btn-success btn-block pull-right"');?>
      </div>

      <?php echo form_close();?>
    </div>
  </div>
  
  <script src="<?php echo base_url();?>assets/backend/plugins/jquery/dist/jquery.min.js"></script>
  <script src="<?php echo base_url();?>assets/backend/plugins/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>
