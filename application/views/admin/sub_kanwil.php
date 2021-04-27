<section class="content">
    <div class="row">
        <div class="col-md-4">
            <h2 style="margin-top: 0px">Setting Kantor Cabang</h2>
        </div>
        <div class="col-md-4 text-center">
            <div style="margin-top: 4px" id="message">
            </div>
        </div>
    </div>

    <div class="box">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Tambah Data Kantor Wilayah</h3>
            </div>
            <form class="form-horizontal" id="form_sub_kanwil" method="post" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group">
                  <label class="col-sm-2 control-label">Jenis Kantor</label>
                  <div class="col-sm-10">
                    <input type="hidden" name="id_sub_kanwil" />
                    <select name="jenis" class="form-control"  required>
                        <option value="">Pilih Jenis Kantor Wilayah</option>
                        <?php foreach ($kanwil as $jenis): ?>
                        <option value="<?php echo $jenis['id_kanwil'] ?>"><?php echo ucwords($jenis['jenis']) ?></option>
                        <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Nama Cabang</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="nama_cabang" id="nama_cabang" placeholder="Nama Kantor" required/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Alamat</label>  
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat Kantor" required/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Region</label>  
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="region" id="region" placeholder="Region" required/>
                    </div>
                </div>
                <!-- <div class="form-group">
                  <label class="col-sm-2 control-label">Status</label>
                  <div class="col-sm-10">
                      <select name="status" class="form-control" required/>
                          <option value="1">Aktif</option>
                          <option value="0">Nonaktif</option>
                      </select>
                  </div>
                </div> -->
              </div>
              <div class="box-footer">
                <button type="reset" class="btn btn-danger">Reset</button>
                <button type="button" id="btn_sub_kanwil" onclick="save_sub_kanwil()" class="btn btn-info pull-right">Tambah Data</button>
              </div>
            </form>
        </div>
    </div>
</section>

<section class="content">
    <div class="box">
        <div class="box box-info">
        <div class="box-body">
            <table class="table table-hover table-bordered dt-responsive order-column" id="table_subKanwil" style="width:100%;">
                <thead>
                    <tr>
                        <th class="text-center" width="80px">No</th>
                        <th class="text-center">Jenis Kantor</th>
                        <th class="text-center">Nama Cabang</th>
                        <th class="text-center">Alamat</th>
                        <th class="text-center">Region</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
</section>