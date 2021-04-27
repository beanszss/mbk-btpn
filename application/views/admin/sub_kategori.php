<section class="content">
    <div class="row">
        <div class="col-md-4">
            <h2 style="margin-top: 0px">Sub Kategori</h2>
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
              <h3 class="box-title">Tambah Data Sub Kategori</h3>
            </div>
            <form class="form-horizontal" id="form_sub_kategori" method="post" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group">
                  <label class="col-sm-2 control-label">Name</label>
                  <div class="col-sm-10">
                    <input type="hidden" name="id_sub_kategori" />
                    <input type="text" class="form-control" name="nama_sub" placeholder="Sub Kategori" required/>
                  </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Kategori</label>
                    <div class="col-sm-10">
                        <select name="category" class="form-control"  required>
                            <option value="">Pilih Kategori</option>
                            <?php foreach ($category as $item): ?>
                            <option value="<?php echo $item['id_category'] ?>">
                                <?php echo ucwords($item['nama_category']) ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
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
                <button type="button" id="btn_sub_kategori" onclick="save_sub_kategori()" class="btn btn-info pull-right">Tambah Data </button>
              </div>
            </form>
          </div>
        </div>
        <div class="col-md-7">
            <div class="box">
                <div class="box-body">
                    <table class="table table-hover table-bordered dt-responsive order-column" id="tableSub_kategori" style="width:100%;">
                        <thead>
                            <tr>
                                <th class="text-center" width="80px">No</th>
                                <th class="text-center">Kategori</th>
                                <th class="text-center">Sub Kategori</th>
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
    <!-- <script>
						    $(function () {
						        $('#hover, #striped, #condensed').click(function () {
						            var classes = 'table';
						
						            if ($('#hover').prop('checked')) {
						                classes += ' table-hover';
						            }
						            if ($('#condensed').prop('checked')) {
						                classes += ' table-condensed';
						            }
						            $('#table-style').bootstrapTable('destroy')
						                .bootstrapTable({
						                    classes: classes,
						                    striped: $('#striped').prop('checked')
						                });
						        });
						    });
						
						    function rowStyle(row, index) {
						        var classes = ['active', 'success', 'info', 'warning', 'danger'];
						
						        if (index % 2 === 0 && index / 2 < classes.length) {
						            return {
						                classes: classes[index / 2]
						            };
						        }
						        return {};
						    }
						</script> -->
    </div>
</section>