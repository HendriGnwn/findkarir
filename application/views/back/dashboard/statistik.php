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
            Dashboard
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content"><!-- Small boxes (Stat box) -->
          <div class="example-modal">
            <div class="modal">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Ubah Statistik</h4>
                  </div>
                  <div class="modal-body">
                    <form action="<?php echo base_url('admin/prosesStatistik'); ?>" method="POST">
                      <label>Statistik Keseluruhan</label>
                      <input type="number" name="statistik" value="<?php echo $row['jml_hit']; ?>" class="form-control" />
                      <br>
                      <label>Statistik Hari ini (<?php echo tgl_indo($row['tgl']) ?>)</label>
                      <input type="number" name="hari_ini" value="<?php echo $row['jml_hari_ini']; ?>" class="form-control" />
                  </div>
                  <div class="modal-footer">
                      <a href="<?php echo base_url('admin'); ?>" class="btn btn-danger pull-left" data-dismiss="modal">Close</a>
                      <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp; &nbsp; Save Changes</button>
                    </form>
                  </div>
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
          </div><!-- /.example-modal -->
        </div>
      </section>