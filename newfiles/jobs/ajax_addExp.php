<?php
$i = $_REQUEST['rows'];


echo '
<tr>    
	<td>  <input type="text" name="job_title[]" style="width:250px" /> </td>
    <td>  <input type="text" name="organization[]" style="width:250px" /> </td>
    <td>  <input type="date" name="exp_from[]" style="width:180px" id="from'.$i.'" class="'.$i.'" onfocusout="calYears(this)" /> </td>
    <td>  <input type="date" name="exp_to[]" style="width:180px" id="to'.$i.'" class="'.$i.'" onfocusout="calYears(this)" />  </td>
    <td>  <input type="text" name="months[]" style="width:80px" id="months'.$i.'" readonly /> </td>
	<td> <input type="button" onclick="deleteRow(this, \'tbl_exp\')" value="Delete" /> </td>
</tr>';

?>