<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row">
	<div class="col-md-12">
		<div class="col-md-5">
			<label>Tampilkan </label>
			<select name="per_page" id="input" class="select-page" onchange="window.location = '<?php echo site_url('mahasiswa?per_page='); ?>' + this.value + '&q=<?php echo $this->input->get('q'); ?>';">
				<option value="20" <?php echo (!$this->input->get('per_page')) ? 'selected' : ''; ?>>20</option>
				<option value="40" <?php echo ($this->input->get('per_page')==40) ? 'selected' : ''; ?>>40</option>
				<option value="60" <?php echo ($this->input->get('per_page')==60) ? 'selected' : ''; ?>>60</option>
				<option value="80" <?php echo ($this->input->get('per_page')==80) ? 'selected' : ''; ?>>80</option>
				<option value="100" <?php echo ($this->input->get('per_page')==100) ? 'selected' : ''; ?>>100</option>
			</select>
			<label> per halaman </label>
			<div class="space-4"></div>
		</div>
		<div class="col-md-4">
			<a href="<?php echo site_url('mahasiswa/add') ?>" class="btn btn-white btn-default btn-bold btn-round btn-sm">
				<i class="ace-icon fa fa-plus gray"></i> Tambah
			</a>
			<a href="<?php echo site_url('mahasiswa/import') ?>" class="btn btn-white btn-default btn-bold btn-round btn-sm">
				<i class="ace-icon fa fa-upload gray"></i> Import
			</a>
			<a href="<?php echo site_url('mahasiswa/export') ?>" class="btn btn-white btn-default btn-bold btn-round btn-sm">
				<i class="ace-icon fa fa-file-excel-o gray"></i> Export
			</a>
			<a href="<?php echo site_url('mahasiswa/print') ?>" class="btn btn-white btn-default btn-bold btn-round btn-sm">
				<i class="ace-icon fa fa-print gray"></i> Print
			</a>
			<div class="space-4"></div>
		</div>
		<div class="col-md-3 pull-right">
	<?php echo form_open(site_url("mahasiswa"), array('method' => 'get')); ?>
			<div class="input-group">
				<input class="form-control input-sm" name="q" type="text" placeholder="Pencarian..." value="<?php echo $this->input->get('q') ?>" />
				<span class="input-group-addon" type="button">
					<i class="ace-icon fa fa-search"></i>
				</span>
			</div>
	<?php echo form_close(); ?>
			<div class="space-4"></div>
		</div>
		<div class="col-md-12"><hr></div>
		
		<div class="col-md-10 col-md-offset-1"><?php echo $this->session->flashdata('alert'); ?><div class="space-4"></div></div>	
<?php  
// open form multiple action
echo form_open(site_url('mahasiswa/bulk_action'));
?>
		<table class="table table-bordered table-hover mini-font">
			<thead>
				<tr>
					<th width="30">
						<label class="pos-rel">
							<input type="checkbox" class="ace" /> <span class="lbl"></span>
						</label>
					</th>
					<th width="50">No.</th>
					<th width="100"></th>
					<th>NPM</th>
					<th>Nama Lengkap</th>
					<th>Jenis Kelamin</th>
					<th>Tanggal Lahir</th>
					<th>Program Studi</th>
					<th>Tahun Masuk</th>
					<th width="70"></th>
				</tr>
			</thead>
			<tbody>
