<section class="content-header">
  <h1>
    Kategori Kantor
    <small>Pengaturan</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dasboard"></i>Dashboard</a></li>
    <li class="active"> Kategori Kantor</li>
  </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-5">
            <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Tambah Data Kanwil</h3>
            </div>
            <form class="form-horizontal" id="formKanwil" method="post" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group">
                  <label class="col-sm-2 control-label">Jenis Kanwil</label>
                  <div class="col-sm-10">
                    <input type="hidden" name="id_kanwil" />
                    <input type="text" class="form-control" name="jenis" placeholder="Jenis Kanwil" required/>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Status</label>
                  <div class="col-sm-10">
                      <select name="status" class="form-control" required>
                          <option value="1">Aktif</option>
                          <option value="0">Nonaktif</option>
                      </select>
                  </div>
                </div>
              </div>
              <div class="box-footer">
                <button type="reset" class="btn btn-danger">Reset</button>
                <button type="button" id="btnKanwil" onclick="saveKanwil()" class="btn btn-info pull-right">Tambah Data</button>
              </div>
            </form>
          </div>
        </div>
        <div class="col-md-7">
            <div class="box">
                <div class="box-body">
                    <table class="table table-hover table-bordered dt-responsive order-column" id="tableKanwil" style="width:100%;">
                        <thead>
                            <tr>
                                <th class="text-center" width="80px">No</th>
                                <th class="text-center">Type</th>
                                <th class="text-center">Active</th>
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
    </div>
</section>
