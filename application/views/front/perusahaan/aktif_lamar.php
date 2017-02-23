<?php
  $tgl_datang= array(
      'id'=>'tgl_datang', 'name'=>'tgl_datang',
      'value'=> isset($row['tgl_datang'])? $row['tgl_datang']:'',
      'placeholder'=>'Tanggal Datang',
      'class'=>'form-control',
    );
  $jam_datang= array(
      'id'=>'jam_datang', 'name'=>'jam_datang',
      'value'=> isset($row['jam_datang'])? $row['jam_datang']:'',
      'placeholder'=>'Jam Datang',
      'class'=>'form-control',
    );
?>
<style>
      .example-modal .modal {
        position: relative;
        top: auto;
        bottom: auto;
        right: auto;
        left: auto;
        display: block;
        z-index: 1;
      }
      .example-modal .modal {
        background: transparent!important;
      }
    </style>
<!-- Content Header (Page header) -->
        <!-- Start Page Banner -->
    <div class="page-banner">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <h2>EDIT Status Pelamar</h2>
          </div>
          <div class="col-md-6">
            <ul class="breadcrumbs">
              <li><a href="<?php echo base_url(); ?>">Beranda</a></li>
              <li>Akun Perusahaan</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <!-- End Page Banner -->
    
    
    
    
    <!-- Start Content -->
    <div id="content">
      <div class="container">
        <!-- Main content -->
        <section class="content"><!-- Small boxes (Stat box) -->
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
              <div class="col-md-2">

              </div>
              <div class="col-md-8">
                  <div class="box box-danger">
                        <div class="box-header align-center">
                          <h4 class="box-title raleway padding-5" style="font-weight: normal;"><a href="<?php echo base_url('company/detailIklan/'.$this->uri->segment('3')); ?>"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp; Konfirmasi Pelamar segera Datang</a></h4>
                        </div>
                        <div class="box-body">
                        <form role="form" class="contact-form form-style" id="form-action" method="post" action="<?php echo $formAction; ?>">
                            <div class="form-group">
                            <div class="controls">
                            <?php echo form_input($tgl_datang); ?>
                            </div>
                            </div>
                            <div class="form-group">
                            <div class="controls">
                            <?php echo form_input($jam_datang); ?>
                            </div>
                            </div>
                            <div class="form-group">
                            <div class="controls">
                            <textarea placeholder="Alamat yang di Tuju" class="form-control" id="ket" name="ket"><?php echo isset($row['ket'])? $row['ket']:''; ?></textarea>
                            </div>
                            </div>

                            <button type="submit" id="submit" class="btn-system btn-medium btn-block"><i class="fa fa-send"></i>&nbsp;&nbsp; KIRIM SEKARANG</button>
                            </form>
                          </div>
                        </div>
              </div>
              <div class="col-md-2">

              </div>
          </div>
      </section>
    </div>
  </div>
<script src="<?php echo base_url(); ?>assets/plugins/jquery-validate/jquery.validate.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
  $("#form-action").validate({
    rules:{
      tgl_datang:{
        required: true,
      },
      jam_datang:{
        required: true,
      },
      ket:{
        required: true,
      },

    },

    messages: {
      tgl_datang: {
        required: "Tanggal Datang harap di isi",
       },
      jam_datang: {
        required: "Jam Datang harap di isi",
       },
      ket: {
        required: "Keterangan Alamat harap di isi",
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
        $("#tgl_datang").inputmask("yyyy-mm-dd", {"placeholder": "yyyy-mm-dd"});
        $("#jam_datang").inputmask("hh:mm:ss", {"placeholder": "hh:mm:ss"});
});
</script>