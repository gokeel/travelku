<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Table_export extends CI_Controller {
 
    function __construct()
    {
        parent::__construct();
		
		if ($this->session->userdata('logged_in')) {
			if ($this->session->userdata('user_level')=='administrator') {
				$this->load->model('assets');
				$this->exporter($table_name);
			}
			else if ($this->session->userdata('user_level')=='agent') {
				redirect(base_url('index.php/agent/home'));
			}
		} else {
			$this->login();
		}
		
		
        // Here you should add some sort of user validation
        // to prevent strangers from pulling your table data
    }
			
    function exporter($table_name)
    {
        $query = $this->assets->get_data($table_name);
 
        if(!$query)
            return false;
 
        // Starting the PHPExcel library
        $this->load->library('excel');
        //$this->load->library('excel/IOFactory');
 
        $objPHPExcel = new excel();
        $objPHPExcel->getProperties()->setTitle("export")->setDescription("none");
 
        $objPHPExcel->setActiveSheetIndex(0);
 
        // Field names in the first row
        $fields = $query->list_fields();
        $col = 0;
        foreach ($fields as $field)
        {
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, $field);
            $col++;
        }
 
        // Fetching the table data
        $row = 2;
        foreach($query->result() as $data)
        {
            $col = 0;
            foreach ($fields as $field)
            {
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $data->$field);
                $col++;
            }
 
            $row++;
        }
 
        $objPHPExcel->setActiveSheetIndex(0);
 
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
 
        // Sending headers to force the user to download the file
        $filename= $table_name.'.xls'; //save our workbook as this file name
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
 
        $objWriter->save('php://output');
    }
 
}