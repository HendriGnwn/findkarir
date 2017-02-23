<?php
  $ket = array(
      'id'=>'ket', 'name'=>'ket',
      'value'=> isset($row['ket'])? $row['ket']:'',
      'class'=>'form-control',
    );
  $file = array(
      'id'=>'file', 'name'=>'file',
    );
?>
<!--<link href="<?php echo base_url(); ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />-->
        <section class="content-header">
          <h1>
            <?php echo $title; ?>
            <small>Preview</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url('admin') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="<?php echo base_url('admin/perusahaan') ?>"><i class="fa fa-laptop"></i> Data Perusahaan</a></li>
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
                    Form Lanjutan
                  </h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-primary btn-xs" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-danger btn-xs" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <?php echo form_open_multipart($formAction, array('id'=>'form-action', 'role'=>'form')); ?>
                  <table class="table">
                    <tr class="bg-gray">
                      <td colspan="3"><i class="fa fa-globe"></i>&nbsp;&nbsp; Deskripsi Perusahaan</td>
                    </tr>
                    <tr>
                      <td width="30%">ID Perusahaan</td>
                      <td width="1%">:</td>
                      <td><b><?php echo $row['id_perusahaan']; ?></b></td>
                    </tr>
                    <tr>
                      <td width="30%">Perusahaan</td>
                      <td width="1%">:</td>
                      <td><b><?php echo $row['perusahaan']; ?></b></td>
                    </tr>
                    <tr>
                      <td width="30%">Alamat</td>
                      <td width="1%">:</td>
                      <td><?php echo $row['alamat'];?></td>
                    </tr>
                    <tr>
                      <td width="30%">Alamat Website</td>
                      <td width="1%">:</td>
                      <td><a href="http://<?php echo $row['web']; ?>"><?php echo $row['web']; ?></a></td>
                    </tr>
                    <tr class="bg-gray">
                      <td colspan="3"><i class="fa fa-globe"></i>&nbsp;&nbsp; Deskripsi Lowongan</td>
                    </tr>
                    <tr>
                      <td width="30%">ID Lowongan</td>
                      <td width="1%">:</td>
                      <td><b><?php echo $row['id_lowongan']; ?></b></td>
                    </tr>
                    <tr>
                      <td width="30%">Lowongan</td>
                      <td width="1%">:</td>
                      <td><?php echo $row['nm_lowongan']; ?></td>
                    </tr>
                    <tr>
                      <td width="30%">Daerah</td>
                      <td width="1%">:</td>
                      <td><?php echo $row['kota']; ?></td>
                    </tr>
                    <tr class="bg-gray">
                      <td colspan="3"><i class="fa fa-globe"></i>&nbsp;&nbsp; Deskripsi Aktivasi</td>
                    </tr>
                    <tr>
                      <td width="30%">ID Aktivasi</td>
                      <td width="1%">:</td>
                      <td><b><?php echo $row['id_aktivasi']; ?></b></td>
                    </tr>
                    <tr>
                      <td width="30%">Golongan || Deskripsi</td>
                      <td width="1%">:</td>
                      <td><span class="btn btn-sm padding-2 <?php echo $row['kode']; ?>"><?php echo $row['nm_golongan']; ?></span> || <?php echo $row['rating']; ?></td>
                    </tr>
                    <tr>
                      <td width="30%">Limit Waktu</td>
                      <td width="1%">:</td>
                      <td><?php echo $row['limit']; ?></td>
                    </tr>
                    <tr>
                      <td width="30%">Total Harga</td>
                      <td width="1%">:</td>
                      <td><b><?php echo $row['harga']; ?></b></td>
                    </tr>
                    <tr>
                      <td width="30%">Upload Bukti</td>
                      <td width="1%">:</td>
                      <td><?php echo form_upload($file); ?><small>*Max Size 1MB || Format .jpg|.png|.gif|.jpeg</small></td>
                    </tr>
                    <tr>
                      <td width="30%">Keterangan</td>
                      <td width="1%">:</td>
                      <td><?php echo form_input($ket); ?></td>
                    </tr>
                    <tr>
                      <td></td>
                      <td></td>
                      <td><button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp; &nbsp; <?php echo $button; ?></button></td>
                    </tr>
                  </table>
                </form>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
<script src="<?php echo base_url(); ?>assets/plugins/jquery-validate/jquery.validate.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
  $("#form-action").validate({
    rules:{
      file: {
        required: true,
      },
      ket: {
        required: true,
      },
    },

    messages: {
      file: {
        required: "File harap di isi",
       },
      ket: {
        required: "Keterangan harap di isi",
       },
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