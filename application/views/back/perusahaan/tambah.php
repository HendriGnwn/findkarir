<link href="<?php echo base_url(); ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
<?php
  $nama=array(
                'id'=>'nama','name'=>'nama',
                'placeholder'=>'Masukkan Nama Perusahaan',
                'value'=> isset($row['nm_perusahaan'])? $row['nm_perusahaan']:'',
                'class'=>'form-control'
    );
  $alamat=array(
                'id'=>'alamat','name'=>'alamat',
                'placeholder'=>'Masukkan Alamat Lengkap',
                'value'=> isset($row['alamat'])? $row['alamat']:'',
                'class'=>'form-control',
                'height'=>'100px',
    );
  $tahun=array(
                'id'=>'tahun','name'=>'tahun',
                'placeholder'=>'Tahun',
                'value'=> isset($row['tahun'])? $row['tahun']:'',
                'class'=>'form-control',
    );
  $telp=array(
                'id'=>'no_telp','name'=>'no_telp',
                'placeholder'=>'No Telp',
                'maxlength'=>'12',
                'value'=> isset($row['no_telp'])? $row['no_telp']:'',
                'class'=>'form-control',
    );
  $fax=array(
                'id'=>'no_fax','name'=>'no_fax',
                'placeholder'=>'No Fax',
                'maxlength'=>'12',
                'value'=> isset($row['no_fax'])? $row['no_fax']:'',
                'class'=>'form-control',
    );
  $email=array(
                'id'=>'email','name'=>'email',
                'placeholder'=>'Masukkan Email',
                'value'=> isset($row['email'])? $row['email']:'',
                'class'=>'form-control',
    );
  $siup=array(
                'id'=>'siup','name'=>'siup',
  );
  $no_izin=array(
                'id'=>'no_izin','name'=>'no_izin',
                'placeholder'=>'Masukkan Nomor Izin Perusahaan',
                'value'=> isset($row['no_izin'])? $row['no_izin']:'',
                'class'=>'form-control',
    );
  $web=array(
                'id'=>'web','name'=>'web',
                'placeholder'=>'Masukkan Alamat Website',
                'value'=> isset($row['web'])? $row['web']:'',
                'class'=>'form-control',
    );
  $password=array(
                'id'=>'password','name'=>'password',
                'placeholder'=>'Masukkan Password',
                'value'=> isset($row['pass_view'])? $row['pass_view']:'',
                'class'=>'form-control',
    );
  $lulusan=array(''=>'...','SMA/SMK SEDERAJAT'=>'SMA/SMK SEDERAJAT', 'DIPLOMA 3'=>'DIPLOMA 3', 'DIPLOMA 4'=>'DIPLOMA 4', 'SARJANA TINGKAT I'=>'SARJANA TINGKAT I', 'SARJANA TINGKAT II'=>'SARJANA TINGKAT II', 'SARJANA TINGKAT III'=>'SARJANA TINGKAT III');
  $file=array('id'=>'file', 'name'=>'file');
