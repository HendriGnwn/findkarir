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
            Order Iklan
            <small>Preview</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url('admin') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-globe"></i>&nbsp;&nbsp; Data Lowongan</li>
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
                        <th>(ID)<br>Lowongan</th>
                        <th>Gol</th>
                        <th>Tgl Order //<br> Tgl Limit</th>
                        <th>Limit</th>
                        <th>Status</th>
                        <th>Bukti</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $no=1;
                        if($loadData!=''){
                        foreach ($loadData as $data) {
                      ?>
                      <tr>
                        <td align="center"><?php echo $no++; ?></td>
                        <td align="center"><b><a href="<?php echo base_url("admin/detailOrder/".$data->id_aktivasi); ?>"><?php echo $data->id_aktivasi; ?></a></b></td>
                        <td><b>(<?php echo $data->id_lowongan; ?>)</b><br><?php echo $data->nm_lowongan; ?></td>
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
                          <?php echo tgl_indo($data->date_bill); ?> //<br> <b><?php echo tgl_indo($data->date_limit); ?></b>
                        </td>
                        <td align="center"><b>
                            <?php 
                              $cek = $this->my_model->showById('job_aktivasi', array('id_lowongan'=>$data->id_lowongan));
                              echo $this->my_model->setSelisihTgl(date('Y-m-d'), $cek->date_limit);
                            ?> Hari</b>
                          </td>
                        <td align="center">
                            <?php
                              if($data->aktif==1){
                                echo "<a data-toggle='tooltip' title='Klik untuk Ubah' href='".base_url()."admin/setAktifLow/".$data->id_perusahaan."/".$data->id_lowongan."/0'><span class='label label-success'>ENABLE</span></a>";
                              }elseif($data->aktif==2){
                                echo "<a data-toggle='tooltip' title='Klik untuk Ubah' href='".base_url()."admin/panjangLow/".$data->id_perusahaan."/".$data->id_lowongan."/".$data->id_aktivasi."'><span class='label label-warning'>PERPANJANG</span></a>";
                              }elseif($data->aktif==0){
                                echo "<a data-toggle='tooltip' title='Klik untuk Ubah' href='".base_url()."admin/setAktifLow/".$data->id_perusahaan."/".$data->id_lowongan."/1'><span class='label label-danger'>DISABLE</span></a>";                                
                              }elseif($data->aktif==3){
                                if($data->status==0){
                                  echo "<span data-toggle='tooltip' title='Belum bisa di Klik' class='label label-warning'>PENDING</span></a>";
                                }elseif($data->status==1){
                                  echo "<a data-toggle='tooltip' title='Klik untuk ENABLE' href='".base_url()."admin/setAktifLow/".$data->id_perusahaan."/".$data->id_lowongan."/1'><span class='label label-warning'>KONFIRMASI</span></a>";
                                }
                              }
                            ?>
                          </td>
                          
                        <td align="center">
                          <?php
                            if($data->upload_bukti!=''){
                          ?>
                          <a data-toggle="tooltip" title="<?php echo $data->ket; ?>" target="_TAB" href="<?php echo base_url('assets/upload/img/'.$data->upload_bukti); ?>" class="btn btn-success padding-2"><i class="fa fa-picture-o"></i></a>
                          <?php
                            }else{
                          ?>
                          <span data-toggle="tooltip" title="Belum Bayar" class="btn btn-danger padding-2"><i class="fa fa-picture-o"></i></span>
                          <?php
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
                        <th>No</th>
                        <th>ID</th>
                        <th>(ID)<br>Lowongan</th>
                        <th>Gol</th>
                        <th>Tgl Order //<br> Tgl Limit</th>
                        <th>Status</th>
                        <th>Bukti</th>
                      </tr>
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
