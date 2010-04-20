<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Try increasing memory available, mostly for PDF generation
 */
ini_set('memory_limit','64M');
include(APPPATH.'config/to_pdf'.EXT);
include(APPPATH.'plugins/dompdf/dompdf_config.inc'.EXT); 


function pdf_create($html, $filename, $stream=TRUE) 
{	
	if (isset($to_pdf))
	{
		$path = $to_pdf['path'];
	}	
	$dompdf = new DOMPDF();
	$dompdf->set_paper('letter', 'portrait'); 
	$dompdf->load_html($html);
	$dompdf->render();
	
	if ($stream)
	{
		$dompdf->stream($filename.'.pdf');
	}
	write_file($path.$filename.'.pdf', $dompdf->output());
}
?>
