<?php
$i = $_REQUEST['rows'];


echo '
<tr>    
	<td>  <input type="text" name="dist_title[]" style="width:300px" /> </td>
    <td>  <input type="text" name="dist_desc[]" style="width:700px" /> </td>
	<td> <input type="button" onclick="deleteRow(this, \'tbl_distinction\')" value="Delete" /> </td>
</tr>';

?>