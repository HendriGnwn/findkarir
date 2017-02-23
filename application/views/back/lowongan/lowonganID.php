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
            Iklan Loker <b><?php echo ucfirst($nm_perusahaan); ?> </b>
            <small>Preview</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url('admin') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="<?php echo base_url('admin/perusahaan') ?>"><i class="fa fa-laptop"></i> Data Perusahaan</a></li>
            <li class="active">Iklan Lowongan</li>
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
            <div class="col-xs-12">
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">
                    <a data-toggle="tooltip" href="<?php echo base_url('admin/perusahaan'); ?>" class="btn btn-primary btn-flat" title="Kembali">
                      <i class="fa fa-arrow-left"></i>&nbsp; KEMBALI
                    </a> |
                    <a data-toggle="tooltip" href="<?php echo base_url('admin/tambahLowongan/'.$this->uri->segment(3)); ?>" class="btn btn-primary btn-flat" title="Tambah Data">
                      <i class="fa fa-plus-square"></i>&nbsp; TAMBAH DATA
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
                        <th rowspan="2" width="4%">No</th>
                        <th rowspan="2" width="4%">ID</th>
                        <th rowspan="2">(Kategori)<br>Lowongan</th>
                        <th rowspan="2" width="5%">Jml Pelamar</th>
                        <th colspan="2" align="center" width="20%">Limit</th>
                        <th rowspan="2" width="8%">Gol</th>
                        <th rowspan="2" width="8%">Aktivasi</th>
                        <th rowspan="2" width="10%">Status</th>
                        <th rowspan="2" width="12%">Aksi</th>
                      </tr>
                      <tr>
                        <th width="10%">Tgl</th>
                        <th width="10%">Sel</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                        $no=1;
                        if($loadData!=''){
                        foreach($loadData as $data){
                      ?>
                        <tr>
                          <td align="center"><?php echo $no++; ?></td>
                          <td align="center"><b><?php echo $data->id_lowongan; ?></b></td>
                          <td align="center">(<?php echo $data->nm_k_lowongan; ?>)<br><?php echo $data->nm_lowongan; ?></td>
                          <td align="center">
                            <a data-toggle="tooltip" class="btn btn-primary padding-2" href="<?php echo base_url('admin/detailLowongan/'.$data->id_perusahaan.'/'.$data->id_lowongan); ?>" title="Lihat Pelamar"><?php echo $this->my_model->showNumRowsById('job_lamar', array('id_lowongan'=>$data->id_lowongan)); ?></a>
                          </td>
                          <td align="center"><?php echo tgl_indo($data->date_limit); ?></td>
                          <td align="center"><b>
                            <?php 
                              $cek = $this->my_model->showById('job_aktivasi', array('id_lowongan'=>$data->id_lowongan));
                              echo $this->my_model->setSelisihTgl(date('Y-m-d'), $cek->date_limit);
                            ?> Hari</b>
                          </td>
                          <td align="center">
                            <?php 
                              if($data->id_golongan=="1"){
                                echo "<span class='label ".$data->kode."' data-toggle='tooltip' title='".$data->rating."'>".$data->nm_golongan."</span>";
                              }elseif($data->id_golongan=="2"){
                                echo "<span class='label ".$data->kode."' data-toggle='tooltip' title='".$data->rating."'>".$data->nm_golongan."</span>";
                              }elseif($data->id_golongan=="3"){
                                echo "<span class='label ".$data->kode."' data-toggle='tooltip' title='".$data->rating."'>".$data->nm_golongan."</span>";
                              }

                            ?>

                          </td>
                          <td align="center">
                            <?php
                              if($data->status==1){
                                echo "<a href='".base_url("admin/cetakStrukLowongan/".$data->id_aktivasi)."' data-toggle='tooltip' title='Sudah, Lihat Detail' class='label label-success'><i class='fa fa-check-square'></i></span>";
                              }elseif($data->status==0){
                                echo "<span data-toggle='tooltip' title='Pending' class='label label-danger'><i class='fa fa-spinner'></i></span>";
                              }
                            ?>
                          </td>
                          <td align="center">
                            <?php
                              if($data->aktif==1){
                                echo "<a data-toggle='tooltip' title='Klik untuk DISABLE' href='".base_url()."admin/setAktifLow/".$this->uri->segment('3')."/".$data->id_lowongan."/0'><span class='label label-success'>ENABLE</span></a>";
                              }elseif($data->aktif==2){
                                echo "<a data-toggle='tooltip' title='Klik untuk Perpanjang' href='".base_url()."admin/panjangLow/".$this->uri->segment('3')."/".$data->id_lowongan."/".$data->id_aktivasi."'><span class='label label-warning'>PERPANJANG</span></a>";
                              }elseif($data->aktif==0){
                                echo "<a data-toggle='tooltip' title='Klik untuk ENABLE' href='".base_url()."admin/setAktifLow/".$this->uri->segment('3')."/".$data->id_lowongan."/1'><span class='label label-danger'>DISABLE</span></a>";                                
                              }elseif($data->aktif==3){
                                if($data->status==0){
                                  echo "<span data-toggle='tooltip' title='Belum bisa di Klik' class='label label-warning'>PENDING</span></a>";
                                }elseif($data->status==1){
                                  echo "<a data-toggle='tooltip' title='Klik untuk ENABLE' href='".base_url()."admin/setAktifLow/".$this->uri->segment('3')."/".$data->id_lowongan."/1'><span class='label label-warning'>KONFIRMASI</span></a>";
                                }
                              }
                            ?>
                          </td>
                          <td align="center">
                            <a href="<?php echo base_url('admin/detailLowongan'); echo '/'.$data->id_perusahaan; echo '/'.$data->id_lowongan; ?>" class="btn btn-primary padding-2" data-toggle="tooltip" title="Detail Data"><i class="fa fa-book"></i>
                            </a>&nbsp;&nbsp;<a href="<?php echo base_url('admin/editLowongan'); echo '/'.$data->id_perusahaan; echo '/'.$data->id_lowongan; ?>" class="btn btn-primary padding-2" data-toggle="tooltip" title="Edit Data"><i class="fa fa-pencil-square"></i>
                            </a>&nbsp;&nbsp;<a href="<?php echo base_url('admin/hapusLowongan');echo '/'.$data->id_perusahaan; echo "/".$data->id_lowongan; ?>" class="btn btn-danger padding-2" data-toggle="tooltip" onclick="return confirm('Apakah Anda ingin menghapus Data ini?')" title="Hapus Data"><i class="fa fa-trash-o"></i></a>
                          </td>
                        </tr>
                      <?php
                        }
                      }
                      ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th rowspan="2" width="4%">No</th>
                        <th rowspan="2" width="4%">ID</th>
                        <th rowspan="2">(Kategori)<br>Lowongan</th>
                        <th rowspan="2">Jml Pelamar</th>
                        <th>Tgl</th>
                        <th>Sel</th>
                        <th rowspan="2" width="8%">Gol</th>
                        <th rowspan="2">Aktivasi</th>
                        <th rowspan="2">Status</th>
                        <th rowspan="2">Aksi</th>
                      </tr>
                      <tr>
                        <th colspan="2" align="center">Limit</th>
                      </tr>
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
