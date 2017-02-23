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
            Manajemen User
            <small>Lihat User</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url('admin') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="">Manajemen User</a></li>
            <li class="active">Lihat User</li>
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
                    <a href="<?php echo base_url('admin/tambahUser'); ?>" class="btn btn-primary btn-flat" title="Tambah Data">
                      <i class="fa fa-plus-square"></i>&nbsp; Tambah User
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
                        <th>Nama</th>
                        <th><i>Username</i> | Password</th>
                        <th width="10%">Keterangan</th>
                        <th width="12%">Hak Akses | Aktif</th>
                        <th width="12%">Login</th>
                        <th width="9%">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                        $no=1;
                        foreach($loadData as $data){
                      ?>
                        <tr>
                          <td align="center"><?php echo $no++; ?></td>
                          <td><?php echo $data->nama; ?></td>
                          <td><i><?php echo $data->username." | </i>".$data->pass_view; ?></td>
                          <td>
                            <font size="1">Create (<?php echo tgl_indo($data->tgl_create); ?>)<br></font>
                          </td>
                          <td align="center">
                            <?php 
                              if($data->hak_akses==1){
                                echo "<span class='label bg-maroon'>ADMIN</span>";
                              }elseif($data->hak_akses==2){
                                echo "<span class='label label-primary'>USER</span>";
                              }
                              if($data->id_user!="64887001"){
                                echo " |";
                              } 
                            ?>
                            
                            <?php 
                              if($data->aktif==1){
                                if($data->id_user!="64887001"){
                                  echo "<a data-toggle='tooltip' title='Klik untuk memblok User' href='".base_url()."admin/aktifUser/".$data->id_user."/0'><span class='label bg-primary'>ACTIVE</span></a>";
                                }
                              }elseif($data->aktif==0){
                                echo "<a data-toggle='tooltip' title='Klik untuk mengaktifkan kembali User' href='".base_url()."admin/aktifUser/".$data->id_user."/1'><span class='label label-danger'>BLOCK</span></a>";
                              }
                            ?>
                          </td>
                          <td align="center">
                            <?php 
                              if($data->sts_login==1){
                                echo "<span data-toggle='tooltip' title='Online' class='label bg-green'><i class='fa fa-check-square'></i></span>";
                              }elseif($data->sts_login==0){
                                echo "<span data-toggle='tooltip' title='Offline' class='label label-danger'><i class='fa fa-minus-square'></i></span>";
                              }
                            ?><br>
                            <font size="1"><?php echo tgl_indo_time1($data->last_login); ?></font>
                          </td>
                          <td align="center">
                            <a data-toggle="tooltip" href="<?php echo base_url('admin/editUser/'); echo "/".$data->id_user; ?>" class="btn btn-primary padding-2" title="Edit Data"><i class="fa fa-pencil-square"></i>
                            </a>&nbsp;&nbsp;<?php if($data->id_user!="550502001"){ ?><a data-toggle="tooltip" href="<?php echo base_url('admin/hapusUser/'); echo "/".$data->id_user; ?>" class="btn btn-danger padding-2" onclick="return confirm('Apakah Anda ingin menghapus Data ini?')" title="Hapus Data"><i class="fa fa-trash-o"></i></a><?php } ?></td>
                        </tr>
                      <?php
                        }
                      ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th width="5px">No</th>
                        <th>Nama</th>
                        <th><i>Username</i> | Password</th>
                        <th>Keterangan</th>
                        <th>Hak Akses | Aktif</th>
                        <th>Login</th>
                        <th>Aksi</th>
                      </tr>
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
