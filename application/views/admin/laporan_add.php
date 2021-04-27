<section class="content-header">
	<h1 style="margin-top: 0px;">New Ticket
	<small>Create New Ticket Here</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url()?>"><i class="fa fa-dashboard"></i>Dasboard</a></li>
		<li class="active">New Ticket</li>
	</ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<a href="<?php echo base_url('admin/detail_laporan')?>" class="active">
						<h4 style="" class="fa fa-android"> Detail Ticket</h4>
					</a>
				</div>
				<div class="panel-body">
					<div class="col-md-12">
						<form id="formLaporan" method="post" action="<?php echo base_url();?>">
							<div class="panel panel-info">
								<div class="panel-heading">
									User Information
								</div>
								<div class="panel-body">
									<div class="col-md-6">
										<div class="form-group">
											<label for="">Nama Lengkap</label>
											<input type="text" class="form-control" name="nama" placeholder="Nama Lengkap" required>
										</div>
										<div class="form-group">
											<label for="">Departement</label>
											<input type="text" class="form-control" name="depart" placeholder="Departement" required>
										</div>
										<div class="form-group">
											<label for="">No Telp/Handphone</label>
											<input type="text" class="form-control" name="nohp" placeholder="(021) / +628xxxx" required>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="">Lokasi</label>
											<input type="text" class="form-control" name="lokasi" placeholder="Lokasi" required>
										</div>
										<div class="form-group">
											<label for="">Alamat Lengkap</label>
											<input type="text" class="form-control" name="alamat" placeholder="Alamat Lengkap" required>
										</div>
									</div>
								</div>
							</div>
							<div class="panel panel-danger">
								<div class="panel-heading">
									Detail Masalah
								</div>
								<div class="panel-body">
									<div class="col-md-6">
										<div class="form-group">
											<label>Case ID</label>
											<input type="hidden" name="id_laporan" />
											<?php if ($this->ion_auth->is_admin() || $this->ion_auth->in_group('helpdesk')): ?>
												<input type="text" class="form-control" name="case_id" placeholder="case ID" required />
												<span class="help-block"></span>
											<?php else :?>
												<input type="text" class="form-control" name="case_id" placeholder="case ID" readonly />
												<span class="help-block"></span>
											<?php endif;?>
										</div>
										<div class="form-group">
										<?php if ($this->ion_auth->is_admin() || $this->ion_auth->in_group('mod')): ?>
											<label for="">Tiket BTPN</label>
											<input type="text" class="form-control" name="tiket_btpn" placeholder="Tiket BTPN" required>
										<?php else: ?>
											<label for="">Tiket BTPN</label>
											<input type="text" class="form-control" name="tiket_btpn" placeholder="Tiket BTPN" readonly>
										<?php endif; ?>
										</div>
										<div class="form-group">
											<label>Kategori Masalah</label>
											<select name="category" class="form-control" id="category" required>
												<option value="">Pilih Kategori</option>
												<?php foreach ($category as $item): ?>
												<option value="<?php echo $item['id_category'] ?>">
													<?php echo $item['nama_category'] ?>
												</option>
												<?php endforeach; ?>
											</select>
										</div>
										<div class="form-group" id="sub_kategoris">
											<label for="sub_kategori">Sub Kategori</label>
											<select name="sub_kategori" class="form-control" id="sub_kategori" disabled="" required>
												<option value="">Pilih Sub Kategori</option>
												<!-- <option value=""><?php echo $nama_sub_kategori ?></option> -->
											</select>
											<!-- <input type="text" class="form-control" id="sub_other" name="sub_other" placeholder="Sub Kategori"> -->
										</div>
										<div class="form-group">
											<label>Status</label>
											<div class="form-group">
												<select name="status" class="form-control" required />
												<option value="1">Aktif</option>
												<option value="0">Nonaktif</option>
												</select>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="">Serial Number & Imei Problem</label>
											<input type="text" class="form-control" style="margin-bottom: 10px;" id="imei_problem" name="imei_prob" placeholder="Imei Problem">
											<input type="text" class="form-control" name="sn_prob" placeholder="Serial Number">
										</div>
										<div class="form-group">
											<label for="">Serial Number & Imei Replace</label>
											<?php if ($this->ion_auth->in_group('mod')) : ?>
											<input type="text" class="form-control" style="margin-bottom: 10px;" name="imei_rep" placeholder="Imei Replace" readonly>
											<input type="text" class="form-control" name="sn_rep" placeholder="Serial Number " readonly>
											<?php else : ?>
											<input type="text" class="form-control" style="margin-bottom: 10px;" name="imei_rep" placeholder="Imei Replace">
											<input type="text" class="form-control" name="sn_rep" placeholder="Serial Number ">
											<?php endif; ?>
										</div>
									</div>
								</div>
							</div>
							<div class="panel panel-danger">
								<div class="panel-heading">
									Deskripsi
								<!-- </div> -->
								<div class="form-group">
									<!-- <label for="pwd">Deskripsi Masalah </label> -->
									<textarea name="text" id="content" class="form-control editorKeren" style="width:100%;" placeholder="Isi Konten" cols="30" rows="20" required></textarea>
								</div>
							</div>
							</div>
							<div class="form-group">
								<button type="reset" class="btn btn-danger">Reset</button>
								<button type="button" id="btnLaporan" onclick="saveLaporan()" class="btn btn-info pull-right">Tambah Tiket</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>



<!-- <section class="content">
    <div class="row" style="margin-bottom: 10px">
        <div class="col-md-4">
            <h2 style="margin-top: 0px">Add New Case</h2>
        </div>
    </div>
    <div class="row">
        <form id="formLaporan" method="post" enctype="multipart/form-data"> -->
<!-- <div class="col-md-9"> -->
<!-- <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Editor</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label>Case ID</label>
                            <input type="hidden" name="id_laporan" />
                            <?php if ($this->ion_auth->in_group('mod')): ?>
                                 <input type="text" class="form-control" name="case_id" placeholder="case ID" readonly/>

                            <?php else :?>
                                <input type="text" class="form-control" name="case_id" placeholder="case ID" required/>
                            <?php endif;?>
                        </div>
                        <div class="form-group">
                            <label>Tiket Btpn</label>
                            <?php if ($this->ion_auth->in_group('helpdesk')): ?>
                            <input type="text" class="form-control" name="tiket_btpn" placeholder="Tiket BTPN" readonly>
                            <?php else :?>
                            <input type="text" class="form-control" name="tiket_btpn" placeholder="Tiket BTPN" required>
                            <?php endif;?>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <div class="form-group">
                                <select name="status" class="form-control" required/>
                                    <option value="1">Aktif</option>
                                    <option value="0">Nonaktif</option>
                                </select>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="reset" class="btn btn-danger">Reset</button>
                            <button type="button" id="btnLaporan" onclick="saveLaporan()" class="btn btn-info pull-right">Add Laporan</button>
                        </div>
                    </div> -->
<!-- <div class="box-footer"></div> -->
<!-- </div> -->
</div>
<!-- </form>
    </div>
</div>
</section> -->
