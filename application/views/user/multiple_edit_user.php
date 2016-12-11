<div class="row">
	<div class="col-md-10 col-md-offset-1"><?php echo $this->session->flashdata('alert'); ?></div>
	<div class="col-md-12">
		<div class="col-md-8 col-md-offset-2">
			<div class="form-group">
				<h4>Sunting Pengguna</h4><hr>
			</div>
<?php 
echo form_open(site_url("user/bulkuser"), array('class' => 'form-horiontal', 'id' => 'create_user')); 
if(is_array($this->input->post('users'))) :
	foreach($this->input->post('users') as $key => $value) :
		$get = $this->user->get($value);
		echo form_hidden('users[]', $get->ID_user);
?>
		  	<div class="form-group col-md-12">
		    	<label for="full_name[]" class="col-sm-2 control-label">Nama Lengkap</label>
		    	<div class="col-sm-10">
		      		<input type="text" class="form-control" name="full_name[]" value="<?php echo $get->nama_lengkap; ?>" required="">
		    	</div>
		  	</div>
		  	<div class="form-group col-md-12">
		    	<label for="email[]" class="col-sm-2 control-label">Alamat E-mail</label>
		    	<div class="col-sm-10">
		      		<input type="email" class="form-control" name="email[]" value="<?php echo $get->email; ?>" required="">
		    	</div>
		  	</div>
		  	<div class="form-group col-md-12">
		    	<label for="access[]" class="col-sm-2 control-label">Hak Akses</label>
		    	<div class="col-sm-10">
		      		<select name="access[]" id="access[]" class="form-control" required="required">
		      			<option value="">-- PILIH --</option>
		      			<option value="operator" <?php echo ($get->level=='operator') ? 'selected' : ''; ?>>Operator</option>
		      			<option value="admin" <?php echo ($get->level=='admin') ? 'selected' : ''; ?>>Administrator</option>
		      		</select>
		    	</div>
		  	</div>
		  	<div class="col-md-12"><hr></div>
	<?php  
	endforeach;
	?>
			  <div class="col-md-12">
				<div class="clearfix form-actions">
					<div class="col-md-offset-4 col-md-9">
						<button class="btn btn-info" type="submit" name="action" value="update">
							<i class="ace-icon fa fa-check bigger-110"></i>Simpan Perubahan
						</button>
						<a href="<?php echo site_url('user') ?>" class="btn" type="reset" style="margin-left: 100px;">
							<i class="ace-icon fa fa-undo bigger-110"></i> Kembali
						</a>
					</div>
				</div>
			  </div>
<?php 
else :
	$this->template->alert(
		' Tidak ada yang terpilih.', 
		array('type' => 'warning','icon' => 'info')
	);
	redirect('user');
endif;
echo form_close(); 
?>
		</div>
	</div>

</div>