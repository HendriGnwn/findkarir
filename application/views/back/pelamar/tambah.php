<link href="<?php echo base_url(); ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
<!-- Content Header (Page header) -->
<?php
  $kode=array(
                'id'=>'kode','name'=>'kode',
                'placeholder'=>'Masukkan Kode Kontrak',
                'value'=> isset($row['kode'])? $row['kode']:'',
                'class'=>'form-control'
    );
  $nama=array(
                'id'=>'nama','name'=>'nama',
                'placeholder'=>'Masukkan Nama Kontrak',
                'value'=> isset($row['nama'])? $row['nama']:'',
                'class'=>'form-control'
    );
  $tgl= array(
                'id'=>'tgl','name'=>'tgl',
                'placeholder'=>'Tgl Awal Kontrak',
                'value'=> isset($row['tgl'])? $row['tgl']:'',
                'class'=>'form-control'
    );
  $tgl_akhir= array(
                'id'=>'tgl_akhir','name'=>'tgl_akhir',
                'placeholder'=>'Tgl Akhir Kontrak',
                'value'=> isset($row['tgl_akhir'])? $row['tgl_akhir']:'',
                'class'=>'form-control'
    );
  $nilai_kontrak= array(
                'id'=>'nilai_kontrak','name'=>'nilai_kontrak',
                'placeholder'=>'Nilai Kontrak',
                'value'=> isset($row['nilai_kontrak'])? $row['nilai_kontrak']:'',
                'class'=>'form-control'
    );
$pdf=array('id'=>'pdf', 'name'=>'pdf');
?>
        <section class="content-header">
          <h1>
            <?php echo $title; ?>
            <small>Preview</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url('admin'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="<?php echo base_url('admin/kontrak'); ?>">Manajemen Kontrak</a></li>
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
                <?php echo form_open_multipart($formAction, array('id'=>'form-action', 'role'=>'form')); ?>
                  <div class="box-body">
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label for="kode">Kode Kontrak</label>
                          <?php echo form_input($kode);?>
                        </div><!-- /input-group -->
                        <div class="form-group">
                          <label for="nama">Nama Kontrak</label>
                          <?php echo form_textarea($nama);?>
                        </div><!-- /input-group -->
                        
                        <div class="form-group">
                          <label for="pdf">File PDF</label>
                          <?php 
                            echo form_upload($pdf);
                          ?>
                          <b>*Max size 15MB, Format Extension (.pdf)</b>
                          <br>
                          <br>
                          <a target="_BLANK" href="<?php echo base_url('assets/upload/pdf/'); echo "/"; echo isset($row['name_pdf'])? $row['name_pdf']:''; ?>"><?php echo isset($row['name_pdf'])? $row['name_pdf']:''; ?></a>
                        </div><!-- /input-group -->
                      </div><!-- /.col-lg-6 -->

                      <div class="col-lg-6">
                        <div class="form-group">
                          <label for="kat">Kategori Kontrak</label>
                          <select name="kat" id="kat" class="form-control">
                            <option value="">...</option>
                            <?php
                              $kat=isset($row['kat'])? $row['kat']:'';
                              foreach($kategori as $data){
                            ?>
                            <option <?php if($data->id_k_kontrak==$kat){echo "SELECTED";} ?> value="<?php echo $data->id_k_kontrak; ?>"><?php echo $data->nm_k_kontrak; ?></option>
                            <?php
                              }
                            ?>
                          </select>
                        </div><!-- /input-group -->
                        <div class="form-group">
                          <label for="tgl">Tanggal Awal & Akhir Kontrak</label>
                          <div class="row">
                            <div class="col-xs-6">
                              <?php echo form_input($tgl);?>
                            </div>
                            <div class="col-xs-6">
                              <?php echo form_input($tgl_akhir);?>
                            </div>
                          </div>
                        </div><!-- /input-group -->
                        <label for="nilai_kontrak">Nilai Kontrak</label>
                        <div class="input-group">
                          
                          <span class="input-group-addon"><b>Rp.</b></span>
                            <?php echo form_input($nilai_kontrak);?>
                          <span class="input-group-addon"><b>,-</b></span>
                        </div><!-- /input-group -->
                      </div><!-- /.col-lg-6 -->
                    </div><!-- /.row -->
                   
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <?php
                    if($title=="Edit Kontrak Perusahaan"){
                    ?>
                    <a href="<?php echo base_url('admin/detailKontrak/'); echo "/".$this->uri->segment(4);?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i>&nbsp; &nbsp; KEMBALI</a>&nbsp;|&nbsp;
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
      kode:{
        required: true,
      },
      nama: {
        required: true,
        maxlength: 1000
      },
      kat:{
        required: true,
      },
<?php if($title=="Tambah Kontrak Perusahaan"){ ?>
      pdf:{required: true,},
<?php } ?>
      tgl:{required: true,},
      tgl_akhir:{required: true,},
      nilai_kontrak:{required: true, digits: true},
    },

    messages: {
      kode:{
        required: "Kode Kontrak harap di isi",
      },
      nama: {
        required: "Nama Kontrak harap di isi",
        minlength: "Maksimal 1000 Karakter",
      },
      kat: {
        required: "Kategori harap di isi"
      },
<?php if($title=="Tambah Kontrak Perusahaan"){ ?>
      pdf: {
        required: "File PDF harap di upload"
      },
<?php } ?>      
      tgl: {
        required: "Tgl Awal harap di isi"
      },
      tgl_akhir: {
        required: "Tgl Akhir harap di isi"
      },
      nilai_kontrak: {
        required: "Nilai Kontrak harap di isi",
        digits: "Nilai Kontrak harus berisi Angka"
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
<script src="<?php echo base_url('assets/plugins/input-mask/jquery.inputmask.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/plugins/input-mask/jquery.inputmask.date.extensions.js')?>" type="text/javascript"></script>
<!--<script src="<?php echo base_url('assets/plugins/input-mask/jquery.inputmask.extensions.js')?>" type="text/javascript"></script>-->
<script>
$(function () {
        //Datemask dd/mm/yyyy
        $("#tgl").inputmask("yyyy-mm-dd", {"placeholder": "yyyy-mm-dd"});
        $("#tgl_akhir").inputmask("yyyy-mm-dd", {"placeholder": "yyyy-mm-dd"});
});
</script>