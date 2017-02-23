        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Data Rekening Bank
            <small>Preview</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url('admin') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Data Rekening Bank</li>
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
                  </h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-primary btn-xs" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-danger btn-xs" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped table-responsive">
                    <thead>
                      <tr role="row">
                        <th width="4%">No</th>
                        <th>No Rekening</th>
                        <th>Atas Nama</th>
                        <th>Bank</th>
                        <th>Logo</th>
                        <th width="7%">Aksi</th>
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
                          <td align="center">
                            <b><?php echo $data->kode_rek ?></b>
                          </td>
                          <td align="left">
                            <?php echo $data->nm_rek; ?>
                          </td>
                          <td align="center">
                            <?php echo $data->nm_bank; ?>
                          </td>
                          <td align="center">
                            <img src="<?php echo base_url('assets/upload/img/'.$data->logo); ?>" width="100px"/>
                          </td>
                          <td align="center">
                            <a href="<?php echo base_url('admin/editBank/'.$data->id_rekening); ?>" class="btn btn-primary padding-2" data-toggle="tooltip" title="Edit Data"><i class="fa fa-pencil-square"></i></a>
                          </td>
                        </tr>
                      <?php
                        }
                      }
                      ?>
                    </tbody>
                    <tfoot>
                      <tr role="row">
                        <th width="4%">No</th>
                        <th>No Rekening</th>
                        <th>Atas Nama</th>
                        <th>Bank</th>
                        <th>Logo</th>
                        <th width="7%">Aksi</th>
                      </tr>
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
