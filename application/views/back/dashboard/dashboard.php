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
<!-- DATA TABES SCRIPT -->
    <script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
   
    <!-- page script -->
    <script type="text/javascript">
      $(function () {
        $('#example1').dataTable({
        });
        $('#example2').dataTable({
        });
        $('#example3').dataTable({
        });
        $('#example4').dataTable({
        });
        $('#example5').dataTable({
        });
        $('#example6').dataTable({
        });
      });
    </script>
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
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua" data-toggle="tooltip" title="Jumlah Data Perusahaan">
                <div class="inner">
                  <h3><?php echo $dataPerusahaan; ?></h3>
                  <p>Data Perusahaan</p>
                </div>
                <a href="<?php echo base_url('admin/perusahaan') ?>" class="small-box-footer">Info Selngkapnya &nbsp;<i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green" data-toggle="tooltip" title="Jumlah Lowongan">
                <div class="inner">
                  <h3><?php echo $dataLowongan; ?></h3>
                  <p>Lowongan</p>
                </div>
                <a href="<?php echo base_url('admin/loker') ?>" class="small-box-footer">Info Selengkapnya &nbsp;<i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow" data-toggle="tooltip" title="Jumlah Konfirmasi Order Belum Bayar">
                <div class="inner">
                  <h3><?php echo $konfirmasiOrder; ?></h3>
                  <p>Order Pending</p>
                </div>
                <a href="<?php echo base_url('admin/order'); ?>" class="small-box-footer">Info Selengkapnya &nbsp;<i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red" data-toggle="tooltip" title="Jumlah Statistik Pengunjung">
                <div class="inner">
                  <h3><?php echo number_format($statistik, 0, '.', ','); ?></h3>
                  <p>Statistik Pengunjung</p>
                </div>
                
                <a href="<?php echo base_url('admin/statistik'); ?>" class="small-box-footer">Info Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
          </div><!-- /.row -->

        <div class="row">
            <div class="col-md-6">
              <!-- Primary box -->
              <div class="box box-success box-solid">
                <div class="box-header" data-toggle="tooltip" title="Order Pending Konfirmasi Segera">
                  <h3 class="box-title">&nbsp;&nbsp;<i class="fa fa-spinner"></i>&nbsp;&nbsp; Order Konfirmasi</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-primary btn-xs" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-danger btn-xs" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped table-responsive">
                    <thead>
                      <tr>
                        <th width="10%">ID</th>
                        <th width="20%">Limit</th>
                        <th width="20%">Harga</th>
                        <th width="30%">Ket</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        if($orderKonfirmasi!=''){
                          foreach($orderKonfirmasi as $data){
                      ?>
                       <tr>
                          <td align="center"><a href="<?php echo base_url('admin/detailOrder/'.$data->id_aktivasi); ?>"><?php echo $data->id_aktivasi; ?></a></td>
                          <td align="center">
                            <?php 
                              echo $this->my_model->setSelisihTgl(date('Y-m-d'), $data->date_limit);
                            ?> Hr
                          </td>
                          <td align="center">Rp. <?php echo number_format($data->harga, 0, ',', '.');?>,-</td>
                          <td align="left"><?php echo $data->ket; ?></td>
                        </tr>
                      <?php
                          }
                        }
                      ?>
                      </tbody>
                    <tfoot>
                      <tr>
                        <th>ID</th>
                        <th>Limit</th>
                        <th>Harga</th>
                        <th>Ket</th>
                      </tr>
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
            <div class="col-md-6">
            <!-- Primary box -->
              <div class="box box-warning box-solid">
                <div class="box-header" data-toggle="tooltip" title="Order Daftar Iklan Belum Bayar">
                  <h3 class="box-title">&nbsp;&nbsp;<i class="fa fa-group"></i>&nbsp;&nbsp; Order Belum di Bayar</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-primary btn-xs" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-danger btn-xs" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="box-body">
                  <table id="example2" class="table table-bordered table-striped table-responsive">
                    <thead>
                      <tr>
                        <th width="10%">ID</th>
                        <th width="20%">Limit</th>
                        <th width="20%">Harga</th>
                        <th width="30%">Ket</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        if($orderPending!=''){
                          foreach($orderPending as $data){
                      ?>
                       <tr>
                          <td align="center"><a href="<?php echo base_url('admin/detailOrder/'.$data->id_aktivasi); ?>"><?php echo $data->id_aktivasi; ?></a></td>
                          <td align="center">
                            <?php 
                              echo $this->my_model->setSelisihTgl(date('Y-m-d'), $data->date_limit);
                            ?> Hr
                          </td>
                          <td align="center">Rp. <?php echo number_format($data->harga, 0, ',', '.');?>,-</td>
                          <td align="left"><?php echo $data->ket; ?></td>
                        </tr>
                      <?php
                          }
                        }
                      ?>
                      </tbody>
                    <tfoot>
                      <tr>
                        <th>ID</th>
                        <th>Limit</th>
                        <th>Harga</th>
                        <th>Ket</th>
                      </tr>
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
        </div>

        <div class="row">
          <?php
            foreach($loadGolongan as $data){
              if($data->kode=="btn-success"){
                $data->kode='box-success';
              }
              elseif($data->kode=="btn-warning"){
                $data->kode='box-warning';
              }
              elseif($data->kode=="bg-gray"){
                $data->kode='box-default';
              }
          ?>
            <div class="col-md-4">
              <!-- Primary box -->
              <div class="box box-solid <?php echo $data->kode; ?>">
                <div class="box-header" data-toggle="tooltip" title="Header tooltip">
                  <h3 class="box-title">&nbsp;&nbsp;<i class="fa fa-trophy"></i>&nbsp;&nbsp; Iklan <?php echo ucfirst(strtolower($data->nm_golongan)); ?></h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-primary btn-xs" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-danger btn-xs" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="box-body">
                  <table id="example<?php echo $data->id_golongan+3; ?>" class="table table-bordered table-striped table-responsive">
                    <thead>
                      <tr>
                        <th width="4%">ID</th>
                        <th>ID PT</th>
                        <th>Pelamar</th>
                        <th width="20%">Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $loadData = $this->my_model->show('job_lowongan, job_aktivasi WHERE job_lowongan.id_lowongan=job_aktivasi.id_lowongan AND id_golongan="'.$data->id_golongan.'"', 'aktif', 'DESC');
                        if($loadData!=''){
                          foreach ($loadData as $row){
                      ?>
                       <tr>
                          <td align="center"><a href="<?php echo base_url('admin/detailLowongan/'.$row->id_perusahaan.'/'.$row->id_lowongan) ?>"><?php echo $row->id_lowongan; ?></a></td>
                          <td align="center"><?php echo $row->id_perusahaan; ?></td>
                          <td align="center"><?php echo $this->my_model->showNumRowsById('job_lamar', array('id_lowongan'=>$row->id_lowongan)); ?></td>
                          <td align="center">
                            <?php
                              if($row->aktif==1){
                                echo "<span data-toggle='tooltip' title='Enable' class='label label-success'>ENABLE</span>";
                              }elseif($row->aktif==2){
                                echo "<span data-toggle='tooltip' title='Perpanjang' class='label label-warning'>PERPANJANG</span>";
                              }elseif($row->aktif==0){
                                echo "<span data-toggle='tooltip' title='Disable' class='label label-danger'>DISABLE</span>";
                              }elseif($row->aktif==3){
                                if($row->status==0){
                                  echo "<span data-toggle='tooltip' title='Belum Bayar' class='label label-warning'>PENDING</span>";
                                }elseif($row->status==1){
                                  echo "<span data-toggle='tooltip' title='Sudah Bayar' class='label label-warning'>KONFIRMASI</span>";
                                }
                              }
                            ?>
                          </td>
                        </tr>
                      <?php
                          }
                        }
                      ?>
                      </tbody>
                    <tfoot>
                      <tr>
                        <th>ID</th>
                        <th>ID PT</th>
                        <th>Pelamar</th>
                        <th>Status</th>
                      </tr>
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
            <?php
              }
            ?>
            </div>
            <div class="row">
            <div class="col-md-12">
              <!-- Primary box -->
              <div class="box box-danger box-solid">
                <div class="box-header" data-toggle="tooltip" title="Header tooltip">
                  <h3 class="box-title">&nbsp;&nbsp;<i class="fa fa-spinner"></i>&nbsp;&nbsp; Iklan Limit</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-primary btn-xs" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-danger btn-xs" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="box-body">
                  <table id="example3" class="table table-bordered table-striped table-responsive">
                    <thead>
                      <tr>
                        <th width="4%">No</th>
                        <th width="10%">ID Aktivasi</th>
                        <th width="10%">ID Lowongan</th>
                        <th width="12%">ID Perusahaan</th>
                        <th>Harga</th>
                        <th>Limit</th>
                        <th>Jatuh Tempo</th>
                        <th width="10%">Gol</th>
                        <th width="8%">Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $no=1;
                      if($limit!=''){
                        foreach ($limit as $data) {
                      ?>
                       <tr>
                          <td align="center"><?php echo $no++; ?></td>
                          <td align="center"><a href="<?php echo base_url('admin/detailOrder/'.$data->id_aktivasi); ?>"><?php echo $data->id_aktivasi; ?></a></td>
                          <td align="center"><?php echo $data->id_lowongan; ?></td>
                          <td align="center"><?php echo $data->id_perusahaan; ?></td>
                          <td align="center">Rp. <?php echo number_format($data->harga, 0, ',', '.');?>,-</td>
                          <td align="center"><b>
                          <?php 
                              echo $this->my_model->setSelisihTgl(date('Y-m-d'), $data->date_limit);
                            ?> Hr</b>
                          </td>
                          <td align="center"><b>
                          <?php 
                              echo tgl_indo($data->date_limit);
                            ?></b>
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
                              if($data->aktif==1){
                                echo "<span data-toggle='tooltip' title='Enable' class='label label-success'>ENABLE</span>";
                              }elseif($data->aktif==2){
                                echo "<a data-toggle='tooltip' title='Klik untuk Perpanjang' href='".base_url()."admin/panjangLow/".$data->id_perusahaan."/".$data->id_lowongan."/".$data->id_aktivasi."'><span class='label label-warning'>PERPANJANG</span></a>";
                              }elseif($data->aktif==0){
                                echo "<span data-toggle='tooltip' title='Disable' class='label label-danger'>DISABLE</span>";
                              }elseif($data->aktif==3){
                                echo "<a data-toggle='tooltip' title='Klik untuk ENABLE' href='".base_url()."admin/setAktifLow/".$data->id_perusahaan."/".$data->id_lowongan."/1'><span class='label label-warning'>KONFIRMASI</span></a>";
                              }
                            ?>
                          </td>
                        </tr>
                      <?php
                        }
                      }
                      ?>
                      </tbody>
                    <!-- <tfoot>
                      <tr>
                        <th width="4%">No</th>
                        <th>ID</th>
                        <th>Request</th>
                        <th width="20%">Login</th>
                      </tr>
                    </tfoot> -->
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
        </div>
