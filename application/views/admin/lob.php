<section class="content-header">
    <h1>LOB Configuration</h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url()?>"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li><i class="fa fa-cog"></i> Devices Configuration</li>
        <li><i class="fa fa-mixcloud active"></i> LOB Configuration</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-5">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">LOB Category</h3>
                </div>
                <form class="form-horizontal" id="formLob" method="post" enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">LOB</label>
                            <div class="col-sm-10">
                                <input type="hidden" name="id_lob">
                                <input type="text" class="form-control" name="lob" placeholder="LOB Category" required>
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
                        <button type="button" id="btnLob" onclick="saveLob()" class="btn btn-info pull-right">Save</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-7">
            <div class="box">
                <div class="box-body">
                    <table class="table table-hover table-bordered dt-responsive order-column" id="tableLob" style="width: 100%;">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">LOB</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>