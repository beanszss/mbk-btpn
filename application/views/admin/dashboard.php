

</script>
<!-- ========== -->

<section class="content-header">
	<h1>
		Dashboard
		<small>Control panel</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active">Dashboard</li>
	</ol>
</section>

<section class="content">
<div class="row">
    <div class="col-lg-3 col-xs-6">
			<div class="small box box-info bg-aqua">
        <div class="inner box-body" id="tableWow">
          <div class="box-header">
            <h4 align="center">BTPN WOW</h4>
          </div>
          <div>
            <p>Total Device :</p>
            <h6>
              <a href="<?php echo base_url('admin/get_wow?type=master_wow') ?>">
                <span class="btn col-lg-12 bg-aqua no-border btn-github"> 
                  <?php echo $count_master_wow ?> 
                  <i class="fa fa-arrow-circle-right"></i>
                </span>
              </a>
            </h6>
          </div>
          <div>
            <p>Warranty :</p>
            <h6>
              <a href="<?php echo base_url('admin/get_wow?=warranty_wow') ?>">
                <span class="btn col-lg-12 bg-aqua no-border btn-github">
                  <?php echo $count_warranty_wow ?>
                  <i class="fa fa-arrow-circle-right"></i>
                </span>
              </a>
            </h6>
          </div>
          <div>
            <p>Backup :</p>
            <h6>
              <a href="<?php echo base_url('/') ?>">
                <span class="btn col-lg-12 bg-aqua no-border btn-github">
                <?php echo $count_other_wow ?>
                </span>
              </a>
            </h6>			
          </div>
        </div>
				<!-- <a href="<?php echo base_url('admin/get_wow?type=master_wow') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
			</div>
    </div>
    <div class="col-lg-3 col-xs-6">
			<div class="small box box-info bg-gray-active">
        <div class="inner box-body" id="tableWow">
          <div class="box-header">
            <h4 align="center">BTPN Purnabakti</h4>
          </div>
          <div>
            <p>Total Device :</p>
            <h6>
              <a href="<?php echo base_url('admin/get_pur?type=master_pur') ?>">
                <span class="btn col-lg-12 bg-gray-active no-border btn-github"> 
                  <?php echo $count_master_pur ?> 
                  <i class="fa fa-arrow-circle-right"></i>
                </span>
              </a>
            </h6>
          </div>
          <div>
            <p>Warranty :</p>
            <h6>
              <a href="<?php echo base_url('admin/get_pur?=warranty_pur') ?>">
                <span class="btn col-lg-12 bg-gray-active no-border btn-github">
                  <?php echo $count_warranty_pur ?>
                  <i class="fa fa-arrow-circle-right"></i>
                </span>
              </a>
            </h6>
          </div>
          <div>
            <p>Backup :</p>
            <h6>
              <a href="<?php echo base_url('/') ?>">
                <span class="btn col-lg-12 bg-gray-active no-border btn-github">
                <?php echo $count_other_pur ?>
                </span>
              </a>
            </h6>			
          </div>
        </div>
				<!-- <a href="<?php echo base_url('admin/get_wow?type=master_wow') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
			</div>
    </div>
    <div class="col-lg-3 col-xs-6">
      <div class="small box box-info bg-green">
        <div class="inner box-body" id="tableWow">
          <div class="box-header">
            <h4 align="center">BTPN MUR</h4>
          </div>
          <div>
            <p>Total Device :</p>
            <h6>
              <a href="<?php echo base_url('admin/get_mur?type=master_mur') ?>">
                <span class="btn col-lg-12 bg-green no-border btn-github"> 
                  <?php echo $count_master_mur ?> 
                  <i class="fa fa-arrow-circle-right"></i>
                </span>
              </a>
            </h6>
          </div>
          <div>
            <p>Warranty :</p>
            <h6>
              <a href="<?php echo base_url('admin/get_mur?=warranty_mur') ?>">
                <span class="btn col-lg-12 bg-green no-border btn-github">
                  <?php echo $count_warranty_mur ?>
                  <i class="fa fa-arrow-circle-right"></i>
                </span>
              </a>
            </h6>
          </div>
          <div>
            <p>Backup :</p>
            <h6>
              <a href="<?php echo base_url('/') ?>">
                <span class="btn col-lg-12 bg-green no-border btn-github">
                <?php echo $count_other_mur ?>
                </span>
              </a>
            </h6>			
          </div>
        </div>
        <!-- <a href="<?php echo base_url('admin/get_wow?type=master_wow') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
      </div>
    </div>
    <div class="col-lg-3 col-xs-6">
      <div class="small box box-info bg-light-blue">
        <div class="inner box-body" id="tableWow">
          <div class="box-header">
            <h4 align="center">BTPN Sinaya</h4>
          </div>
          <div>
            <p>Total Device :</p>
            <h6>
              <a href="<?php echo base_url('admin/get_sinaya?type=master_sinaya') ?>">
                <span class="btn col-lg-12 bg-light-blue no-border btn-github"> 
                  <?php echo $count_master_sinaya ?> 
                  <i class="fa fa-arrow-circle-right"></i>
                </span>
              </a>
            </h6>
          </div>
          <div>
            <p>Warranty :</p>
            <h6>
              <a href="<?php echo base_url('admin/get_sinaya?=warranty_sinaya') ?>">
                <span class="btn col-lg-12 bg-light-blue no-border btn-github">
                  <?php echo $count_warranty_sinaya ?>
                  <i class="fa fa-arrow-circle-right"></i>
                </span>
              </a>
            </h6>
          </div>
          <div>
            <p>Backup :</p>
            <h6>
              <a href="<?php echo base_url('/') ?>">
                <span class="btn col-lg-12 bg-light-blue no-border btn-github">
                <?php echo $count_other_sinaya ?>
                </span>
              </a>
            </h6>			
          </div>
        </div>
        <!-- <a href="<?php echo base_url('admin/get_wow?type=master_wow') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
      </div>
    </div>
	</div>
  <!-- <div class="row">
    <div class="col-lg-12">
      <div class="small box box-info bg-success">
        <div class="inner box-body">
          <div class="box-header">
            <h5><b><u>Detail Case</u></b></h5>
          </div>
          <div align="center">
            <div class="col-lg-4">
              <p>On Progress :</p>
            </div>
            <div class="col-lg-4">
              <p>Resolved :</p>
            </div>
            <div class="col-lg-4">
              <p>Closed :</p>
            </div>  
          </div>
        </div>
      </div>
    </div>
  </div> -->
  <div class="row">
    <div class="col-lg-3 col-xs-6">
			<div class="small box box-body bg-yellow">
        <div class="inner box-body" id="tableWow">
          <div class="box-header">
            <h4 align="center">Jenius</h4>
          </div>
          <div>
            <p>Total Device :</p>
            <h6>
              <a href="<?php echo base_url('admin/get_jenius?type=master_jenius') ?>">
                <span class="btn col-lg-12 bg-yellow no-border btn-github"> 
                  <?php echo $count_master_jenius ?> 
                  <i class="fa fa-arrow-circle-right"></i>
                </span>
              </a>
            </h6>
          </div>
          <div>
            <p>Warranty :</p>
            <h6>
              <a href="<?php echo base_url('/') ?>">
                <span class="btn col-lg-12 bg-yellow no-border btn-github">
                  <?php echo $count_warranty_jenius ?>
                  <i class="fa fa-arrow-circle-right"></i>
                </span>
              </a>
            </h6>
          </div>
          <div>
            <p>Backup :</p>
            <h6>
              <a href="<?php echo base_url('/') ?>">
                <span class="btn col-lg-12 bg-yellow no-border btn-github">
                <?php echo $count_other_jenius ?>
                </span>
              </a>
            </h6>			
          </div>
        </div>
				<!-- <a href="<?php echo base_url('admin/get_wow?type=master_wow') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
			</div>
    </div>
    <div class="col-lg-3 col-xs-6">
			<div class="small box box-body bg-teal">
        <div class="inner box-body" id="tableWow">
          <div class="box-header">
            <h4 align="center">SMBCI</h4>
          </div>
          <div>
            <p>Total Device :</p>
            <h6>
              <a href="<?php echo base_url('admin/get_smbc?type=master_smbc') ?>">
                <span class="btn col-lg-12 bg-teal no-border btn-github"> 
                  <?php echo $count_master_smbc ?> 
                  <i class="fa fa-arrow-circle-right"></i>
                </span>
              </a>
            </h6>
          </div>
          <div>
            <p>Warranty :</p>
            <h6>
              <a href="<?php echo base_url('/') ?>">
                <span class="btn col-lg-12 bg-teal no-border btn-github">
                  <?php echo $count_warranty_smbc ?>
                  <i class="fa fa-arrow-circle-right"></i>
                </span>
              </a>
            </h6>
          </div>
          <div>
            <p>Backup :</p>
            <h6>
              <a href="<?php echo base_url('/') ?>">
                <span class="btn col-lg-12 bg-teal no-border btn-github">
                <?php echo $count_other_smbc ?>
                </span>
              </a>
            </h6>			
          </div>
        </div>
				<!-- <a href="<?php echo base_url('admin/get_wow?type=master_wow') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
			</div>
    </div>
    <div class="col-lg-3 col-xs-6">
      <div class="small box box-body bg-red-gradient">
        <div class="inner box-body" id="tableWow">
          <div class="box-header">
            <h4 align="center">Quality Kiosk</h4>
          </div>
          <div>
            <p>Total Device :</p>
            <h6>
              <a href="<?php echo base_url('admin/get_wow?type=master_wow') ?>">
                <span class="btn col-lg-12 bg-red-gradient no-border btn-github"> 
                  <!-- <?php echo $count_master_wow ?>  -->
                  not defined
                  <i class="fa fa-arrow-circle-right"></i>
                </span>
              </a>
            </h6>
          </div>
          <div>
            <p>Warranty :</p>
            <h6>
              <a href="<?php echo base_url('admin/get_wow?=warranty_wow') ?>">
                <span class="btn col-lg-12 bg-red-gradient no-border btn-github">
                  <!-- <?php echo $count_warranty_wow ?> -->
                  not defined
                  <i class="fa fa-arrow-circle-right"></i>
                </span>
              </a>
            </h6>
          </div>
          <div>
            <p>Backup :</p>
            <h6>
              <a href="<?php echo base_url('/') ?>">
                <span class="btn col-lg-12 bg-red-gradient no-border btn-github">
                <!-- <?php echo $count_other_wow ?> -->
                not defined
                </span>
              </a>
            </h6>			
          </div>
        </div>
        <!-- <a href="<?php echo base_url('admin/get_wow?type=master_wow') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
      </div>
    </div>
    <div class="col-lg-3 col-xs-6">
      <div class="small box box-body bg-gray">
        <div class="inner box-body" id="tableWow">
          <div class="box-header">
            <h4 align="center">OTHERS</h4>
          </div>
          <div>
            <p>Total Device :</p>
            <h6>
              <a href="<?php echo base_url('admin/get_other?type=master_other') ?>">
                <span class="btn col-lg-12 bg-gray no-border btn-github"> 
                  <?php echo $count_master_other ?> 
                  <i class="fa fa-arrow-circle-right"></i>
                </span>
              </a>
            </h6>
          </div>
          <div>
            <p>Warranty :</p>
            <h6>
              <a href="<?php echo base_url('/') ?>">
                <span class="btn col-lg-12 bg-gray no-border btn-github">
                  <?php echo $count_warranty_other ?>
                  <i class="fa fa-arrow-circle-right"></i>
                </span>
              </a>
            </h6>
          </div>
          <div>
            <p>Backup :</p>
            <h6>
              <a href="<?php echo base_url('/') ?>">
                <span class="btn col-lg-12 bg-gray no-border btn-github">
                <?php echo $count_other ?>
                </span>
              </a>
            </h6>			
          </div>
        </div>
        <!-- <a href="<?php echo base_url('admin/get_wow?type=master_wow') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
      </div>
    </div>
	</div>
  
  
    


	
</div>
</div>

</section>