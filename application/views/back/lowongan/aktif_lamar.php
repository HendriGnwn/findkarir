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
        <section class="content-header">
          <h1>
            <?php echo $title; ?>
            <small>Preview</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url('admin') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="<?php echo base_url('admin/golongan') ?>"><i class="fa fa-dashboard"></i> Data Lowongan</a></li>
            <li class="active"><?php echo $title; ?></li>
          </ol>
        </section>

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
          <div class="example-modal">
            <div class="modal">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><?php echo $title; ?></h4>
                  </div>
                  <div class="modal-body">
                    <?php echo form_open_multipart($formAction, array('id'=>'form-action', 'role'=>'form')); ?>
                     <label for="date_post">Tanggal Datang</label>
                     <?php echo form_input($tgl_datang); ?>
                     <br />
                     <label for="date_close">Jam Datang</label>
                      <?php echo form_input($jam_datang); ?>
                      <br />
                      <label for="ket">Datang ke Alamat</label>
                       <textarea class="form-control" id="ket" name="ket"><?php echo isset($row['ket'])? $row['ket']:''; ?></textarea>
                       <br />
                  </div>
                  <div class="modal-footer">
                      <a href="<?php echo base_url('admin/detailLowongan/'.$this->uri->segment('3').'/'.$this->uri->segment('4')); ?>" class="btn btn-danger pull-left" data-dismiss="modal">Close</a>
                      <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp; &nbsp; Save Changes</button>
                    </form>
                  </div>
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
          </div><!-- /.example-modal -->
        </div>
      </section>
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