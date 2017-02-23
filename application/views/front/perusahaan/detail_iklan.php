<!-- DATA TABES SCRIPT -->
    <script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
   
    <!-- page script -->
    <script type="text/javascript">
      $(function () {
        $('#example').dataTable({
        });
        $('#example1').dataTable({
        });
      });
    </script>
    <link href="<?php echo base_url(); ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />

<!-- Start Page Banner -->
    <div class="page-banner no-subtitle">
      <div class="container">
        <div class="row">
          <div class="col-md-8">
            <h2>Selamat Datang di <strong class="accent-color">Halaman Pribadi Perusahaan</strong></h2>
          </div>
          <div class="col-md-4">
            <ul class="breadcrumbs">
              <li><a href="<?php echo base_url(''); ?>">Beranda</a></li>
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
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1 class="align-center">
            Detail Iklan Lowongan
            <small>Preview</small>
          </h1>
          <br>
        </section>


        <!-- Main content -->
        <section class="content">
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
            <div class="col-xs-1"></div>
            <div class="col-xs-10">
              <div class="box box-danger">
                <h3 class="box-header align-center">Tabel Pelamar</h3>
                <div class="box-body">
                  <?php if($loadData!=''){ ?>
                  <a data-toggle="tooltip" title="Refresh Data" class="btn btn-default" href=""><i class="fa fa-refresh"></i></a> | 
                  <a data-toggle="tooltip" title="Generate to Excel" class="btn btn-success" href="<?php echo base_url('company/excelPelamar/'.$row['id']); ?>"><i class="fa fa-file-excel-o"></i></a>
                  <br><br>
                  <table id="example1" class="table table-bordered table-strip table-responsive">
                    <thead>
                      <tr>
                        <th width="4%">No</th>
                        <th width="4%">ID</th>
                        <th>Nama</th>
                        <th width="20%">Lulusan</th>
                        <th width="30%">Ket</th>
                        <th align="center" width="8%">File CV</th>
                        <th align="center" width="8%">Status</th>
                        <th width="12%">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $no=1;
                          foreach($loadData as $data){
                      ?>
                      <tr>
                        <td align="center"><?php echo $no++; ?></td>
                        <td width="4%"><b><?php echo $data->id_pelamar; ?></b></td>
                        <td><?php echo $data->nama; ?></td>
                        <td align="center"><?php echo $data->pendidikan; ?></td>
                        <td><?php echo $data->ket; ?></td>
                        <td align="center"><?php echo "<a target='_TAB2' class='btn btn-success padding-5' title='".$data->cv."' target='_BLANK' href='".base_url('assets/upload/pelamar/')."/".$data->cv."'><i class='fa fa-file-pdf-o'></i></a>"; ?></td>
                        <td align="center">
                          <?php
                              if($data->sts_lamar==1){
                                echo "<span data-toggle='tooltip' title='".tgl_indo_time1($data->tgl_datang." ".$data->jam_datang).", ".$data->almt_datang."' class='label label-success'>DATANG</span>";
                              }elseif($data->sts_lamar==0){
                                echo "<a data-toggle='tooltip' title='Klik untuk Datang' href='".base_url()."company/aktifLamar/".$row['id']."/".$data->id_lamar."'><span class='label label-warning'>TERTUNDA</span></a>";
                              }
                          ?>
                        </td>
                        <td align="center">
                          <a target="_TAB" href="<?php echo base_url('company/detailPelamar'); echo '/'.$data->id_pelamar; ?>" class="btn btn-primary padding-2" data-toggle="tooltip" title="Detail Data"><i class="fa fa-book"></i>
                          <!-- </a>&nbsp;&nbsp;<a href="<?php echo base_url('admin/hapusPelamar');echo "/".$data->id_pelamar; ?>" class="btn btn-danger padding-2" data-toggle="tooltip" onclick="return confirm('Apakah Anda ingin menghapus Data ini?')" title="Hapus Data"><i class="fa fa-trash-o"></i></a></td> -->
                      </tr>
                      <?php
                          }
                      ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>No</th>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Lulusan</th>
                        <th>Ket</th>
                        <th>File CV</th>
                        <th>Status</th>
                        <th>Aksi</th>
                      </tr>
                    </tfoot>
                  </table>
                  <?php
                    }else{
                  ?>
                    <div class="alert alert-info alert-danger">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <h4><i class="icon fa fa-info"></i> Informasi Pelamar</h4>
                      <?php echo $alert_detail; ?>
                    </div>
                  <?php
                    }
                  ?>
                  <br>
                  <table class="table">
                    <tr>
                      <td width="30%">Pelamar</td>
                      <td width="1%">:</td>
                      <td><?php echo $row['pelamar'] ?></td>
                    </tr>
                    <tr>
                      <th colspan="3"><i class="fa fa-laptop"></i>&nbsp;&nbsp; Keterangan Perusahaan</th>
                    </tr>
                    <tr>
                      <td width="30%">Perusahaan</td>
                      <td width="1%">:</td>
                      <td><b><?php echo $row['nm_perusahaan'] ?></b></td>
                    </tr>
                    <tr>
                      <td width="30%">Alamat</td>
                      <td width="1%">:</td>
                      <td><b><?php echo $row['alamat'] ?></b></td>
                    </tr>
                    <tr>
                      <td width="30%">Telp // Email</td>
                      <td width="1%">:</td>
                      <td><?php echo $row['telp'] ?> // <?php echo $row['email'] ?></td>
                    </tr>
                    <tr>
                      <th colspan="3"><i class="fa fa-globe"></i>&nbsp;&nbsp; Keterangan Lowongan</th>
                    </tr>
                    <tr>
                      <td width="30%">ID</td>
                      <td width="1%">:</td>
                      <td><b><?php echo $row['id'] ?></b></td>
                    </tr>
                    <tr>
                      <td width="30%">Kategori</td>
                      <td width="1%">:</td>
                      <td><b><?php echo $row['k_lowongan'] ?></b></td>
                    </tr>
                    <tr>
                      <td width="30%">Lowongan</td>
                      <td width="1%">:</td>
                      <td><b><?php echo $row['lowongan'] ?></b></td>
                    </tr>
                    <tr>
                      <td width="30%">Kualifikasi</td>
                      <td width="1%">:</td>
                      <td><?php echo $row['kualifikasi']; ?>
                      </td>
                    </tr>
                    <tr>
                      <td width="30%">Benefit</td>
                      <td width="1%">:</td>
                      <td><?php echo $row['benefit'] ?></td>
                    </tr>
                    <tr>
                      <td width="30%">Rentan Gaji</td>
                      <td width="1%">:</td>
                      <td><?php echo $row['gaji'] ?></td>
                    </tr>
                    <tr>
                      <td width="30%">Kota, Provinsi</td>
                      <td width="1%">:</td>
                      <td><?php echo $row['kota'] ?>, <?php echo $row['provinsi']; ?></td>
                    </tr>
                    <tr>
                      <td width="30%">Pekerjaan</td>
                      <td width="1%">:</td>
                      <td><?php echo $row['type'] ?></td>
                    </tr>
                    <tr>
                      <th colspan="3"><i class="fa fa-globe"></i>&nbsp;&nbsp; Keterangan Lainnya</th>
                    </tr>
                    <tr>
                      <td width="30%">Aktivasi</td>
                      <td width="1%">:</td>
                      <td>
                        <?php
                          if($row['status']==1){
                            echo "<span data-toggle='tooltip' title='Sudah' class='label label-success'><i class='fa fa-check-square'></i></span>";
                          }elseif($row['status']==0){
                            echo "<span data-toggle='tooltip' title='Pending' class='label label-danger'><i class='fa fa-spinner'></i></span>";
                          }
                        ?>
                        &nbsp;&nbsp;&nbsp;
                        <?php echo $row['ket']; ?>
                      </td>
                    </tr>
                    <tr>
                      <td width="30%">Bukti</td>
                      <td width="1%">:</td>
                      <td width="69%">
                        <?php
                          if($row['bukti']=='' || $row['bukti']==null){
                            echo "Pending";
                          }else{
                        ?>
                        <div class="row">
                          <div class="col-md-6">
                            <img width="100%" src="<?php echo base_url('assets/upload/img/'.$row['bukti']); ?>" class="img-responsive" style="border: 1px solid #ddd;" />
                          </div>
                        </div>
                        <?php
                          }
                        ?>
                      </td>
                    </tr>
                    <tr>
                      <td width="30%">Golongan</td>
                      <td width="1%">:</td>
                      <td>
                        <?php 
                          if($row['id_golongan']=="1"){
                            echo "<span class='label label-success' data-toggle='tooltip' title='".$row['rating']."'>".$row['golongan']."</span>";
                          }elseif($row['id_golongan']=="2"){
                            echo "<span class='label label-warning' data-toggle='tooltip' title='".$row['rating']."'>".$row['golongan']."</span>";
                          }elseif($row['id_golongan']=="3"){
                            echo "<span class='label bg-gray' data-toggle='tooltip' title='".$row['rating']."'>".$row['golongan']."</span>";
                          }

                        ?>

                      </td>
                    </tr>
                    <tr>
                      <td width="30%">Tanggal Buka Iklan</td>
                      <td width="1%">:</td>
                      <td><?php echo tgl_indo($row['date_post']); ?></td>
                    </tr>
                    <tr>
                      <td width="30%">Tanggal Tutup Iklan</td>
                      <td width="1%">:</td>
                      <td><?php echo tgl_indo($row['date_close']); ?></td>
                    </tr>
                    <tr>
                      <td width="30%">Status Penayangan</td>
                      <td width="1%">:</td>
                      <td>
                        <?php
                          if($row['aktif']==1){
                            echo "<span data-toggle='tooltip' title='Enable' class='label label-success'>TAYANG</span>";
                          }elseif($row['aktif']==2){
                            echo "<span data-toggle='tooltip' title='Memasuki masa Perpanjang' class='label label-warning'>PERPANJANG</span>";
                          }elseif($row['aktif']==0){
                            echo "<span data-toggle='tooltip' title='Disable' class='label label-danger'>TIDAK TAYANG</span>";
                          }elseif($row['aktif']==3){
                            if($row['status']==0){
                              echo "<span data-toggle='tooltip' title='Belum bisa di Klik' class='label label-warning'>PENDING</span></a>";
                            }elseif($row['status']==1){
                              echo "<a data-toggle='tooltip' title='Klik untuk ENABLE'><span class='label label-warning'>PROSES</span></a>";                                
                            }
                          }
                        ?>
                      </td>
                    </tr>
                    
                  </table>
                  
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div>
      </div>
