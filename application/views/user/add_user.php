<div class="row">
	<div class="col-md-10 col-md-offset-1"><?php echo $this->session->flashdata('alert'); ?></div>
	<div class="col-md-12">
		<div class="col-md-8 col-md-offset-2">
			<div class="form-group">
				<h4>Tambah Pengguna</h4><hr>
			</div>
	<?php echo form_open(site_url("user/insert"), array('class' => 'form-horiontal', 'id' => 'create_user')); ?>
		  	<div class="form-group col-md-12">
		    	<label for="full_name" class="col-sm-2 control-label">Nama Lengkap</label>
		    	<div class="col-sm-10">
		      		<input type="text" class="form-control" name="full_name" value="" required="">
		    	</div>
		  	</div>
		  	<div class="form-group col-md-12">
		    	<label for="username" class="col-sm-2 control-label">Username</label>
		    	<div class="col-sm-10">
		      		<input type="text" class="form-control" name="username" value="" required="">
		    	</div>
		  	</div>
		  	<div class="form-group col-md-12">
		    	<label for="password" class="col-sm-2 control-label">Password</label>
		    	<div class="col-sm-10">
		      		<input type="password" class="form-control" name="password" id="password" value="" required="">
		    	</div>
		  	</div>
		  	<div class="form-group col-md-12">
		    	<label for="pass_again" class="col-sm-2 control-label">Ulangi Password</label>
		    	<div class="col-sm-10">
		      		<input type="password" class="form-control" name="pass_again" value="" required="">
		    	</div>
		  	</div>
		  	<div class="form-group col-md-12">
		    	<label for="email" class="col-sm-2 control-label">Alamat E-mail</label>
		    	<div class="col-sm-10">
		      		<input type="email" class="form-control" name="email" value="" required="">
		    	</div>
		  	</div>
		  	<div class="form-group col-md-12">
		    	<label for="access" class="col-sm-2 control-label">Hak Akses</label>
		    	<div class="col-sm-10">
		      		<select name="access" id="access" class="form-control" required="required">
		      			<option value="">-- PILIH --</option>
		      			<option value="operator">Operator</option>
		      			<option value="admin">Administrator</option>
		      		</select>
		    	</div>
		  	</div>
			  <div class="col-md-12">
				<div class="clearfix form-actions">
					<div class="col-md-offset-4 col-md-9">
						<button class="btn btn-info" type="submit">
							<i class="ace-icon fa fa-check bigger-110"></i>Simpan
						</button>
						<a href="<?php echo site_url('user') ?>" class="btn" type="reset" style="margin-left: 100px;">
							<i class="ace-icon fa fa-undo bigger-110"></i> Kembali
						</a>
					</div>
				</div>
			  </div>
	<?php echo form_close(); ?>
		</div>
	</div>

</div>