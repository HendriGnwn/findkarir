<!-- Content Header (Page header) -->
<?php
  $passlama=array(
                'id'=>'passlama','name'=>'passlama',
                'placeholder'=>'Password Lama',
                'class'=>'form-control'
    );
  $password=array(
                'id'=>'password','name'=>'password',
                'placeholder'=>'Password Baru',
                'class'=>'form-control'
    );
  $konfpassword=array(
                'id'=>'konfpassword','name'=>'konfpassword',
                'placeholder'=>'Konfirmasi Password',
                'class'=>'form-control'
    );
?>
        <section class="content-header">
          <h1>
            <?php echo $title; ?>
            <small>Preview</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#">Manajemen User</a></li>
            <li class="active"><?php echo $title ?></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
                <?php
                  if($this->session->flashdata('notification')!=null){
                ?>
                  <div class="alert alert-info alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-info"></i> Informasi</h4>
                    <?php echo $this->session->flashdata('notification'); ?>
                  </div>
                  <?php
                    }
                  ?>
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Isi Form di bawah ini.</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-primary btn-xs" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-danger btn-xs" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open($formAction, array('id'=>'form-action', 'role'=>'form')); ?>
                  <div class="box-body">
                    <div class="row">
                      <div class="col-lg-6">
                        <label>Password Lama</label>
                        <div class="input-group">
                          <span class="input-group-addon">
                            <i class="fa fa-lock"></i>
                          </span>
                          <?php echo form_password($passlama);?>
                        </div><!-- /input-group -->
                        <br>
                        <label>Password Baru</label>    
                        <div class="input-group">
                          <span class="input-group-addon">
                            <i class="fa fa-lock"></i>
                          </span>
                          <?php echo form_password($password); ?>
                        </div><!-- /input-group -->
                        <br>
                        <label>Konfirmasi Password Baru</label>    
                        <div class="input-group">
                          <span class="input-group-addon">
                            <i class="fa fa-lock"></i>
                          </span>
                          <?php echo form_password($konfpassword); ?>
                        </div><!-- /input-group -->

                      </div><!-- /.col-lg-6 -->
                    </div><!-- /.row -->
                   
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <?php
                    if($title=="Edit User"){
                    ?>
                    <a href="<?php echo base_url('admin/user'); ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i>&nbsp; &nbsp; KEMBALI</a>&nbsp;|&nbsp;
                    <?php
                    }
                    ?>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp; &nbsp; <?php echo $button; ?></button>
                  </div>
                <?php echo form_close(); ?>
              </div><!-- /.box -->
              </form>
        </section><!-- /.content -->
<script src="<?php echo base_url(); ?>assets/plugins/jquery-validate/jquery.validate.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
  $("#form-action").validate({
    rules:{
      passlama: {
        required: true,
      },
      password: {
        required: true,
        minlength: 5,
        maxlength: 30,
      },
      konfpassword: {
        required: true,
        minlength: 5,
        maxlength: 30,
      }
    },

    messages: {
      passlama: {
        required: "Password Lama harap di isi",
      },
      password: {
        required: "Password Baru harap di isi",
        minlength: "Minimal 6 Digit",
        maxlength: "Maksimal 30 Digit",
      },
      konfpassword: {
        required: "Konfirmasi Password harap di isi",
        minlength: "Minimal 6 Digit",
        maxlength: "Maksimal 30 Digit",
      }
    }
  });
});
</script>
<style>
  label.error {
    margin: 2px 0 0 10px;
    color: #ff6666;
  }
</style>