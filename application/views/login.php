<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title><?php echo $this->Config_Model->get_app_name_url() ?> | Login Administrator</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta name="Description" content="Login Website Admin <?php echo $this->Config_Model->get_app_name_url() ?>" />
    <meta name="Author" content="Hendri Gunawan" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.hg.css" />
    <link rel="shortcut icon" href="<?php echo base_url('assets/img/icon.png') ?>" />
    <!-- Bootstrap 3.3.2 -->
    <link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('assets/css/style.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('assets/css/style-hg.css'); ?>" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/colors/red.css');?>" title="red" media="screen" />
	<meta name="robots" content="noindex,nofollow">
	<meta name="googlebot" content="noindex,nofollow">
    <!-- FontAwesome 4.3.0
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />-->
    <!-- FontAwesome 4.3.0 -->
    <link href="<?php echo base_url('assets/font_awesome/css/font-awesome.min.css');?>" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo base_url('assets/dist/css/AdminLTE.min.css');?>" rel="stylesheet" type="text/css" />
  </head>
  <body class="login-page">
     <?php
        if($this->session->flashdata('notification')!=null){
      ?>
        <div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h4 align="center"><i class="icon fa fa-info"></i> Informasi</h4>
          <center><?php echo $this->session->flashdata('notification'); ?></center>
        </div>
        <?php
          }
        ?>
    <div class="login-box">
      <div class="login-logo">
        <a href="<?php echo base_url();?>"><img src="<?php echo $logo; ?>" class="img-logo" /></a>
      </div><!-- /.login-logo -->
      
      <div class="box box-danger padding-5">
            <div class="box-header align-center">
              <h4 class="box-title raleway padding-5" style="font-weight: normal;"><?php echo $message; ?></h4>
            </div>
            <div class="box-body">
                <!-- Start daftar Form -->
                <?php echo form_open($formAction, array('class'=>'contact-form form-style', 'id'=>'contact-form')); ?>
                <div class="form-group has-feedback">
                  <input type="text" name="username" id="username" class="form-control" placeholder="Username" required/>
                  <?php echo form_error('username'); ?>
                  <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                  <input type="password" name="password" id="password" class="form-control" placeholder="Password" required/>
                  <?php echo form_error('password'); ?>
                  <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                
                <button type="submit" name="submit" id="submit" class="btn-system btn-medium btn-block"><i class="fa fa-sign-in"></i>&nbsp;&nbsp; LOGIN</button>
               
                </form>
                <!-- End Daftar Form -->
            </div>
        </div>
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.3 -->
    <script src="<?php echo base_url('assets/plugins/jQuery/jQuery-2.1.3.min.js');?>"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js');?>" type="text/javascript"></script>
  </body>
</html>