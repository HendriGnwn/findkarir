<?php
  $judul = array(
      'id'=>'judul', 'name'=>'judul',
      'value'=> isset($row['judul'])? $row['judul']:'',
      'class'=>'form-control',
    );
  $deskripsi = array(
      'id'=>'deskripsi', 'name'=>'deskripsi',
      'value'=> isset($row['deskripsi'])? $row['deskripsi']:'',
      'class'=>'form-control',
    );
  $file = array(
      'id'=>'file', 'name'=>'file',
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
            <li><a href="<?php echo base_url('admin/berita') ?>"><i class="fa fa-book"></i> Data Berita</a></li>
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
                    <a href="<?php echo base_url('admin/berita'); ?>"><span class="btn btn-primary btn-flat padding-2"><i class="fa fa-arrow-left"></i>&nbsp; &nbsp; KEMBALI</span></a>
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
                      <td width="30%">Judul Berita</td>
                      <td width="1%">:</td>
                      <td><?php echo form_input($judul); ?></td>
                    </tr>
                    <tr>
                      <td width="30%">Deskripsi</td>
                      <td width="1%">:</td>
                      <td><?php echo form_textarea($deskripsi); ?></td>
                    </tr>
                     <tr>
                      <td width="30%">Terkait Foto</td>
                      <td width="1%">:</td>
                      <td>
                        <?php
                          echo form_upload($file);
                        ?>
                        *Max Size 1MB || Format .jpg|.png|.gif|.jpeg
                        <div class="row">
                          <div class="col-md-6">
                            <?php
                              $foto = isset($row['foto'])? $row['foto']:'';
                              if($foto!=null || $foto!=''){
                            ?>
                              <br>
                              <img src="<?php echo base_url('assets/upload/img/'.$foto) ?>" class="img-responsive" />
                            <?php
                              }
                            ?>
                          </div>
                        </div>
                      </td>
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
        <script src="<?php echo base_url(); ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
    <!-- Page Script -->
    <script>
      $(function () {
        //Add text editor
        $("#deskripsi").wysihtml5();
      });
    </script>        
<script src="<?php echo base_url(); ?>assets/plugins/jquery-validate/jquery.validate.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
  $("#form-action").validate({
    rules:{
      judul: {
        required: true,
      },
      deskripsi: {
        required: true,
      },
    },

    messages: {
      judul: {
        required: "Judul Berita harap di isi",
       },
      deskripsi: {
        required: "Deskripsi harap di isi",
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