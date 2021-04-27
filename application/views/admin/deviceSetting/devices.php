<section class="content-header">
    <h1>
        Device Configuration
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url()?>"><i class="fa fa-dashboard"></i>Home</a></li>
        <li><i class="fa fa-cog"></i> Devices Configuration</li>
        <li class="active"><a href="#">Detail Tiket</a></li>
    </ol>
</section>

<section class="content">
    <div class="box">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">
                    Tambah Data Master Device
                </h3>
            </div>
            <form method="post" class="form-horizontal" id="formDevice" enctype="multipart/form-data">
                <div class="box-body">
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">Device :</label>
                        <div class="col-sm-10">
                            <input type="hidden" name="id_device">
                            <input type="text" name="nama_device" class="form-control" id="device" placeholder="Jenis Device" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">Brand :</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="brand" id="brand" placeholder="Brand Device" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">Model :</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="model" id="model" placeholder="Model Device" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Serial Number :</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="sn" placeholder="Serial Number" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">IMEI :</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="imei" placeholder="IMEI" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="lob" class="col-sm-2 control-label">LOB :</label>
                        <div class="col-sm-10">
                            <select name="nama_lob" id="lob" class="form-control" required>
                                <option value="">Pilih LOB</option>
                                <?php foreach($lob as $lb) :?>
                                <option value="<?php echo $lb['id_lob'] ?>">
                                    <?php echo ucwords($lb['nama_lob']) ?>
                                </option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="service" class="col-sm-2 control-label">Service :</label>
                        <div class="col-sm-10">
                            <select name="jenis_service" class="form-control" required>
                                <option value="">Pilih Service</option>
                                <?php foreach($service as $sc) :?>
                                <option value="<?php echo $sc['id_service'] ?>">
                                    <?php echo ucwords($sc['service']) ?>
                                </option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="reset" class="btn btn-danger">Reset</button>
                    <button type="button" id="btnDevice" class="btn btn-info pull-right" onclick="saveDevice()">Tambah Device</button>
                </div>
            </form>
        </div>
    </div>
</section>

<section class="content">
    <div class="box">
        <div class="box-body">
            <table class="table table-hover table-bordered dt-responsive" id="tableDevice" style="width: 100%;">
                <thead>
                    <tr>
                        <th class="text-center" width="80px">No</th>
                        <th class="text-center">Device</th>
                        <th class="text-center">Brand</th>
                        <th class="text-center">Model</th>
                        <th class="text-center">Serial Number</th>
                        <th class="text-center">IMEI</th>
                        <th class="text-center">LOB</th>
                        <th class="text-center">Service</th>
                        <!-- <th class="text-center">Create at</th> -->
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    </div>
</section>