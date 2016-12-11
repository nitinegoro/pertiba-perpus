<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends Application 
{
	public function __construct() 
	{
		parent::__construct();
		$this->page_title->push('Dashboard', 'Halaman Utama');
	}

	public function index()
	{
		$this->data = array(
			'title' => "Main",
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show()
		);
		$this->template->view('main/main-view', $this->data);
	}

	public function test($value='')
	{
		$this->load->library('PHPExcel','PHPExcel/IOFactory');
		$excel = new PHPExcel();
		$excel->getProperties()
					->setCreator('E-Library V.1.0.1')
					->setLastModifiedBy($this->session->userdata('user')->nama_lengkap)
					->setTitle("Laporan Perpustakaan STIE Pertiba Pangkalpinang")
					->setCategory("Export");


		$worksheet = $excel->createSheet(0);
		//$this->excel->getActiveSheet()->setTitle('Test');
		//$this->excel->getActiveSheet()->setCellValue('A1','this oke');
		$worksheet->setCellValue('A1', "Tahun");
		$worksheet->setTitle("Laporan Buku Tanah");
		$excel->setActiveSheetIndex(0);


        $objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');\
        header('Content-Disposition: attachment;filename="TEST.xlsx"');
        $objWriter->save("php://output");
	}
}

/* End of file Main.php */
/* Location: ./application/controllers/Main.php */