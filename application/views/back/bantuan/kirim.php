<?php
  $nama = array(
      'id'=>'nama', 'name'=>'nama',
      'value'=> isset($row['nama'])? $row['nama']:'',
      'class'=>'form-control',
    );
  $subjek = array(
      'id'=>'subjek', 'name'=>'subjek',
      'value'=> isset($row['subjek'])? $row['subjek']:'',
      'class'=>'form-control',
    );
  $email = array(
      'id'=>'email', 'name'=>'email',
      'value'=> isset($row['email'])? $row['email']:'',
      'class'=>'form-control',
    );
  $pesan = array(
      'id'=>'pesan', 'name'=>'pesan',
      'value'=> isset($row['pesan'])? $row['pesan']:'',
      'class'=>'form-control',
    );
?>
<link href="<?php echo base_url(); ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
        <section class="content-header">
          <h1>
            <?php echo $title; ?>
            <small>Preview</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url('admin') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="<?php echo base_url('admin/bantuan') ?>"><i class="fa fa-inbox"></i> Data Bantuan</a></li>
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
                    <a href="<?php echo base_url('admin/bantuan'); ?>"><span class="btn btn-primary btn-flat padding-2"><i class="fa fa-arrow-left"></i>&nbsp; &nbsp; KEMBALI</span></a>
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
                      <td width="30%">Nama</td>
                      <td width="1%">:</td>
                      <td><?php echo isset($row['nama'])? $row['nama']:''; ?></td>
                    </tr>
                    <tr>
                      <td width="30%">Untuk (to)</td>
                      <td width="1%">:</td>
                      <td><?php echo form_input($email); ?></td>
                    </tr>
                    <tr>
                      <td width="30%">Subjek</td>
                      <td width="1%">:</td>
                      <td><?php echo form_input($subjek); ?></td>
                    </tr>
                    <tr>
                      <td width="30%">Pesan</td>
                      <td width="1%">:</td>
                      <td><?php echo form_textarea($pesan); ?></td>
                    </tr>
                    <tr>
                      <td></td>
                      <td></td>
                      <td><button type="submit" class="btn btn-primary"><i class="fa fa-location-arrow"></i>&nbsp; &nbsp; <?php echo $button; ?></button></td>
                    </tr>
                  </table>
                </form>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
        <script src="<?php echo base_url(); ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
    <!-- Page Script -->
    <script>
      $(function () {
        //Add text editor
        $("#pesan").wysihtml5();
      });
    </script>