?>
        <section class="content-header">
          <h1>
            <?php echo $title; ?>
            <small>Preview</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url('admin') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><?php echo $title; ?></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
                <?php
                  $this->load->helper('fungsi_date');
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
            <div class="col-xs-12">
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">
                    Isi form di Bawah ini&nbsp;&nbsp;<a href="<?php echo base_url('admin/perusahaan'); ?>"><span class="btn btn-primary btn-flat padding-2"><i class="fa fa-arrow-left"></i>&nbsp; &nbsp; KEMBALI</span></a>
                  </h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-primary btn-xs" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-danger btn-xs" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <?php echo form_open_multipart($formAction, array('id'=>'form-action', 'role'=>'form')); ?>
                  <table class="table">
                    <tr>
                      <td width="30%">Nama Perusahaan</td>
                      <td width="1%">:</td>
                      <td><?php echo form_input($nama);?></td>
                    </tr>
                    <tr>
                      <td width="30%">Nomor Izin Perusahaan</td>
                      <td width="1%">:</td>
                      <td><?php echo form_input($no_izin);?></td>
                    </tr>
                    <tr>
                      <td width="30%">Logo</td>
                      <td width="1%">:</td>
                      <td><?php echo form_upload($file); ?><small>*Max Size 1MB || Format .jpg|.png|.gif|.jpeg</small></td>
                    </tr>
                    <tr>
                      <td width="30%">Alamat</td>
                      <td width="1%">:</td>
                      <td><textarea class="form-control" id="alamat" name="alamat" value="Masukkan Tentang Perusahaan"><?php echo isset($row['alamat'])? $row['alamat']:''; ?></textarea></td>
                    </tr>
                    <tr>
                      <td width="30%">Tentang</td>
                      <td width="1%">:</td>
                      <td><textarea class="form-control" id="tentang" name="tentang" value="Masukkan Tentang Perusahaan"><?php echo isset($row['tentang'])? $row['tentang']:''; ?></textarea></td>
                    </tr>
                    <tr>
                      <td width="30%">No Telp</td>
                      <td width="1%">:</td>
                      <td><div class="input-group">
                          <span class="input-group-addon">
                            <i class="fa fa-phone"></i>
                          </span>
                          <?php echo form_input($telp);?>
                        </div><!-- /input-group --></td>
                    </tr>
                    <tr>
                      <td width="30%">No Fax</td>
                      <td width="1%">:</td>
                      <td><?php echo form_input($fax); ?></td>
                    </tr>
                    <tr>
                      <td width="30%">Email</td>
                      <td width="1%">:</td>
                      <td><div class="input-group">
                          <span class="input-group-addon">
                            <i class="fa fa-envelope"></i>
                          </span>
                          <?php echo form_input($email);?>
                        </div><!-- /input-group --></td>
                    </tr>
                    <tr>
                      <td width="30%">Alamat Website</td>
                      <td width="1%">:</td>
                      <td><div class="input-group">
                          <span class="input-group-addon">
                            <i class="fa fa-globe"></i>
                          </span>
                          <?php echo form_input($web);?>
                        </div><!-- /input-group --></td>
                    </tr>
                    <tr>
                      <td colspan="3"><b>Keterangan Lainnya</b></td>
                    </tr>
                    <tr>
                      <td width="30%">Password</td>
                      <td width="1%">:</td>
                      <td><div class="input-group">
                          <span class="input-group-addon">
                            <i class="fa fa-lock"></i>
                          </span>
                          <?php echo form_input($password);?>
                        </div><!-- /input-group --></td>
                    </tr>
                    <tr>
                      <td></td>
                      <td></td>
                      <td colspan="3"><button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-save"></i>&nbsp; &nbsp; <?php echo $button; ?></button></td>
                    </tr>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
<!-- Bootstrap WYSIHTML5 -->
    <script src="<?php echo base_url('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js'); ?>" type="text/javascript"></script>
    <!-- Page Script -->
    <script>
      $(function () {
        //Add text editor
        $("#tentang").wysihtml5();
        $("#compose-textarea1").wysihtml5();
      });
    </script>
    <script src="<?php echo base_url(); ?>assets/plugins/jquery-validate/jquery.validate.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
  $("#form-action").validate({
    rules:{
      nama: {
        required: true,
      },
      alamat: {
        required: true,
      },
      tentang:{
        required: true,
      },
      web: {
        required: true,
      },
      no_izin:{
        required: true,
      },
      siup: {
        required: true,
      },
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
      no_telp:{
        required: true,
        digits: true,
      },
      no_fax:{
        digits: true,
      },
      email:{
        required: true,
        email: true,
      },
<?php if($title=="Tambah Perusahaan"){ ?>  
      file:{required: true,}
  <?php
    }
  ?>
    },

    messages: {
      nama: {
        required: "Nama Perusahaan harap di isi",
       },
      alamat: {
        required: "Alamat harap di isi"
      },
      siup: {
        required: "Surat Izin harap di Upload"
      },
      web: {
        required: "Alamat Website harap di isi"
      },
      no_izin: {
        required: "No Izin harap di isi"
      },

      tentang: {
        required: "Tentang harap di isi"
      },
      email: {
        required: "Email harap di isi"
      },
      username: {
        required: "Username harap di isi",
        minlength: "Minimal 5 Karakter",
        minlength: "Maksimal 30 Karakter",
      },
      password: {
        required: "Password harap di isi",
        minlength: "Minimal 6 Karakter",
        minlength: "Maksimal 30 Karakter",
      },
<?php if($title=="Tambah Perusahaan"){ ?>
      file: {
        required: "Logo harap di upload"
      },
  <?php
    }
  ?>
      no_telp: {
        required: "No Telp harap di isi",
        digits: "Inputan harus Angka"
      },
      no_fax: {
        digits: "Inputan harus Angka"
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
   