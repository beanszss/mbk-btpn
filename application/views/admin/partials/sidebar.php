<aside class="main-sidebar">
	<!-- sidebar: style can be found in sidebar.less -->
	
	<section class="sidebar">
		<!-- Sidebar user panel -->
		<div class="user-panel">
			<div class="pull-left image">
				<img src="<?php echo base_url()?>assets/backend/dist/img/avatar.png" class="img-circle" alt="User Image">
			</div>
			<div class="pull-left info">
				<p>
					<?php echo $this->session->userdata('full_name') ?>
				</p>
				<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
			</div>
		</div>
		<!-- <div class="slimScrollDiv" > -->
			<ul class="sidebar-menu" data-widget="tree">
				<li class="header">MAIN NAVIGATION</li>
					<li>
						<a href="<?php echo base_url('admin/')?>">
							<i class="fa fa-dashboard"></i> 
							<span> Dashboard</span>
						</a>
					</li>
				<li><a href="<?php echo base_url('admin/map')?>"><i class="fa fa-globe"></i> <span> Map</span></a></li>
				<?php if($this->ion_auth->in_group('mod') || $this->ion_auth->is_admin()): ?>
				<li><a href="<?php echo base_url('admin/laporan?type=add') ?>"><i class="fa fa-edit"></i><span> Create New Ticket</span></a></li>
				<?php endif;?>
				<li>
					<a href="<?php echo base_url('admin/detail_laporan')?>"><i class="fa fa-file-o"></i><span> Detail Case</span></a>
				</li>
				<?php if($this->ion_auth->is_admin() || $this->ion_auth->in_group('mod')): ?>
				<li>
					<a href="<?php echo base_url('admin/detail_kanwil') ?>"><i class="fa fa-adjust"></i> <span>Detail Data Cabang</span></a>
				</li>
				<?php endif;?>
				<li class="treeview">
					<a href="#">
						<i class="fa fa-tasks"></i>
						<span>Device</span>
						<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
						</span>
					</a>
					<ul class="treeview-menu">
						<li><a href="<?php echo base_url('admin/get_device') ?>"><i class="fa fa-circle-o"></i>Master Device</a></li>
						<li class="treeview">
							<a href="#"><i class="fa fa-list-alt"></i> <span>Details WOW</span>
								<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li><a href="<?php echo base_url('admin/get_wow?type=master_wow') ?>"><i class="fa fa-circle-o"></i>Master Data</a></li>
								<li><a href="<?php echo base_url('admin/get_wow?=warranty_wow')?>"><i class="fa fa-circle-o"></i>Warranty</a></li>
							</ul>
						</li>
						<li class="treeview">
							<a href="#"><i class="fa fa-list-alt"></i> <span>Details Pur</span>
								<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li><a href="<?php echo base_url('admin/get_pur?type=master_pur') ?>"><i class="fa fa-circle-o"></i>Master Data</a></li>
								<li><a href="<?php echo base_url('admin/get_pur?=warranty_pur')?>"><i class="fa fa-circle-o"></i>Warranty</a></li>
							</ul>
						</li>
						<li class="treeview">
							<a href="#"><i class="fa fa-list-alt"></i> <span>Details Mur</span>
								<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li><a href="<?php echo base_url('admin/get_mur?type=master_mur') ?>"><i class="fa fa-circle-o"></i>Master Data</a></li>
								<li><a href="<?php echo base_url('admin/get_mur?=warranty_mur')?>"><i class="fa fa-circle-o"></i>Warranty</a></li>
							</ul>
						</li>
						<li class="treeview">
							<a href="#"><i class="fa fa-list-alt"></i> <span>Details Sinaya</span>
								<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li><a href="<?php echo base_url('admin/get_sinaya?type=master_sinaya') ?>"><i class="fa fa-circle-o"></i>Master Data</a></li>
								<li><a href="<?php echo base_url('admin/get_sinaya?=warranty_sinaya')?>"><i class="fa fa-circle-o"></i>Warranty</a></li>
							</ul>
						</li>
						<li class="treeview">
							<a href="#"><i class="fa fa-list-alt"></i> <span>Details SMBC</span>
								<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li><a href="<?php echo base_url('admin/get_smbc?type=master_smbc') ?>"><i class="fa fa-circle-o"></i>Master Data</a></li>
								<!-- <li><a href="<?php echo base_url('admin/get_smbc?=warranty_smbc')?>"><i class="fa fa-circle-o"></i>Warranty</a></li> -->
							</ul>
						</li>
						<li class="treeview">
							<a href="#"><i class="fa fa-list-alt"></i> <span>Details Jenius</span>
								<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li><a href="<?php echo base_url('admin/get_jenius?type=master_jenius') ?>"><i class="fa fa-circle-o"></i>Master Data</a></li>
								<!-- <li><a href="<?php echo base_url('admin/get_smbc?=warranty_smbc')?>"><i class="fa fa-circle-o"></i>Warranty</a></li> -->
							</ul>
						</li>
						<li class="treeview">
							<a href="#"><i class="fa fa-list-alt"></i> <span>Details Others</span>
								<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li><a href="<?php echo base_url('admin/get_other?type=master_other') ?>"><i class="fa fa-circle-o"></i>Master Data</a></li>
								<!-- <li><a href="<?php echo base_url('admin/get_smbc?=warranty_smbc')?>"><i class="fa fa-circle-o"></i>Warranty</a></li> -->
							</ul>
						</li>
					</ul>
				</li>
				<?php if($this->ion_auth->is_admin() || $this->ion_auth->in_group('mod') ): ?>
				<li class="treeview">
					<a href="#">
						<i class="fa fa-wrench"></i> <span>Pengaturan</span>
						<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
						</span>
					</a>
					<ul class="treeview-menu">

						<li><a href="<?php echo base_url('admin/user') ?>"><i class="fa fa-user"></i> User Configuration</a></li>

						<li class="treeview">
							<a href="#"><i class="fa fa-cogs"></i> <span>Problem Configuration</span>
								<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li><a href="<?php echo base_url('admin/category')?>"><i class="fa fa-chain"></i><span>Problem Category</span></a></li>
								<li><a href="<?php echo base_url('admin/sub_kategori') ?>"><i class="fa fa-chain-broken"></i><span>Problem Details</span></a></li>
								<li><a href="<?php echo base_url('admin/allocated') ?>"><i class="fa fa-barcode"></i><span>Allocated Configuration</span></a></li>
								<li><a href="<?php echo base_url('admin/services') ?>"><i class="fa fa-object-ungroup"></i><span>Services Configuration</span></a></li>
								<li><a href="<?php echo base_url('admin/lob') ?>"><i class="fa fa-product-hunt"></i><span>Project Configuration</span></a></li>
								<li><a href="<?php echo base_url('admin/activity') ?>"><i class="fa fa-activity"></i><span>Activity Configuration</span></a></li>
							</ul>
						</li>
						<li class="treeview">
							<a href="#"><i class="fa fa-mobile-phone"></i> <span>Devices Configuration</span>
								<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li><a href="<?php echo base_url('admin/deviceType') ?>"><i class="fa fa-th-large"></i><span>Device Type</span></a></li>
								<li><a href="<?php echo base_url('admin/deviceBrand') ?>"><i class="fa fa-barcode"></i><span>Device Brand</span></a></li>
								<li><a href="<?php echo base_url('admin/j_kanwil')?>"><i class="fa fa-chain"></i><span>Jenis Kantor Cabang</span></a></li>
								<li><a href="<?php echo base_url('admin/sub_kanwil') ?>"><i class="fa fa-institution"></i><span>Data Cabang Details</span></a></li>
								<li><a href="<?php echo base_url('admin/device') ?>"><i class="fa fa-adn"></i><span>Tablet Configuration</span></a></li>
							</ul>
						</li>
						<li>
							<a href="<?php echo base_url('admin/laporan')?>">
								<i class="fa fa-file"></i>
								<?php if($this->ion_auth->in_group('helpdesk')):?>
								<span>Case ID</span>
								<?php else:?>
								<span>Case ID Configuration</span>
								<?php endif;?>
								<span class="pull-right-container">
									<small class="label pull-right bg-yellow">10</small>
								</span>
							</a>
						</li>
						<!-- <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li> -->
					</ul>
					
				</li>
				<?php endif;?>
			</ul>
		<!-- </div> -->
	</section>
	
</aside>
<div class="content-wrapper">
