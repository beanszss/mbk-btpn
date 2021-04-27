<section class="content">
	<div class="row">
		<div class="col-md-4">
			<h2 style="margin-top: 0px">Tiket detail</h2>
		</div>
	</div>
	<div class="box">
		<!-- <div class="box"> -->
			<div class="box-body">
				<table class="table  table-hover table-bordered dt-responsive" id="tableLaporan" style="width:100%;">
					<thead>
						<tr>
							<th class="text-center" width="80px">No</th>
							<th class="text-center">Case ID</th>
							<th class="text-center">Tiket BTPN</th>
							<th class="text-center">Create at</th>
							<!-- <th>Kebutuhan Bisnis</th> -->
							<th class="text-center">PIC</th>
							<th class="text-center">No Telp / Handphone</th>
							<th class="text-center">Lokasi</th>
							<th class="text-center">Alamat</th>
							<!-- <th>Type Device</th> -->
							<th class="text-center">Imei Problem</th>
							<th class="text-center">Sn Problem</th>
							<th class="text-center">Imei Replace</th>
							<th class="text-center">Sn Replace</th>
							<th class="text-center">Subject Masalah</th>
							<th class="text-center">Kategori</th>
							<!-- <th>Solution</th> -->
							<!-- <th>Status</th> -->
							<!-- <th>Last Update</th> -->
							<th class="text-center">Deskripsi</th>
							<th class="text-center">Active</th>
							<th class="text-center">Action</th>

						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		<!-- </div> -->
	</div>
	</div>
</section>

<div class="modal modal-child fade bd-example-modal-lg" id="modalLaporan" data-backdrop-limit="1" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Edit Laporan</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<form id="formLaporan" method="post" enctype="multipart/form-data">
						<div class="panel-body">
						<div class="panel panel-info">
								<div class="panel-heading">
									User Information
								</div>
								<div class="panel-body">
									<div class="col-md-6">
										<div class="form-group">
											<label for="">Nama Lengkap</label>
											<input type="text" class="form-control" name="nama" placeholder="Nama Lengkap" >
										</div>
										<div class="form-group">
											<label for="">Departement</label>
											<input type="text" class="form-control" name="depart" placeholder="Departement" >
										</div>
										<div class="form-group">
											<label for="">No Telp/Handphone</label>
											<input type="text" class="form-control" name="nohp" placeholder="(021) / +628xxxx" >
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="">Lokasi</label>
											<input type="text" class="form-control" name="lokasi" placeholder="Lokasi" >
										</div>
										<div class="form-group">
											<label for="">Alamat Lengkap</label>
											<input type="text" class="form-control" name="alamat" placeholder="Alamat Lengkap" >
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
											<?php if ($this->ion_auth->in_group('mod')): ?>
											<input type="text" class="form-control" name="case_id" placeholder="case ID" readonly />
											<span class="help-block"></span>
											<?php else :?>
											<input type="text" class="form-control" name="case_id" placeholder="case ID"  />
											<span class="help-block"></span>
											<?php endif;?>
										</div>
										<div class="form-group">
											<label for="">Tiket BTPN</label>
											<input type="text" class="form-control" name="tiket_btpn" placeholder="Tiket BTPN" >
										</div>
										<div class="form-group">
											<label>Kategori Masalah</label>
											<select name="category" class="form-control" id="category" >
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
											<select name="sub_kategori" class="form-control" id="sub_kategori" disabled="" >
												<option value="">Pilih Sub Kategori</option>
												<!-- <option value=""><?php echo $nama_sub_kategori ?></option> -->
											</select>
											<input type="text" class="form-control" id="sub_other" name="sub_other" placeholder="Sub Kategori">
										</div>
										<div class="form-group">
											<label>Status</label>
											<div class="form-group">
												<select name="status" class="form-control"  />
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
											<input type="text" class="form-control" style="margin-bottom: 10px;" name="imei_rep" placeholder="Imei Replace" >
											<input type="text" class="form-control" name="sn_rep" placeholder="Serial Number " >
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
									<textarea name="text" id="content" class="form-control editorKeren" style="width:100%;" placeholder="Isi Konten" cols="30" rows="20" ></textarea>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal"> Close</button>
							<button type="reset" class="btn btn-danger">Reset</button>
							<button type="button" id="btnLaporan" onclick="updateLaporan()" class="btn btn-info pull-right">Update Laporan</button>
						</div>
					</form>
				</div>
			</div>

		</div>
	</div>
</div>
</div>
