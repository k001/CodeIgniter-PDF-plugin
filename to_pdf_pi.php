<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Try increasing memory available, mostly for PDF generation
 */
ini_set('memory_limit','64M');

function pdf_create($html, $filename, $stream=TRUE) 
{
	include(APPPATH.'config/to_pdf'.EXT);
	if (isset($to_pdf))
	{
		$this->path = $to_pdf['path'];
	}
	require_once(BASEPATH.'plugins/dompdf/dompdf_config.inc.php'); 
	
	$dompdf = new DOMPDF();
	$dompdf->set_paper('letter', 'portrait'); 
	$dompdf->load_html($html);
	$dompdf->render();
	
	if ($stream)
	{
		$dompdf->stream($filename.'.pdf');
	}
	write_file($this->config.$filename.'.pdf', $dompdf->output());
}
?>
