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
            <b><?php echo $row['nm_perusahaan'] ?></b>
            <small>Preview</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url('admin') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Detail Perusahaan</li>
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
                    Detail Perusahaan&nbsp;&nbsp;
					<a href="<?php echo base_url('admin/perusahaan'); ?>">
						<span class="btn btn-primary btn-flat padding-2">
							<i class="fa fa-arrow-left"></i>
							&nbsp; &nbsp; KEMBALI
						</span>
					</a>
					&nbsp;|&nbsp;
					<a href="<?php echo base_url('admin/lowonganById/'.$row['id']); ?>">
						<span class="btn btn-primary btn-flat padding-2">LIHAT IKLAN&nbsp;&nbsp;&nbsp;<i class="fa fa-arrow-right"></i></span>
					</a>
                  </h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-primary btn-xs" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-danger btn-xs" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table class="table">
                    <tr>
                      <td width="30%">ID</td>
                      <td width="1%">:</td>
                      <td><b><?php echo $row['id'] ?></b></td>
                    </tr>
					<tr>
                      <td width="30%">Kode</td>
                      <td width="1%">:</td>
                      <td><b><?php echo $row['kode'] ?></b></td>
                    </tr>
                    <tr>
                      <td width="30%">Nama Perusahaan</td>
                      <td width="1%">:</td>
                      <td><b><?php echo $row['nm_perusahaan'] ?></b></td>
                    </tr>
                    <tr>
                      <td width="30%">Nomor Izin Perusahaan</td>
                      <td width="1%">:</td>
                      <td><b><?php echo $row['no_izin'] ?></b></td>
                    </tr>
                    <tr>
                      <td width="30%">Logo</td>
                      <td width="1%">:</td>
                      <td>
                        <div class="row">
                          <div class="col-md-3">
                            <img src="<?php echo base_url('assets/upload/img/'.$row['logo']); ?>" class="img-responsive" style="border: 1px solid #ddd;" />
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td width="30%">Alamat</td>
                      <td width="1%">:</td>
                      <td><?php echo $row['alamat'] ?></td>
                    </tr>
                    <tr>
                      <td width="30%">Tentang</td>
                      <td width="1%">:</td>
                      <td><?php echo $row['tentang'] ?></td>
                    </tr>
                    <tr>
                      <td width="30%">No Telp</td>
                      <td width="1%">:</td>
                      <td><?php echo $row['no_telp'] ?></td>
                    </tr>
                    <tr>
                      <td width="30%">No Fax</td>
                      <td width="1%">:</td>
                      <td><?php echo $row['no_fax'] ?></td>
                    </tr>
                    <tr>
                      <td width="30%">Email</td>
                      <td width="1%">:</td>
                      <td><?php echo $row['email'] ?></td>
                    </tr>
                    <tr>
                      <td width="30%">Alamat Web</td>
                      <td width="1%">:</td>
                      <td><a target="_BLANK" href="http://<?php echo $row['web']; ?>"><?php echo $row['web'] ?></a></td>
                    </tr>
					<tr>
                      <td width="30%">Kategory</td>
                      <td width="1%">:</td>
                      <td><?php echo $row['category'] == 1 ? 'Umum' : 'Partnership' ?></td>
                    </tr>
                    <tr class="bg-gray">
                      <td colspan="3"><i class="fa fa-bookmark"></i>&nbsp;&nbsp; <b>Keterangan Lainnya</b></td>
                    </tr>
                    <tr>
                      <td width="30%">ID</td>
                      <td width="1%">:</td>
                      <td><?php echo $row['id'] ?></td>
                    </tr>
                    <tr>
                      <td width="30%">Password</td>
                      <td width="1%">:</td>
                      <td><?php echo $row['pass_view'] ?></td>
                    </tr>
                    <tr>
                      <td width="30%">STATUS | LOGIN</td>
                      <td width="1%">:</td>
                      <td>
                        <?php 
                              if($row['aktif']==1){
                                echo "<span data-toggle='tooltip' title='ENABLE' class='label bg-primary'>ENABLE</span>";
                              }elseif($row['aktif']==0){
                                echo "<span data-toggle='tooltip' title='DISABLE' class='label label-danger'>DISABLE</span></a>";
                              }
                            ?>
                            |
                            <?php 
                              if($row['login']==1){
                                echo "<span data-toggle='tooltip' title='Online' class='label bg-green'><i class='fa fa-check-square'></i></span>";
                              }elseif($row['login']==0){
                                echo "<span data-toggle='tooltip' title='Offline' class='label label-danger'><i class='fa fa-minus-square'></i></span>";
                              }
                            ?>
                      </td>
                    </tr>
                    <tr>
                      <td width="30%">Create // Last Login</td>
                      <td width="1%">:</td>
                      <td>
                        <?php 
                          echo tgl_indo_time1($row['tgl_create']); 
                          echo " // ";
                          echo tgl_indo_time1($row['last_login']);
                        ?>
                      </td>
                    </tr>
                  </table>
				<?php if ($row['category'] == 2) : ?>
				<br/>
				<div class="box-header bg-gray">
					<h4 class="box-title">Limit Details&nbsp;&nbsp;
						<a href="<?php echo base_url('admin/tambahlimitLow/'.$row['id']); ?>">
							<span class="btn btn-primary btn-flat padding-2">Tambah Limit&nbsp;&nbsp;&nbsp;<i class="fa fa-plus-square-o"></i></span>
						</a>
					</h4>
				</div>
				<br/>
				<table id="example1" class="table table-bordered table-striped table-responsive">
                    <thead>
						<tr>
							<th width="4%">No</th>
							<th>Limit</th>
							<th>Tanggal Mulai</th>
							<th>Tanggal Selesai</th>
							<th>Status</th>
							<th width="10%">Aksi</th>
						</tr>
                    </thead>
                    <tbody>
						<?php $no = 1; foreach($perusahaanLimits as $limit) : ?>
						<tr>
							<td><?php echo $no++ ?></td>
							<td><?php echo $limit->limit ?></td>
							<td><?php echo $limit->date_start ?></td>
							<td><?php echo $limit->date_end ?></td>
							<td><?php echo $limit->status == 1 ? 'Active' : 'Inactive' ?></td>
							<td><?php if ($limit->status==1) : ?><a href="<?php echo base_url('admin/updateLimitLow/'.$limit->id) ?>">Update Limit</a> <?php endif; ?></td>
						</tr>
						<?php endforeach; ?>
					</tbody>
					<tfoot>
						<tr>
							<th width="4%">No</th>
							<th>Limit</th>
							<th>Tanggal Mulai</th>
							<th>Tanggal Selesai</th>
							<th>Status</th>
							<th>Aksi</th>
						</tr>
					</tfoot>
				</table>
				<?php endif; ?>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->