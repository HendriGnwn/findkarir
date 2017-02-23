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
            <li><a href="<?php echo base_url('admin/golongan') ?>"><i class="fa fa-dashboard"></i> Data Golongan</a></li>
            <li class="active"><?php echo $title; ?></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content"><!-- Small boxes (Stat box) -->
          <div class="example-modal">
            <div class="modal">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header <?php echo $row['kode']; ?>">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><?php echo $title; ?></h4>
                  </div>
                  <div class="modal-body">
                    <form action="<?php echo $formAction; ?>" method="POST" id="form-action">
                      <label for="waktu">Limit Waktu</label>
                      <input type="number" name="waktu" value="<?php echo isset($row['waktu'])? $row['waktu']:''; ?>" class="form-control" id="waktu"/>
                      <br/>
                      <label for="harga">Harga</label>
                      <div class="input-group">
                          <span class="input-group-addon">
                            Rp.
                          </span>
                          <input type="number" name="harga" value="<?php echo isset($row['harga'])? $row['harga']:''; ?>" class="form-control" id="harga"/>
                          <span class="input-group-addon">
                            ,-
                          </span>
                      </div><!-- /input-group -->
                      <br>
                      <label for="deskripsi">Deskripsi</label>
                      <textarea name="deskripsi" class="form-control" id="deskripsi"><?php echo isset($row['deskripsi'])? $row['deskripsi']:''; ?></textarea>
                  </div>
                  <div class="modal-footer">
                      <a href="<?php echo base_url('admin/lihatGolongan/'.$this->uri->segment('3')); ?>" class="btn btn-danger pull-left" data-dismiss="modal">Close</a>
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
      waktu:{
        required: true,
        digits: true,
      },
      harga:{
        required: true,
        digits: true,
      },
      deskripsi:{
        required: true,
      },
    },

    messages: {
      waktu: {
        required: "Waktu harap di isi",
        digits: "Input harus Angka",
       },
      harga: {
        required: "Harga harap di isi",
        digits: "Input harus Angka",
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