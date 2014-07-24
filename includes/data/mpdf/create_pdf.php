<?php
if(isset($_GET["html_ricetta"]) && !empty($_GET["html_ricetta"]) ) {

$html = $_GET["html_ricetta"];
$html = explode("@@@@", $html);

$stringa = "";

foreach ($html as $key =>$value) {
	if($key == 0) {
		$stringa = $stringa."<h1>".$value."</h1><hr />";
	} else if ($key != 0 && $key !=(count($html)-1)){
		$substringa =  substr($value, 0, 4);

		if ($substringa == "Fase") {
			$stringa = $stringa."<h2>".$value."</h2><br>";
		} else {
			$stringa = $stringa."<p class='elemento'>".$value."</p><br>";
		}
	} else {
		$stringa = $stringa."<h4>".$value." g</h4>";
	}
}

$header = '
<table width="100%" style="vertical-align: bottom;"><tr>
<td width="33%"></td>
<td width="33%" align="center"></td>
<td width="33%" align="right"><img src="arc.png" width="70px" /></td>
</tr></table>
';



//==============================================================
//==============================================================
//==============================================================

include("mpdf.php");

$mpdf=new mPDF(); 
$stylesheet = file_get_contents('pdf_style.css');
$mpdf->SetHTMLHeader($header);
$mpdf->SetHTMLHeader($headerE,'E');
$mpdf->WriteHTML($stylesheet,1);
$mpdf->WriteHTML($stringa);
$mpdf->Output('Ricetta.pdf','D');
exit;

//==============================================================
//==============================================================
//==============================================================

}
?>