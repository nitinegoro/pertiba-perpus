<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row">
	<div class="col-md-10 col-md-offset-1"><?php echo $this->session->flashdata('alert'); ?></div>	
	<div class="col-md-10 col-md-offset-1" style="margin-top: 40px;">
<?php  
echo form_open_multipart(site_url("mahasiswa/update/{$get->ID}"), array('id' => 'form-update-mahasiswa', 'data-id' => $get->ID));
?>
	  <div class="form-group col-md-12">
	  	<blockquote>Data Mahasiswa  </blockquote>
	  </div>
		<div class="form-group col-md-12">
	  		<label for="" class="col-sm-3 control-label">NPM <strong class="text-danger">*</strong></label>
	  		<div class="col-sm-4">
	    		<input type="text" name="npm" class="form-control" id="" value="<?php echo $get->npm; ?>" placeholder="" required="">
	  		</div>
		</div>
		<div class="form-group col-md-12">
	  		<label for="" class="col-sm-3 control-label">Nama Lengkap <strong class="text-danger">*</strong></label>
	  		<div class="col-sm-8">
	    		<input type="text" name="nama" class="form-control" id="" placeholder="" required="" value="<?php echo $get->nama_lengkap; ?>">
	  		</div>
		</div>
		<div class="form-group col-md-12">
	  		<label for="" class="col-sm-3 control-label">Jenis Kelamin <strong class="text-danger">*</strong></label>
	  		<div class="col-sm-8">
				<div class="radio">
					<label>
						<input type="radio" name="gender" value="Laki-laki" class="ace" required="" <?php echo ($get->jenis_kelamin=='Laki-laki') ? 'checked' : ''; ?> />
						<span class="lbl"> Laki-laki</span>
					</label>
					<label>
						<input type="radio" name="gender" value="Perempuan" class="ace" required="" <?php echo ($get->jenis_kelamin=='Perempuan') ? 'checked' : ''; ?> />
						<span class="lbl"> Perempuan</span>
					</label>
				</div>
	  		</div>
		</div>
		<div class="form-group col-md-12">
	  		<label for="" class="col-sm-3 control-label">Tanggal Lahir <strong class="text-danger">*</strong></label>
	  		<div class="col-sm-4">
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-calendar bigger-110"></i></span>
					<input name="tgl_lahir" class="form-control date-picker" type="text" placeholder="Contoh : <?php echo date('Y-m-d') ?>" value="<?php echo $get->tgl_lahir; ?>" required="">
				</div>
	  		</div>
		</div>
		<div class="form-group col-md-12">
	  		<label for="" class="col-sm-3 control-label">Tahun Masuk</label>
	  		<div class="col-sm-4">
	    		<input name="thn_masuk" type="text" class="form-control" value="<?php echo $get->thn_masuk; ?>" placeholder="Contoh : 2015/2016">
	  		</div>
		</div>
		<div class="form-group col-md-12">
	  		<label for="" class="col-sm-3 control-label">Program Studi</label>
	  		<div class="col-sm-8">
	    		<input name="program" type="text" class="form-control" value="<?php echo $get->program_studi; ?>" placeholder="">
	  		</div>
		</div>
		<div class="form-group col-md-12">
	  		<label for="" class="col-sm-3 control-label">Kelas Perkuliahan</label>
	  		<div class="col-sm-8">
	    		<input name="kelas" type="text" class="form-control" value="<?php echo $get->kelas_perkuliahan; ?>" placeholder="">
	  		</div>
		</div>
		<div class="form-group col-md-12">
	  		<label for="" class="col-sm-3 control-label">Konsentrasi</label>
	  		<div class="col-sm-8">
	    		<input name="konsentrasi" type="text" class="form-control" value="<?php echo $get->konsentrasi; ?>" placeholder="">
	  		</div>
		</div>
	  <div class="form-group col-md-12" style="margin-top: 20px;">
	  	<blockquote>Data KTM  </blockquote>
	  </div>
		<div class="form-group col-md-12">
	  		<label for="" class="col-sm-3 control-label">Barcode KTM</label>
	  		<div class="col-sm-8">
	    		<input name="barcode" type="text" class="form-control" value="<?php echo $get->barcode; ?>" placeholder="">
	  		</div>
		</div>
		<div class="form-group col-md-12">

		</div>
		<div class="form-group col-md-12">
	  		<label for="" class="col-sm-3 control-label">Foto</label>
	  		<div class="col-sm-4">
	    		<input name="foto" type="file" id="id-input-file-3" />
	    		<p class="help-block">File foto maksimum 1500x2000 Pixel.</p>
	  		</div>
	  		<div class="col-sm-4 col-sm-offset-1">
	    		<img id="preview-image" src="<?php echo base_url("assets/foto-ktm/{$get->foto}"); ?>" id="preview-picture" alt="" class="img-thumbnail" width="200" height="300">
			</div>
		</div>
	    <div class="col-md-12">
	  	  	<hr>
	      	<strong class="text-danger">* </strong>: Wajib diisi!
	    </div>
	  <div class="col-md-12">
		<div class="clearfix form-actions">
			<div class="col-md-offset-4 col-md-9">
				<button class="btn btn-info" type="submit">
					<i class="ace-icon fa fa-check bigger-110"></i>Simpan 
				</button>
				<button class="btn" type="reset" style="margin-left: 100px;">
					<i class="ace-icon fa fa-undo bigger-110"></i> Reset
				</button>
			</div>
		</div>
	  </div>
<?php  
echo form_close();
?>
	</div>
</div>

<?php  
/* End of file editmahasiswa.php */
/* Location: ./application/modules/Mahasiswa/views/edit_mahasiswa.php */
?>