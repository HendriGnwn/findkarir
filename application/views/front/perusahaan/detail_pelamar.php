<?php $this->load->helper('fungsi_date'); ?>
<html>
  <head>
    <title><?php echo $this->Config_Model->get_app_name_url() ?> | DETAIL PELAMAR</title>
    <link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />    
    <!-- FontAwesome 4.3.0
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />-->
    <!-- FontAwesome 4.3.0 -->
    <link href="<?php echo base_url(); ?>assets/font_awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
  </head>
<body>
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
              <div class="box box-danger">
                <div class="box-header">
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
                    
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
