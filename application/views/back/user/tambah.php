<link href="<?php echo base_url(); ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
<!-- Content Header (Page header) -->
<?php
  $username=array(
                'id'=>'username','name'=>'username',
                'placeholder'=>'Masukkan Username',
                'value'=> isset($row['username'])? $row['username']:'',
                'class'=>'form-control'
    );
  $password=array(
                'id'=>'password','name'=>'password',
                'placeholder'=>'Masukkan Password',
                'value'=> isset($row['password'])? $row['password']:'',
                'class'=>'form-control'
    );
  $nama=array(
                'id'=>'namaLengkap','name'=>'namaLengkap',
                'placeholder'=>'Masukkan Nama Lengkap',
                'value'=> isset($row['nama'])? $row['nama']:'',
                'class'=>'form-control'
    );
  $hakAkses=array(''=>'-----------PILIH HAK AKSES-----------','1'=>'ADMIN', '2'=>'USER');
  if($this->uri->segment(3)=="550502001"){
    $aktif=array(''=>'-----------PILIH AKTIF-----------','1'=>'ACTIVE');
  }else{
    $aktif=array(''=>'-----------PILIH AKTIF-----------','1'=>'ACTIVE', '0'=>'BLOCK');
  }
?>
        <section class="content-header">
          <h1>
            <?php echo $title; ?>
            <small>Preview</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url('admin'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
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
                        <label>Username</label>
                        <div class="input-group">
                          <span class="input-group-addon">
                            <i class="fa fa-user"></i>
                          </span>
                          <?php echo form_input($username);?>
                        </div><!-- /input-group -->
                        <br/>
                        <div class="form-group">
                          <label for="namaLengkap">Nama Lengkap</label>
                          <?php echo form_input($nama);?>
                        </div><!-- /input-group -->

                        <div class="form-group">
                          <label for="aktif">Hak Akses</label>
                          <?php 
                            $ket='class="form-control" id="hakAkses"';
                            echo form_dropdown('hakAkses', $hakAkses, isset($row['hakAkses'])? $row['hakAkses']:'', $ket);
                          ?>
                          </div><!-- /input-group -->

                        <div class="form-group">
                          <div class="row">
                            <div class="col-xs-6">
                              <?php
                                if(isset($row['foto'])? $row['foto']:''){
                              ?>  
                                <label for="aktif">Foto</label><br>
                                <img src="<?php echo base_url('assets/upload/img/'.$row['foto']); ?>" class="img-responsive" />
                              <?php
                                }
                              ?>
                            </div>
                          </div>
                        </div><!-- /input-group -->

                      </div><!-- /.col-lg-6 -->

                      <div class="col-lg-6">
                        <label>Password</label>                        
                        <div class="input-group">
                          <span class="input-group-addon">
                            <i class="fa fa-lock"></i>
                          </span>
                          <?php echo form_input($password); ?>
                        </div><!-- /input-group -->
                        <br/>
                        <div class="form-group">
                          <label for="deskripsi">Alamat Lengkap</label>
                          <textarea class="form-control" id="deskripsi" name="deskripsi"><?php echo isset($row['deskripsi'])? $row['deskripsi']:''; ?></textarea>
                        </div><!-- /input-group -->

                        <div class="form-group">
                          <label for="aktif">Aktif</label>
                          <?php 
                            $ket='class="form-control" id="aktif"';
                            echo form_dropdown('aktif', $aktif, isset($row['aktif'])? $row['aktif']:'', $ket);
                          ?>
                          <br>
                          <?php echo  isset($row['keterangan'])? $row['keterangan']:''; ?>
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
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
    <!-- Page Script -->
    <script>
      $(function () {
        //Add text editor
        $("#compose-textarea").wysihtml5();
      });
    </script>
<script src="<?php echo base_url(); ?>assets/plugins/jquery-validate/jquery.validate.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
  $("#form-action").validate({
    rules:{
      username: {
        required: true,
        minlength: 5,
        maxlength: 30
      },
      password: {
        required: true,
        minlength: 6,
        maxlength: 40
      },
      namaLengkap: {
        required: true
      },
      hakAkses: {
        required: true
      }
    },

    messages: {
      username: {
        required: "Username harap di isi",
        minlength: "Minimal 5 Karakter",
        minlength: "Maksimal 30 Karakter",
      },
      password: {
        required: "Password harap di isi",
        minlength: "Minimal 6 Karakter",
        minlength: "Maksimal 40 Karakter",
      },
      namaLengkap: {
        required: "Nama Lengkap harap di isi"
      },
      hakAkses: {
        required: "Hak Akses harap di isi"
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