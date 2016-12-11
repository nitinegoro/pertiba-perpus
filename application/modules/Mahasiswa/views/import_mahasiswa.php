<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row">
	<div class="col-md-10 col-md-offset-1"><?php echo $this->session->flashdata('alert'); ?></div>	
	<div class="col-md-10 col-md-offset-1" style="margin-top: 40px;">
<?php  
echo form_open_multipart(site_url('mahasiswa/set_import'), array('id' => 'form-import-mahasiswa'));
?>
		<div id="pro" class="loader hide"></div>
		<div id="alert"></div>
		<div class="form-group col-md-12" style="margin-top: 50px;">
	  		<label for="" class="col-sm-2 control-label">File (Excel)</label>
	  		<div class="col-sm-8">
	    		<input name="excel" type="file" id="file-excel" required="" />
	    		<p class="help-block">File harus berektensi Microsoft Excel 2007 Worksheet (.xlsx).</p>
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
/* End of file import_mahasiswa.php */
/* Location: ./application/modules/Mahasiswa/views/import_mahasiswa.php */
?>