<?php  
$no = (!$this->input->get('page')) ? 0 : $this->input->get('page');
// start Loop Mahasiswa
foreach($mahasiswa as $row) :
?>
				<tr>
					<td>
						<label class="pos-rel">
							<input name="mahasiswa[]" type="checkbox" class="ace" value="<?php echo $row->ID; ?>" /> <span class="lbl"></span>
						</label>
					</td>
					<td><?php echo ++$no; ?>.</td>
					<td>
			<?php  
			if($row->foto != '') :
			?>
						<img id="preview-image" src="<?php echo base_url("assets/foto-ktm/{$row->foto}"); ?>" id="preview-picture" alt="" class="img-responsive" width="100" height="150">
			<?php else : ?>
						<img id="preview-image" src="<?php echo base_url("assets/foto-ktm/temp.jpg"); ?>" id="preview-picture" alt="" class="img-responsive" width="100" height="150">
			<?php  
			endif;
			?>
					</td>
					<td><?php echo $row->npm; ?></td>
					<td><?php echo $row->nama_lengkap; ?></td>
					<td><?php echo $row->jenis_kelamin; ?></td>
					<td><?php echo str_replace('-', '/', $row->tgl_lahir); ?></td>
					<td><?php echo $row->program_studi; ?></td>
					<td><?php echo $row->thn_masuk; ?></td>
					<td class="text-center">
						<div class="action-buttons">
							<a class="green" href="<?php echo site_url("mahasiswa/get/{$row->ID}") ?>" data-rel="popover" data-trigger="hover" data-placement="top" data-content="Sunting">
									<i class="ace-icon fa fa-pencil bigger-130"></i>
							</a>
							<a class="red open-mahasiswa-delete" href="#" data-id="<?php echo $row->ID; ?>" data-rel="popover" data-trigger="hover" data-placement="top" data-content="Hapus">
								<i class="ace-icon fa fa-trash-o bigger-130"></i>
							</a>
						</div>
					</td>
				</tr>
<?php  
// end Loops
endforeach;

// set alert empty data mahasiswa
if(!$mahasiswa) :
?>
<tr>
	<td colspan="10">
		<div class="alert alert-warning animated fadeIn col-md-5 col-md-offset-3">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<strong>Maaf!</strong> Tidak ada data mahasiswa.
		</div>
	</td>
</tr>
<?php  
endif;
?>
			</tbody>
			<thead>
			<tr>
				<th>
					<label class="pos-rel">
						<input type="checkbox" class="ace" /> <span class="lbl"></span>
					</label>
				</th>
				<th colspan="7">
					<small style="padding-right:20px;">Yang Terpilih :</small>
					<a class="btn btn-minier btn-white btn-round btn-danger open-delete-mahasiswa-multiple" data-rel="popover" data-trigger="hover" data-placement="top" data-content="Hapus">
							<i class="ace-icon fa fa-trash-o"></i> <small> Hapus</small>
					</a>
				</th>
				<th colspan="2">Total <?php echo count($mahasiswa)."\ndari\n".$total_rows; ?> data</th>
			</tr>
			</thead>
		</table>
<?php  
// set Modal delete all
?>
<div class="modal" id="modal-delete-mahasiswa-multiple">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header bg-delete">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h5 class="modal-title"><i class="fa fa-question-circle"></i> Hapus data yang terpilih ?</h5>
			</div>
			<div class="modal-body">
				<div class="alert alert-danger bigger-110">
					Ini mungkin akan menyebabkan data yang berkaitan akan ikut terhapus.
				</div>
				<p class="bigger-110 bolder center grey">
					<i class="ace-icon fa fa-hand-o-right blue bigger-120"></i> Yakin menghapusnya?
				</p>
			</div>
			<div class="modal-footer text-center">
				<a class="btn btn-sm pull-right btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Batal</a>
				<button name="action" value="delete" class="btn btn-sm pull-left btn-danger"><i class="fa fa-trash-o"></i> Hapus</button>
			</div>
		</div>
	</div>
</div>
<?php  
// end form multiple
echo form_close();
?>
		<div class="col-md-12 text-center"><?php echo $this->pagination->create_links(); ?></div>
	</div>
</div>


<!--  modal -->
<div class="modal" id="modal-delete-mahasiswa">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header bg-delete">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h5 class="modal-title"><i class="fa fa-question-circle"></i> Hapus data ini ?</h5>
			</div>
			<div class="modal-body">
				<div class="alert alert-danger bigger-110">
					Ini mungkin akan menyebabkan data yang berkaitan akan ikut terhapus.
				</div>
				<p class="bigger-110 bolder center grey">
					<i class="ace-icon fa fa-hand-o-right blue bigger-120"></i> Yakin menghapusnya?
				</p>
			</div>
			<div class="modal-footer text-center">
				<a class="btn btn-sm pull-right btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Batal</a>
				<a id="button-delete" class="btn btn-sm pull-left btn-danger"><i class="fa fa-trash-o"></i> Hapus</a>
			</div>
		</div>
	</div>
</div>