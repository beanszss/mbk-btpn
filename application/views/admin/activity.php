<section class="content">
  <div class="row">
    <div class="col-md-4">
      <h2 style="margin-top: 0px">Activity</h2>
    </div>
    <div class="col-md-4 text-center">
      <div id="message" style="margin-top :4px">
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-5">
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Tambah Data Activity</h3>
        </div>
        <form action="" method="post" class="form-horizontal" id="formActivity">
          <div class="box-body">
            <div class="form-group">
              <label for="" class="col-sm-2 control-label">Nama Activity</label>
              <div class="col-sm-10">
                <input type="hidden" name="id_activity">
                <input type="text" class="form-control" name="nama_activity" placeholder="Activity Name" required>
              </div>
            </div>
            <div class="form-group">
              <label for="" class="col-sm-2 control-label">Status</label>
              <div class="col-sm-10">
                <select name="status" class="form-control" required>
                  <option value="1">Aktif</option>
                  <option value="0">Nonaktif</option>
                </select>
              </div>
            </div>
          </div>
          <div class="box-footer">
            <button class="btn btn-danger" type="reset">Reset</button>
            <button type="button" onclick="saveActivity()" id="btnActivity" class="btn btn-info pull-right">Tambah Activity</button>
          </div>
        </form>
      </div>
    </div>
    <div class="col-md-7">
      <div class="box">
        <div class="box-body">
          <table class="table table-hover table-bordered dt-responsive order-column" id="tableActivity" style="width: 100">
            <thead>
              <tr>
                <th class="text-center">No</th>
                <th class="text-center">Activity</th>
                <th class="text-center">Status</th>
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