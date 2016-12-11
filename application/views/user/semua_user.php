<div class="row">
	<div class="col-md-10 col-md-offset-1"><?php echo $this->session->flashdata('alert'); ?></div>
	<div class="col-md-12">
		<div class="col-md-4">
			<a href="<?php echo site_url('user/adduser') ?>" class="btn btn-white btn-default btn-bold btn-round">
				<i class="ace-icon fa fa-plus gray"></i> Tambahkan Pengguna
			</a>
			<div class="space-4"></div>
		</div>
		<div class="col-md-3 pull-right">
	<?php echo form_open(site_url("user"), array('method' => 'get')); ?>
			<div class="input-group">
				<input class="form-control input-sm" name="q" type="text" placeholder="Pencarian..." value="<?php echo $this->input->get('q') ?>" />
				<span class="input-group-addon" type="button">
					<i class="ace-icon fa fa-search"></i>
				</span>
			</div>
	<?php echo form_close(); ?>
			<div class="space-4"></div>
		</div>
<?php echo form_open(site_url('user/bulkuser')); ?>
		<table class="table table-hover table-bordered">
			<thead>
				<tr>
					<th width="30">
						<label class="pos-rel">
							<input type="checkbox" class="ace" /> <span class="lbl"></span>
						</label>
					</th>
					<th>Username</th>
					<th>Nama Lengkap</th>
					<th>Akses</th>
					<th width="100">Tindakan</th>
				</tr>
			</thead>
			<tbody>
<?php  
/* Start Loop Users All */
foreach($users as $row) :
?>
				<tr>
					<td>
	<?php  
	// cek tidak sama dengan sessionid
	if($this->session->userdata('user')->ID_user != $row->ID_user) :
	?>
						<label class="pos-rel">
							<input type="checkbox" class="ace" name="users[]" value="<?php echo $row->ID_user; ?>" /> <span class="lbl"></span>
						</label>
	<?php  
	endif;
	?>
					</td>
					<td><?php echo $row->username; ?></td>
					<td><?php echo $row->nama_lengkap; ?></td>
					<td><?php echo ($row->level=='admin') ? 'Administrator' : 'Operator'; ?></td>
					<td>
						<div class="hidden-sm hidden-xs action-buttons">
							<a class="green" href="<?php echo site_url("user/get/{$row->ID_user}") ?>" data-rel="popover" data-trigger="hover" data-placement="top" data-content="Sunting">
									<i class="ace-icon fa fa-pencil bigger-130"></i>
							</a>
	<?php  
	// cek tidak sama dengan sessionid
	if($this->session->userdata('user')->ID_user != $row->ID_user) :
	?>
							<a class="red open-user-delete" href="#" data-id="<?php echo $row->ID_user; ?>" data-rel="popover" data-trigger="hover" data-placement="top" data-content="Hapus">
								<i class="ace-icon fa fa-trash-o bigger-130"></i>
							</a>
	<?php  
	endif;
	?>
						</div>
						<div class="hidden-md hidden-lg text-center">
							<div class="inline pos-rel">
								<button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
									<i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
								</button>

								<ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
									<li>
										<a href="<?php echo site_url("user/get/{$row->ID_user}") ?>" class="tooltip-success" data-rel="tooltip" title="Sunting">
											<span class="green"><i class="ace-icon fa fa-pencil-square-o bigger-120"></i></span>
										</a>
									</li>
	<?php  
	// cek tidak sama dengan sessionid
	if($this->session->userdata('user')->ID_user != $row->ID_user) :
	?>
									<li>
										<a href="#" data-id="<?php echo $row->ID_user; ?>" class="tooltip-error open-user-delete" data-rel="tooltip" title="Hapus">
											<span class="red"><i class="ace-icon fa fa-trash-o bigger-120"></i></span>
										</a>
									</li>
	<?php  
	endif;
	?>
								</ul>
							</div>
						</div>
					</td>
				</tr>
<?php  
/* End Loops */
endforeach;
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
					<button name="action" value="set_update" class="btn btn-minier btn-white btn-round btn-primary" data-rel="popover" data-trigger="hover" data-placement="top" data-content="Sunting">
						<i class="ace-icon fa fa-pencil"></i> <small> Sunting</small>
					</button>
					<a class="btn btn-minier btn-white btn-round btn-danger open-delete-multiple" data-rel="popover" data-trigger="hover" data-placement="top" data-content="Hapus">
						<i class="ace-icon fa fa-trash-o"></i> <small> Hapus</small>
					</a>
				</th>
			</tr>
			</thead>
		</table>
		<div class="modal" id="modal-delete-multiple">
			<div class="modal-dialog modal-sm">
				<div class="modal-content">
					<div class="modal-header bg-delete">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h5 class="modal-title"><i class="fa fa-question-circle"></i> Hapus</h5>
					</div>
					<div class="modal-body">
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
<?php echo form_close(); ?>
		<div class="col-md-12 text-center">
			<?php echo $this->pagination->create_links(); ?>
		</div>
	</div>
</div>

<div class="modal" id="modal-delete">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header bg-delete">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h5 class="modal-title"><i class="fa fa-question-circle"></i> Hapus</h5>
			</div>
			<div class="modal-body">
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