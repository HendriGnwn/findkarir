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
            <li><a href="<?php echo base_url('admin/bank') ?>"><i class="fa fa-dollar"></i> Data Rekening Bank</a></li>
            <li class="active"><?php echo $title; ?></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content"><!-- Small boxes (Stat box) -->
                <?php
                  $this->load->model('my_model');
                  $this->load->helper('fungsi_date');
                  if($this->session->flashdata('notification')!=null){
                ?>
                  <div class="alert alert-info alert-warning">
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
                    <form action="<?php echo $formAction; ?>" method="POST" id="form-action" enctype="multipart/form-data">
                      <label for="no_rek">Nomor Rekening</label>
                      <input type="text" name="no_rek" value="<?php echo isset($row['no_rek'])? $row['no_rek']:''; ?>" class="form-control" id="no_rek"/>
                      <br/>
                      <label for="nm_rek">Atas Nama</label>
                      <input type="text" name="nm_rek" value="<?php echo isset($row['nm_rek'])? $row['nm_rek']:''; ?>" class="form-control" id="nm_rek"/>
                      <br>
                      <label for="nm_bank">Nama Bank</label>
                      <input type="text" name="nm_bank" value="<?php echo isset($row['nm_bank'])? $row['nm_bank']:''; ?>" class="form-control" id="nm_bank"/>
                      <br>
                      <label for="file">Logo Bank</label>
                      <input type="file" name="file" /><small>*Maz SIze 1MB || Format .jpg|.png|.jpeg|.gif</small>
                  </div>
                  <div class="modal-footer">
                      <a href="<?php echo base_url('admin/bank'); ?>" class="btn btn-danger pull-left" data-dismiss="modal">Close</a>
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
      no_rek:{
        required: true,
      },
      nm_rek:{
        required: true,
      },
      nm_bank:{
        required: true,
      },
    },

    messages: {
      no_rek: {
        required: "Nomor Rekening harap di isi",
       },
      nm_rek: {
        required: "Atas Nama harap di isi",
       },
      nm_bank: {
        required: "Nama Bank harap di isi",
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