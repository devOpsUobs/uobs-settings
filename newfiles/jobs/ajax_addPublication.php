<?php
$i = $_REQUEST['rows'];


echo '
<tr>    
	 <td>  <input type="text" name="publ_title[]" style="width:300px" /> </td>
    <td>  <input type="text" name="journal[]" style="width:400px" /> </td>
    <td>  <input type="text" name="impact_factor[]" style="width:100px" /> </td>
	<td> <input type="button" onclick="deleteRow(this, \'tbl_publication\')" value="Delete" /> </td>
</tr>';

?>