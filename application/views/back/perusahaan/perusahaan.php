
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
            Data Perusahaan
            <small>Preview</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url('admin') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Data Perusahaan</li>
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
                    <a href="<?php echo base_url('admin/tambahPerusahaan'); ?>" class="btn btn-primary btn-flat" title="Tambah Data">
                      <i class="fa fa-plus-square"></i>&nbsp; Tambah Data
                    </a>
                  </h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-primary btn-xs" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-danger btn-xs" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped table-responsive">
                    <thead>
                      <tr>
                        <th width="4%">No</th>
                        <th width="4%">ID</th>
                        <th>Perusahaan</th>
                        <th width="15%">Website</th>
                        <th width="18%">Iklan Lowongan</th>
                        <th width="10%">Status</th>
                        <th width="15%">Aksi</th>
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
                          <td align="center"><b><?php echo $data->id_perusahaan; ?></b></td>
                          <td><a href="<?php echo base_url('admin/detailPerusahaan'); echo '/'.$data->id_perusahaan; ?>"><?php echo $data->nm_perusahaan; ?></a></td>
                          <td align="center"><a target="_BLANK" href="http://<?php echo $data->almt_web; ?>"><?php echo $data->almt_web; ?></a></td>
                          <td align="center"><b><?php echo $this->my_model->showNumRowsById('job_lowongan', array('id_perusahaan'=>$data->id_perusahaan)); ?></b> | <a href="<?php echo base_url('admin/lowonganById/'.$data->id_perusahaan); ?>"><span class='label bg-primary'>Lihat Lowongan</span></a></td>
                          <td align="center">
                            <?php 
                              if($data->aktif==1){
                                echo "<a data-toggle='tooltip' title='Klik untuk DISABLE' href='".base_url()."admin/aktifPer/".$data->id_perusahaan."/0'><span class='label bg-primary'>ENABLE</span></a>";
                              }elseif($data->aktif==0){
                                echo "<a data-toggle='tooltip' title='Klik untuk ENABLE' href='".base_url()."admin/aktifPer/".$data->id_perusahaan."/1'><span class='label label-danger'>DISABLE</span></a>";
                              }
                            ?>
                            |
                            <?php 
                              if($data->sts_login==1){
                                echo "<span data-toggle='tooltip' title='Online' class='label bg-green'><i class='fa fa-check-square'></i></span>";
                              }elseif($data->sts_login==0){
                                echo "<span data-toggle='tooltip' title='Offline' class='label label-danger'><i class='fa fa-minus-square'></i></span>";
                              }
                            ?>
                          </td>
                          <td align="center">
                            <a href="<?php echo base_url('admin/detailPerusahaan'); echo '/'.$data->id_perusahaan; ?>" class="btn btn-primary padding-2" data-toggle="tooltip" title="Detail Data"><i class="fa fa-book"></i>
                            </a>&nbsp;&nbsp;<a href="<?php echo base_url('admin/editPerusahaan'); echo '/'.$data->id_perusahaan; ?>" class="btn btn-primary padding-2" data-toggle="tooltip" title="Edit Data"><i class="fa fa-pencil-square"></i>
                            </a>&nbsp;&nbsp;<a href="<?php echo base_url('admin/hapusPerusahaan');echo "/".$data->id_perusahaan; ?>" class="btn btn-danger padding-2" data-toggle="tooltip" onclick="return confirm('Apakah Anda ingin menghapus Data ini?')" title="Hapus Data"><i class="fa fa-trash-o"></i></a>
                          </td>
                        </tr>
                      <?php
                        }
                      }
                      ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th width="4%">No</th>
                        <th width="4%">ID</th>
                        <th>Perusahaan</th>
                        <th width="15%">Password</th>
                        <th width="18%">Iklan Lowongan</th>
                        <th width="10%">Status</th>
                        <th>Aksi</th>
                      </tr>
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
