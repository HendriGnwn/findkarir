<!-- Start Page Banner -->
    <div class="page-banner no-subtitle">
      <div class="container">
        <div class="row">
          <div class="col-md-8">
            <h2>Paket Pembayaran Pemasangan Iklan Lowongan Kerja</h2>
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
        <?php
        $this->load->helper('fungsi_date');
        $this->load->model('fronModel');
                if($this->session->flashdata('berhasil')!=null){
                ?>
                  <div class="alert alert-info alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-info"></i> Berhasil</h4>
                    <?php echo $this->session->flashdata('berhasil'); ?>
                  </div>
                <?php
                  }
                ?>

                <?php
                if($this->session->flashdata('gagal')!=null){
                ?>
                  <div class="alert alert-info alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-info"></i> Gagal</h4>
                    <?php echo $this->session->flashdata('gagal'); ?>
                  </div>
                <?php
                  }
                ?>

        <section class="content-header">
          <h1 class="align-center">
            Paket Pembayaran Pemasangan Iklan Lowongan
          </h1>
          <br>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box box-danger">
                <div class="box-header">
                    <div class="row">
                      <div class="col-md-6 align-left">
                        <a href="<?php echo base_url('company'); ?>"><span class="btn btn-system btn-medium"><i class="fa fa-arrow-left"></i>&nbsp; &nbsp; KEMBALI</span></a>
                      </div>
                      <div class="col-md-6 align-right">
                        <a href="<?php echo base_url('company/tambahIklanLanjut'); ?>"><span class="btn btn-system btn-medium">LANJUT&nbsp; &nbsp;<i class="fa fa-arrow-right"></i></span></a>
                      </div>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                      <h3 class="classic-title">Table Keterangan Pembayaran</h3>
                      <table class="table table-bordered table-strip table-responsive">
                        <tr>
                          <th width="4%" class="align-center">No</th>
                          <th width="20%" class="align-center">Paket Pembayaran</th>
                          <th width="30%" class="align-center">Keterangan</th>
                          <th width="30%" class="align-center">Waktu Tayang - Harga</th>
                        </tr>
                        <?php 
                          $no=1; 
                            foreach($loadGolongan as $data){ 
                              if($data->kode=='btn-success'){
                                $data->kode='label-success color-white';
                              }
                              if($data->kode=='btn-warning'){
                                $data->kode='label-warning color-white';
                              }
                          ?>
                        <tr>
                          <td align="center"><?php echo $no++; ?></td>
                          <td align="center"><span style="padding: 5px 10px; font-size: 9pt;" class="label <?php echo $data->kode ?>"><?php echo $data->nm_golongan; ?></span></td>
                          <td><?php echo $data->rating; ?></td>
                          <td>
                            <div class="row">
                            <?php
                              $k_gol = $this->fronModel->show('job_k_golongan WHERE id_golongan="'.$data->id_golongan.'"', 'id_k_golongan', 'ASC');
                              foreach($k_gol as $gol){
                            ?>
                                <div class="col-md-6 margin-15 align-center">
                                  <i class="fa fa-clock-o"></i>&nbsp;&nbsp;<b><?php echo $gol->limit_waktu; ?> Hari</b>
                                </div>
                                <div class="col-md-6 margin-15 align-center">
                                  <b>Rp. <?php echo number_format($gol->harga,0, ',', '.'); ?></b>
                                </div>
                                 
                            <?php
                              }
                            ?>
                            </div>

                          </td>
                        </tr>
                        <?php } ?>
                      </table>
                </form>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
    </div>
  </div>