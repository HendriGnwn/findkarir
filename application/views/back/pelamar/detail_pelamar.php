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
            <b>Detail Pendaftar</b>
            <small>Preview</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url('admin') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="<?php echo base_url('admin/pendaftar') ?>"><i class="fa fa-group"></i> Manajemen Pendaftar</a></li>
            <li class="active">Detail Pendaftar</li>
          </ol>
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
            <div class="col-xs-12">
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">
                    <a href="<?php echo base_url('admin/pendaftar'); ?>" class="btn btn-primary btn-flat padding-2" data-toggle="tooltip" title="Kembali"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp; KEMBALI</a>
                  </h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-primary btn-xs" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-danger btn-xs" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table class="table">
                    <tr class="bg-gray">
                      <td colspan="3"><i class="fa fa-user"></i>&nbsp;&nbsp; Keterangan Pendaftar</td>
                    </tr>
                    <tr>
                      <td width="30%">ID Pendaftar</td>
                      <td width="1%">:</td>
                      <td><b><?php echo $row['id'] ?></b></td>
                    </tr>
                    <tr>
                      <td width="30%">Nama Lengkap</td>
                      <td width="1%">:</td>
                      <td><b><?php echo $row['nama'] ?></b></td>
                    </tr>
                    <tr>
                      <td width="30%">Foto</td>
                      <td width="1%">:</td>
                      <td>
                        <?php 
                          if($row['foto']!=''){
                        ?>
                          <img src="<?php echo base_url('assets/upload/img/'.$row['foto']) ?>" width="200px" />
                        <?php
                          }
                        ?>

                      </td>
                    </tr>
                    <tr>
                      <td width="30%">Tempat Tanggal Lahir</td>
                      <td width="1%">:</td>
                      <td><?php echo $row['tmp_lhr'] ?></td>
                    </tr>
                    <tr>
                      <td width="30%">Jenis Kelamin</td>
                      <td width="1%">:</td>
                      <td><?php echo $row['jk'] ?></td>
                    </tr>
                    <tr>
                      <td width="30%">Alamat</td>
                      <td width="1%">:</td>
                      <td><?php echo $row['alamat'] ?></td>
                    </tr>
                    <tr>
                      <td width="30%">Kota</td>
                      <td width="1%">:</td>
                      <td><?php echo $row['kota'] ?></td>
                    </tr>
                    <tr>
                      <td width="30%">Email</td>
                      <td width="1%">:</td>
                      <td><?php echo $row['email'] ?></td>
                    </tr>
                    <tr>
                      <td width="30%">No Telp</td>
                      <td width="1%">:</td>
                      <td><?php echo $row['no_telp'] ?></td>
                    </tr>
                    <tr>
                      <td width="30%">Pendidikan</td>
                      <td width="1%">:</td>
                      <td><b><?php echo $row['pendidikan'] ?></b></td>
                    </tr>
                    <tr>
                      <td width="30%">Agama</td>
                      <td width="1%">:</td>
                      <td><?php echo $row['agama'] ?></td>
                    </tr>
                    <tr>
                      <td width="30%">Status Perkawinan</td>
                      <td width="1%">:</td>
                      <td><?php echo $row['sts_kawin'] ?></td>
                    </tr>
                    
                    <tr class="bg-gray">
                      <td colspan="3"><i class="fa fa-bookmark"></i>&nbsp;&nbsp; Keterangan Lainnya</td>
                    </tr>
                    
                    <tr>
                      <td width="30%">Tanggal Buat</td>
                      <td width="1%">:</td>
                      <td><?php echo $row['tgl_create'] ?></td>
                    </tr>
                    <tr>
                      <td width="30%">Jumlah Melamar</td>
                      <td width="1%">:</td>
                      <td><?php echo $row['jml_lamar'] ?></td>
                    </tr>
                    <tr>
                      <td width="30%">Password</td>
                      <td width="1%">:</td>
                      <td><?php echo $row['password'] ?></td>
                    </tr>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
