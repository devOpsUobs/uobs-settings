<?php
require 'vendor/autoload.php';
use Spipu\Html2Pdf\Html2Pdf;
$html2pdf = new Html2Pdf();


    $resume = '
    <style>
    table {
        width: 100%;
        border-collapse: collapse;
    }
    th, td {
        border: 1px solid;
        text-align: center;
        word-wrap: break-word;
        white-space: normal;
        word-break: break-all;
    }
</style>
<table>
    <tr>
        <th>S.No</th>
        <th>Name</th>
        <th>Father Name</th>
        <th>CNIC</th>
        <th>Designation</th>
        <th>Picture</th>
    </tr>';
    foreach($employees as $emp)
    {
        if(file_exists("newfiles/hr/pictures/".$emp["picture"]))
            $pathToFile = "newfiles/hr/pictures/".$emp["picture"];
        else
            $pathToFile = "newfiles/jobs/pictures/pic.jpg";

        $sno++;
        $resume .='
        <tr>
            <td style="width:10%">'.$sno.'</td>
            <td style="width:15%">'.$emp["first_name"].' '.$emp["last_name"].'</td>
            <td style="width:15%">'.$emp["fname"].'</td>
            <td style="width:20%">'.$emp["cnic"].'</td>
            <td style="width:20%">'.$emp["designation"].'</td>
            <td style="width:20%">
                <img src="'.$pathToFile.'" alt="" class="img-thumbnail mx-auto d-block rounded-circle" 
                    style="width:150px; height:150px">
            </td>
        </tr>';
    }
    $resume .='
</table>';


$html2pdf->writeHTML($resume);
$html2pdf->shrink_tables_to_fit = 1;
$html2pdf->Output($_SERVER['DOCUMENT_ROOT'] .'uobs-settings/'.$folder_path.'/'.$file_name.'.pdf', 'F');
// $html2pdf->Output($_SERVER['DOCUMENT_ROOT'] . 'jobs/'.$folder_path.'resume.pdf', 'F');



