<!-- DATA TABES SCRIPT -->
    <script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
   
    <!-- page script -->
    <script type="text/javascript">
      $(function () {
        $('#example1').dataTable({
        });
      });
    </script>
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Data Bantuan
            <small>Preview</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url('admin') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Data Bantuan</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
                <?php
                  $this->load->model('my_model');
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
                  </h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-primary btn-xs" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-danger btn-xs" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped table-responsive">
                    <thead>
                      <tr role="row">
                        <th width="4%">No</th>
                        <th width="10%">Nama<br>(Email)</th>
                        <th width="20%">Subjek</th>
                        <th width="40%">Pesan</th>
                        <th width="10%">Tanggal</th>
                        <th width="5%">Status</th>
                        <th width="7%">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                        $no=1;
                        if($loadData!=""){
                        foreach($loadData as $data){
                      ?>
                        <tr>
                          <td align="center"><?php echo $no++; ?></td>
                          <td align="center">
                            <?php echo $data->nama ?><br>(<?php echo $data->email; ?>)
                          </td>
                          <td align="left">
                            <a href="<?php echo base_url('admin/kirimBantuan/'.$data->id_bantuan); ?>"><?php echo $data->subjek ?></a>
                          </td>
                          <td align="left">
                            <?php echo substr($data->pesan, 0, 100); ?>
                          </td>
                          <td align="center">
                            <?php echo tgl_indo_time($data->tgl); ?>
                          </td>
                          <td align="center">
                            <?php 
                              if($data->sts=="1"){
                                echo "<span class='label label-success' data-toggle='tooltip' title='Sudah di Bales'>SDH</span>";
                              }elseif($data->sts=="0"){
                                echo "<span class='label label-warning' data-toggle='tooltip' title='Belum di Bales'>BLS</span>";
                              }
                            ?>

                          </td>
                          <td align="center">
                            <a href="<?php echo base_url('admin/kirimBantuan/'.$data->id_bantuan); ?>" class="btn btn-success padding-2" data-toggle="tooltip" title="Kirim Data"><i class="fa fa-location-arrow"></i></a>
                            <a href="<?php echo base_url('admin/hapusBantuan/'.$data->id_bantuan); ?>" onclick="return confirm('Apakah Anda ingin menghapus Data ini?')" class="btn btn-danger padding-2" data-toggle="tooltip" title="Hapus Data"><i class="fa fa-trash-o"></i></a>
                          </td>
                        </tr>
                      <?php
                        }
                      }
                      ?>
                    </tbody>
                    <tfoot>
                      <tr role="row">
                        <th width="4%">No</th>
                        <th>Nama<br>(Email)</th>
                        <th>Subjek</th>
                        <th>Pesan</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th width="7%">Aksi</th>
                      </tr>
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
