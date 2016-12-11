		<div class="main-container ace-save-state" id="main-container">
			<script type="text/javascript">
				try{ace.settings.loadState('main-container')}catch(e){}
			</script>

			<div id="sidebar" class="sidebar h-sidebar navbar-collapse collapse ace-save-state sidebar-fixed">
				<script type="text/javascript">
					try{ace.settings.loadState('sidebar')}catch(e){}
				</script>
				<ul class="nav nav-list">
					<li class="<?php echo active_link_controller('main'); ?> hover">
						<a href="<?php echo site_url('main') ?>">
							<i class="menu-icon fa fa-tachometer"></i>
							<span class="menu-text"> Dashboard </span>
						</a>

						<b class="arrow"></b>
					</li>

					<li class="<?php echo active_link_controller('mahasiswa'); ?> hover">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-users"></i>
							<span class="menu-text">
								Mahasiswa
							</span>
							<b class="arrow fa fa-angle-down"></b>
						</a>
						<b class="arrow"></b>
						<ul class="submenu">
							<li class="hover <?php echo active_link_method('index', 'mahasiswa'); ?>">
								<a href="<?php echo site_url('mahasiswa') ?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Data Mahasiswa
								</a>
								<b class="arrow"></b>
							</li>
							<li class="hover <?php echo active_link_method('add', 'mahasiswa'); ?>">
								<a href="<?php echo site_url('mahasiswa/add') ?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Tambah Mahasiswa
								</a>
								<b class="arrow"></b>
							</li>
							<li class="hover <?php echo active_link_method('import', 'mahasiswa'); ?>">
								<a href="<?php echo site_url('mahasiswa/import') ?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Import Mahasiswa
								</a>
								<b class="arrow"></b>
							</li>
						</ul>
					</li>

					<li class="<?php echo active_link_controller('aahasiswa'); ?> hover">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-exchange"></i>
							<span class="menu-text">
								Transaksi
							</span>
							<b class="arrow fa fa-angle-down"></b>
						</a>
						<b class="arrow"></b>
						<ul class="submenu">
							<li class="hover <?php echo active_link_method('index', 'pengajuan'); ?>">
								<a href="">
									<i class="menu-icon fa fa-caret-right"></i>
									Presensi
								</a>
								<b class="arrow"></b>
							</li>
							<li class="hover <?php echo active_link_method('index', 'pengajuan'); ?>">
								<a href="">
									<i class="menu-icon fa fa-caret-right"></i>
									Peminjaman
								</a>
								<b class="arrow"></b>
							</li>
							<li class="hover <?php echo active_link_method('create', 'pengajuan'); ?>">
								<a href="">
									<i class="menu-icon fa fa-caret-right"></i>
									Pengembalian
								</a>
								<b class="arrow"></b>
							</li>
							<li class="hover <?php echo active_link_method('create', 'pengajuan'); ?>">
								<a href="">
									<i class="menu-icon fa fa-caret-right"></i>
									Kehilangan
								</a>
								<b class="arrow"></b>
							</li>
						</ul>
					</li>

					<li class="<?php echo active_link_controller('inventori'); ?> hover">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-book"></i>
							<span class="menu-text"> Master Buku </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>
						<b class="arrow"></b>
						<ul class="submenu">
							<li class="hover ">
								<a href="<?php echo site_url('inventori') ?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Daftar Buku
								</a>
								<b class="arrow"></b>
							</li>
							<li class="hover <?php echo active_link_method('category'); ?>">
								<a href="">
									<i class="menu-icon fa fa-caret-right"></i>
									Tambah Buku
								</a>
								<b class="arrow"></b>
							</li>
							<li class="hover <?php echo active_link_method('condition'); ?>">
								<a href="">
									<i class="menu-icon fa fa-caret-right"></i>
									Import Data Buku
								</a>
								<b class="arrow"></b>
							</li>
							<li class="hover ">
								<a href="<?php echo site_url('inventori') ?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Kategori Buku
								</a>
								<b class="arrow"></b>
							</li>
						</ul>
					</li>

					<li class="<?php echo active_link_controller('inventori'); ?> hover">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-bar-chart"></i>
							<span class="menu-text"> Laporan </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>
						<b class="arrow"></b>
						<ul class="submenu">
							<li class="hover ">
								<a href="
									<i class="menu-icon fa fa-caret-right"></i>
									Laporan Presensi
								</a>
								<b class="arrow"></b>
							</li>
							<li class="hover <?php echo active_link_method('category'); ?>">
								<a href="">
									<i class="menu-icon fa fa-caret-right"></i>
									Laporan Peminjaman
								</a>
								<b class="arrow"></b>
							</li>
							<li class="hover <?php echo active_link_method('category'); ?>">
								<a href="">
									<i class="menu-icon fa fa-caret-right"></i>
									Laporan Pengembalian
								</a>
								<b class="arrow"></b>
							</li>
							<li class="hover <?php echo active_link_method('condition'); ?>">
								<a href="">
									<i class="menu-icon fa fa-caret-right"></i>
									Laporan Buku Hilang
								</a>
								<b class="arrow"></b>
							</li>
							<li class="hover <?php echo active_link_method('category'); ?>">
								<a href="">
									<i class="menu-icon fa fa-caret-right"></i>
									Laporan Denda
								</a>
								<b class="arrow"></b>
							</li>
						</ul>
					</li>
	<?php  
	// untuk fitur administrator
	if($this->session->userdata('user')->level == 'admin') :
	?>
					<li class="hover <?php echo active_link_controller('user') ?>">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-wrench"></i>
							<span class="menu-text"> Pengaturan </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="hover <?php echo active_link_method('index', 'user'); ?>">
								<a href="<?php echo site_url('user') ?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Data Pengguna
								</a>

								<b class="arrow"></b>
							</li>

							<li class="hover <?php echo active_link_method('adduser'); ?>">
								<a href="<?php echo site_url('user/adduser') ?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Tambah Pengguna
								</a>

								<b class="arrow"></b>
							</li>

							<li class="hover <?php echo active_link_method('divisi'); ?>">
								<a href="">
									<i class="menu-icon fa fa-caret-right"></i>
									Pengaturan Aplikasi
								</a>

								<b class="arrow"></b>
							</li>
						</ul>
					</li>
	<?php  
	endif;
	?>
				</ul><!-- /.nav-list -->
			</div>

			<div class="main-content">
				<div class="main-content-inner">
					<div class="page-content">
						<div class="ace-settings-container" id="ace-settings-container" style="margin-top: 50px;">
							<div class="btn btn-app btn-xs btn-warning ace-settings-btn" id="ace-settings-btn">
								<i class="ace-icon fa fa-cog bigger-130"></i>
							</div>

							<div class="ace-settings-box clearfix" id="ace-settings-box">
								<div class="pull-left width-50">

									<div class="ace-settings-item">
										<input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-navbar" autocomplete="off" />
										<label class="lbl" for="ace-settings-navbar"> Fixed Navbar</label>
									</div>

									<div class="ace-settings-item">
										<input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-sidebar" autocomplete="off" />
										<label class="lbl" for="ace-settings-sidebar"> Fixed Sidebar</label>
									</div>

									<div class="ace-settings-item">
										<input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-breadcrumbs" autocomplete="off" />
										<label class="lbl" for="ace-settings-breadcrumbs"> Fixed Breadcrumbs</label>
									</div>

									<div class="ace-settings-item">
										<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-rtl" autocomplete="off" />
										<label class="lbl" for="ace-settings-rtl"> Right To Left (rtl)</label>
									</div>

									<div class="ace-settings-item">
										<input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-add-container" autocomplete="off" />
										<label class="lbl" for="ace-settings-add-container">
											Inside
											<b>.container</b>
										</label>
									</div>
								</div><!-- /.pull-left -->

								<div class="pull-left width-50">
									<div class="ace-settings-item">
										<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-hover" autocomplete="off" />
										<label class="lbl" for="ace-settings-hover"> Submenu on Hover</label>
									</div>

									<div class="ace-settings-item">
										<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-compact" autocomplete="off" />
										<label class="lbl" for="ace-settings-compact"> Compact Sidebar</label>
									</div>

									<div class="ace-settings-item">
										<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-highlight" autocomplete="off" />
										<label class="lbl" for="ace-settings-highlight"> Alt. Active Item</label>
									</div>
								</div><!-- /.pull-left -->
							</div><!-- /.ace-settings-box -->
						</div><!-- /.ace-settings-container -->

<div class="page-header">
<?php  
/**
 * Generated Page Title
 *
 * @return string
 **/
	echo $page_title;
?>
<?php 
/**
 * Generate Breadcrumbs from library
 *
 * @var string
 **/
	echo $breadcrumb; 
?>
</div><!-- /.page-header -->
				

