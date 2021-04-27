<section class="content">
    <div class="row">
        <div class="col-md-4">
            <h2 style="margin-top: 0px">Status Problem</h2>
        </div>
        <div class="col-md-4 text-center">
            <div style="margin-top: 4px" id="message">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5">
            <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Tambah Data Status Problem</h3>
            </div>
            <form class="form-horizontal" id="formActivity" method="post" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group">
                  <label class="col-sm-2 control-label">Activity</label>
                  <div class="col-sm-10">
                    <input type="hidden" name="id_activity" />
                    <input type="text" class="form-control" name="nama_activity" placeholder="Activity Status" required/>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Status</label>
                  <div class="col-sm-10">
                      <select name="status" class="form-control" required/>
                          <option value="1">Aktif</option>
                          <option value="0">Nonaktif</option>
                      </select>
                  </div>
                </div>
              </div>
              <div class="box-footer">
                <button type="reset" class="btn btn-danger">Reset</button>
                <button type="button" id="btnActivity" onclick="saveActivity()" class="btn btn-info pull-right">Tambah</button>
              </div>
            </form>
          </div>
        </div>
        <div class="col-md-7">
            <div class="box">
                <div class="box-body">
                    <table class="table table-hover table-bordered dt-responsive order-column" id="tableActivity" style="width:100%;">
                        <thead>
                            <tr>
                                <th class="text-center" width="80px">No</th>
                                <th class="text-center">Name</th>
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